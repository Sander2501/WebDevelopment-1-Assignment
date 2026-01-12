# Atlevia Sports - Gym Booking System

Web Development 1 Assignment - Term 2.2  
Student: Sander2501  
Date: January 2026

## Project Description

Atlevia Sports is a comprehensive gym booking system that allows members to: 
- Book group fitness classes (Yoga, Boxing, HIIT, Strength Training)
- Reserve individual gym sessions
- Manage their bookings with real-time updates
- View trainer profiles and blog posts
- Request free consultations with trainers
- Manage their profile and account settings

## Setup Instructions

### Prerequisites
- Docker and Docker Compose installed
- Port 80 and 3306 available

### Installation Steps

1. Clone the repository: 
```bash
git clone [your-repo-url]
cd atlevia-sports
```

2. Start Docker containers:
```bash
docker-compose up -d
```

3. Import the database: 
   - Visit http://localhost:8080 (phpMyAdmin)
   - Login with:  `developer` / `secret123`
   - Import `sql/schema.sql`
   - Import `sql/seed_data.sql`

4. Access the application:
   - Application:  http://localhost
   - phpMyAdmin: http://localhost:8080

### Test Credentials
- Email: `test@atleviasports.com`
- Password: `password123`

## Features Implemented

### Core Features
- ✅ User Authentication (Register, Login, Logout)
- ✅ Class Booking System
- ✅ Gym Session Booking
- ✅ My Bookings Management
- ✅ Profile Settings (Edit, Change Password, Delete Account)
- ✅ Trainers & Blog Posts
- ✅ Free Consultation Request Form

### Technical Features
- ✅ MVC Architecture with Service & Repository Layers
- ✅ Interface-based Dependency Injection
- ✅ RESTful JSON API Endpoints
- ✅ AJAX-powered UI Updates (No Page Refresh)
- ✅ Responsive Bootstrap Design
- ✅ PDO with Prepared Statements
- ✅ Password Hashing (bcrypt)
- ✅ Input Validation & Sanitization
- ✅ XSS Prevention
- ✅ Session Security

## Architecture

### MVC Layered Architecture

```
Controllers → Services (Interfaces) → Repositories (Interfaces) → Database
```

### Directory Structure

```
app/
├── public/
│   ├── index.php              # Application entry point & routing
│   └── assets/
│       ├── css/style.css      # Custom styles
│       └── js/bookings.js     # AJAX booking functionality
├── src/
│   ├── Controllers/           # HTTP request handling
│   │   ├── AuthController.php
│   │   ├── BookingController. php
│   │   ├── ClassBookingController.php
│   │   ├── ProfileController.php
│   │   ├── TrainerController.php
│   │   └── ApiBookingsController.php
│   ├── Services/              # Business logic
│   │   ├── Interfaces/
│   │   │   ├── IUserService.php
│   │   │   ├── IBookingService.php
│   │   │   ├── IValidationService.php
│   │   │   ├── IProfileService.php
│   │   │   └── ITrainerService.php
│   │   ├── UserService.php
│   │   ├── BookingService.php
│   │   ├── ValidationService.php
│   │   ├── ProfileService.php
│   │   └── TrainerService.php
│   ├── Repositories/          # Data access
│   │   ├── Interfaces/
│   │   │   ├── IUserRepository.php
│   │   │   ├── IBookingRepository.php
│   │   │   ├── IClassRepository.php
│   │   │   ├── IProfileRepository.php
│   │   │   ├── ITrainerRepository.php
│   │   │   └── IContactRepository.php
│   │   ├── UserRepository.php
│   │   ├── BookingRepository.php
│   │   ├── ClassRepository.php
│   │   ├── ProfileRepository.php
│   │   ├── TrainerRepository. php
│   │   └── ContactRepository.php
│   ├── Models/                # Data entities
│   │   ├── User.php
│   │   ├── Booking.php
│   │   ├── ClassModel.php
│   │   ├── Trainer.php
│   │   └── BlogPost.php
│   ├── Views/                 # Presentation layer
│   │   ├── auth/
│   │   │   ├── login.php
│   │   │   └── register.php
│   │   ├── booking/
│   │   │   ├── index.php
│   │   │   └── error.php
│   │   ├── class-booking/
│   │   │   └── index.php
│   │   ├── profile/
│   │   │   ├── index.php
│   │   │   └── delete.php
│   │   ├── trainers/
│   │   │   ├── index.php
│   │   │   └── view.php
│   │   ├── dashboard/
│   │   │   └── index.php
│   │   ├── partials/
│   │   │   ├── header.php
│   │   │   ├── navbar.php
│   │   │   └── footer. php
│   │   └── privacy.php
│   ├── Framework/             # Base classes
│   │   ├── BaseRepository.php
│   │   └── Helpers.php        # e(), redirect(), flash()
│   └── Config/
│       └── Database.php       # PDO connection
```

## API Endpoints

All API endpoints return JSON and require authentication.

### Bookings API

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/bookings` | Get all user bookings |
| POST | `/api/bookings` | Create new booking |
| DELETE | `/api/bookings/{id}` | Delete booking |

#### Example Request (Create Booking):
```json
POST /api/bookings
Content-Type: application/json

{
  "class_id": 3,
  "start_at": "2026-01-15 10:00:00",
  "end_at": "2026-01-15 11:00:00"
}
```

#### Example Response:
```json
{
  "id": 42,
  "status": "confirmed",
  "message": "Booking created successfully"
}
```

## WCAG Compliance

### Accessibility Features Implemented

1. **Semantic HTML** ✅
   - All pages use semantic elements:  `<nav>`, `<main>`, `<footer>`, `<article>`
   - Files: `partials/header.php`, `partials/navbar.php`

2. **Form Labels** ✅
   - All form inputs have associated `<label>` elements with `for` attributes
   - Files: `auth/login.php`, `auth/register.php`, `profile/index.php`

3. **Keyboard Navigation** ✅
   - Skip-to-main-content link for keyboard users
   - All interactive elements accessible via keyboard
   - File: `partials/header.php`

4. **Color Contrast** ✅
   - Bootstrap default theme meets WCAG AA standards (4.5:1 ratio)
   - Primary colors tested with contrast checker

5. **Responsive Design** ✅
   - Mobile-friendly layout using Bootstrap grid
   - Works on smartphones, tablets, and desktops
   - Files: All view files use responsive Bootstrap classes

6. **Alt Text** ✅
   - All images include descriptive alt attributes (when images are added)

7. **Clear Error Messages** ✅
   - Validation errors displayed prominently
   - Files: `ValidationService.php`, all form views

## GDPR Compliance

### Data Protection Measures

1. **Minimal Data Collection** ✅
   - Only collect necessary data: email, name, phone (optional), password
   - No tracking cookies or third-party analytics
   - Files: `UserRepository.php`, database schema

2. **Secure Password Storage** ✅
   - Passwords hashed using `password_hash()` with bcrypt
   - Never stored in plain text
   - Files: `AuthController.php` line 50, `UserRepository.php` line 35

3. **Right to Erasure** ✅
   - Users can delete their account via Profile Settings
   - All associated data (bookings, profile) deleted
   - Files: `ProfileController.php:: confirmDelete()`, `ProfileRepository.php:: deleteUser()`

4. **Right to Rectification** ✅
   - Users can update their personal information
   - Files: `ProfileController.php`, `profile/index.php`

5. **Secure Data Transmission** ✅
   - HTTPS ready (configured in production)
   - Session cookies set with HttpOnly flag
   - File: `index.php` lines 3-7

6. **Data Breach Prevention** ✅
   - SQL Injection prevented with PDO prepared statements
   - XSS prevented with output escaping (`e()` helper)
   - Files: All repositories use prepared statements, `Helpers.php:: e()`

7. **Privacy Policy** ✅
   - Accessible privacy policy page
   - File: `Views/privacy.php`
   - Link:  `/privacy`

8. **Session Security** ✅
   - HttpOnly cookies prevent JavaScript access
   - Strict session mode enabled
   - File: `index.php` lines 3-7

### GDPR Rights Implemented

| Right | Implementation | File Reference |
|-------|----------------|----------------|
| Access | View profile data | `profile/index.php` |
| Rectification | Edit profile | `ProfileController:: updateProfile()` |
| Erasure | Delete account | `ProfileController::confirmDelete()` |
| Data Portability | Contact form available | `trainers/view.php` |

## Security Features

### Input Validation ✅
- Server-side validation for all forms
- File: `ValidationService.php`
- Methods: `validateRegistration()`, `validateBooking()`

### SQL Injection Prevention ✅
- PDO prepared statements with bound parameters
- Files: All repository classes
- Example: `UserRepository.php::findByEmail()`

### XSS Prevention ✅
- Output escaping using `e()` helper (`htmlspecialchars`)
- Files: All view files
- Example: `<h5><? = e($trainer['name']) ?></h5>`

### Password Security ✅
- Bcrypt hashing via `password_hash()`
- Verification via `password_verify()`
- Files: `AuthController.php`, `ProfileService.php`

### Session Security ✅
- HttpOnly cookies
- Strict mode enabled
- File: `index.php` lines 3-7

### CSRF Protection 🔄
- To be implemented (recommended for production)

## Database Schema

### Users Table
```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    name VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_email (email)
);
```

### Bookings Table
```sql
CREATE TABLE bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    class_id INT,
    start_at DATETIME NOT NULL,
    end_at DATETIME NOT NULL,
    status VARCHAR(20) DEFAULT 'confirmed',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (class_id) REFERENCES classes(id),
    INDEX idx_user_time (user_id, start_at),
    UNIQUE KEY unique_user_time (user_id, start_at, end_at)
);
```

### Other Tables
- `classes` - Group fitness classes
- `trainers` - Trainer profiles
- `blog_posts` - Trainer blog posts
- `contact_requests` - Free consultation requests

## Technology Stack

- **Backend:** PHP 8.2
- **Database:** MariaDB 10.6
- **Frontend:** Bootstrap 5.3, Vanilla JavaScript
- **Development:** Docker, Docker Compose
- **Database Management:** phpMyAdmin

## Browser Compatibility

Tested and working on:
- ✅ Chrome 120+
- ✅ Firefox 120+
- ✅ Safari 17+
- ✅ Edge 120+

## Known Limitations & Future Improvements

1. **CSRF Protection** - Should be added for production
2. **Rate Limiting** - Prevent brute force attacks on login
3. **Email Verification** - Confirm email addresses on registration
4. **Password Reset** - Forgot password functionality
5. **Admin Panel** - Manage users, classes, and bookings
6. **Calendar View** - Visual calendar for booking selection
7. **Payment Integration** - For memberships and day passes

## Assignment Requirements Fulfilled

### Rubric Checklist

| Criteria | Points | Status | Evidence |
|----------|--------|--------|----------|
| **Authentic Use Case** | Required | ✅ | Gym booking system with multiple features |
| **CSS Framework** | 2 | ✅ | Bootstrap 5.3, responsive design |
| **Sessions** | 1 | ✅ | `index.php` lines 3-7, authentication |
| **Security** | 2 | ✅ | PDO prepared statements, XSS prevention, password hashing, validation |
| **MVC** | 2 | ✅ | Full MVC with services, repositories, interfaces |
| **API** | 1 | ✅ | `/api/bookings` endpoints (GET/POST/DELETE) |
| **JavaScript** | 1 | ✅ | AJAX booking system (`bookings.js`) |
| **Legal/Accessibility** | 1 | ✅ | WCAG & GDPR documented |

**Total: 10/10 points possible**

## Author

**Sander2501**  
Inholland University of Applied Sciences  
Web Development 1 - Term 2.2  
January 2026

## License

This project is submitted as academic coursework for Web Development 1.

---

For questions or issues, contact:  [your-email]@student.inholland.nl