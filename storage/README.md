# Storage Directory - StayHub Data Storage System

This directory contains all application data storage including uploaded files, logs, cache, and framework files for the StayHub platform.

## 📁 Directory Structure

```
storage/
├── app/           # Application files and user uploads
│   ├── public/    # Publicly accessible files (symlinked to public/storage)
│   └── private/   # Private application files
├── framework/     # Laravel framework storage
│   ├── cache/     # Application cache files
│   ├── sessions/  # Session data storage
│   ├── testing/   # Testing environment files
│   └── views/     # Compiled Blade templates
└── logs/          # Application logs and error tracking
```

## 🎯 Purpose
Provides organized storage for all persistent data, uploaded content, temporary files, and application state information.

## 📂 App Directory - User Content Storage

### **app/public/** - Web-Accessible Storage
```
app/public/
└── properties/    # Property image uploads
    ├── gUxqpJAOwYfLuBtwUQL2Ytmj423kTH2osEfux5i3.png  # Burger property
    ├── [other uploaded property images]
    └── [future property galleries]
```

**Key Features:**
- **Property Gallery System**: 5 images per property requirement
- **Secure File Storage**: Laravel-generated filenames prevent conflicts
- **Public Access**: Available via `/storage/properties/` URL path
- **Symlinked Access**: Connected to `public/storage/` for web serving

**File Naming Convention:**
```php
// Laravel Storage System generates secure filenames:
// Original: "my-house-photo.jpg"
// Stored as: "gUxqpJAOwYfLuBtwUQL2Ytmj423kTH2osEfux5i3.png"
```

### **app/private/** - Internal Application Files
- **User documents** (if implemented)
- **Backup files** and exports
- **Private uploads** not meant for public access
- **System-generated reports**

## ⚙️ Framework Directory - Laravel System Storage

### **framework/cache/** - Application Caching
```
framework/cache/
├── data/          # General application cache
└── [cache files]  # Serialized cache entries
```

**Cached Content:**
- **Configuration cache** for production performance
- **Route cache** for faster URL resolution
- **View cache** for compiled Blade templates
- **Model cache** for frequently accessed data

### **framework/sessions/** - User Session Data
```
framework/sessions/
└── [session files]  # User authentication and state
```

**Session Features:**
- **Authentication state** for logged-in users
- **Shopping cart data** during booking process
- **Flash messages** for user notifications
- **CSRF tokens** for form security

### **framework/views/** - Compiled Templates
```
framework/views/
└── [compiled blade files]  # Pre-processed templates
```

**Template Compilation:**
- **Blade syntax processing** to pure PHP
- **Performance optimization** through pre-compilation
- **Include resolution** and template inheritance
- **Cache invalidation** on template changes

### **framework/testing/** - Test Environment
- **Test database files** for isolated testing
- **Test upload directories** for file upload testing
- **Mock data storage** for unit tests

## 📊 Logs Directory - Application Monitoring

### **logs/** - Error and Activity Tracking
```
logs/
├── laravel.log          # Main application log
├── laravel-2024-10-22.log  # Daily log rotation
└── [dated log files]    # Historical logs
```

**Log Categories:**
```php
// Error Levels Tracked
Log::emergency($message);  // System unusable
Log::alert($message);      // Action must be taken
Log::critical($message);   // Critical conditions
Log::error($message);      // Error conditions
Log::warning($message);    // Warning conditions
Log::notice($message);     // Normal but significant
Log::info($message);       // Informational
Log::debug($message);      // Debug-level messages
```

**StayHub-Specific Logging:**
- **User authentication** events and failures
- **Property creation** and modification tracking
- **Booking transactions** and payment processing
- **File upload** success and error tracking
- **Database errors** and performance issues
- **Security incidents** and suspicious activity

## 💾 File Storage System

### **Property Image Management:**

#### **Upload Process:**
```php
// Controller: PropertyController@store
$imagePath = $request->file('image')->store('properties', 'public');
// Results in: storage/app/public/properties/[hash-filename].extension
```

#### **Storage Configuration:**
```php
// config/filesystems.php
'disks' => [
    'public' => [
        'driver' => 'local',
        'root' => storage_path('app/public'),
        'url' => env('APP_URL').'/storage',
        'visibility' => 'public',
    ],
],
```

#### **File Access URLs:**
```blade
<!-- Uploaded Property Images -->
{{ asset('storage/properties/filename.jpg') }}
<!-- Generates: http://127.0.0.1:8000/storage/properties/filename.jpg -->
```

### **Multi-Image Gallery System:**
```php
// Database Storage (Property Model)
$property->image    // Main property image
$property->image_2  // Gallery image 2
$property->image_3  // Gallery image 3  
$property->image_4  // Gallery image 4
$property->image_5  // Gallery image 5

// File Paths Example:
"properties/abc123.jpg"
"properties/def456.jpg" 
"properties/ghi789.jpg"
"properties/jkl012.jpg"
"properties/mno345.jpg"
```

## 🔐 Security Features

### **File Upload Security:**
- **Type validation**: Only JPEG, PNG allowed
- **Size limits**: 2MB maximum per image
- **Filename sanitization**: Laravel generates secure names
- **Directory isolation**: Uploads stored in dedicated folders
- **No executable files**: PHP execution blocked in upload directories

### **Access Control:**
```php
// Private files (app/private) - Not web accessible
// Public files (app/public) - Web accessible via symlink
// Framework files - Never web accessible
// Logs - Admin access only
```

### **Storage Permissions:**
```bash
# Recommended permissions
chmod 755 storage/
chmod -R 775 storage/app/
chmod -R 775 storage/framework/
chmod -R 775 storage/logs/
```

## 🚀 Performance Optimization

### **Cache Management:**
```bash
# Clear all caches
php artisan cache:clear

# Clear view cache
php artisan view:clear

# Clear config cache
php artisan config:clear

# Clear route cache
php artisan route:clear
```

### **Storage Optimization:**
```bash
# Create public storage symlink
php artisan storage:link

# Optimize storage performance
php artisan storage:optimize

# Clean old log files
php artisan log:clean
```

### **File Management:**
```php
// Efficient file operations
Storage::disk('public')->put('path/file.jpg', $content);
Storage::disk('public')->delete('path/file.jpg');
Storage::disk('public')->exists('path/file.jpg');
```

## 📈 Monitoring and Maintenance

### **Log Analysis:**
```bash
# View recent errors
tail -f storage/logs/laravel.log

# Search for specific errors
grep "ERROR" storage/logs/laravel.log

# Monitor file uploads
grep "Property image uploaded" storage/logs/laravel.log
```

### **Storage Usage Monitoring:**
```bash
# Check storage directory sizes
du -sh storage/app/public/properties/   # Property images
du -sh storage/framework/cache/         # Cache size
du -sh storage/logs/                    # Log file size

# Clean up old files
find storage/logs/ -name "*.log" -mtime +30 -delete
```

### **Backup Strategies:**
```bash
# Backup uploaded files
tar -czf uploads-backup.tar.gz storage/app/public/

# Backup application data
rsync -av storage/app/ /backup/storage/app/

# Database export (separate from storage)
mysqldump stayhub_db > backup/database.sql
```

## 🔄 File Lifecycle Management

### **Property Image Lifecycle:**
1. **Upload**: User submits 5 images via property creation form
2. **Validation**: Server validates file type, size, count
3. **Storage**: Files saved with secure generated names
4. **Database**: File paths stored in property record
5. **Display**: Images served via public symlink
6. **Cleanup**: Old images removed when property deleted

### **Cache Lifecycle:**
1. **Generation**: Views/config compiled on first access
2. **Storage**: Cached versions stored in framework directory
3. **Serving**: Pre-compiled versions served for performance
4. **Invalidation**: Cache cleared on code changes
5. **Regeneration**: New cache created on next access

### **Log Rotation:**
```php
// config/logging.php - Daily log rotation
'daily' => [
    'driver' => 'daily',
    'path' => storage_path('logs/laravel.log'),
    'level' => 'debug',
    'days' => 14,  // Keep 14 days of logs
],
```

## 🔧 Development Commands

### **Storage Management:**
```bash
# Create storage directories
mkdir -p storage/app/public/properties
mkdir -p storage/framework/{cache,sessions,views}
mkdir -p storage/logs

# Set permissions
chmod -R 775 storage/

# Create symlink for public access
php artisan storage:link

# Clear storage caches
php artisan cache:clear
php artisan view:clear
```

### **File Operations:**
```php
// Check if file exists
if (Storage::disk('public')->exists('properties/image.jpg')) {
    // File operations
}

// Get file URL for display
$url = Storage::disk('public')->url('properties/image.jpg');

// Delete old files
Storage::disk('public')->delete('properties/old-image.jpg');
```

## 📋 Storage Configuration

### **Disk Configuration (config/filesystems.php):**
```php
'disks' => [
    'local' => [
        'driver' => 'local',
        'root' => storage_path('app'),
    ],
    'public' => [
        'driver' => 'local',
        'root' => storage_path('app/public'),
        'url' => env('APP_URL').'/storage',
        'visibility' => 'public',
    ],
],
```

### **Environment Variables:**
```bash
# .env configuration
FILESYSTEM_DISK=public
LOG_CHANNEL=daily
LOG_LEVEL=debug
SESSION_DRIVER=file
CACHE_DRIVER=file
```

## 🎯 StayHub-Specific Features

### **Property Gallery Storage:**
- **5-image requirement** for all new property listings
- **Automatic file organization** in properties subdirectory
- **Unique filename generation** prevents conflicts
- **Web-optimized delivery** via CDN-ready structure

### **User Data Management:**
- **Session persistence** for booking flow
- **Profile image storage** (if implemented)
- **Document storage** for verification (future feature)
- **Backup and recovery** procedures

### **Performance Monitoring:**
- **Upload success tracking** in logs
- **Cache hit ratios** for optimization
- **Storage usage alerts** for capacity planning
- **Error rate monitoring** for system health

This storage system provides secure, scalable, and efficient file management for the StayHub property rental platform while maintaining proper organization and performance optimization.