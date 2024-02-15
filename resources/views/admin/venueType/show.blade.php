@extends('admin/layouts.app')

@section('content')
<main class="content">
    <div class="container-fluid p-0">
        <div class="card flex-fill container">
            <div class="card-header d-flex justify-content-end">
                <a href="{{url('admin/venueType')}}" class="btn btn-success btn-sm">View All</a>
            </div>
            <div class="mb-3 text-center">
                <h1 class="form-label" id="exampleFormControlInput1">{{$data->title}}</h1>
                <p class="form-label" id="exampleFormControlTextarea1">{{$data->detail}}</p>
                <div class="container">
                    <div class="row">
                        @foreach($data->venueTypeImgs as $img)
                            <div class="col-6 col-md-4 col-lg-4 col-xl-3 mb-4">
                                <div class="card">
                                    <img src="{{ asset('storage/imgs/' . basename($img->img_src)) }}" class="card-img-top img-fluid" alt="Image" style="width:110%; height:auto;">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
