# Resources Directory - StayHub Frontend Assets

This directory contains all frontend resources including views, styles, and JavaScript for the StayHub platform.

## 📁 Directory Structure

```
resources/
├── css/            # Stylesheets and CSS files
├── js/             # JavaScript files and Vue components
└── views/          # Blade templates (HTML with PHP)
```

## 🎯 Purpose
Houses all frontend presentation layer components including templates, styling, and client-side functionality.

## 📂 Subdirectories

### css/
Stylesheet files for application styling:
- **`app.css`** - Main application styles
- Custom CSS classes and Tailwind customizations
- Responsive design rules

### js/
JavaScript files and frontend logic:
- **`app.js`** - Main JavaScript entry point
- **`bootstrap.js`** - Frontend framework configuration
- Vue.js components (if used)
- Interactive features and AJAX calls

### views/
Blade template files organized by functionality:

## 🎨 Views Directory Structure

### 📁 **layouts/**
Base templates and shared components:
- **`app.blade.php`** - Main application layout with navigation, authentication menu
- **`guest.blade.php`** - Layout for non-authenticated users
- Shared header, footer, and navigation components

### 📁 **auth/** 
Authentication-related pages:
- **`login.blade.php`** - User login form
- **`register.blade.php`** - User registration with role selection
- **`verify-email.blade.php`** - Email verification page
- **`forgot-password.blade.php`** - Password reset request
- **`reset-password.blade.php`** - Password reset form

### 📁 **properties/**
Property management and display:
- **`index.blade.php`** - Property listings with filters and search
- **`show.blade.php`** - **Individual property page with 5-image gallery**
- **`create.blade.php`** - **Property creation form (requires 5 images)**
- **`edit.blade.php`** - Property editing interface

### 📁 **bookings/**
Reservation system interfaces:
- **`create.blade.php`** - Booking form with date selection
- **`show.blade.php`** - Booking details and management
- **`review.blade.php`** - Review submission after stay

### 📁 **customer/**
Customer-specific dashboard and features:
- **`dashboard.blade.php`** - Customer dashboard with bookings overview
- Booking history and account management
- **No favorites functionality** (removed as requested)

### 📁 **owner/**
Property owner dashboard and management:
- **`dashboard.blade.php`** - Owner dashboard with property analytics
- Booking management and earnings overview
- Property performance statistics

### 📁 Root Level Pages:
- **`home.blade.php`** - **Homepage with property search and featured listings**
- **`profile.blade.php`** - **User profile management with personal info, security, preferences**
- **`welcome.blade.php`** - Landing page for new visitors

### 📁 **vendor/**
Third-party package views (if any)

## 🎨 Styling Architecture

### **Hybrid Approach:**
The application uses a combination of:

1. **Tailwind CSS Classes:**
   ```blade
   class="bg-white rounded-lg shadow-md overflow-hidden hover-scale property-card"
   class="grid grid-cols-1 md:grid-cols-3 gap-8"
   class="text-3xl font-bold text-center mb-12"
   ```

2. **Inline Styles for Brand Colors:**
   ```blade
   style="background-color: #91C4C3; transition: opacity 0.3s;"
   style="border-color: #80A1BA;"
   style="background: linear-gradient(135deg, #80A1BA 0%, #91C4C3 100%);"
   ```

3. **Custom CSS Classes:**
   ```blade
   class="hero-gradient"     // Custom gradient backgrounds
   class="hover-scale"       // Hover animations
   class="property-card"     // Property card styling
   ```

### **Color Palette:**
- **Primary Blue**: `#80A1BA` - Navigation, buttons, accents
- **Secondary Teal**: `#91C4C3` - Buttons, highlights
- **Light Green**: `#B4DEBD` - Gradients, backgrounds
- **Light Gray**: `#F5F5F0` - Section backgrounds

## 🖼️ Image System Features

### **Property Gallery:**
- **5-image display** in property show pages
- **Dynamic image loading** (Unsplash URLs vs. uploaded files)
- **Smart fallbacks** with contextual icons (🏠 🛏️ 🛁 🍽️ 🛋️)
- **Responsive grid layout** with main image and 4 thumbnails

### **Property Creation:**
- **Requires 5 images** with helpful photography tips
- **File upload validation** (JPG, PNG, max 2MB each)
- **User guidance** for professional property photography

## 🚀 Interactive Features

### **JavaScript Enhancements:**
```javascript
// Hover effects for buttons and links
onmouseover="this.style.opacity='0.9'" 
onmouseout="this.style.opacity='1'"

// Dynamic background color changes
onmouseover="this.style.backgroundColor='#F5F5F0'"
```

### **Form Features:**
- **Date pickers** for check-in/check-out
- **Dynamic validation** with Laravel error display
- **Multi-step forms** for property creation
- **Search functionality** with filters

### **Responsive Design:**
- **Mobile-first approach** with Tailwind breakpoints
- **Grid layouts** that adapt to screen size
- **Responsive navigation** with mobile menu
- **Touch-friendly** buttons and interactions

## 🔧 Template Features

### **Blade Directives Used:**
```blade
@extends('layouts.app')              // Template inheritance
@section('content')                  // Content sections
@forelse($properties as $property)   // Loop with empty state
@if($property->image)               // Conditional rendering
@php $image = $property->getImage() // PHP in templates
{{ asset('storage/' . $image) }}    // Asset URL generation
```

### **Authentication Integration:**
```blade
@auth                               // Show for logged-in users
@guest                             // Show for guests only
@if(Auth::user()->role === 'owner') // Role-based display
```

### **Error Handling:**
```blade
@error('title')                     // Display validation errors
    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
@enderror
```

## 📱 User Experience Features

### **Property Discovery:**
- **Featured properties** on homepage
- **Property type browsing** with visual icons
- **Search functionality** with location and date filters
- **Detailed property pages** with image galleries

### **Booking Experience:**
- **Calendar integration** for date selection
- **Real-time availability** checking
- **Booking management** dashboard
- **Review system** after completed stays

### **Account Management:**
- **Profile editing** with personal information
- **Password management** with validation
- **Role-specific dashboards** (customer vs. owner)
- **Navigation adapted** to user role and authentication status

## 🔧 Development Notes

### **Best Practices:**
- Use Blade template inheritance for consistent layouts
- Keep business logic in controllers, not views
- Use proper HTML semantic elements for accessibility
- Implement responsive design from the start
- Validate all forms on both client and server side

### **Performance Considerations:**
- Optimize images for web delivery
- Use lazy loading for property galleries
- Minimize inline styles where possible
- Compress CSS and JavaScript in production

### **Maintenance:**
- Keep views organized by feature/module
- Use consistent naming conventions
- Document custom CSS classes and JavaScript functions
- Regular testing across different devices and browsers