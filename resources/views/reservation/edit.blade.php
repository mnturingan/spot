@extends('layouts.app')

@section('content')

<main class="content">
    <div class="container-fluid p-0">
        <div class="card flex-fill container">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="h3 col-sm-8"><strong>Modify Reservation</strong></h1>
                </div>
                @if(Session::has('success'))
                        <p class="text-success">{{session('success')}}</p>
                @endif
            </div>
            
        </div>
    </div>
</main>

@endsection
