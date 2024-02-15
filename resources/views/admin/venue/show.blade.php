@extends('admin/layouts.app')

@section('content')

<main class="content">
    <div class="container-fluid p-0">
        <div class="card flex-fill container">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="h3 col-sm-8">Details</h1>
                    <a href="{{url('admin/venue')}}" class="btn btn-success btn-sm">View All</a>
                </div>

                <div class="mb-3">
                  
                        <label for="exampleFormControlInput1" class="form-label"><h1>{{$data->venue_code}}</h1></label>
                  
                        <br>
                        <label for="exampleFormControlInput1" class="form-label"><h1>{{$data->capacity}}</h1></label>
                  
                        <br>
                        <label for="exampleFormControlInput1" class="form-label"><h1>{{$data->description}}</h1></label>
                  
                        <br>
                        
                </div>
            </div>
        </div>
    </div>
</main>

@endsection
