<x-layout :title="'Welcome'">
    @vite('resources/css/body.css')
    <div class="welcome-container">
        <div class="welcome-text">
            <h1>Welcome to <span>HotelGo</span></h1>
            <p>Your gateway to comfort and luxury.</p>
        </div>
        <a href="/book" class="book-button">Book Rooms</a>

        
    </div>
</x-layout>