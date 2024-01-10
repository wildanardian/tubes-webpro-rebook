<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::where('user_id', auth()->user()->id)->get();
        if($bookings->count() == 0) {
            return view('booking.index', compact('bookings'));
        }
        $list_resto = $bookings->pluck('restaurant_id')->toArray();
        $restaurant = Restaurant::whereIn('id', $list_resto)->get();

        $title = 'Booking';
        return view('booking.index', compact('bookings', 'restaurant', 'title'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'booking_day' => 'required',
            'booking_time' => 'required',
            'booking_seat' => 'required',
        ]);

        if ($validator->fails()) {
            toastr()->error('Please check your input again!', 'Error');
            return redirect()->back()->withErrors($validator->errors());
        }

        $list_seat_number = $this->listSeatNumber();
        $first_available_seat = $this->findFirstAvailableSeat($list_seat_number);

        if ($first_available_seat) {
            $booking = Booking::create([
                'user_id' => auth()->user()->id,
                'restaurant_id' => $request->restaurant_id,
                'day' => $request->booking_day,
                'time' => $request->booking_time,
                'seat_type' => $request->booking_seat,
                'seat_number' => $first_available_seat,
            ]);

            if ($booking) {
                toastr()->success('Booking success!', 'Success');
                return redirect()->route('booking');
            } else {
                toastr()->error('Booking failed!', 'Error');
                return redirect()->back();
            }
        } else {
            toastr()->error('Booking failed! No Seat Available', 'Error');
            return redirect()->back();
        }
    }

    function listSeatNumber()
    {
        $seatNumber = [];

        $numberOfRows = 5;
        $numberSeatPerRow = 5;

        for ($row = 'A'; $row < chr(ord('A') + $numberOfRows); $row++) {
            for ($seat = 1; $seat <= $numberSeatPerRow; $seat++) {
                $seatNumber[] = $row . $seat;
            }
        }
        return $seatNumber;
    }

    protected function findFirstAvailableSeat($list_seat_number)
    {
        foreach ($list_seat_number as $seatNumber) {
            if (!$this->isSeatBooked($seatNumber)) {
                return $seatNumber;
            }
        }
        return null;
    }

    protected function isSeatBooked($seatNumber)
    {
        return Booking::where('seat_number', $seatNumber)->exists();
    }

    public function update(Request $request, string $id)
    {
        $booking = Booking::find($id);
        $booking->status = $request->status;
        $booking->save();
        if ($booking) {
            toastr()->success('Booking status updated!', 'Success');
            return redirect()->back();
        } else {
            toastr()->error('Booking status failed to update!', 'Error');
            return redirect()->back();
        }
    }

    public function destroy(string $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();
        if ($booking) {
            toastr()->success('Booking deleted!', 'Success');
            return redirect()->back();
        } else {
            toastr()->error('Booking failed to delete!', 'Error');
            return redirect()->back();
        }
    }

}
