# App Directory - StayHub Laravel Application Core

This directory contains the core application logic for the StayHub property rental platform.

## 📁 Directory Structure

```
app/
├── Http/           # HTTP layer (Controllers, Middleware, Requests)
├── Models/         # Eloquent Models (Database entities)
└── Providers/      # Service Providers (Application bootstrapping)
```

## 🎯 Purpose
The `app/` directory houses the main application code that implements the business logic for StayHub's property rental functionality.

## 📂 Subdirectories

### Http/ 
Contains all HTTP-related components:
- **Controllers**: Handle incoming requests and return responses
- **Middleware**: Filter HTTP requests entering your application
- **Requests**: Form validation and authorization logic

### Models/
Eloquent ORM models representing database tables:
- **User.php**: User authentication and relationships
- **Property.php**: Property listings with booking logic
- **Booking.php**: Reservation system with reviews

### Providers/
Service providers for application bootstrapping:
- **AppServiceProvider.php**: Main application services
- **RouteServiceProvider.php**: Route registration and configuration

## 🔧 Key Features Implemented
- **Multi-role Authentication** (Customer, Property Owner, Admin)
- **Property Management** with multiple image support
- **Booking System** with calendar integration
- **Review System** with detailed ratings
- **Profile Management** with security features

## 📋 File Relationships
- Models define database relationships and business logic
- Controllers use Models to interact with data
- Providers register services used throughout the application

## 🚀 Development Notes
- Follow Laravel naming conventions
- Use Eloquent relationships for data associations
- Implement proper validation in controllers
- Keep business logic in models, not controllers