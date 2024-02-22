@extends('admin/layouts.app')

@section('content')

<main class="content">
    <div class="container-fluid p-0">
        <div class="card flex-fill container">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="h3 col-sm-8"><strong>Venue</strong> Types</h1>
                    <a href="{{url('admin/venueType/create')}}" class="btn btn-success btn-sm" onclick="addNew()">Add New</a>
                </div>
            </div>
            <table class="table table-hover my-0">
                <thead>
                    <tr>
                        <th class="d-none d-md-table-cell">#</th>
                        <th class="d-none d-md-table-cell">Title</th>
                        <th class="d-none d-md-table-cell">Images</th>
                        <th class="d-none d-md-table-cell">Actions</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th class="d-none d-md-table-cell">#</th>
                        <th class="d-none d-md-table-cell">Title</th>
                        <th class="d-none d-md-table-cell">Images</th>
                        <th class="d-none d-md-table-cell">Actions</th>
                    </tr>
                </tfoot>
                <tbody>
                    @if($data && count($data) > 0)
                        @foreach($data as $d)
                            <tr>
                                <td>{{$d->id}}</td>
                                <td>{{$d->title}}</td>
                                <td>{{count($d->venueTypeImgs)}}</td>
                                <td>
                                    <a href="{{url('admin/venueType/'.$d->id)}}" class="btn btn-info btn-sm">
                                        <i data-feather="eye"></i></a>
                                    <a href="{{url('admin/venueType/'.$d->id.'/edit')}}" class="btn btn-primary btn-sm">
                                        <i data-feather="edit"></i></a>
                                    <a href="{{url('admin/venueType/'.$d->id.'/delete')}}" class="btn btn-danger btn-sm" onclick="confirmation(event)">
                                        <i data-feather="trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3">No data available</td>
                        </tr>
                    @endif
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