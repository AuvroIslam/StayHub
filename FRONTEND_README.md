# StayHub - Airbnb-like Property Rental Platform

## Project Overview
StayHub is a comprehensive property rental platform built with Laravel, similar to Airbnb. The platform supports two main user roles:
- **Property Owners**: Can list and manage their properties, handle bookings, and track earnings
- **Customers**: Can search, book properties, manage bookings, and save favorites

## Frontend Structure

### Technologies Used
- **Laravel Blade Templates**: Server-side templating
- **Tailwind CSS**: Utility-first CSS framework (via CDN)
- **Font Awesome**: Icon library
- **Responsive Design**: Mobile-first approach

### Pages Created

#### 1. Layout
- **File**: `resources/views/layouts/app.blade.php`
- **Description**: Main layout template with navigation, footer, and responsive design
- **Features**:
  - Sticky navigation bar with search
  - User dropdown menu (role-based)
  - Footer with links and social media
  - Mobile-responsive design

#### 2. Homepage
- **File**: `resources/views/home.blade.php`
- **Route**: `/`
- **Features**:
  - Hero section with gradient background
  - Advanced search form (location, dates, guests)
  - Property type categories
  - Featured properties grid
  - Why Choose Us section
  - Call-to-action for property owners

#### 3. Property Listing Page
- **File**: `resources/views/properties/index.blade.php`
- **Route**: `/properties`
- **Features**:
  - Advanced filtering (location, dates, type, price)
  - Sort options (recommended, price, rating, newest)
  - Property cards with images and details
  - Pagination
  - Responsive grid layout

#### 4. Property Detail Page
- **File**: `resources/views/properties/show.blade.php`
- **Route**: `/property/{id}`
- **Features**:
  - Image gallery (5 images)
  - Property information and amenities
  - Host details
  - Location map placeholder
  - Reviews and ratings
  - Booking card (sticky sidebar)
  - Price calculator

#### 5. Authentication Pages

##### Login
- **File**: `resources/views/auth/login.blade.php`
- **Route**: `/login`
- **Features**:
  - Email/password login
  - Remember me option
  - Social login (Google, Facebook)
  - Forgot password link

##### Register
- **File**: `resources/views/auth/register.blade.php`
- **Route**: `/register`
- **Features**:
  - Role selection (Property Owner/Customer)
  - Registration form with validation
  - Terms & conditions acceptance
  - Social registration options

#### 6. Property Owner Dashboard
- **File**: `resources/views/owner/dashboard.blade.php`
- **Route**: `/owner/dashboard`
- **Features**:
  - Statistics cards (properties, bookings, earnings, ratings)
  - Recent bookings list
  - Property management
  - Quick actions
  - Earnings overview
  - Message notifications

#### 7. Customer Dashboard
- **File**: `resources/views/customer/dashboard.blade.php`
- **Route**: `/customer/dashboard`
- **Features**:
  - Statistics cards (upcoming trips, total bookings, favorites, spending)
  - Upcoming trips with details
  - Past trips with ratings
  - Profile card
  - Favorite properties
  - Quick links menu

## Database Schema (To Be Implemented)

The following tables will be created in the next phase:

1. **users**
   - id, name, email, password, role (owner/customer), phone, created_at, updated_at

2. **properties**
   - id, user_id, title, description, address, city, country, type, bedrooms, bathrooms, guests, price_per_night, status, created_at, updated_at

3. **property_images**
   - id, property_id, image_path, is_primary, created_at, updated_at

4. **amenities**
   - id, name, icon, created_at, updated_at

5. **property_amenities**
   - id, property_id, amenity_id

6. **bookings**
   - id, property_id, user_id, check_in, check_out, guests, total_price, status, created_at, updated_at

7. **reviews**
   - id, property_id, user_id, booking_id, rating, comment, created_at, updated_at

8. **payments**
   - id, booking_id, amount, payment_method, status, transaction_id, created_at, updated_at

9. **messages**
   - id, sender_id, receiver_id, property_id, message, is_read, created_at, updated_at

## Color Scheme
- **Primary**: Purple (#7C3AED - purple-600)
- **Secondary**: Indigo (#4F46E5)
- **Success**: Green (#10B981)
- **Warning**: Yellow (#F59E0B)
- **Danger**: Red (#EF4444)
- **Background**: Gray (#F9FAFB - gray-50)

## Icons
Using Font Awesome 6.4.0 for all icons:
- Home/Properties: `fa-home`, `fa-building`
- User: `fa-user-circle`, `fa-user`
- Calendar: `fa-calendar-check`, `fa-calendar`
- Search: `fa-search`
- Heart: `fa-heart`
- Star: `fa-star`
- And many more...

## Responsive Breakpoints
- Mobile: < 768px
- Tablet: 768px - 1024px
- Desktop: > 1024px

## Next Steps

1. **Database Implementation**
   - Create migrations for all tables
   - Set up relationships
   - Add seeders with sample data

2. **Backend Development**
   - Controllers for each feature
   - Authentication system
   - API endpoints
   - Image upload functionality

3. **Advanced Features**
   - Real-time messaging
   - Payment integration
   - Email notifications
   - Calendar availability
   - Reviews and ratings system
   - Search with filters

## Installation & Setup

1. Clone the repository
2. Install dependencies:
   ```bash
   composer install
   npm install
   ```

3. Configure environment:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. Set up database in `.env`:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=stayhub
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. Run migrations (after creating them):
   ```bash
   php artisan migrate
   ```

6. Start the development server:
   ```bash
   php artisan serve
   ```

7. Access the application at: `http://localhost:8000`

## Routes Summary

### Public Routes
- `/` - Homepage
- `/properties` - Property listing
- `/property/{id}` - Property details
- `/login` - Login page
- `/register` - Registration page
- `/search` - Search results

### Owner Routes (Protected)
- `/owner/dashboard` - Owner dashboard
- `/owner/properties` - Manage properties
- `/owner/bookings` - Manage bookings
- `/owner/earnings` - Earnings report

### Customer Routes (Protected)
- `/customer/dashboard` - Customer dashboard
- `/customer/bookings` - My bookings
- `/customer/favorites` - Favorite properties

### Common Routes
- `/messages` - Messages
- `/profile` - User profile

## Contributing
This is a learning project for demonstration purposes.

## License
Open-source project for educational use.
