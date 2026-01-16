document.addEventListener('DOMContentLoaded', function () {
    const bookingForms = document.querySelectorAll('.booking-form');
    bookingForms.forEach(form => {
        form.addEventListener('submit', handleBookingSubmit);
    });

    const deleteButtons = document.querySelectorAll('.delete-booking-btn');
    deleteButtons.forEach(btn => {
        btn.addEventListener('click', handleBookingDelete);
    });
});

async function handleBookingSubmit(e) {
    e.preventDefault();

    const form = e.target;
    const formData = new FormData(form);

    const bookingData = {
        class_id: formData.get('class_id') ? parseInt(formData.get('class_id')) : null,
        start_at: formData.get('start_at'),
        end_at: formData.get('end_at')
    };

    const submitButton = form.querySelector('button[type="submit"]');
    const originalText = submitButton.textContent;
    submitButton.disabled = true;
    submitButton.textContent = 'Booking...';

    try {
        const response = await fetch('/api/bookings', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(bookingData)
        });
        const result = await response.json();

        if (response.ok) {
            showSuccess('Booking created successfully!');
            submitButton.textContent = 'Booked!';
            submitButton.classList.remove('btn-primary');
            submitButton.classList.add('btn-success');
            setTimeout(() => {
                window.location.href = '/bookings';
            }, 1500);
        } else {
            showError(result.error || 'Failed to create booking');
            submitButton.disabled = false;
            submitButton.textContent = originalText;
        }
    } catch (error) {
        showError('Network error. Please try again.');
        console.error('Booking error:', error);
        submitButton.disabled = false;
        submitButton.textContent = originalText;
    }
}

async function handleBookingDelete(e) {
    e.preventDefault();

    const bookingId = e.target.dataset.bookingId;

    const button = e.target;
    const originalText = button.textContent;
    button.disabled = true;
    button.textContent = 'Deleting...';

    try {
        const response = await fetch(`/api/bookings/${bookingId}`, {
            method: 'DELETE',
            headers: { 'Content-Type': 'application/json' }
        });

        if (response.ok) {
            showSuccess('Booking deleted successfully!');
            const row = button.closest('tr');
            if (row) {
                row.style.opacity = '0.5';
                setTimeout(() => {
                    row.remove();
                    checkEmptyBookings();
                }, 500);
            }
        } else {
            const result = await response.json();
            showError(result.error || 'Failed to delete booking');
            button.disabled = false;
            button.textContent = originalText;
        }
    } catch (error) {
        showError('Network error. Please try again.');
        console.error('Delete error:', error);
        button.disabled = false;
        button.textContent = originalText;
    }
}

function showSuccess(message) {
    showAlert(message, 'success');
}

function showError(message) {
    showAlert(message, 'danger');
}

function showAlert(message, type) {
    const existingAlert = document.querySelector('.alert-floating');
    if (existingAlert) existingAlert.remove();

    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type} alert-dismissible fade show alert-floating`;
    alertDiv.style.cssText = 'position: fixed; top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
    alertDiv.role = 'alert';
    alertDiv.innerHTML = `<strong>${type === 'success' ? '✓ Success!' : '✗ Error!'}</strong> ${message}<button type="button" class="btn-close" data-bs-dismiss="alert"></button>`;

    document.body.appendChild(alertDiv);

    setTimeout(() => {
        alertDiv.classList.remove('show');
        setTimeout(() => alertDiv.remove(), 150);
    }, 5000);
}

function checkEmptyBookings() {
    const tbody = document.querySelector('tbody');
    if (tbody && tbody.children.length === 0) {
        const table = tbody.closest('table');
        if (table) table.style.display = 'none';

        const emptyMessage = document.createElement('div');
        emptyMessage.className = 'alert alert-info';
        emptyMessage.innerHTML = '<i class="bi bi-info-circle"></i> You don\'t have any bookings yet. Go to <a href="/classes">Class Booking</a> to book one.';

        const container = tbody.closest('.card-body');
        if (container) {
            container.appendChild(emptyMessage);
        }
    }
}