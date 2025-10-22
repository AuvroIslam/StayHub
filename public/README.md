# Public Directory - StayHub Web-Accessible Assets

This directory contains all publicly accessible files that are directly served by the web server for the StayHub application.

## 📁 Directory Structure

```
public/
├── .htaccess        # Apache rewrite rules and security
├── favicon.ico      # Website favicon
├── index.php        # Laravel application entry point
├── robots.txt       # Search engine crawler instructions
├── storage/         # Symlink to storage/app/public (for uploaded files)
└── images/          # Static application images and icons
```

## 🎯 Purpose
Serves as the web root directory containing all files that users and browsers can directly access via HTTP requests.

## 🌐 File Descriptions

### **index.php** - Application Entry Point
```php
// Laravel application bootstrap
require_once __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
```

**Functionality:**
- **Single entry point** for all web requests
- **Bootstraps Laravel application** and handles request routing
- **Security layer** that prevents direct file access to application code
- **URL rewriting** through `.htaccess` directs all traffic here

### **.htaccess** - Apache Configuration
```apache
# Laravel URL rewriting and security rules
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^(.*)$ index.php [L]
```

**Security Features:**
- **URL rewriting** for clean, SEO-friendly URLs
- **Direct file access prevention** for security
- **HTTPS enforcement** (if configured)
- **Cache headers** for static assets

### **robots.txt** - SEO Configuration
```text
# Search engine crawling rules for StayHub
User-agent: *
Disallow: /admin/
Disallow: /api/
Allow: /
Allow: /properties/

Sitemap: https://stayhub.com/sitemap.xml
```

**SEO Features:**
- **Property pages indexing** encouraged for search visibility
- **Admin/API sections** blocked from search engines
- **Sitemap reference** for better crawling

### **favicon.ico** - Website Icon
- **Browser tab icon** for StayHub branding
- **Bookmark icon** when users save the site
- **Mobile app icon** integration
- **Brand recognition** element

## 🖼️ Images Directory

### **Static Application Icons:**
```
images/
├── home.png         # Villa/luxury property icon
├── house.png        # House property type icon  
├── real-estate.png  # Apartment property type icon
└── studio.png       # Studio property type icon
```

### **Icon Usage in Application:**
```blade
<!-- Property type browsing on homepage -->
<img src="{{ asset('images/real-estate.png') }}" alt="Apartments" class="w-24 h-24 object-contain">
<img src="{{ asset('images/house.png') }}" alt="Houses" class="w-24 h-24 object-contain">
<img src="{{ asset('images/home.png') }}" alt="Villas" class="w-24 h-24 object-contain">
<img src="{{ asset('images/studio.png') }}" alt="Studios" class="w-24 h-24 object-contain">
```

### **Design Features:**
- **Consistent visual style** across all property type icons
- **High resolution** for crisp display on all devices
- **Optimized file sizes** for fast loading
- **Semantic naming** for easy maintenance

## 💾 Storage Directory (Symlinked)

### **Purpose:**
```bash
# Created via: php artisan storage:link
public/storage -> ../storage/app/public
```

**File Organization:**
```
storage/ (symlinked)
└── properties/
    ├── gUxqpJAOwYfLuBtwUQL2Ytmj423kTH2osEfux5i3.png  # Burger property image
    ├── [additional uploaded property images...]
    └── [future property uploads...]
```

### **Image Access URLs:**
```blade
<!-- Uploaded property images -->
<img src="{{ asset('storage/properties/filename.jpg') }}" alt="Property Image">

<!-- Generated URLs -->
http://127.0.0.1:8000/storage/properties/gUxqpJAOwYfLuBtwUQL2Ytmj423kTH2osEfux5i3.png
```

### **File Upload System:**
- **5 images per property** requirement for new listings
- **Validation**: JPEG, PNG, max 2MB per file
- **Automatic resizing** and optimization (if configured)
- **Secure file naming** to prevent conflicts and security issues

## 🔐 Security Features

### **File Access Control:**
```apache
# .htaccess security rules
<Files "*.php">
    Order Deny,Allow
    Deny from all
</Files>

# Allow only index.php
<Files "index.php">
    Allow from all
</Files>
```

### **Upload Security:**
- **File type validation** on server side
- **File size limits** to prevent abuse
- **Secure filename generation** using Laravel's storage system
- **No direct PHP execution** in upload directories

### **HTTPS Configuration** (Production):
```apache
# Force HTTPS for security
RewriteCond %{HTTPS} off
RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
```

## 🚀 Performance Optimization

### **Static Asset Caching:**
```apache
# Browser caching for static files
<IfModule mod_expires.c>
    ExpiresActive on
    ExpiresByType image/png "access plus 1 month"
    ExpiresByType image/jpg "access plus 1 month"
    ExpiresByType image/jpeg "access plus 1 month"
    ExpiresByType text/css "access plus 1 month"
    ExpiresByType application/javascript "access plus 1 month"
</IfModule>
```

### **Image Optimization:**
- **Compressed images** without quality loss
- **WebP format support** (if implemented)
- **Lazy loading** for property galleries
- **CDN integration** potential for global delivery

### **Gzip Compression:**
```apache
# Enable compression for faster loading
<IfModule mod_deflate.c>
    AddOutputFilterByType DEFLATE text/plain
    AddOutputFilterByType DEFLATE text/html
    AddOutputFilterByType DEFLATE text/css
    AddOutputFilterByType DEFLATE application/javascript
</IfModule>
```

## 📱 Asset Management

### **Laravel Asset Helper:**
```blade
<!-- Static images -->
{{ asset('images/house.png') }}
<!-- Generates: http://127.0.0.1:8000/images/house.png -->

<!-- Uploaded files -->
{{ asset('storage/properties/image.jpg') }}
<!-- Generates: http://127.0.0.1:8000/storage/properties/image.jpg -->
```

### **Versioning and Cache Busting:**
```php
// In production, use versioned assets
{{ asset('css/app.css?v=' . filemtime(public_path('css/app.css'))) }}
```

## 🔧 Development vs Production

### **Development Setup:**
- **Local file serving** via `php artisan serve`
- **Debug-friendly** error pages and asset serving
- **Hot reloading** for CSS/JS changes (if using Vite)
- **Uncompressed assets** for debugging

### **Production Configuration:**
- **Web server optimization** (Apache/Nginx)
- **Asset compilation** and minification
- **CDN integration** for global asset delivery
- **Security hardening** and access restrictions

## 📋 File Upload Flow

### **Property Image Upload Process:**
1. **Form Submission**: 5 images via property creation form
2. **Validation**: File type, size, and count validation
3. **Storage**: Files saved to `storage/app/public/properties/`
4. **Database**: File paths stored in property record
5. **Access**: Files served via symlinked `public/storage/`

### **Image Display Logic:**
```php
// In PropertyController
$imagePath = $request->file('image')->store('properties', 'public');
$property->image = $imagePath; // Stores: "properties/filename.jpg"

// In Blade template
<img src="{{ asset('storage/' . $property->image) }}" alt="Property">
// Generates: http://domain.com/storage/properties/filename.jpg
```

## 🔧 Maintenance Commands

### **Storage Symlink Management:**
```bash
# Create storage symlink (required for file uploads)
php artisan storage:link

# Remove symlink
unlink public/storage

# Verify symlink
ls -la public/storage
```

### **Asset Optimization:**
```bash
# Compile assets for production
npm run production

# Optimize images (if using Laravel Mix)
npm run optimize-images

# Clear compiled assets
rm -rf public/js/* public/css/*
```

### **Security Audits:**
```bash
# Check file permissions
ls -la public/

# Verify .htaccess rules
apache2ctl configtest

# Monitor upload directory
du -sh storage/app/public/properties/
```

## 🎨 Brand Assets Integration

### **Current Visual Identity:**
- **Color Scheme**: Integrated via CSS and inline styles
- **Property Icons**: Custom-designed for different property types
- **Favicon**: StayHub brand recognition
- **Consistent Styling**: Matches overall application design

### **Future Brand Assets:**
- **Logo variations** for different contexts
- **Social media images** for property sharing
- **Email template assets** for notifications
- **Marketing materials** for property owners

This public directory structure ensures secure, efficient, and scalable asset delivery for the StayHub property rental platform while maintaining proper security boundaries and performance optimization.