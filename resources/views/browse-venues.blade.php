@extends('/layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.css"/>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.js"></script>
	
   
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">


	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<style>
    .card {
        height: 400px; /* Set your desired fixed height here */
    }

    .card img {
        object-fit: cover; /* Ensure the image covers the entire card */
        height: 60%; /* Set the height of the image within the card */
    }
</style>

	<main class="content">
		<div class="container-fluid p-0">
            <h1 class="h3 mb-3"><strong>Browse Venues</strong></h1>
            
            <div class="row">
                @foreach(DB::table('venue_types')
                    ->join('venue_type_images', 'venue_types.id', '=', 'venue_type_images.venue_type_id')
                    ->select('venue_types.*', 'venue_type_images.img_src')
                    ->get() as $venueType)
                <div class="col-12 col-md-6">
                    <div class="card" data-toggle="modal" data-target="#myModal{{ $venueType->id }}">
                        <img class="card-img-top" src="{{ asset('storage/imgs/' . basename($venueType->img_src)) }}" alt="{{ $venueType->title }}">
                        <div class="card-header">
                            <h5 class="card-title mb-0">{{ $venueType->title }}</h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">{{ $venueType->detail }}</p>
                            <button class="btn btn-primary view-360-btn" data-toggle="modal" data-target="#myModal{{ $venueType->id }}">View in 360</button>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="myModal{{ $venueType->id }}" role="dialog">
                        <div class="modal-dialog modal-lg"> <!-- Set modal-lg for a large modal -->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">{{ $venueType->title }} 360 Virtual Tour</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <div id="panorama{{ $venueType->id }}" style="width: 100%; height: 400px;"></div>
                                    <script>
                                        var viewer{{ $venueType->id }} = pannellum.viewer('panorama{{ $venueType->id }}', {
                                            "type": "equirectangular",
                                            "panorama": "{{ asset('storage/imgs/' . basename($venueType->img_src)) }}"
                                        });
                                    </script>
                                    <!-- Add more content here based on your requirements -->
                                    <p>{{ $venueType->detail }}</p>
                                    <!-- Add more content as needed -->
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
		</div>
	</main>


@endsection