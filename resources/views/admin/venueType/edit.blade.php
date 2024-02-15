@extends('admin/layouts.app')

@section('content')

<main class="content">
    <div class="container-fluid p-0">
        <div class="card flex-fill container">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="h3 col-sm-8"><strong>Update {{$data->title}}</strong></h1>
                    <a href="{{url('admin/venueType')}}" class="btn btn-success btn-sm">View All</a>
                </div>

                <div class="mb-3">
                    @if(Session::has('success'))
                        <p class="text-success">{{session('success')}}</p>
                    @endif
                    <form enctype="multipart/form-data" method="post" action="{{url('admin/venueType/'.$data->id)}}">
                        @csrf
                        @method('put')

                        <label for="exampleFormControlInput1" class="form-label">Title</label>
                        <input value="{{$data->title}}" name="title" type="text" class="form-control" placeholder="Input">
                        <br>

                        <label for="exampleFormControlTextarea1" class="form-label">Detail</label>
                        <textarea name="detail" class="form-control" id="exampleFormControlTextarea1" rows="3">{{$data->detail}}</textarea>
                        <br>

                        <label for="exampleFormControlTextarea1" class="form-label">Images</label>
                        <input multiple name="imgs[]" type="file" class="form-control" placeholder="Input">
                        <br>
                        <div class="container">
                            <div class="row">
                                @foreach($data->venueTypeImgs as $img)
                                    <div class="col-6 col-md-4 col-lg-4 col-xl-3 mb-4">
                                        <div class="card">
                                            <img src="{{ asset('storage/imgs/' . basename($img->img_src)) }}" class="card-img-top img-fluid" alt="Image">
                                            <div class="card-body text-center imgcol{{$img->id}}">
                                                <button class="btn btn-danger btn-sm delete-image"
                                                    data-image-id="{{$img->id}}"
                                                    data data-bs-toggle="modal" data-bs-target="#deleteImageModal{{ $img->id }}" 
                                                    onclick="return confirm('Are you sure to delete this image?')">
                                                    <i data-feather="trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <br>
                        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
    @section('scripts')
    <script type="text/javascript"> 
        $(document).ready(function(){
                $(".delete-image").on('click', function(){
                    var _img_id=$(this).attr('data-image-id');
                    var _vm=$(this);
                    $.ajax({
                        url: "{{url('admin/venueTypeImage/delete')}}/"+_img_id,
                        dataType: 'json',
                        beforeSend:function(){
                            _vm.addClass('disabled');
                        },
                        success:function(res){
                            if(res.bool==true){
                                $(".imgcol"+_img_id.remove());
                            }
                            _vm.removeClass('disabled');
                        }
                    });
                });
        });
    </script>
    @endsection

@endsection
