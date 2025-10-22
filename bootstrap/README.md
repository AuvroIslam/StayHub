# Bootstrap Directory - StayHub Application Initialization

This directory contains the core files responsible for bootstrapping and initializing the StayHub Laravel application.

## 📁 Directory Structure

```
bootstrap/
├── app.php         # Application instance creation and configuration
├── providers.php   # Service provider registration
└── cache/          # Bootstrap cache files for performance
```

## 🎯 Purpose
Handles the initial setup and configuration of the Laravel application, preparing all services and components before handling requests.

## ⚡ Bootstrap Files

### **app.php** - Application Bootstrap
```php
<?php
// Create Laravel Application Instance
$app = new Illuminate\Foundation\Application(
    $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__)
);

// Bind important interfaces
$app->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    App\Http\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

return $app;
```

**Key Responsibilities:**
- **Application Container Creation**: Sets up the Laravel service container
- **Core Service Binding**: Registers HTTP and Console kernels
- **Exception Handler**: Configures error and exception handling
- **Base Path Configuration**: Establishes application root directory
- **Return Application Instance**: Provides configured app to public/index.php

### **providers.php** - Service Provider Registration
```php
<?php
return [
    App\Providers\AppServiceProvider::class,
    App\Providers\RouteServiceProvider::class,
    // Additional service providers for StayHub features
];
```

**Service Providers for StayHub:**
- **AppServiceProvider**: Core application services and bindings
- **RouteServiceProvider**: Route configuration and model bindings
- **AuthServiceProvider**: Authentication and authorization setup
- **EventServiceProvider**: Event listeners and observers (if used)

### **cache/** - Bootstrap Performance Cache
```
cache/
├── compiled.php     # Compiled service providers
├── config.php       # Cached configuration array
├── routes.php       # Cached route definitions
└── services.php     # Cached service container bindings
```

**Performance Optimization:**
- **Service Provider Compilation**: Pre-processes provider registration
- **Configuration Caching**: Merges all config files into single array
- **Route Caching**: Compiles routes for faster resolution
- **Container Caching**: Optimizes dependency injection performance

## 🔄 Application Lifecycle

### **1. Request Entry (public/index.php)**
```php
// Bootstrap application
$app = require_once __DIR__.'/../bootstrap/app.php';

// Create kernel instance
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

// Handle request
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);
```

### **2. Application Bootstrap Process**
1. **Container Creation**: Laravel service container instantiation
2. **Core Bindings**: HTTP/Console kernels and exception handler binding  
3. **Service Provider Registration**: Load all application services
4. **Configuration Loading**: Merge all config files
5. **Route Registration**: Load and compile route definitions
6. **Middleware Pipeline**: Set up request/response filtering

### **3. StayHub-Specific Bootstrap**
```php
// AppServiceProvider boot method
public function boot()
{
    // Property image storage configuration
    Storage::disk('public')->buildTemporaryUrlsUsing(function ($path, $expiration, $options) {
        return URL::temporarySignedRoute(
            'local-temp-files',
            $expiration,
            array_merge($options, ['path' => $path])
        );
    });
    
    // Model observers for property management
    Property::observe(PropertyObserver::class);
}
```

## 🛠️ Service Provider Configuration

### **AppServiceProvider** - Core Services
```php
// app/Providers/AppServiceProvider.php
public function register()
{
    // Register StayHub-specific services
    $this->app->singleton('property.manager', function ($app) {
        return new PropertyManager($app['filesystem.disk']);
    });
    
    // Image processing services
    $this->app->bind('image.processor', function ($app) {
        return new ImageProcessor();
    });
}

public function boot()
{
    // Configure property image validation
    Validator::extend('property_images', function ($attribute, $value, $parameters, $validator) {
        return count($value) >= 5; // Require 5 images minimum
    });
}
```

### **RouteServiceProvider** - URL Configuration
```php
// app/Providers/RouteServiceProvider.php
public function boot()
{
    // Model route bindings for clean URLs
    Route::model('property', Property::class);
    Route::model('booking', Booking::class);
    Route::model('user', User::class);
    
    // Configure route caching
    $this->configureRateLimiting();
    
    // Load route files
    $this->routes(function () {
        Route::prefix('api')
            ->middleware('api')
            ->group(base_path('routes/api.php'));
            
        Route::middleware('web')
            ->group(base_path('routes/web.php'));
    });
}
```

## 📈 Performance Optimization

### **Production Caching Commands:**
```bash
# Cache configuration for production
php artisan config:cache

# Cache routes for faster resolution  
php artisan route:cache

# Cache compiled views
php artisan view:cache

# Optimize autoloader
composer install --optimize-autoloader --no-dev

# Cache service providers
php artisan optimize
```

### **Development Cache Clearing:**
```bash
# Clear all caches during development
php artisan optimize:clear

# Individual cache clearing
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### **Cache Performance Impact:**
- **Configuration Cache**: ~50% faster config loading
- **Route Cache**: ~30% faster URL resolution
- **View Cache**: ~40% faster template rendering
- **Autoloader Optimization**: ~20% faster class loading

## 🔐 Security Configuration

### **Environment Detection:**
```php
// Automatic environment detection
$app->detectEnvironment(function () {
    return getenv('APP_ENV') ?: 'production';
});

// Security settings based on environment
if ($app->environment('production')) {
    // Production security hardening
    $app->configureMonologUsing(function ($monolog) {
        $monolog->pushHandler(new StreamHandler('php://stderr', Logger::WARNING));
    });
}
```

### **Service Container Security:**
```php
// Prevent mass assignment vulnerabilities
Model::unguard(false);

// Configure trusted proxies for load balancers
TrustProxies::class,

// CSRF protection configuration
VerifyCsrfToken::class,
```

## 🔧 Debugging and Development

### **Debug Mode Configuration:**
```php
// In bootstrap/app.php (debug configuration)
if (env('APP_DEBUG', false)) {
    // Enable detailed error reporting
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    // Register debug service providers
    $app->register(Barryvdh\Debugbar\ServiceProvider::class);
}
```

### **Development Service Providers:**
```php
// config/app.php - Environment-specific providers
'providers' => [
    // Production providers
    App\Providers\AppServiceProvider::class,
    
    // Development-only providers
    'local' => [
        Laravel\Telescope\TelescopeServiceProvider::class,
        Barryvdh\Debugbar\ServiceProvider::class,
    ],
],
```

## 📊 Application Monitoring

### **Health Check Integration:**
```php
// AppServiceProvider boot method
public function boot()
{
    // Register health check routes
    Route::get('/health', function () {
        return [
            'status' => 'healthy',
            'database' => DB::connection()->getPdo() ? 'connected' : 'disconnected',
            'storage' => Storage::disk('public')->exists('test.txt') ? 'writable' : 'not_writable',
            'cache' => Cache::put('test', 'value', 1) ? 'working' : 'not_working',
        ];
    });
}
```

### **Error Tracking:**
```php
// Exception handler configuration
public function register()
{
    $this->reportable(function (Throwable $e) {
        // Send to external error tracking service
        if (app()->environment('production')) {
            // Sentry, Bugsnag, etc.
            app('sentry')->captureException($e);
        }
    });
}
```

## 🎯 StayHub-Specific Bootstrap

### **Property Management Bootstrap:**
```php
// Register property-specific services
$this->app->bind('property.validator', function ($app) {
    return new PropertyValidator();
});

$this->app->bind('image.gallery', function ($app) {
    return new GalleryManager($app['filesystem.disk']);
});

$this->app->bind('booking.calendar', function ($app) {
    return new CalendarService();
});
```

### **Multi-Role Authentication Setup:**
```php
// Configure role-based authentication
Auth::provider('eloquent.role', function ($app, array $config) {
    return new EloquentRoleUserProvider($app['hash'], $config['model']);
});

// Register role-based middleware
$router->aliasMiddleware('role', \App\Http\Middleware\CheckRole::class);
```

### **Image Upload Configuration:**
```php
// Configure image processing pipeline
$this->app->singleton('image.pipeline', function ($app) {
    return new Pipeline($app)
        ->send(new ImageUpload())
        ->through([
            ValidateImageType::class,
            ValidateImageSize::class,
            GenerateSecureName::class,
            OptimizeImage::class,
            StoreImage::class,
        ]);
});
```

## 🔄 Maintenance Mode

### **Maintenance Mode Configuration:**
```php
// Enable maintenance mode
php artisan down --refresh=15 --message="StayHub is updating property galleries"

// Allow specific IPs during maintenance
php artisan down --allow=127.0.0.1 --allow=192.168.1.0/24

// Disable maintenance mode
php artisan up
```

### **Custom Maintenance Page:**
```php
// resources/views/errors/503.blade.php
@extends('layouts.app')
@section('content')
<div class="maintenance-page">
    <h1>StayHub is temporarily unavailable</h1>
    <p>We're updating our property gallery system. Please check back soon!</p>
</div>
@endsection
```

## 📋 Troubleshooting

### **Common Bootstrap Issues:**

1. **Class Not Found Errors:**
```bash
# Regenerate autoloader
composer dump-autoload
```

2. **Configuration Cache Issues:**
```bash
# Clear config cache
php artisan config:clear
```

3. **Route Cache Problems:**
```bash
# Clear route cache
php artisan route:clear
```

4. **Permission Errors:**
```bash
# Fix bootstrap cache permissions
chmod -R 775 bootstrap/cache/
chown -R www-data:www-data bootstrap/cache/
```

### **Performance Debugging:**
```php
// Add to AppServiceProvider for performance monitoring
public function boot()
{
    if (app()->environment('local')) {
        DB::listen(function ($query) {
            Log::info("Query: {$query->sql} - Time: {$query->time}ms");
        });
    }
}
```

This bootstrap system ensures the StayHub application starts up efficiently and securely while providing all necessary services for property management, user authentication, and image gallery functionality.