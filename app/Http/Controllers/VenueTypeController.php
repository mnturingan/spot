<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\VenueType;

use App\Models\VenueTypeImage;

use Illuminate\Support\Facades\Storage;

use Alert;

class VenueTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = VenueType::all();
        return view('admin/venueType.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin/venueType.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'detail'=>'required'
        ]);

        $data = new VenueType;
        $data->title = $request->title;
        $data->detail = $request->detail;
        $data->save();

        foreach ($request->file('imgs') as $img) {
            $imgPath = $img->store('public/imgs');
            $imgData = new VenueTypeImage;
            $imgData->venue_type_id = $data->id;
            $imgData->img_src = $imgPath;
            $imgData->img_alt = $request->title;
            $imgData->save();
        }
        
        Alert::success('Congrats', 'Data is added successfully!');

        return redirect('admin/venueType/create');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = VenueType::find($id);
        return view('admin/venueType.show', ['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = VenueType::find($id);
        return view('admin/venueType.edit', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = VenueType::find($id);
        $data->title = $request->title;
        $data->detail = $request->detail;
        $data->save();

        if($request->hasFile('imgs')){
            foreach ($request->file('imgs') as $img) {
                $imgPath = $img->store('public/imgs');
                $imgData = new VenueTypeImage;
                $imgData->venue_type_id = $data->id;
                $imgData->img_src = $imgPath;
                $imgData->img_alt = $request->title;
                $imgData->save();
            }
        }

        return redirect('admin/venueType/'.$id.'/edit')->with('success', 'Data is updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        VenueType::where('id',$id)->delete();
        return redirect('admin/venueType/')->with('success', 'Data is deleted.');

    }

    public function destroy_image($img_id)
    {
        $data=VenueTypeImage::where('id', $img_id)->first();
        Storage::delete($data->img_src);

        VenueTypeImage::where('id',$img_id)->delete();
        return response()->json(['bool'=>true]);
    }

    
}