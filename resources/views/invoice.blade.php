<x-layout :title="'Invoice'">
    @vite('resources/css/booking.css')

    <div class="invoice-container">
        <h2>Thank You</h2>
        <h1>Room Has Been Booked</h1><br>
        <h1 class="inv-1">Booked category: <span>{{ $booking['room_category'] }}</span></h1>
        <h1 class="inv-1">Customer Name: <span>{{ $booking['name'] }}</span></h1>
        <br>

        <p>Customer Phone: {{ $booking['phone'] }}</p>
        <p>Customer email: {{ $booking['email'] }}</p>
        <p>Room Number: <span>{{ $booking->room->room_number }}</span></p>
        <br>
        <h3>Booked Date: {{ $booking['check_in'] }} to {{ $booking['check_out'] }} </h3>
        <br>
        <p class="inv-3">Base Price: {{ $booking->room->roomcategory->base_price }}</p>
        <p class="inv-2">Final Price: {{ $booking['total_price'] }}</p>
    </div>
</x-layout>