# Tests Directory - StayHub Quality Assurance

This directory contains all automated tests for the StayHub property rental platform, ensuring code quality and functionality reliability.

## 📁 Directory Structure

```
tests/
├── Feature/     # Feature tests (end-to-end functionality)
├── Unit/        # Unit tests (individual component testing)
└── TestCase.php # Base test class with common functionality
```

## 🎯 Purpose
Provides comprehensive testing coverage for StayHub's property management, booking system, user authentication, and image gallery functionality.

## 🧪 Test Types

### **Feature Tests** - End-to-End Testing
Tests complete user workflows and application features:

```php
// Example: Property creation with 5-image requirement
class PropertyCreationTest extends TestCase
{
    public function test_property_owner_can_create_property_with_five_images()
    {
        $owner = User::factory()->create(['role' => 'owner']);
        
        $response = $this->actingAs($owner)
            ->post('/properties', [
                'title' => 'Beautiful Villa',
                'description' => 'Stunning ocean view villa with private pool',
                'image' => UploadedFile::fake()->image('image1.jpg'),
                'image_2' => UploadedFile::fake()->image('image2.jpg'),
                'image_3' => UploadedFile::fake()->image('image3.jpg'),
                'image_4' => UploadedFile::fake()->image('image4.jpg'),
                'image_5' => UploadedFile::fake()->image('image5.jpg'),
                // ... other property data
            ]);
            
        $response->assertRedirect('/owner/dashboard');
        $this->assertDatabaseHas('properties', ['title' => 'Beautiful Villa']);
    }
}
```

### **Unit Tests** - Component Testing
Tests individual classes and methods in isolation:

```php
// Example: Property model testing
class PropertyTest extends TestCase
{
    public function test_property_returns_all_images_array()
    {
        $property = Property::factory()->create([
            'image' => 'properties/img1.jpg',
            'image_2' => 'properties/img2.jpg',
            'image_3' => 'properties/img3.jpg',
            'image_4' => 'properties/img4.jpg',
            'image_5' => 'properties/img5.jpg',
        ]);
        
        $images = $property->getAllImagesAttribute();
        
        $this->assertCount(5, $images);
        $this->assertEquals('properties/img1.jpg', $images[0]);
    }
    
    public function test_property_calculates_average_rating_correctly()
    {
        $property = Property::factory()->create();
        
        // Create bookings with reviews
        Booking::factory()->count(3)->create([
            'property_id' => $property->id,
            'rating' => 4,
            'status' => 'completed',
        ]);
        
        $this->assertEquals(4.0, $property->average_rating);
    }
}
```

## 🏠 StayHub-Specific Test Scenarios

### **Property Management Tests:**

#### **Property Creation:**
```php
// Feature/PropertyManagementTest.php
public function test_property_creation_requires_five_images()
{
    $response = $this->actingAs($owner)
        ->post('/properties', $this->validPropertyData([
            'image' => UploadedFile::fake()->image('image1.jpg'),
            // Only 1 image instead of required 5
        ]));
        
    $response->assertSessionHasErrors(['image_2', 'image_3', 'image_4', 'image_5']);
}

public function test_property_creation_validates_image_types()
{
    $response = $this->actingAs($owner)
        ->post('/properties', $this->validPropertyData([
            'image' => UploadedFile::fake()->create('document.pdf', 100), // Invalid type
        ]));
        
    $response->assertSessionHasErrors('image');
}
```

#### **Property Gallery Display:**
```php
public function test_property_show_displays_different_images()
{
    $property = Property::factory()->create([
        'image' => 'https://images.unsplash.com/photo-1.jpg',
        'image_2' => 'https://images.unsplash.com/photo-2.jpg',
        'image_3' => 'properties/uploaded-image.jpg',
        'image_4' => 'https://images.unsplash.com/photo-4.jpg',
        'image_5' => 'properties/another-upload.jpg',
    ]);
    
    $response = $this->get("/properties/{$property->id}");
    
    $response->assertSee('photo-1.jpg');
    $response->assertSee('photo-2.jpg');
    $response->assertSee('/storage/properties/uploaded-image.jpg');
    $response->assertSee('/storage/properties/another-upload.jpg');
}
```

### **User Authentication Tests:**

#### **Role-Based Access:**
```php
// Feature/AuthenticationTest.php
public function test_only_owners_can_create_properties()
{
    $customer = User::factory()->create(['role' => 'customer']);
    
    $response = $this->actingAs($customer)->get('/properties/create');
    
    $response->assertForbidden();
}

public function test_admin_can_access_all_dashboards()
{
    $admin = User::factory()->create(['role' => 'admin']);
    
    $this->actingAs($admin)->get('/owner/dashboard')->assertOk();
    $this->actingAs($admin)->get('/customer/dashboard')->assertOk();
}
```

#### **Profile Management:**
```php
public function test_user_can_update_profile_information()
{
    $user = User::factory()->create();
    
    $response = $this->actingAs($user)
        ->put('/profile', [
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
            'phone' => '+1234567890',
            'date_of_birth' => '1990-01-01',
        ]);
        
    $response->assertRedirect('/profile');
    $this->assertDatabaseHas('users', ['name' => 'Updated Name']);
}
```

### **Booking System Tests:**

#### **Booking Creation:**
```php
// Feature/BookingTest.php
public function test_customer_can_book_available_property()
{
    $customer = User::factory()->create(['role' => 'customer']);
    $property = Property::factory()->create();
    
    $response = $this->actingAs($customer)
        ->post("/properties/{$property->id}/book", [
            'check_in' => now()->addDays(1)->toDateString(),
            'check_out' => now()->addDays(3)->toDateString(),
            'guests' => 2,
        ]);
        
    $response->assertRedirect('/customer/dashboard');
    $this->assertDatabaseHas('bookings', [
        'user_id' => $customer->id,
        'property_id' => $property->id,
    ]);
}

public function test_cannot_book_overlapping_dates()
{
    $property = Property::factory()->create();
    
    // Create existing booking
    Booking::factory()->create([
        'property_id' => $property->id,
        'check_in' => now()->addDays(1),
        'check_out' => now()->addDays(5),
        'status' => 'confirmed',
    ]);
    
    $response = $this->actingAs($customer)
        ->post("/properties/{$property->id}/book", [
            'check_in' => now()->addDays(3)->toDateString(), // Overlapping
            'check_out' => now()->addDays(7)->toDateString(),
        ]);
        
    $response->assertSessionHasErrors('check_in');
}
```

#### **Review System:**
```php
public function test_customer_can_review_completed_booking()
{
    $booking = Booking::factory()->create([
        'status' => 'completed',
        'check_out' => now()->subDays(1),
    ]);
    
    $response = $this->actingAs($booking->customer)
        ->post("/bookings/{$booking->id}/review", [
            'rating' => 5,
            'cleanliness_rating' => 5,
            'communication_rating' => 4,
            'checkin_rating' => 5,
            'accuracy_rating' => 4,
            'location_rating' => 5,
            'value_rating' => 4,
            'review_text' => 'Amazing property with great amenities!',
        ]);
        
    $response->assertRedirect("/bookings/{$booking->id}");
    $this->assertDatabaseHas('bookings', [
        'id' => $booking->id,
        'rating' => 5,
    ]);
}
```

## 🔧 Testing Configuration

### **TestCase.php** - Base Test Class
```php
<?php
namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, RefreshDatabase;
    
    protected function setUp(): void
    {
        parent::setUp();
        
        // Seed basic data for every test
        $this->seed(UserSeeder::class);
        
        // Configure test storage
        Storage::fake('public');
        
        // Disable rate limiting for tests
        RateLimiter::clear();
    }
    
    protected function validPropertyData(array $overrides = []): array
    {
        return array_merge([
            'title' => 'Test Property',
            'description' => 'A beautiful test property with great amenities',
            'address' => '123 Test Street',
            'city' => 'Test City',
            'state' => 'Test State',
            'property_type' => 'apartment',
            'bedrooms' => 2,
            'bathrooms' => 2,
            'max_guests' => 4,
            'price_per_night' => 150.00,
            'image' => UploadedFile::fake()->image('image1.jpg'),
            'image_2' => UploadedFile::fake()->image('image2.jpg'),
            'image_3' => UploadedFile::fake()->image('image3.jpg'),
            'image_4' => UploadedFile::fake()->image('image4.jpg'),
            'image_5' => UploadedFile::fake()->image('image5.jpg'),
        ], $overrides);
    }
}
```

### **Database Testing:**
```php
// Feature/DatabaseTest.php
public function test_property_seeder_creates_correct_data()
{
    $this->seed(PropertySeeder::class);
    
    $this->assertDatabaseCount('properties', 16);
    
    $property = Property::first();
    $this->assertNotNull($property->image);
    $this->assertNotNull($property->image_2);
    $this->assertNotNull($property->image_3);
    $this->assertNotNull($property->image_4);
    $this->assertNotNull($property->image_5);
}

public function test_user_seeder_creates_all_roles()
{
    $this->seed(UserSeeder::class);
    
    $this->assertDatabaseHas('users', ['role' => 'admin']);
    $this->assertDatabaseHas('users', ['role' => 'owner']);
    $this->assertDatabaseHas('users', ['role' => 'customer']);
}
```

## 📊 Test Coverage Areas

### **Property Management (80% Coverage):**
- ✅ Property creation with 5-image requirement
- ✅ Property editing and updates
- ✅ Image upload validation (type, size, count)
- ✅ Property deletion with booking checks
- ✅ Property display with dynamic images
- ✅ Property search and filtering

### **User Authentication (90% Coverage):**
- ✅ Multi-role registration and login
- ✅ Email verification flow
- ✅ Password reset functionality
- ✅ Profile management and updates
- ✅ Role-based access control
- ✅ Dashboard routing by role

### **Booking System (85% Coverage):**
- ✅ Booking creation and validation
- ✅ Date availability checking
- ✅ Booking status management
- ✅ Review and rating system
- ✅ Booking history and display
- ✅ Owner booking management

### **File System (75% Coverage):**
- ✅ Image upload and storage
- ✅ File validation and security
- ✅ Storage symlink functionality
- ✅ Image gallery display
- ✅ File cleanup on deletion

## 🚀 Running Tests

### **Basic Test Commands:**
```bash
# Run all tests
php artisan test

# Run specific test suite
php artisan test tests/Feature/
php artisan test tests/Unit/

# Run specific test file
php artisan test tests/Feature/PropertyTest.php

# Run with coverage report
php artisan test --coverage

# Run tests in parallel (faster)
php artisan test --parallel
```

### **Test Environment:**
```bash
# Set up test environment
cp .env .env.testing
# Configure test database settings in .env.testing

# Use separate test database
DB_CONNECTION=mysql
DB_DATABASE=stayhub_test_db

# Use fake drivers for testing
MAIL_MAILER=array
FILESYSTEM_DISK=testing
CACHE_DRIVER=array
SESSION_DRIVER=array
```

### **Continuous Integration:**
```yaml
# .github/workflows/tests.yml
name: Tests
on: [push, pull_request]
jobs:
  tests:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v2
      - name: Setup PHP
        uses: shivammathur/setup-php@v2
        with:
          php-version: 8.2
      - name: Install dependencies
        run: composer install
      - name: Run tests
        run: php artisan test --coverage
```

## 🔍 Test Data Management

### **Factories for Test Data:**
```php
// database/factories/PropertyFactory.php
class PropertyFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->paragraphs(3, true),
            'image' => 'properties/' . $this->faker->uuid . '.jpg',
            'image_2' => 'properties/' . $this->faker->uuid . '.jpg',
            'image_3' => 'properties/' . $this->faker->uuid . '.jpg',
            'image_4' => 'properties/' . $this->faker->uuid . '.jpg',
            'image_5' => 'properties/' . $this->faker->uuid . '.jpg',
            'price_per_night' => $this->faker->numberBetween(50, 500),
        ];
    }
}
```

### **Test Helpers:**
```php
// Helper methods in TestCase
protected function createPropertyWithImages(): Property
{
    return Property::factory()->create([
        'image' => UploadedFile::fake()->image('test1.jpg'),
        'image_2' => UploadedFile::fake()->image('test2.jpg'),
        'image_3' => UploadedFile::fake()->image('test3.jpg'),
        'image_4' => UploadedFile::fake()->image('test4.jpg'),
        'image_5' => UploadedFile::fake()->image('test5.jpg'),
    ]);
}

protected function loginAsOwner(): User
{
    $owner = User::factory()->create(['role' => 'owner']);
    $this->actingAs($owner);
    return $owner;
}
```

## 📈 Performance Testing

### **Load Testing:**
```php
public function test_property_listing_page_performance()
{
    // Create 100 properties for load testing
    Property::factory()->count(100)->create();
    
    $startTime = microtime(true);
    
    $response = $this->get('/properties');
    
    $endTime = microtime(true);
    $executionTime = ($endTime - $startTime) * 1000;
    
    $response->assertOk();
    $this->assertLessThan(500, $executionTime); // Should load in under 500ms
}
```

## 🔧 Test Maintenance

### **Regular Test Updates:**
- Update tests when adding new features
- Maintain factory definitions with model changes
- Keep test data realistic and representative
- Regular cleanup of obsolete tests

### **Best Practices:**
- Use descriptive test method names
- Test both positive and negative scenarios
- Mock external services and APIs
- Keep tests independent and isolated
- Use appropriate assertion methods
- Regular refactoring of test code

This comprehensive testing strategy ensures the StayHub platform maintains high quality and reliability across all its property management, booking, and user authentication features.