# 🏠 StayHub - Quick Visual Guide

## 🎯 Your 8 Pages at a Glance

### 1. 🏠 Homepage (/)
```
┌─────────────────────────────────────────┐
│  STAYHUB  [Search Bar]    Login | SignUp│
├─────────────────────────────────────────┤
│                                         │
│      Find Your Perfect Stay             │
│      [Location] [Check-in] [Check-out]  │
│            [SEARCH BUTTON]              │
│                                         │
├─────────────────────────────────────────┤
│  Browse by Type                         │
│  [Apt] [House] [Villa] [Studio]        │
├─────────────────────────────────────────┤
│  Featured Properties                    │
│  [Card1] [Card2] [Card3]               │
├─────────────────────────────────────────┤
│  Why Choose Us?                         │
│  [Security] [Support] [Price] [Quality]│
└─────────────────────────────────────────┘
```

### 2. 🔍 Property Listing (/properties)
```
┌─────────────────────────────────────────┐
│  Filters: [Location] [Date] [Type] [$] │
├─────────────────────────────────────────┤
│  [Property 1]  [Property 2]  [Property 3]│
│  $120/night    $350/night    $85/night  │
│  ★4.8 NY       ★4.9 Miami    ★4.7 SF    │
├─────────────────────────────────────────┤
│  [Property 4]  [Property 5]  [Property 6]│
│  [Pagination: 1 2 3 4]                  │
└─────────────────────────────────────────┘
```

### 3. 🏢 Property Detail (/property/1)
```
┌──────────────────────────┬──────────────┐
│  [5 Image Gallery]       │  $120/night  │
│                          │  ★4.8 (124)  │
│  Modern Apartment        │  [Check-in]  │
│  123 Main St, NY         │  [Check-out] │
│                          │  [Guests]    │
│  Features:               │  [RESERVE]   │
│  • WiFi  • Parking       │              │
│  • Kitchen • AC          │  Total: $600 │
│                          │              │
│  About This Place        │              │
│  [Description...]        │              │
│                          │              │
│  Reviews (124)           │              │
│  ★★★★★ Great place!      │              │
└──────────────────────────┴──────────────┘
```

### 4. 🔐 Login (/login)
```
┌─────────────────────────────────┐
│         STAYHUB LOGO            │
│       Welcome Back              │
├─────────────────────────────────┤
│  Email:    [____________]       │
│  Password: [____________]       │
│  □ Remember me | Forgot?        │
│         [SIGN IN]               │
│                                 │
│  ─────── Or ───────             │
│  [Google] [Facebook]            │
│                                 │
│  Don't have account? Sign up    │
└─────────────────────────────────┘
```

### 5. 📝 Register (/register)
```
┌─────────────────────────────────┐
│      Create Your Account        │
├─────────────────────────────────┤
│  I want to:                     │
│  [👤 Book Properties]           │
│  [🏢 List Properties] ← Select  │
├─────────────────────────────────┤
│  First Name: [_____]            │
│  Last Name:  [_____]            │
│  Email:      [_____]            │
│  Phone:      [_____]            │
│  Password:   [_____]            │
│  Confirm:    [_____]            │
│  □ I agree to Terms             │
│      [CREATE ACCOUNT]           │
└─────────────────────────────────┘
```

### 6. 👨‍💼 Owner Dashboard (/owner/dashboard)
```
┌─────────────────────────────────────────┐
│  Owner Dashboard    [+ Add Property]    │
├──────────┬──────────┬──────────┬────────┤
│ 12       │ 28       │ $8,450   │ ★4.8   │
│Properties│Bookings  │Earnings  │Rating  │
├──────────┴──────────┴──────────┴────────┤
│  Recent Bookings                        │
│  • Modern Apt - Sarah - $600 [Confirmed]│
│  • Beach Villa - Mike - $2,100 [Pending]│
│  • Studio - Emily - $255 [Confirmed]    │
├─────────────────────────────────────────┤
│  My Properties                          │
│  [Property 1 Card] [Property 2 Card]    │
│  [Edit] [Delete]   [Edit] [Delete]      │
└─────────────────────────────────────────┘
```

### 7. 👤 Customer Dashboard (/customer/dashboard)
```
┌─────────────────────────────────────────┐
│  My Dashboard       [Browse Properties] │
├──────────┬──────────┬──────────┬────────┤
│ 3        │ 15       │ 8        │$4,250  │
│Upcoming  │Total     │Favorites │Spent   │
├──────────┴──────────┴──────────┴────────┤
│  Upcoming Trips                         │
│  [Image] Modern Apt - Dec 15-20 $600    │
│  [Image] Beach Villa - Dec 28-Jan 2     │
├─────────────────────────────────────────┤
│  Past Trips                             │
│  [Image] Cozy Studio - Oct 10-14        │
│  ★★★★★ You rated 5.0                    │
└─────────────────────────────────────────┘
```

### 8. 📐 Main Layout (template)
```
┌─────────────────────────────────────────┐
│ [LOGO]  [Search]  Properties  Login     │ ← Navigation
├─────────────────────────────────────────┤
│                                         │
│         PAGE CONTENT HERE               │
│                                         │
├─────────────────────────────────────────┤
│ About | Quick Links | For Hosts | Help │ ← Footer
│ Social: [f] [t] [i] [in]               │
│ © 2025 StayHub. All rights reserved.   │
└─────────────────────────────────────────┘
```

---

## 🎨 Component Examples

### Property Card Component
```
┌────────────────────┐
│   [Property Image] │
│   ♡ [Favorite]     │
│   [Featured Badge] │
├────────────────────┤
│ Modern Apartment   │
│ 📍 New York, USA   │
│ 🛏️ 2  🛁 2  👥 4   │
│ $120/night  ★4.8   │
│     [View Details] │
└────────────────────┘
```

### Stat Card Component
```
┌─────────────────┐
│  [Icon] 🏢      │
│  Total Props    │
│     12          │
│  ↑ 2 new        │
└─────────────────┘
```

### Booking Card Component
```
┌─────────────────┐
│ [Property Img]  │
│ Modern Apt      │
│ 📍 New York     │
│ 📅 Dec 15-20    │
│ [Confirmed]     │
│    $600         │
│ [View] [Message]│
└─────────────────┘
```

---

## 🗂️ File Organization

```
resources/views/
├── layouts/
│   └── app.blade.php          # Base template for all pages
│
├── auth/
│   ├── login.blade.php        # Extends layouts.app
│   └── register.blade.php     # Extends layouts.app
│
├── properties/
│   ├── index.blade.php        # Extends layouts.app
│   └── show.blade.php         # Extends layouts.app
│
├── owner/
│   └── dashboard.blade.php    # Extends layouts.app
│
├── customer/
│   └── dashboard.blade.php    # Extends layouts.app
│
└── home.blade.php             # Extends layouts.app
```

---

## 🎯 Navigation Flow

```
Homepage (/)
    ↓
    ├─→ Browse Properties (/properties)
    │       ↓
    │       └─→ Property Detail (/property/{id})
    │               ↓
    │               └─→ Book (requires login)
    │
    ├─→ Login (/login)
    │       ↓
    │       └─→ Dashboard (role-based redirect)
    │
    └─→ Register (/register)
            ↓
            └─→ Select Role → Dashboard
```

### Owner Flow
```
Owner Dashboard (/owner/dashboard)
    ├─→ Add Property
    ├─→ Manage Properties
    ├─→ View Bookings
    ├─→ Check Earnings
    └─→ Messages
```

### Customer Flow
```
Customer Dashboard (/customer/dashboard)
    ├─→ View Upcoming Trips
    ├─→ Browse Past Trips
    ├─→ Manage Favorites
    ├─→ Messages
    └─→ Profile Settings
```

---

## 📱 Responsive Breakpoints

```
Mobile (< 768px)
├── Single column layout
├── Hamburger menu
└── Stacked cards

Tablet (768px - 1024px)
├── 2 column grid
├── Expanded menu
└── Side-by-side cards

Desktop (> 1024px)
├── 3-4 column grid
├── Full navigation
└── Sidebar layouts
```

---

## 🎨 Color Usage Guide

```
Purple (#7C3AED) → Primary actions, links, headers
Green (#10B981)  → Success, confirmed bookings
Yellow (#F59E0B) → Warnings, pending status
Red (#EF4444)    → Errors, cancellations, favorites
Blue (#3B82F6)   → Info, secondary actions
Gray (#6B7280)   → Text, borders, backgrounds
```

---

## ✨ Interactive Elements

```
Buttons:
  Primary:   [Purple background, white text]
  Secondary: [White background, purple border]
  Danger:    [Red background, white text]

Forms:
  Input:     [Border, focus ring on purple]
  Select:    [Dropdown with arrow]
  Checkbox:  [Purple when checked]
  Radio:     [Purple when selected]

Cards:
  Default:   [White, shadow]
  Hover:     [Shadow increases, slight scale]
  Active:    [Purple border]

Links:
  Default:   [Purple text]
  Hover:     [Darker purple, underline]
```

---

## 🚀 Testing Checklist

- [ ] Visit homepage - search form works
- [ ] Browse properties - filters display
- [ ] Click property - detail page loads
- [ ] Check login page - form displays
- [ ] Check register - role selection works
- [ ] View owner dashboard - stats show
- [ ] View customer dashboard - bookings show
- [ ] Test mobile view - responsive layout
- [ ] Check navigation - all links work
- [ ] Test footer links - pages load

---

## 📊 Page Statistics

- **Total Pages**: 8
- **Total Routes**: 15+
- **Components**: 20+
- **Features**: 50+
- **Design System**: Complete
- **Responsive**: 100%
- **Icons**: 100+ Font Awesome
- **Colors**: 6 main colors
- **Status**: ✅ Complete

---

*This is your visual reference guide for the StayHub frontend!*
*Keep this handy while developing the backend.*
