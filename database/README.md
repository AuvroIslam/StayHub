# Database Directory - StayHub Data Layer

This directory contains all database-related files for the StayHub property rental platform.

## 📁 Directory Structure

```
database/
├── factories/      # Model Factories for testing data
├── migrations/     # Database schema migrations
├── seeders/        # Database seeders for sample data
├── .gitignore      # Git ignore rules for database
└── database.sqlite # SQLite database file (if using SQLite)
```

## 🎯 Purpose
Manages database schema, sample data, and database versioning for the StayHub application.

## 📂 Subdirectories & Files

### migrations/
Database schema definition files that create and modify tables:

#### Core Tables:
- **`create_users_table.php`** - User accounts (customers, owners, admins)
- **`create_properties_table.php`** - Property listings with details
- **`create_bookings_table.php`** - Reservation system
- **`add_multiple_images_to_properties_table.php`** - Property gallery support
- **`update_property_type_enum.php`** - Property type expansion

#### Key Features:
- **User Authentication**: Role-based system with profile fields
- **Property Management**: Multi-image support, location data, pricing
- **Booking System**: Date ranges, status tracking, payment info
- **Review System**: Detailed rating categories for bookings

### seeders/
Sample data generators for development and testing:

- **`DatabaseSeeder.php`** - Main seeder that runs all others
- **`UserSeeder.php`** - Creates sample users (customers, owners, admin)
- **`PropertySeeder.php`** - Generates realistic property listings
- **`BookingSeeder.php`** - Creates sample bookings with reviews
- **`AddMoreImagesSeeder.php`** - Adds varied Unsplash images to properties

### factories/
Model factories for generating test data:
- **`UserFactory.php`** - Random user generation
- **`PropertyFactory.php`** - Property data generation
- **`BookingFactory.php`** - Booking scenario creation

### Configuration Files:
- **`.gitignore`** - Prevents tracking of local database files
- **`database.sqlite`** - Local SQLite database (if configured)

## 🔄 Migration History

### Property System Evolution:
1. **Initial Schema** - Basic properties table
2. **Image Enhancement** - Added 5-image gallery support
3. **Property Types** - Expanded from 4 to 6 property types
4. **Booking Reviews** - Added detailed rating system

### User System Features:
- **Multi-role Authentication** - Customer, Owner, Admin roles
- **Profile Management** - Personal info, security, preferences
- **Date Tracking** - Birth dates, created/updated timestamps

## 🎨 Sample Data Features

### Realistic Property Data:
- **16 Airbnb-style properties** with professional descriptions
- **Varied locations** across different cities and states
- **Professional images** from Unsplash for visual appeal
- **Realistic pricing** based on property type and location

### User Scenarios:
- **Multiple user roles** for testing different permissions
- **Sample bookings** with different statuses and review scenarios
- **Rating distribution** across multiple criteria

## 🚀 Quick Commands

```bash
# Run all migrations
php artisan migrate

# Seed database with sample data
php artisan db:seed

# Reset and reseed (fresh start)
php artisan migrate:fresh --seed

# Create new migration
php artisan make:migration create_table_name

# Create new seeder
php artisan make:seeder TableNameSeeder
```

## 📋 Database Schema Overview

### Users Table:
- Authentication fields (email, password)
- Role management (customer, owner, admin)
- Profile information (name, phone, date_of_birth)
- Timestamps and email verification

### Properties Table:
- Basic info (title, description, address)
- Property details (bedrooms, bathrooms, max_guests)
- Pricing (price_per_night)
- **5-image gallery** (image, image_2, image_3, image_4, image_5)
- **6 property types** (apartment, house, villa, studio, condo, other)
- Status management (active/inactive)

### Bookings Table:
- Date management (check_in, check_out)
- Pricing (total_price, total_nights)
- Status tracking (pending, confirmed, cancelled, completed)
- **Detailed review system** with 6 rating categories
- Guest information and special requests

## 🔧 Development Notes
- Always create migrations for schema changes
- Use seeders to maintain consistent test data
- Keep migrations reversible with proper down() methods
- Use factories for flexible test data generation
- Follow Laravel naming conventions for all database files