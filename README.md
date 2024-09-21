# RegistrationApp

A Laravel-based application for user registration with photo upload, email notifications, and CRUD operations on a single page. The app uses queues for email processing and event listeners for sending email notifications with file attachments.

## Features

- **User Registration**: Register users with name, email, photo, and address.
- **CRUD Operations**: Create, read, update, and delete users on one page.
- **Photo Upload**: Supports image upload (JPEG/PNG).
- **Email Notifications**: Sends an email upon registration with a file attachment (user photo).
- **Event Listener**: Email notifications are triggered via Laravel event listeners.
- **Queue System**: Email notifications are sent asynchronously using Laravel queues.

## Setup

1. Clone the repository:
   ```bash
   git clone https://github.com/jayeshpawar28/registrationApp.git
   cd registrationApp
2. Use this cmd for Queue (Important)
    php artisan queue:work

