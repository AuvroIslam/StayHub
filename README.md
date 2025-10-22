# StayHub - Property Rental Management System

**A comprehensive Airbnb-style property rental platform built with Laravel 11**

---

## 📋 Table of Contents

- [Overview](#-overview)
- [Features](#-features)
- [Technology Stack](#-technology-stack)
- [System Requirements](#-system-requirements)
- [Installation](#-installation)
- [Database Setup](#-database-setup)
- [Usage](#-usage)
- [User Roles](#-user-roles)
- [API Endpoints](#-api-endpoints)
- [Project Structure](#-project-structure)
- [Contributing](#-contributing)
- [License](#-license)

---

## 🏠 Overview

StayHub is a modern property rental management system that connects property owners with travelers. Built with Laravel 11 and featuring a responsive design, it provides a complete solution for managing property listings, bookings, and user interactions.

### Key Highlights

- **Multi-role system** with Admin, Property Owner, and Customer roles
- **Comprehensive property management** with multiple image uploads
- **Real-time booking system** with availability checking
- **Responsive design** optimized for all devices
- **Professional UI/UX** with Tailwind CSS
- **Secure authentication** with role-based access control

---

## ✨ Features

### 🔐 Authentication & Authorization
- User registration and login system
- Role-based access control (Admin, Owner, Customer)
- Secure password handling with Laravel's built-in authentication

### 🏘️ Property Management
- Create, edit, and delete property listings
- Upload multiple high-quality images (5 per property)
- Detailed property information (bedrooms, bathrooms, amenities)
- Property status management (active/inactive)
- Geographic information with address, city, state, country

### 📅 Booking System
- Real-time availability checking
- Booking creation and management
- Multiple booking statuses (pending, confirmed, completed, cancelled)
- Price calculation with guest count consideration
- Booking history and tracking

### 👥 User Management
- User profile management
- Role-based dashboard views
- Contact information and bio management
- Email verification system

### 🎨 User Interface
- Modern, responsive design with Tailwind CSS
- Professional color scheme with custom styling
- Font Awesome icons for enhanced visual appeal
- Mobile-optimized layouts
- Interactive elements with hover effects

---

## 🛠 Technology Stack

### Backend
- **Framework**: Laravel 11.x
- **Language**: PHP 8.2+
- **Database**: MySQL 8.0+
- **Authentication**: Laravel Sanctum
- **File Storage**: Laravel Storage with Symlink

### Frontend
- **CSS Framework**: Tailwind CSS (CDN)
- **Icons**: Font Awesome 6.5.1
- **Template Engine**: Blade Templates
- **JavaScript**: Vanilla JS with modern ES6+

### Development Tools
- **Version Control**: Git
- **Dependency Management**: Composer
- **Database Migration**: Laravel Migrations
- **Seeding**: Laravel Seeders with realistic data

---

## 📋 System Requirements

- **PHP**: 8.2 or higher
- **Composer**: 2.0 or higher
- **MySQL**: 8.0 or higher
- **Node.js**: 16.x or higher (for asset compilation, if needed)
- **Web Server**: Apache 2.4+ or Nginx 1.18+

### PHP Extensions Required
- OpenSSL
- PDO
- Mbstring
- Tokenizer
- XML
- JSON
- BCMath
- Ctype
- Fileinfo
- GD (for image processing)

---

## 🚀 Installation

### 1. Clone the Repository
```bash
git clone https://github.com/AuvroIslam/StayHub.git
cd StayHub
```

### 2. Install Dependencies
```bash
composer install
```

### 3. Environment Configuration
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Configure Database
Edit your `.env` file with your database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=stayhub_db
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 5. Create Storage Symlink
```bash
php artisan storage:link
```

---

## 💾 Database Setup

### 1. Create Database
```bash
# Create MySQL database
mysql -u root -p
CREATE DATABASE stayhub_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
exit
```

### 2. Run Migrations
```bash
php artisan migrate
```

### 3. Seed Database (Choose One Option)

#### Option A: Comprehensive Airbnb-style Data (Recommended)
```bash
php artisan db:seed --class=AirbnbStyleSeeder
```

#### Option B: Simplified Test Data
```bash
php artisan db:seed --class=SimplifiedDatabaseSeeder
```

#### Option C: Minimal Basic Data
```bash
php artisan db:seed
```

### 4. Add Multiple Images to Properties
```bash
php artisan db:seed --class=AddMoreImagesSeeder
```

---

## 💻 Usage

### Start Development Server
```bash
php artisan serve
```

Visit `http://127.0.0.1:8000` in your browser.

### Default Test Accounts

| Role | Email | Password |
|------|-------|----------|
| **Admin** | admin@stayhub.com | password |
| **Property Owner** | john@stayhub.com | password |
| **Property Owner** | sarah@stayhub.com | password |
| **Customer** | alice@example.com | password |
| **Customer** | bob@example.com | password |

---

## 👤 User Roles

### 🔧 Administrator
- Full system access and management
- User account management
- System monitoring and configuration
- All property and booking oversight

### 🏠 Property Owner
- Create and manage property listings
- Upload property images and details
- Manage booking requests
- View earnings and analytics
- Access to owner dashboard

### 🧳 Customer
- Browse and search properties
- Make booking requests
- Manage booking history
- Update profile information
- Access to customer dashboard

---

## 🔗 API Endpoints

### Authentication Routes
```http
GET    /login                    # Show login form
POST   /login                    # Process login
POST   /logout                   # User logout
GET    /register                 # Show registration form
POST   /register                 # Process registration
```

### Property Routes
```http
GET    /properties               # List all properties
GET    /properties/create        # Show create form (Auth)
POST   /properties               # Store new property (Auth)
GET    /properties/{id}          # Show property details
GET    /properties/{id}/edit     # Show edit form (Auth)
PUT    /properties/{id}          # Update property (Auth)
DELETE /properties/{id}          # Delete property (Auth)
```

### Booking Routes
```http
GET    /bookings                 # List user bookings (Auth)
POST   /bookings                 # Create booking (Auth)
GET    /bookings/{id}            # Show booking details (Auth)
PUT    /bookings/{id}            # Update booking (Auth)
DELETE /bookings/{id}            # Cancel booking (Auth)
```

### Dashboard Routes
```http
GET    /owner/dashboard          # Property owner dashboard (Auth)
GET    /customer/dashboard       # Customer dashboard (Auth)
GET    /admin/dashboard          # Admin dashboard (Auth)
```

---

## 📁 Project Structure

```
StayHub/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/
│   │   │   ├── BookingController.php
│   │   │   ├── DashboardController.php
│   │   │   └── PropertyController.php
│   │   └── Middleware/
│   └── Models/
│       ├── User.php
│       ├── Property.php
│       └── Booking.php
├── database/
│   ├── migrations/
│   └── seeders/
│       ├── AirbnbStyleSeeder.php
│       ├── SimplifiedDatabaseSeeder.php
│       └── AddMoreImagesSeeder.php
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php
│       ├── auth/
│       ├── properties/
│       ├── bookings/
│       └── owner/
├── routes/
│   └── web.php
└── public/
    └── storage/ (symlinked)
```

---

## 🤝 Contributing

We welcome contributions to StayHub! Please follow these steps:

### 1. Fork the Repository
```bash
git fork https://github.com/AuvroIslam/StayHub.git
```

### 2. Create Feature Branch
```bash
git checkout -b feature/your-feature-name
```

### 3. Make Changes and Test
```bash
# Make your changes
php artisan test  # Run tests if available
```

### 4. Commit and Push
```bash
git add .
git commit -m "Add: your feature description"
git push origin feature/your-feature-name
```

### 5. Create Pull Request
Submit a pull request with detailed description of changes.

### Code Standards
- Follow PSR-12 coding standards
- Write meaningful commit messages
- Add comments for complex logic
- Ensure responsive design compatibility

---

## 📄 License

This project is licensed under the **MIT License** - see the [LICENSE](LICENSE) file for details.

---

## 🙏 Acknowledgments

- Built with [Laravel Framework](https://laravel.com)
- UI styled with [Tailwind CSS](https://tailwindcss.com)
- Icons provided by [Font Awesome](https://fontawesome.com)
- Images courtesy of [Unsplash](https://unsplash.com)

---

## 📞 Support

For support, email [support@stayhub.com](mailto:support@stayhub.com) or create an issue in the GitHub repository.

---

**Made with ❤️ by [AuvroIslam](https://github.com/AuvroIslam)**
