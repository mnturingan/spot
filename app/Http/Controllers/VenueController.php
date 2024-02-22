<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\VenueType;

use App\Models\Venue;

use Alert;

class VenueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Venue::all();
        return view('admin/venue.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $venueTypes = VenueType::all();
        return view('admin/venue.create',['venueTypes'=>$venueTypes]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = new Venue;
        $data->venue_type_id = $request->vt_id;
        $data->venue_code = $request->venue_code;
        $data->capacity = $request->capacity;
        $data->description = $request->description;
        $data->save();

        Alert::success('Congrats', 'Data is added successfully!');
        
        return redirect('admin/venue/create');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Venue::find($id);
        return view('admin/venue.show', ['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $venueTypes = VenueType::all();
        $data = Venue::find($id);
        return view('admin/venue.edit', ['data'=>$data, 'venueTypes'=>$venueTypes]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Venue::find($id);
        $data->venue_type_id = $request->vt_id;
        $data->venue_code = $request->venue_code;
        $data->capacity = $request->capacity;
        $data->description = $request->description;
        $data->save();

        return redirect('admin/venue/'.$id.'/edit')->with('success', 'Data is updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Venue::where('id',$id)->delete();
        return redirect('admin/venue/')->with('success', 'Data is deleted.');

    }
}
