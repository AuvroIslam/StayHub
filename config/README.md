# Config Directory - StayHub Application Configuration

This directory contains all configuration files that control various aspects of the StayHub Laravel application.

## 📁 Directory Structure

```
config/
├── app.php          # Main application configuration
├── auth.php         # Authentication configuration
├── cache.php        # Cache configuration
├── database.php     # Database connections
├── filesystems.php  # File storage configuration
├── logging.php      # Logging configuration
├── mail.php         # Email configuration
├── queue.php        # Queue configuration
├── services.php     # Third-party services
└── session.php      # Session configuration
```

## 🎯 Purpose
Centralizes all application settings and configurations, making the app environment-aware and easily configurable.

## ⚙️ Configuration Files

### **app.php** - Main Application Settings
```php
// Core application configuration
'name' => env('APP_NAME', 'StayHub'),
'env' => env('APP_ENV', 'production'),
'debug' => env('APP_DEBUG', false),
'url' => env('APP_URL', 'http://localhost'),
'timezone' => 'UTC',
'locale' => 'en',
```

**Key Features:**
- **Application name and environment** settings
- **Debug mode** control for development
- **URL configuration** for asset generation
- **Timezone and localization** settings
- **Service provider registration**

### **auth.php** - Authentication Configuration
```php
// Authentication settings for StayHub
'defaults' => [
    'guard' => 'web',
    'passwords' => 'users',
],
'guards' => [
    'web' => ['driver' => 'session', 'provider' => 'users'],
],
```

**StayHub Features:**
- **Multi-role authentication** (Customer, Owner, Admin)
- **Session-based authentication** for web interface
- **Password reset configuration**
- **User provider settings** for Eloquent model

### **database.php** - Database Configuration
```php
// Database connections for StayHub
'default' => env('DB_CONNECTION', 'mysql'),
'connections' => [
    'mysql' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '127.0.0.1'),
        'database' => env('DB_DATABASE', 'stayhub_db'),
        'username' => env('DB_USERNAME', 'forge'),
        'password' => env('DB_PASSWORD', ''),
    ],
],
```

**Database Setup:**
- **Primary Database**: MySQL (`stayhub_db`)
- **XAMPP Integration**: Local development setup
- **Connection pooling** and charset configuration
- **Migration and seeding** support

### **filesystems.php** - File Storage Configuration
```php
// File storage for property images
'default' => env('FILESYSTEM_DISK', 'local'),
'disks' => [
    'public' => [
        'driver' => 'local',
        'root' => storage_path('app/public'),
        'url' => env('APP_URL').'/storage',
    ],
],
```

**StayHub Storage Features:**
- **Property image uploads** to `storage/app/public/properties/`
- **Public disk symlink** for web-accessible images
- **5-image gallery support** per property
- **File validation** (JPEG, PNG, max 2MB per image)

### **mail.php** - Email Configuration
```php
// Email settings for notifications
'default' => env('MAIL_MAILER', 'smtp'),
'mailers' => [
    'smtp' => [
        'transport' => 'smtp',
        'host' => env('MAIL_HOST', 'smtp.mailgun.org'),
    ],
],
```

**Email Features:**
- **Booking confirmations** and notifications
- **Password reset emails**
- **Email verification** for new accounts
- **Property owner notifications**

### **session.php** - Session Management
```php
// Session configuration
'driver' => env('SESSION_DRIVER', 'file'),
'lifetime' => env('SESSION_LIFETIME', 120),
'encrypt' => false,
'files' => storage_path('framework/sessions'),
```

**Session Features:**
- **User authentication sessions**
- **Shopping cart** for booking process
- **Flash messages** for user feedback
- **CSRF protection** for forms

### **cache.php** - Cache Configuration
```php
// Caching for performance
'default' => env('CACHE_DRIVER', 'file'),
'stores' => [
    'file' => [
        'driver' => 'file',
        'path' => storage_path('framework/cache/data'),
    ],
],
```

**Caching Strategy:**
- **View caching** for Blade templates
- **Route caching** for production
- **Configuration caching** for performance
- **Model caching** for frequently accessed data

### **logging.php** - Application Logging
```php
// Logging configuration
'default' => env('LOG_CHANNEL', 'stack'),
'channels' => [
    'stack' => ['driver' => 'stack', 'channels' => ['single']],
    'single' => ['driver' => 'single', 'path' => storage_path('logs/laravel.log')],
],
```

**Logging Features:**
- **Error tracking** and debugging
- **User action logs** for security
- **Booking transaction logs**
- **Performance monitoring**

### **queue.php** - Queue Configuration
```php
// Background job processing
'default' => env('QUEUE_CONNECTION', 'sync'),
'connections' => [
    'sync' => ['driver' => 'sync'],
    'database' => ['driver' => 'database', 'table' => 'jobs'],
],
```

**Queue Features:**
- **Email sending** in background
- **Image processing** for uploads
- **Notification dispatch**
- **Report generation**

### **services.php** - Third-Party Services
```php
// External service integrations
'mailgun' => [
    'domain' => env('MAILGUN_DOMAIN'),
    'secret' => env('MAILGUN_SECRET'),
],
```

**Integrated Services:**
- **Email providers** (Mailgun, SendGrid)
- **Payment gateways** (if implemented)
- **Image hosting services**
- **Analytics services**

## 🔐 Environment Variables

### **Required .env Settings for StayHub:**
```bash
# Application
APP_NAME=StayHub
APP_ENV=local
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

# Database (XAMPP MySQL)
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=stayhub_db
DB_USERNAME=root
DB_PASSWORD=

# File Storage
FILESYSTEM_DISK=public

# Mail (for development)
MAIL_MAILER=log
MAIL_FROM_ADDRESS="noreply@stayhub.com"
MAIL_FROM_NAME="StayHub"

# Session
SESSION_DRIVER=file
SESSION_LIFETIME=120
```

## 🚀 Environment-Specific Configuration

### **Development (Local):**
- **Debug mode enabled** for error visibility
- **File-based** cache and sessions
- **Log mailer** for email testing
- **Relaxed security** settings

### **Production (Future):**
- **Debug mode disabled** for security
- **Redis/Memcached** for caching
- **Real SMTP** for email delivery
- **Strict security** configurations

## 🔧 Configuration Best Practices

### **Security:**
- Never commit `.env` file to version control
- Use strong `APP_KEY` for encryption
- Keep `APP_DEBUG=false` in production
- Use HTTPS for `APP_URL` in production

### **Performance:**
- Cache configurations in production
- Use efficient cache drivers (Redis)
- Configure queue workers for background jobs
- Optimize database connection pooling

### **Maintenance:**
- Document all custom configuration additions
- Use environment variables for sensitive data
- Keep development and production configs in sync
- Regular backup of configuration files

## 📋 StayHub-Specific Settings

### **Property Management:**
- **Image storage** configuration for 5-image galleries
- **File upload limits** and validation rules
- **Public storage** symlink requirements

### **User Authentication:**
- **Multi-role support** configuration
- **Session management** for different user types
- **Password policies** and reset flows

### **Booking System:**
- **Database connections** for transaction safety
- **Queue configuration** for booking confirmations
- **Mail settings** for customer notifications

### **Development Setup:**
- **XAMPP integration** for local MySQL
- **File-based sessions** for simplicity
- **Debug toolbar** configuration (if installed)

## 🔧 Quick Commands

```bash
# Cache configuration for production
php artisan config:cache

# Clear configuration cache
php artisan config:clear

# View current configuration
php artisan config:show

# Create storage symlink
php artisan storage:link
```

This configuration setup ensures StayHub runs efficiently across different environments while maintaining security and performance standards.