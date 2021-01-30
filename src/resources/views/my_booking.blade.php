@extends('layouts.main')
@section('content')
<!-- Jumbotron Header -->


<h4 class="display-4">Your Bookings</h4>

<!-- Page Features -->
<div class="row text-left" id="list-page">
	<table class="table table-hover">
		<thead>
			<tr>
				<th scope="col">Number</th>
				<th scope="col">Movie</th>
				<th scope="col">Tickets</th>
				<th scope="col">Date</th>
				<th scope="col">Time</th>
				<th scope="col">Cinema</th>
				<th scope="col">Theatre</th>
				<th scope="col">Status</th>
				<th scope="col">Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($bookings as $booking)
			<tr>
				<th scope="row">{{$booking->reference_number}}</th>
				<td>{{$booking->title}}</td>
				<td>{{$booking->total_seats}}</td>
				<td>{{ Carbon\Carbon::parse($booking->start_time)->format('d M Y')}} </td>
				<td>{{ Carbon\Carbon::parse($booking->start_time)->format('H:i') }} </td>
				<td>{{$booking->location}}</td>
				<td>{{$booking->theatre}}</td>
				<td>{{$booking->status}}</td>
				<td>
					@if($booking->status_id == 1)
					{{--
						making sure user can cancel one hour before the show start
						there is time zone issue with different server
						this can be solved by deciding with timezone to use
						i am ussuming for now we are using default time zone of the server with is UTC time 2 hours less than South Africa
						--}}
					@php
						$start_time = Carbon\Carbon::parse($booking->start_time)->timezone('Africa/Johannesburg');
						$now = Carbon\Carbon::now()->timezone('Africa/Johannesburg');
						$seconds_diff = $start_time->diffInSeconds($now);
					@endphp
						@if($start_time >= $now && $seconds_diff >= 3600)
						<a class="btn btn-danger booking-cancelation" href="#" data-link="/booking-cancelation/{{$booking->reference_number}}">
							Cancel
						</a>
						@endif
					@endif
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
<!-- /.row -->
@endsection

@section('javascript')
<script>
	$(function() {
		$('#list-page').on('click', '.booking-cancelation', function(e) {

			e.preventDefault();
			var delete_url = $(this).attr("data-link");

			swal({
				title: 'Are you sure?',
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, Cancel !',
				cancelButtonText: 'No'
			}).then(function(result){
				if (result.value) {
					window.location.href = delete_url;
				}
			});
		});
	});
</script>
@endsection

