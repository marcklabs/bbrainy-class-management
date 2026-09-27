# BRAINY — Class Management Web App

**BRAINY** is a PHP/MySQL web application developed to help a school class manage everyday academic activities in one place.

The project combines authentication, class announcements, appointments, an interactive calendar and an exam-booking workflow in a responsive web interface.

> This repository contains the source code of the project. It was originally developed and deployed as a school project and is published here as a portfolio/reference project.

## Features

- User registration and login
- Password hashing with PHP `password_hash()` / `password_verify()`
- Session-based authentication
- Optional "remember me" login token
- Personal appointments
- Class appointments
- Class announcements
- Interactive calendar
- Exam creation and registration
- Seat availability management
- Registration export to Excel
- User support / feedback messages
- Administrative panel
- Progressive Web App (PWA) assets and service worker
- Responsive interface for desktop and mobile

## Tech Stack

- **PHP**
- **MySQL / MariaDB**
- **HTML5**
- **CSS3**
- **JavaScript**
- **Composer**
- **PhpSpreadsheet**
- **PWA / Service Worker**

## Project Structure

```text
bbrainy/
├── index.php                  # Login / authentication
├── register.php               # User registration
├── homePage.php               # Main dashboard
├── calendar.php               # Calendar interface
├── registrationExam.html      # Exam registration interface
├── registerExam.php           # Exam registration endpoint
├── get_exams.php              # Exam data endpoint
├── fetch_events.php           # Calendar events endpoint
├── profile.php                # User profile / support
├── admin.php                  # Administrative panel
├── appointments.php            # Personal appointments
├── classappointments.php       # Class appointments
├── add_exam.php               # Create exams
├── add_announcement.php        # Create announcements
├── export_registrations.php    # Excel export
│
├── src/                       # Additional styles/assets
├── composer.json
├── composer.lock
├── config.example.php
├── .gitignore
└── LICENSE
```

## Installation

### Requirements

- PHP 8.x
- MySQL or MariaDB
- Composer
- A PHP-capable web server such as Apache or PHP's built-in development server

### 1. Clone the repository

```bash
git clone https://github.com/marckhak/bbrainy-class-management.git
cd bbrainy-class-management
```

### 2. Install PHP dependencies

```bash
composer install
```

The project uses [PhpSpreadsheet](https://github.com/PHPOffice/PhpSpreadsheet) for Excel exports.

### 3. Configure the database

Copy the example configuration:

```bash
cp config.example.php config.php
```

Then set the database connection values in `config.php`, or use the following environment variables:

```text
BBRAINY_DB_HOST
BBRAINY_DB_USER
BBRAINY_DB_PASSWORD
BBRAINY_DB_NAME
```

### 4. Database

The application expects a MySQL/MariaDB database named `my_bbrainy` by default.

A sanitized schema-only export is included at [`database/schema.sql`](database/schema.sql). It recreates the table structure, indexes and foreign-key constraints without publishing any production records, password hashes, remember tokens or other user data.

Import it with:

```bash
mysql -u YOUR_USER -p < database/schema.sql
```

The schema includes `users`, `messages`, `esami`, `registrazioni`, `announcements`, `announcements_table`, `class_appointments`, `personal_appointments`, `notification_queue` and `user_subscriptions`.

### 5. Run locally

With PHP's built-in server:

```bash
php -S localhost:8000
```

Then open:

```text
http://localhost:8000
```

## Application Architecture

The application follows a lightweight server-rendered architecture:

```text
Browser
   │
   ├── HTML / CSS / JavaScript
   │
   ▼
PHP application
   │
   ├── Authentication & sessions
   ├── Business logic
   ├── JSON endpoints
   └── Excel export
   │
   ▼
MySQL / MariaDB
```

JavaScript is used for interactive components such as the calendar and exam registration, while PHP handles server-side logic and database access.

## Authentication

Passwords are stored using PHP's password hashing API rather than plaintext passwords.

Database queries for authentication and several application workflows use prepared statements.

## Excel Export

Administrators can export exam registrations to an `.xlsx` file using **PhpSpreadsheet**.

## PWA

The project includes:

- `manifest.json`
- service worker scripts
- application icons
- mobile-oriented metadata

This allows the application to behave similarly to an installable web application on supported devices.

## Project Background

BRAINY was developed as a practical school project to solve a real organisational problem: centralising class information, appointments and exam registrations in a single web application.

The project involved both technical development and practical aspects of designing a system around the needs of a real group of users.

## Author

**Marco Francavilla**

Computer Engineering Student · University of Bologna

- GitHub: [@marckhak](https://github.com/marckhak)
- Project repository: [github.com/marckhak/bbrainy](https://github.com/marckhak/bbrainy-class-management)

## License

This project is released under the MIT License. See [`LICENSE`](LICENSE).
