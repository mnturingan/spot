@extends('admin/layouts.app')

@section('content')

<main class="content">
        <div class="container-fluid p-0">
            
        <div class="card flex-fill container">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="h3 col-sm-8"><strong>All Reservations</strong></h1>
                </div>
            </div>
            <table class="table table-hover my-0">
                <thead>
                    <tr>
                        <th class="d-none d-md-table-cell">Name</th>
                        <th class="d-none d-md-table-cell">Venue</th>
                        <th class="d-none d-md-table-cell">Type</th>
                        <th class="d-none d-md-table-cell">Date</th>
                        <th class="d-none d-md-table-cell">Start Time</th>
                        <th class="d-none d-md-table-cell">End Time</th>
                        <th class="d-none d-md-table-cell">Purpose</th>
                        <th class="d-none d-md-table-cell">Action</th>         
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th class="d-none d-md-table-cell">Name</th>
                        <th class="d-none d-md-table-cell">Venue</th>
                        <th class="d-none d-md-table-cell">Type</th>
                        <th class="d-none d-md-table-cell">Date</th>
                        <th class="d-none d-md-table-cell">Start Time</th>
                        <th class="d-none d-md-table-cell">End Time</th>
                        <th class="d-none d-md-table-cell">Purpose</th>
                        <th class="d-none d-md-table-cell">Action</th> 
                    </tr>
                </tfoot>
                <tbody>
                        @foreach($data as $reservation)
                            <tr>
                                <td>{{$reservation->user->name}}</td>
                                <td>{{$reservation->venue->venue_code}}</td>
                                <td>{{$reservation->venue->VenueType->title}}</td>
                                <td>{{$reservation->reservation_date}}</td>
                                <td>{{$reservation->start_time}}</td>
                                <td>{{$reservation->end_time}}</td>
                                <td>{{$reservation->purpose}}</td>
                                <td>
                                    @if ($reservation->status == 'acknowledged')
                                    <button class="btn btn-success btn-sm" disabled>Acknowledged</button>
                                    @elseif ($reservation->status == 'rejected')
                                    <button class="btn btn-warning btn-sm" disabled>Rejected</button>
                                    @else
                                        <a href="{{ route('admin.reservation.acknowledge', $reservation->id) }}" class="btn btn-info btn-sm">
                                            <i data-feather="check-circle"></i> Acknowledge
                                        </a>
                                        <a href="{{ route('admin.reservation.reject', $reservation->id) }}" class="btn btn-warning btn-sm">
                                            <i data-feather="x-square"></i> Reject
                                        </a>
                                    @endif
                                    <a href="{{url('admin/reservation/'.$reservation->id.'/delete')}}" class="btn btn-danger btn-sm" onclick="confirmation(event)">
                                        <i data-feather="trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                </tbody>
            </table>
        </div>
    </div>
</main>

@endsection

<script type="text/javascript">

    function confirmation(ev) 
    {
        ev.preventDefault();
        var urlToRedirect = ev.currentTarget.getAttribute('href');
        console.log(urlToRedirect);

        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this data!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willCancel) => {
                if (willCancel) {
                    window.location.href = urlToRedirect;
                 }
        });
    }
</script>