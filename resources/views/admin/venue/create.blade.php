@extends('admin/layouts.app')

@section('content')

<main class="content">
    <div class="container-fluid p-0">
        <div class="card flex-fill container">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="h3 col-sm-8"><strong>Add Venue</strong></h1>
                    <a href="{{url('admin/venue')}}" class="btn btn-success btn-sm">View All</a>
                </div>

                <div class="mb-3">
                    @if(Session::has('success'))
                        <p class="text-success">{{session('success')}}</p>
                    @endif
                    <form method="post" action="{{url('admin/venue')}}">
                        @csrf
                        <label for="titleInput" class="form-label">Select Venue Type</label>
                        <select name="vt_id" class="form-control">
                            <option value="0">--- Select ---</option>
                            @foreach($venueTypes as $vt)
                            <option value="{{$vt->id}}">{{$vt->title}}</option>
                            @endforeach
                        </select>
                        <br>

                        <label for="titleInput" class="form-label">Name</label>
                        <input id="titleInput" name="venue_code" type="text" class="form-control" placeholder="Input" required>
                        <br>
                        
                        <label for="capacityInput" class="form-label">Capacity</label>
                        <input id="capacityInput" name="capacity" type="number" class="form-control" placeholder="Input" min="0" required>
                        <br>
                        
                        <label for="descriptionTextarea" class="form-label">Description</label>
                        <textarea id="descriptionTextarea" name="description" class="form-control" rows="3"></textarea>
                        <br>
                        
                        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection
