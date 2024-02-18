@extends('layouts.app')

@section('content')

<main class="content">
    <div class="container-fluid p-0">
        <div class="card flex-fill container">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="h3 col-sm-8"><strong>All Reservations</strong></h1>
                </div>
                @if(Session::has('success'))
                        <p class="text-success">{{session('success')}}</p>
                @endif
            </div>
            <table class="table table-hover my-0">
                <thead>
                    <tr>
                        <th class="d-none d-md-table-cell">#</th>
                        <th class="d-none d-md-table-cell">Venue</th>
                        <th class="d-none d-md-table-cell">Type</th>
                        <th class="d-none d-md-table-cell">Date</th>
                        <th class="d-none d-md-table-cell">Start Time</th>
                        <th class="d-none d-md-table-cell">End Time</th>
                        <th class="d-none d-md-table-cell">Purpose</th>
                        <th class="d-none d-md-table-cell">Status</th>         
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th class="d-none d-md-table-cell">#</th>
                        <th class="d-none d-md-table-cell">Venue</th>
                        <th class="d-none d-md-table-cell">Type</th>
                        <th class="d-none d-md-table-cell">Date</th>
                        <th class="d-none d-md-table-cell">Start Time</th>
                        <th class="d-none d-md-table-cell">End Time</th>
                        <th class="d-none d-md-table-cell">Purpose</th>
                        <th class="d-none d-md-table-cell">Status</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($userReservations as $reservation)
                    <tr>
                        <td>{{$reservation->id}}</td>
                        <td>{{$reservation->venue->venue_code}}</td>
                        <td>{{$reservation->venue->VenueType->title}}</td>
                        <td>{{$reservation->reservation_date}}</td>
                        <td>{{$reservation->start_time}}</td>
                        <td>{{$reservation->end_time}}</td>
                        <td>{{$reservation->purpose}}</td>
                        <td>
                            @if ($reservation->status == 'acknowledged')
                            <span class="badge bg-success">Acknowledged</span>
                            @elseif ($reservation->status == 'rejected')
                            <span class="badge bg-danger">Rejected</span>
                            <a href="" class="btn btn-info btn-sm">
                                <i data-feather="edit"></i>
                            </a>
                            @else
                            <span class="badge bg-warning">Waiting</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</main>

@endsection
