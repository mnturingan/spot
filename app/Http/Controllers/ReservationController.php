<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

use App\Models\User;

use App\Models\VenueType;

use App\Models\Reservation;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservations=Reservation::all();
        return view('admin.reservation.index', ['data'=>$reservations]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('reservation.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'venue_id'=>'required',
            'reservation_date'=>'required',
            'start_time'=>'required',
            'end_time'=>'required',
            'purpose'=>'required'
        ]);

        $data = new Reservation;

        // Check if the user is authenticated
        if (auth()->check()) {
            $data->user_id = auth()->user()->id;
        } else {
            // Handle the case where the user is not authenticated (e.g., redirect to login)
            return redirect()->route('login')->with('error', 'You must be logged in to make a reservation.');
        }

        $data->user_id = auth()->user()->id;
        $data->venue_id = $request->venue_id;
        $data->reservation_date = $request->reservation_date;
        $data->start_time = $request->start_time;
        $data->end_time = $request->end_time;
        $data->status = 'waiting';
        $data->purpose = $request->purpose;
        $data->save();
        

        return redirect('reservation/create')->with('success', "Data is added.");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Reservation::where('id', $id)->delete();
        return redirect('admin/reservation')->with('success', 'Data is deleted');
    }

    // Check availability
    function available_venues(Request $request) {
        $reservationDate = $request->input('reservation_date');
        $startTime = $request->input('start_time');
        $endTime = $request->input('end_time');

        $avenues = DB::select("SELECT * FROM venues WHERE id NOT IN (
            SELECT venue_id FROM reservations 
            WHERE reservation_date = ? 
            AND (
                (start_time BETWEEN ? AND ?) OR 
                (end_time BETWEEN ? AND ?)
            )
        )", [$reservationDate, $startTime, $endTime, $startTime, $endTime]);

        $data=[];
        foreach($avenues as $venue){
            $venueTypes = VenueType::find($venue->venue_type_id);
            $data[]=['venue' => $venue, 'venue_type' => $venueTypes];
        }

        return response()->json(['data' => $data]);
    }

    public function userReservation()
    {
        return view('reservation.create');
    }

    public function acknowledge($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->status = 'acknowledged';
        $reservation->save();

        // Send acknowledgment email to the user (you'll need to implement this)
        // You can use Laravel's built-in Mail functionality here

        return redirect()->back()->with('success', 'Reservation Acknowledged');
    }

    public function reject($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->status = 'rejected';
        $reservation->save();

        // You may want to provide a reason for rejection or notify the user in some way

        return redirect()->back()->with('success', 'Reservation Rejected');
    }


    public function myReservations()
    {
        $userReservations = Reservation::where('user_id', auth()->id())->get();
        return view('reservation.my-reservations', ['userReservations' => $userReservations]);
    }
}
