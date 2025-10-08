<x-layout>
    <div>
        <h1>Booking From: {{ $request['checkin'] }} to {{ $request['checkout'] }}</h1>
        <h1>Category: {{ $request['category'] }}</h1>
        <h1>Price: {{ $request['price'] }}</h1>
        <form action="{{ route('booking.store')}}" method="post">
            @csrf

            <label for="name">Full Name:</label>
            <input type="text" id="name" name="name" required><br>

            <label for="phone">Phone Number:</label>
            <input type="number" id="phone" name="phone" required><br>
            @error('phone')
                <span class="error-message">{{ $message }}</span>
            @enderror

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br>
            @error('email')
                <span class="error-message">{{ $message }}</span>
            @enderror


            <input type="hidden" id="checkin" name="checkin" value="{{ $request['checkin'] }}" required>
            <input type="hidden" id="checkout" name="checkout" value="{{ $request['checkout'] }}" required>  
            <input type="hidden" id="category" name="room-category" value="{{ $request['category'] }}" required>  
            <input type="hidden" id="price" name="total-price" value="{{ $request['price'] }}" required>  
            <button type="submit" class="submit-button">Confirm Booking</button>
        </form>
    </div>

</x-layout>