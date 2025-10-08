<x-layout :title="'Booking'">
    @vite('resources/css/booking.css')

    <div class="booking-container">
        <!-- first step // validation -->
        @isset($verify)
        <form action="{{ route('booking.check') }}" method="POST" class="booking-form">
            @csrf
            <h1 class="booking-title"><span>Book</span> Your Stay</h1>

            <div class="form-group">
                <!-- <div style="display: flex; gap:1rem; align-items: center;">
                    <label for="phone">Phone Number:</label>
                    <input type="text" id="phone" name="phone" required>
                    @error('phone')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div> -->
                <label for="phone">Phone Number:</label>
                <input type="text" id="phone" name="phone" required>
                @error('phone')
                    <span class="error-message">{{ $message }}</span>
                @enderror

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required><br>
                @error('email')
                    <span class="error-message">{{ $message }}</span>
                @enderror

                <div style="display: flex; " >
                    <label for="checkin">Check-In Date:</label>
                    <input type="date" id="checkin" name="checkin" min="{{ date('Y-m-d') }}" required>
                    @error('checkin')
                    <span class="error-message">{{ $message }}</span>
                    @enderror

                    <label for="checkout">Check-Out Date:</label>
                    <input type="date" id="checkout" name="checkout" min="{{ date('Y-m-d') }}" required> 
                    @error('checkout')
                    <span class="error-message">{{ $message }}</span>
                    @enderror    
                </div>
                            
            </div>

            <button type="submit" class="submit-button">Check Availability</button>
        </form>
        @endisset

        <!-- available rooms -->
        @isset($validated)
        <div class="available-container">
            <div class="in-out">
            <h1>Check In date: {{ $checkin }}</h1>
            <h1>Check Out date: {{ $checkout }}</h1>  
            </div>
            <h1 class="available-rooms-title">Available Room Categories</h1>
            <div class="grid">>
                @foreach ($availableCategories as $category)
                    <div class="category-card">
                        <h2>{{ $category['category'] }}</h2>

                        <!-- price -->
                        <p>Base Price: {{ $category['base_price'] }} BDT</p>
                        
                        @if ($discount && $weekendSurcharge >0)
                        @php
                            $price = ($category['base_price'] + $weekendSurcharge) - (($category['base_price'] + $weekendSurcharge) * 0.1);
                        @endphp
                            <p class="surcharge-info">*Both Discount and Weekend Surchager Applied: {{ $price }} BDT</p>

                        @elseif ($discount && $weekendSurcharge ==0)
                            @php
                                $price = $category['base_price'] - ($category['base_price'] * 0.1)
                            @endphp
                            <p class="surcharge-info">*Discount Applied: {{ $price }} BDT </p>

                        @elseif (!$discount && $weekendSurcharge >0)
                            @php
                                $price = $category['base_price'] + $weekendSurcharge;
                            @endphp
                            <p class="surcharge-info">*Weekend Surchager Applied: {{ $price }} BDT </p>
                        @else
                            @php
                                $price = $category['base_price'];
                            @endphp
                        @endif
                        <!-- room available -->
                        @if ($category['available_rooms'] > 0)
                            <p>Available Rooms: <span>{{ $category['available_rooms'] }}</span></p>
                            <form action="{{ route('booking.book', $category['category']) }}" method="get">
                                @csrf
                                <input type="hidden" name="checkin" value="{{ $checkin }}">
                                <input type="hidden" name="checkout" value="{{ $checkout }}">
                                <input type="hidden" name="phone" value="{{ $validated['phone'] }}">
                                <input type="hidden" name="email" value="{{ $validated['email'] }}">
                                <input type="hidden" name="category" value="{{ $category['category'] }}">
                                <input type="hidden" name="price" value="{{ $price }}">
                                <button type="submit">Add to Cart</button>
                            </form>
                        @else
                            <p class="no-room">No rooms available</p>
                        @endif
                        

                    </div>
                @endforeach
            </div>
        </div>
        @endisset
    </div>
    
</x-layout>
@vite('resources/js/index.js')