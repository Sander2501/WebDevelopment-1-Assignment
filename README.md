Here is a comprehensive README.md file for your project based on the provided source code and architecture.

Atlevia Sports - Gym & Class Booking System
Atlevia Sports is a custom MVC PHP web application that allows users to book gym sessions, reserve spots in fitness classes, manage their profiles, and read fitness blogs written by expert trainers.

🚀 Features
User Authentication: Secure registration and login system with password hashing.

Dashboard: Personalized user dashboard showing upcoming schedules and recent activity.

Class & Gym Booking: * Book specific classes led by trainers (e.g., Yoga, HIIT, Boxing).

Schedule independent "Open Gym" sessions.

Prevent booking conflicts and overlaps.

Trainer Blogs: View trainer profiles, read their fitness blogs, and contact them directly via a secure form.

Profile Management: Update personal details, change email/password, and securely delete accounts.

RESTful API: Includes API endpoints (/api/bookings) for asynchronous front-end interactions.

🛠️ Tech Stack
Backend: PHP 8 (Custom MVC Architecture)

Database: MariaDB / MySQL

Frontend: HTML5, vanilla JavaScript, CSS3, Bootstrap 5 (Bootswatch Lux theme)

Server: Nginx

Containerization: Docker & Docker Compose

📁 Project Structure
The application follows a clean MVC (Model-View-Controller) architecture utilizing the Repository and Service patterns for better separation of concerns:

Plaintext
├── app/
│   ├── public/             # Web root (index.php, CSS, JS)
│   └── src/
│       ├── Config/         # Database configuration
│       ├── Controllers/    # Request handling and routing logic
│       ├── Framework/      # Base classes and helper functions
│       ├── Models/         # Data entities (User, Booking, Class, Trainer, BlogPost)
│       ├── Repositories/   # Database interaction and queries
│       ├── Services/       # Business logic and validation
│       └── Views/          # UI templates (HTML/PHP)
├── sql/                    # Database initialization scripts
├── docker-compose.yml      # Docker services configuration
├── nginx.conf              # Nginx server configuration
└── PHP.Dockerfile          # Custom PHP-FPM image setup
⚙️ Prerequisites
To run this application, you will need:

Docker

Docker Compose

🚀 Installation & Setup
Clone the repository (or navigate to the project directory):

Bash
cd Webdevelopment
Start the Docker containers:
Run the following command to build the PHP image and start the Nginx, PHP, MySQL, and phpMyAdmin containers in the background.

Bash
docker-compose up -d --build
Access the Application:
Once the containers are up and running, the database will be automatically seeded with sample data, trainers, classes, and blogs.

Web Application: http://localhost

phpMyAdmin: http://localhost:8080

Testing the App:
You can register a new account from the home page or use one of the pre-seeded users (check phpMyAdmin for existing email addresses, or simply create your own).

🗄️ Database Configuration
If you need to connect to the database manually or adjust settings, the default credentials defined in docker-compose.yml are:

Host: mysql (or localhost outside of Docker)

Database: developmentdb

User: developer

Password: secret123

Port: 3306

🛑 Stopping the Application
To stop the running containers without destroying your database data:

Bash
docker-compose stop
To stop the containers and remove the volumes (this will erase your database data):

Bash
docker-compose down -v
