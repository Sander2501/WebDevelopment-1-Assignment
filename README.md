# Atlevia Sports – Gym Booking System

A simple gym booking web application built with PHP (MVC), Bootstrap 5, and MySQL.

## Login Details

A test user is already available in the database:

*   Email: test@user.com
*   Password: password123
* You can also create a new account through the website.

## How to Run the Project

The project uses Docker.

Start the containers:

* docker-compose up -d

Open the website:

* http://localhost

## Database Setup

The database is imported automatically on first startup.

SQL file: sql/developmentdb.sql

Import method: Mounted to /docker-entrypoint-initdb.d

* phpMyAdmin: http://localhost:8080

* Username: developer

* Password: secret123

## Application Features

MVC structure with Controllers, Services, and Repositories

Gym booking system with users, classes, trainers, and bookings

Secure login system

PDO prepared statements

Passwords hashed with password_hash

Output escaping to prevent XSS

Responsive design using Bootstrap 5

AJAX booking actions without page reload

API endpoint: /api/bookings (JSON)

## Legal & Accessibility
GDPR

Users can edit or delete their account

Privacy Policy page included

Accessibility

Semantic HTML
