<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Booking;
use App\Models\RoomCategory;
use GuzzleHttp\Promise\Create;
use carbon\carbon;

class BookingController extends Controller
{
    public function index()
    {   
        $verify = true;
        return view('booking',compact('verify'));
    }

    public function check(Request $request)
    {
        // regex check and validate data
        $validated = $request->validate([
            'email' => ['required', 'regex:/^[\w\.-]+@[\w\.-]+\.\w{2,4}$/'],
            'phone' => ['required', 'regex:/^(\+88)?01[3-9]\d{8}$/'],
            'checkin' => 'required|date|after_or_equal:now',
            'checkout' => 'required|date|after:checkin',
        ]);
    
        $checkin = $validated['checkin'];
        $checkout = $validated['checkout'];
        
        $categories = RoomCategory::with('room')->get();

        $availableCategorys = [];

        foreach ($categories as $category) {
            $roomIds = $category->room->pluck('id');

            $bookedCount = Booking::whereIn('room_id', $roomIds) ->where(function ($query) use ($checkin, $checkout) {
                $query->whereBetween('check_in', [$checkin, $checkout])
                      ->orWhereBetween('check_out', [$checkin, $checkout])
                      ->orWhere(function ($query) use ($checkin, $checkout) {
                          $query->where('check_in', '<=', $checkin)
                                ->where('check_out', '>=', $checkout);
                      });
            })
            ->count();

            $bookedRoomIds = Booking::whereIn('room_id', $roomIds) ->where(function ($query) use ($checkin, $checkout) {
                $query->whereBetween('check_in', [$checkin, $checkout])
                      ->orWhereBetween('check_out', [$checkin, $checkout])
                      ->orWhere(function ($query) use ($checkin, $checkout) {
                          $query->where('check_in', '<=', $checkin)
                                ->where('check_out', '>=', $checkout);
                      });
            })
            ->pluck('room_id'); //might change

            $totalRooms = $category->room->count();
            $availableRooms = $totalRooms - $bookedCount;
            $availableRoomIds = $roomIds->diff($bookedRoomIds); //might change

            $availableCategories[] = [
                'category' => $category->category,
                'base_price' => $category->base_price,
                'room_ids' => $availableRoomIds->values(), //might change
                'available_rooms' => max($availableRooms, 0),
        ];
        }

        
        $checkinDate = new \DateTime($checkin);
        $checkoutDate = new \DateTime($checkout);
        $discount  = false;

        $numberOfDays = $checkinDate->diff($checkoutDate)->days +1;
            // dd($numberOfDays);
        
        if($numberOfDays >=3){
            $discount = true;
        }
        
        $weekendDays = ['Friday', 'Saturday'];
        $weekendSurcharge = 0;

        for ($i = 0; $i < $numberOfDays; $i++) {
            $currentDay = (clone $checkinDate)->modify("+$i day");
            // dd($currentDay);
            $dayOfWeek = $currentDay->format('l');

            // Check if the current day is a weekend
            if (in_array($dayOfWeek, $weekendDays)) {
                $weekendSurcharge += ($category->base_price * 0.20);
            }
        }

        // dd($weekendSurcharge);
        // dd($roomIds);
        

        // return redirect()->route('booking.index')->with('success', 'Rooms are available for your selected dates!');
        return view('booking', compact( 'discount','weekendSurcharge','validated','availableCategories','checkin', 'checkout'));
    }
    public function book(Request $request)
    {   
        $request->all();
        // dd($request);
        return view('userinfo',compact('request'));
        
    }
    public function store(Request $request)
    {   
    $validatedData = $request->validate([
        'name' => 'required|string',
        'email' => ['required', 'regex:/^[\w\.-]+@[\w\.-]+\.\w{2,4}$/'],
        'phone' => ['required', 'regex:/^(\+88)?01[3-9]\d{8}$/'], 
        'room-category' => 'required|string',
        'total-price' => 'required|numeric',
        'checkin' => 'required|string',
        'checkout' => 'required|string',
        
    ]);

    $checkin = Carbon::parse($validatedData['checkin']);
    $checkout = Carbon::parse($validatedData['checkout']);
    // dd($validatedData['total-price']);

    $category = RoomCategory::where('category', $validatedData['room-category'])->first();
    $roomIds = $category->room->pluck('id');

    // overlap check
    $bookedRoomIds = Booking::whereIn('room_id', $roomIds) ->where(function ($query) use ($checkin, $checkout) {
                $query->whereBetween('check_in', [$checkin, $checkout])
                      ->orWhereBetween('check_out', [$checkin, $checkout])
                      ->orWhere(function ($query) use ($checkin, $checkout) {
                          $query->where('check_in', '<=', $checkin)
                                ->where('check_out', '>=', $checkout);
                      });
            })
            ->pluck('room_id');
    $availableRoom = Room::where('room_category_id', $category->id)
                    ->whereNotIn('id',$bookedRoomIds)->first();

    // dd($availableRoom['id']);
        

    $booking =Booking::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'phone' => $validatedData['phone'],
                'room_category' => $validatedData['room-category'],
                'room_id' => $availableRoom['id'],
                'total_price' => $validatedData['total-price'],
                'check_in' => $checkin,
                'check_out' => $checkout,
    ]);
    return redirect()->route('booking.invoice', ['booking' => $booking->id]);
}
    public function invoice(Booking $booking)
    {
        return view('invoice', compact('booking'));
    }

}
