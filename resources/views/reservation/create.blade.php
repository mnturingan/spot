@extends('layouts.app')

@section('content')

<main class="content">
    <div class="container-fluid p-0">
        <div class="card flex-fill container">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="h3 col-sm-8"><strong>Make a Reservation</strong></h1>
                </div>
                <div class="mb-3">
                @if($errors->any())
                        @foreach($errors->all() as $error)
                            <p class="text-danger">{{$error}}</p>
                        @endforeach
                    @endif

                    @if(Session::has('success'))
                        <p class="text-success">{{session('success')}}</p>
                    @endif
                    <form enctype="multipart/form-data" method="post" action="{{url('admin/reservation')}}" id="form_upload">
                        @csrf
                        <label for="reservation_date" class="form-label reserve-date">Reservation Date</label>
                        <input name="reservation_date" type="date" class="form-control" min="{{ date('Y-m-d', strtotime('+2 days')) }}">
                        <br>

                        <label for="start_time" class="form-label">Start Time</label>
                        <select name="start_time" id="start_time" class="form-control start-time">
                            @for ($i = 7; $i <= 18; $i++)
                                @foreach (['00', '30'] as $min)
                                    <option value="{{ sprintf('%02d', $i) }}:{{ $min }}">{{ sprintf('%02d', $i) }}:{{ $min }}</option>
                                @endforeach
                            @endfor
                        </select>
                        <br>

                        <label for="end_time" class="form-label">End Time</label>
                        <select name="end_time" id="end_time" class="form-control">
                            @for ($i = 7; $i <= 18; $i++)
                                @foreach (['00', '30'] as $min)
                                    <option value="{{ sprintf('%02d', $i) }}:{{ $min }}">{{ sprintf('%02d', $i) }}:{{ $min }}</option>
                                @endforeach
                            @endfor
                        </select>
                        <br>

                        <label for="available_venues" class="form-label">Available Venues/Rooms</label>
                        <select name="venue_id" class="form-control venue-list" id="venue_id">
                            <option value="">--Select a room/venue--</option>
                        </select>
                        <br>

                        <label for="purpose" class="form-label"><strong>Purpose</strong></label>
                        <textarea name="purpose" class="form-control" id="purpose" rows="3" placeholder="Please provide a valid purpose to avoid getting rejected..."></textarea>
                        <br>

                        <label class="form-check">
                            <input id="school-org-checkbox" class="form-check-input" type="checkbox" name="school_org" value="1">
                            <span class="form-check-label">
                                For school organization
                            </span>
                        </label>
                        <br>

                        <div id="file-input-div" style="display: none;">
                            <label for="exampleFormControlInput1" class="form-label">Upload your Activity Proposal Form (APF)</label>
                            <input multiple name="file" type="file" class="form-control" placeholder="Input">
                        </div>
                        <br>

                        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $(".start-time, #start_time, #end_time").on('change', function () {
        var reservationDate = $("input[name='reservation_date']").val();
        var startTime = $(".start-time").val();
        var endTime = $("#end_time").val();
       
        if (reservationDate && startTime && endTime) {
            $.ajax({
                url: "{{ url('reservation')}}/available-venues",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}', // Add this line to include the CSRF token
                    reservation_date: reservationDate,
                    start_time: startTime,
                    end_time: endTime
                },
                dataType: 'json',
                beforeSend: function () {
                    $(".venue-list").html('<option>--- Loading ---</option>');
                },
                success: function (res) {
                    var _html = '';
                    $.each(res.data, function (index, row) {
                        _html += '<option value="' + row.venue.id + '">' + row.venue.venue_code + ' - ' + row.venue_type.title + '</option>';
                    });
                    $(".venue-list").html(_html);
                }
            });
        }
    });


        $('#start_time').change(function() {
            var startTime = $(this).val();
            $('#end_time option').each(function() {
                if ($(this).val() <= startTime) {
                    $(this).hide();
                } else {
                    $(this).show();
                }
            });
            // Reset end_time value
            $('#end_time').val('');
        });

        $('#start_time, #end_time').change(function() {
            var startTime = $('#start_time').val();
            var endTime = $('#end_time').val();

            if (startTime && endTime) {
                $.get('/api/available-venues', {
                    start_time: startTime,
                    end_time: endTime
                }, function(data) {
                    var venueSelect = $('#venue_id');
                    venueSelect.empty();
                    venueSelect.append('<option value="">--- Select ---</option>');
                    $.each(data, function(index, venue) {
                        venueSelect.append('<option value="' + venue.id + '">' + venue.name + '</option>');
                    });
                });
            }
        });
    });
</script>

<script type ="text/javascript">
    $(document).ready(function(){
        $('#form_upload').on('submit',function(event)
        {
            event.preventDefault();

            jQuery.ajax({
                url: '{{ url('admin/reservation') }}',
                type: 'POST',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data)
                {
                    jQuery('#form_upload')[0].reset();
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#school-org-checkbox').change(function() {
            if(this.checked) {
                $('#file-input-div').show();
            } else {
                $('#file-input-div').hide();
            }
        });
    });
</script>
@endsection
