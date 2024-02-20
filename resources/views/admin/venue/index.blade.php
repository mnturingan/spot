@extends('admin/layouts.app')

@section('content')

<main class="content">
    <div class="container-fluid p-0">
        <div class="card flex-fill container">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="h3 col-sm-8"><strong>Venues</strong></h1>
                    <a href="{{url('admin/venue/create')}}" class="btn btn-success btn-sm" onclick="addNew()">Add New</a>
                </div>
            </div>
            <table class="table table-hover my-0">
                <thead>
                    <tr>
                        <th class="d-none d-md-table-cell">Venue Type</th>
                        <th class="d-none d-md-table-cell">Code</th>
                        <th class="d-none d-md-table-cell">Capacity</th>
                        <th class="d-none d-md-table-cell">Actions</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th class="d-none d-md-table-cell">Venue Type</th>
                        <th class="d-none d-md-table-cell">Code</th>
                        <th class="d-none d-md-table-cell">Capacity</th>
                        <th class="d-none d-md-table-cell">Actions</th>
                    </tr>
                </tfoot>
                <tbody>
                    @if($data && count($data) > 0)
                        @foreach($data as $d)
                            <tr>
                                <td>{{$d->venueType->title}}</td>
                                <td>{{$d->venue_code}}</td>
                                <td>{{$d->capacity}}</td>
                                <td>
                                    <a href="{{url('admin/venue/'.$d->id)}}" class="btn btn-info btn-sm">
                                        <i data-feather="eye"></i></a>
                                    <a href="{{url('admin/venue/'.$d->id.'/edit')}}" class="btn btn-primary btn-sm">
                                        <i data-feather="edit"></i></a>
                                    <a href="{{url('admin/venue/'.$d->id.'/delete')}}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete this data?')">
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
