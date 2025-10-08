<x-layout>
    <div>
        <h1>Booked Room</h1>
        <h1>Booked category: {{ $booking['room_category'] }}</h1>
        <h1>Customer Name: {{ $booking['name'] }}</h1>
        <br>

        <p>Customer Phone: {{ $booking['phone'] }}</p>
        <p>Customer email: {{ $booking['email'] }}</p>
        <p>Room Number: {{ $booking->room->room_number }}</p>
        <br>
        <h2>Booked Date: {{ $booking['check_in'] }} to {{ $booking['check_out'] }} </h2>
        <p>Base Price: {{ $booking->room->roomcategory->base_price }}</p>
        <p>Final Price: {{ $booking['total_price'] }}</p>
    </div>
</x-layout>