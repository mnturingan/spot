<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

use App\Models\User;

use App\Models\Reservation;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.reservation.create');
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
        //
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

        return response()->json(['data' => $avenues]);
    }

    public function userReservation()
    {
        return view('reservation.create');
    }
}
