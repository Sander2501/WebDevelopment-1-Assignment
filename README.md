# Atlevia Sports — Gym & Class Booking System

Atlevia Sports is a custom MVC PHP web application that allows users to book gym sessions, reserve spots in fitness classes, manage their profiles, and read fitness blogs written by expert trainers.

## Features

- **User Authentication**
  - Secure registration and login
  - Password hashing

- **Dashboard**
  - Personalized dashboard with upcoming schedules and recent activity

- **Class & Gym Booking**
  - Book trainer-led classes (e.g., Yoga, HIIT, Boxing)
  - Schedule independent **Open Gym** sessions
  - Prevent booking conflicts and time overlaps

- **Trainer Blogs**
  - View trainer profiles
  - Read trainer-written fitness blogs
  - Contact trainers via a secure form

- **Profile Management**
  - Update personal details
  - Change email/password
  - Securely delete accounts

- **RESTful API**
  - API endpoints for asynchronous interactions (e.g. `/api/bookings`)

## Tech Stack

- **Backend:** PHP 8 (Custom MVC Architecture)
- **Database:** MariaDB / MySQL
- **Frontend:** HTML5, Vanilla JavaScript, CSS3, Bootstrap 5 (Bootswatch Lux theme)
- **Server:** Nginx
- **Containerization:** Docker & Docker Compose

## Project Structure

```text
.
├── app/
│   ├── public/                 # Web root (index.php, CSS, JS)
│   └── src/
│       ├── Config/             # Database configuration
│       ├── Controllers/        # Request handling and routing logic
│       ├── Framework/          # Base classes and helper functions
│       ├── Models/             # Data entities (User, Booking, Class, Trainer, BlogPost)
│       ├── Repositories/       # Database interaction and queries
│       ├── Services/           # Business logic and validation
│       └── Views/              # UI templates (HTML/PHP)
├── sql/                        # Database initialization scripts
├── docker-compose.yml          # Docker services configuration
├── nginx.conf                  # Nginx server configuration
└── PHP.Dockerfile              # Custom PHP-FPM image setup
```

## Prerequisites

- Docker
- Docker Compose

## Installation & Setup (Docker)

1. **Clone the repository** (or navigate to your project folder):
   ```bash
   cd Webdevelopment
   ```

2. **Build and start the containers:**
   ```bash
   docker-compose up -d --build
   ```

3. **Access the application:**
   - Web Application: http://localhost  
   - phpMyAdmin: http://localhost:8080

> The database is automatically initialized and seeded with sample data (trainers, classes, blogs) when the containers start.

## Test Accounts / Usage

- You can register a new account from the home page, **or**
- Use one of the pre-seeded users (check phpMyAdmin for existing email addresses)

## Database Configuration

Default credentials (from `docker-compose.yml`):

- **Host:** `mysql` (or `localhost` outside Docker)
- **Database:** `developmentdb`
- **User:** `developer`
- **Password:** `secret123`
- **Port:** `3306`

## API

Example endpoints:
- `GET /api/bookings`
- `POST /api/bookings`

> Adjust this section to list all available endpoints, required fields, and example responses if you want a more complete API reference.

## Stopping the Application

Stop containers without deleting data:
```bash
docker-compose stop
```

Stop containers and remove volumes (**this deletes database data**):
```bash
docker-compose down -v
```

## Security Notes

- Passwords are stored securely using hashing.
- Use environment variables/secrets for credentials in production deployments.

## License

Add your license here (e.g., MIT), or remove this section if not applicable.
