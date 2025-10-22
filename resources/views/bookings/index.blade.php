@extends('layouts.app')

@section('content')
<div class="min-h-screen" style="background-color: #F5F5F0;">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex justify-between items-center">
                <div>
                    @if(Auth::user()->role === 'owner' || Auth::user()->role === 'admin')
                        <h1 class="text-4xl font-bold mb-2">Property Bookings</h1>
                        <p class="text-gray-600">View and manage bookings for your properties</p>
                    @else
                        <h1 class="text-4xl font-bold mb-2">My Bookings</h1>
                        <p class="text-gray-600">View and manage all your reservations</p>
                    @endif
                </div>
                @if(Auth::user()->role === 'owner' || Auth::user()->role === 'admin')
                    <a href="{{ route('owner.dashboard') }}" 
                       class="px-6 py-3 rounded-lg font-medium text-white transition"
                       style="background-color: #80A1BA;"
                       onmouseover="this.style.opacity='0.8'" 
                       onmouseout="this.style.opacity='1'">
                        <i class="fas fa-arrow-left mr-2"></i> Back to Dashboard
                    </a>
                @endif
            </div>
        </div>

        @if($bookings->count() > 0)
            <!-- Bookings Grid -->
            <div class="space-y-6">
                @foreach($bookings as $booking)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="md:flex">
                            <!-- Property Image -->
                            <div class="md:w-1/3">
                                @if($booking->property->image)
                                    @if(str_starts_with($booking->property->image, 'http'))
                                        <img src="{{ $booking->property->image }}" 
                                             alt="{{ $booking->property->title }}" 
                                             class="w-full h-48 md:h-full object-cover">
                                    @else
                                        <img src="{{ asset('storage/' . $booking->property->image) }}" 
                                             alt="{{ $booking->property->title }}" 
                                             class="w-full h-48 md:h-full object-cover">
                                    @endif
                                @else
                                    <div class="w-full h-48 md:h-full bg-gray-200 flex items-center justify-center">
                                        <i class="fas fa-home text-4xl text-gray-400"></i>
                                    </div>
                                @endif
                            </div>

                            <!-- Booking Details -->
                            <div class="md:w-2/3 p-6">
                                <div class="flex justify-between items-start mb-4">
                                    <div>
                                        <h3 class="text-xl font-bold mb-2">{{ $booking->property->title }}</h3>
                                        <p class="text-gray-600 mb-1">
                                            <i class="fas fa-map-marker-alt mr-1"></i>
                                            {{ $booking->property->city }}, {{ $booking->property->state }}
                                        </p>
                                        <p class="text-gray-600">
                                            <i class="fas fa-users mr-1"></i>
                                            {{ $booking->guests }} {{ Str::plural('guest', $booking->guests) }}
                                        </p>
                                        @if(Auth::user()->role === 'owner' || Auth::user()->role === 'admin')
                                            <p class="text-gray-600 mt-1">
                                                <i class="fas fa-user mr-1"></i>
                                                Guest: {{ $booking->customer->name }}
                                            </p>
                                            <p class="text-gray-600">
                                                <i class="fas fa-envelope mr-1"></i>
                                                {{ $booking->customer->email }}
                                            </p>
                                        @endif
                                    </div>
                                    
                                    <!-- Booking Status -->
                                    <div class="text-right">
                                        @php
                                            $statusColor = match($booking->status) {
                                                'confirmed' => 'bg-green-100 text-green-800',
                                                'pending' => 'bg-yellow-100 text-yellow-800',
                                                'cancelled' => 'bg-red-100 text-red-800',
                                                'completed' => 'bg-blue-100 text-blue-800',
                                                default => 'bg-gray-100 text-gray-800'
                                            };
                                        @endphp
                                        <span class="px-3 py-1 rounded-full text-sm font-medium {{ $statusColor }}">
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Dates and Price -->
                                <div class="grid md:grid-cols-3 gap-4 mb-4">
                                    <div>
                                        <p class="text-sm text-gray-500">Check-in</p>
                                        <p class="font-semibold">{{ $booking->check_in->format('M d, Y') }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Check-out</p>
                                        <p class="font-semibold">{{ $booking->check_out->format('M d, Y') }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Total Price</p>
                                        <p class="font-semibold text-lg" style="color: #80A1BA;">${{ number_format($booking->total_price, 2) }}</p>
                                    </div>
                                </div>

                                <!-- Duration -->
                                <div class="mb-4">
                                    <p class="text-sm text-gray-500">Duration</p>
                                    <p class="font-medium">{{ $booking->check_in->diffInDays($booking->check_out) }} {{ Str::plural('night', $booking->check_in->diffInDays($booking->check_out)) }}</p>
                                </div>

                                <!-- Actions -->
                                <div class="flex gap-3 mt-4">
                                    <a href="{{ route('bookings.show', $booking) }}" 
                                       class="px-4 py-2 rounded-lg font-medium transition"
                                       style="background-color: #91C4C3; color: white;"
                                       onmouseover="this.style.opacity='0.8'" 
                                       onmouseout="this.style.opacity='1'">
                                        <i class="fas fa-eye mr-1"></i> View Details
                                    </a>
                                    <a href="{{ route('properties.show', $booking->property) }}" 
                                       class="px-4 py-2 rounded-lg font-medium transition"
                                       style="background-color: #80A1BA; color: white;"
                                       onmouseover="this.style.opacity='0.8'" 
                                       onmouseout="this.style.opacity='1'">
                                        View Property
                                    </a>
                                    
                                    @if($booking->status === 'confirmed' && $booking->check_out->isPast())
                                        @if(!$booking->hasReview())
                                            <button onclick="openReviewModal({{ $booking->id }})" 
                                                    class="px-4 py-2 rounded-lg font-medium transition"
                                                    style="background-color: #91C4C3; color: white;"
                                                    onmouseover="this.style.opacity='0.8'" 
                                                    onmouseout="this.style.opacity='1'">
                                                Leave Review
                                            </button>
                                        @else
                                            <span class="px-4 py-2 rounded-lg font-medium bg-gray-200 text-gray-600">
                                                Reviewed
                                            </span>
                                        @endif
                                    @endif
                                    
                                    @if($booking->status === 'pending')
                                        <form action="{{ route('bookings.destroy', $booking) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    onclick="return confirm('Are you sure you want to cancel this booking?')"
                                                    class="px-4 py-2 bg-red-500 text-white rounded-lg font-medium hover:bg-red-600 transition">
                                                Cancel Booking
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $bookings->links() }}
            </div>

        @else
            <!-- Empty State -->
            <div class="bg-white rounded-lg shadow-md p-12 text-center">
                <div class="mb-6">
                    <i class="fas fa-calendar-times text-6xl text-gray-300"></i>
                </div>
                @if(Auth::user()->role === 'owner' || Auth::user()->role === 'admin')
                    <h2 class="text-2xl font-bold text-gray-600 mb-4">No Bookings Yet</h2>
                    <p class="text-gray-500 mb-6">No one has booked your properties yet. Make sure your properties are listed and attractive!</p>
                    <div class="space-x-4">
                        <a href="{{ route('owner.dashboard') }}" 
                           class="inline-block px-6 py-3 rounded-lg font-medium text-white transition"
                           style="background-color: #80A1BA;"
                           onmouseover="this.style.opacity='0.8'" 
                           onmouseout="this.style.opacity='1'">
                            Back to Dashboard
                        </a>
                        <a href="{{ route('properties.create') }}" 
                           class="inline-block px-6 py-3 rounded-lg font-medium border-2 transition"
                           style="border-color: #80A1BA; color: #80A1BA;"
                           onmouseover="this.style.backgroundColor='rgba(128, 161, 186, 0.1)'" 
                           onmouseout="this.style.backgroundColor=''">
                            Add Property
                        </a>
                    </div>
                @else
                    <h2 class="text-2xl font-bold text-gray-600 mb-4">No Bookings Yet</h2>
                    <p class="text-gray-500 mb-6">You haven't made any reservations yet. Start exploring properties!</p>
                    <a href="{{ route('properties.index') }}" 
                       class="inline-block px-6 py-3 rounded-lg font-medium text-white transition"
                       style="background-color: #80A1BA;"
                       onmouseover="this.style.opacity='0.8'" 
                       onmouseout="this.style.opacity='1'">
                        Browse Properties
                    </a>
                @endif
            </div>
        @endif
    </div>
</div>

<!-- Review Modal -->
<div id="reviewModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50" style="display: none; align-items: center; justify-content: center;">
    <div class="bg-white rounded-lg p-6 w-full max-w-md mx-4">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold">Leave a Review</h3>
            <button onclick="closeReviewModal()" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <form id="reviewForm" method="POST">
            @csrf
            @method('PUT')
            
            <!-- Overall Rating -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Overall Rating</label>
                <div class="flex gap-1">
                    @for($i = 1; $i <= 5; $i++)
                        <button type="button" class="star-rating" data-rating="{{ $i }}" data-field="rating">
                            <i class="far fa-star text-2xl text-gray-300"></i>
                        </button>
                    @endfor
                </div>
                <input type="hidden" name="rating" id="rating" required>
            </div>
            
            <!-- Review Comment -->
            <div class="mb-4">
                <label for="review_comment" class="block text-sm font-medium text-gray-700 mb-2">Review</label>
                <textarea name="review_comment" id="review_comment" rows="4" 
                          class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                          placeholder="Share your experience..."></textarea>
            </div>
            
            <div class="flex gap-3">
                <button type="submit" 
                        class="flex-1 px-4 py-2 rounded-lg font-medium text-white transition"
                        style="background-color: #80A1BA;"
                        onmouseover="this.style.opacity='0.8'" 
                        onmouseout="this.style.opacity='1'">
                    Submit Review
                </button>
                <button type="button" onclick="closeReviewModal()" 
                        class="px-4 py-2 border border-gray-300 rounded-lg font-medium text-gray-700 hover:bg-gray-50 transition">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openReviewModal(bookingId) {
    const modal = document.getElementById('reviewModal');
    modal.classList.remove('hidden');
    modal.style.display = 'flex';
    document.getElementById('reviewForm').action = `/bookings/${bookingId}`;
    
    // Reset form
    document.getElementById('rating').value = '';
    document.getElementById('review_comment').value = '';
    resetStars();
}

function closeReviewModal() {
    const modal = document.getElementById('reviewModal');
    modal.classList.add('hidden');
    modal.style.display = 'none';
}

function resetStars() {
    document.querySelectorAll('.star-rating i').forEach(star => {
        star.className = 'far fa-star text-2xl text-gray-300';
    });
}

// Star rating functionality
document.querySelectorAll('.star-rating').forEach(button => {
    button.addEventListener('click', function() {
        const rating = parseInt(this.dataset.rating);
        const field = this.dataset.field;
        
        document.getElementById(field).value = rating;
        
        // Update visual stars
        const stars = document.querySelectorAll(`.star-rating[data-field="${field}"] i`);
        stars.forEach((star, index) => {
            if (index < rating) {
                star.className = 'fas fa-star text-2xl text-yellow-400';
            } else {
                star.className = 'far fa-star text-2xl text-gray-300';
            }
        });
    });
});
</script>
@endsection