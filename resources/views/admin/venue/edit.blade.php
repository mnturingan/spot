@extends('admin/layouts.app')

@section('content')

<main class="content">
    <div class="container-fluid p-0">
        <div class="card flex-fill container">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="h3 col-sm-8"><strong>Edit Venue</strong></h1>
                    <a href="{{url('admin/venue')}}" class="btn btn-success btn-sm">View All</a>
                </div>

                <div class="mb-3">
                    @if(Session::has('success'))
                        <p class="text-success">{{session('success')}}</p>
                    @endif
                    <form method="post" action="{{url('admin/venue/'.$data->id)}}">
                        @csrf
                        @method('put')
                        <label for="titleInput" class="form-label">Select Venue Type</label>
                        <select name="vt_id" class="form-control">
                            <option value="0">--- Select ---</option>
                            @foreach($venueTypes as $vt)
                            <option @if($data->venue_type_id==$vt->id) selected @endif value="{{$vt->id}}">{{$vt->title}}</option>
                            @endforeach
                        </select>
                        <br>

                        <label for="exampleFormControlInput1" class="form-label">Venue Code</label>
                        <input value="{{$data->venue_code}}" name="venue_code" type="text" class="form-control" placeholder="Input">
                        <br>

                        <label for="exampleFormControlTextarea1" class="form-label">Capacity</label>
                        <input value="{{$data->capacity}}" name="capacity" type="number" class="form-control" placeholder="Input" min="0">
                        <br>

                        <label for="descriptionTextarea" class="form-label">Description</label>
                        <textarea id="descriptionTextarea" name="description" class="form-control" rows="3">{{$data->description}}</textarea>
                        <br>

                        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection
