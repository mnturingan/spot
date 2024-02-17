<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;

class AdminController extends Controller
{
    public function adminDashboard()
    {
        $reservations=Reservation::selectRaw('count(id) as total_reservations, reservation_date')->groupBy('reservation_date')->get();
        $labels=[];
        $data=[];
        foreach($reservations as $reservation){
            $labels[]=$reservation->reservation_date;
            $data[]=$reservation->total_reservations;
        }

        //pie chart
        $vtReservations=DB::table('venue_types as vt')
            ->join('venues as v', 'v.venue_type_id', '=', 'vt.id')
            ->join('reservations as r', 'r.venue_id', '=', 'v.id')
            ->select('vt.*', 'v.*', 'r.*', DB::raw('count(r.id) as total_reservations'))
            ->groupBy('v.venue_type_id')
            ->get();  
            
        $plabels=[];
        $pdata=[];
        foreach($vtReservations as $vReservation){
            $plabels[]=$vReservation->title;
            $pdata[]=$vReservation->total_reservations;
        }
            
        return view('admin.dashboard', ['labels'=>$labels, 'data'=>$data, 'plabels'=>$plabels, 'pdata'=>$pdata]);
    }

    public function adminLogout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

}
