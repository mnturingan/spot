@extends('admin/layouts.app')

@section('content')

<main class="content">
    <div class="container-fluid p-0">
        <div class="card flex-fill container">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="h3 col-sm-8"><strong>Add Venue</strong> Types</h1>
                    <a href="{{url('admin/venueType')}}" class="btn btn-success btn-sm">View All</a>
                </div>

                <div class="mb-3">
                @include('sweetalert::alert')
                    <form enctype="multipart/form-data" method="post" action="{{url('admin/venueType')}}">
                        @csrf
                        <label for="exampleFormControlInput1" class="form-label">Title</label>
                        <input name="title" type="text" class="form-control" placeholder="Input">
                        <br>

                        <label for="exampleFormControlTextarea1" class="form-label">Detail</label>
                        <textarea name="detail" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        <br>

                        <label for="exampleFormControlInput1" class="form-label">Gallery</label>
                        <input multiple name="imgs[]" type="file" class="form-control" placeholder="Input">
                        <br>
                        
                        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection
