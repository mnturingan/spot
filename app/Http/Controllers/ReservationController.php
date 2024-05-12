<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

use App\Models\User;

use App\Models\VenueType;

use App\Models\Venue;

use App\Models\Reservation;

use Alert;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservations=Reservation::all();
        $reservations = Reservation::orderBy('created_at', 'desc')->get();
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

        $file = $request->file('file');

        if ($file) {
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('apf'), $fileName);
            $data->file = $fileName;
        }

        $data->school_org = $request->input('school_org') ? true : false;

        $data->save();

        return redirect()->back()->with(['success' => 'Reservation has been created successfully!']);
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
    public function edit($id)
    {
        $reservation = Reservation::find($id);
        $venues = Venue::all(); // replace Venue with your actual model name for venues

        // Format the start_time and end_time to match the format in the view
        $reservation->start_time = date('H:i', strtotime($reservation->start_time));
        $reservation->end_time = date('H:i', strtotime($reservation->end_time));

        return view('reservation.edit', compact('reservation', 'venues'));
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

        // Send acknowledgment email to the user (implement as needed)

        return redirect()->back()->with('success', 'Reservation Acknowledged');
    }

    public function reject(Request $request, $id)
{
        $reservation = Reservation::findOrFail($id);
        $reservation->status = 'rejected';
        $reservation->save();

        return redirect()->back()->with('success', 'Reservation Rejected');
    }

    public function myReservations()
    {
        $userReservations = Reservation::where('user_id', auth()->id())
                                    ->orderBy('created_at', 'desc')
                                    ->get();
        return view('reservation.my-reservations', ['userReservations' => $userReservations]);
    }

    public function destroy_user(string $id)
    {
        Reservation::where('id', $id)->delete();
        return redirect('my-reservations')->with('success', 'Reservation is cancelled');
    }
}
