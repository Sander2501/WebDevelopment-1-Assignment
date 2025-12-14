document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('bookingForm');
  if (!form) return;

  form.addEventListener('submit', async (e) => {
    e.preventDefault();

    const payload = {
      class_id: form.class_id.value ? Number(form.class_id.value) : null,
      start_at: form.start_at.value,
      end_at:   form.end_at.value
    };

    const res = await fetch('/api/bookings', {
      method: 'POST',
      headers: {'Content-Type': 'application/json'},
      body: JSON.stringify(payload)
    });

    const data = await res.json();
    if (!res.ok) { alert(data.error || 'Booking failed'); return; }

    const ul = document.getElementById('myBookings');
    if (ul) {
      const r = await fetch('/api/bookings');
      const list = await r.json();
      ul.innerHTML = '';
      list.forEach(b => {
        const li = document.createElement('li');
        li.textContent = `${b.start_at} – ${b.end_at}: ${b.class_name}`;
        ul.appendChild(li);
      });
    } else {
      window.location.href = '/bookings';
    }
  });
});
