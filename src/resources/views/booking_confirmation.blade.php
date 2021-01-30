@extends('layouts.main')
@section('content')
<!-- Page Features -->
<div class="row">
	@if($movie)
	<div class="col-4">
		<img src="{{$movie->image_url}}">
	</div>
	<div class="col-8">
		<h1 class="display-4">Congratulations! You are all set</h1>
		<p class="lead">
			<strong>Booking number:</strong> {{$booking->reference_number}}<br>
			<strong>Movie:</strong> {{$movie->title}}<br>
			<strong>Tickets:</strong> {{$booking->total_seats}}<br>
			<strong>Cinema:</strong> {{$movie->location}}<br>
			<strong>Theatre:</strong> {{$movie->theatre}}<br>
			<strong>Date:</strong> {{ Carbon\Carbon::parse($movie->start_time)->format('d M Y')}}<br>
			<strong>Time:</strong> {{ Carbon\Carbon::parse($movie->start_time)->format('H:i') }}<br>
		</p>
		<p class="">
			<a href="/my-booking" class="btn btn-primary btn-lg">View All your booking</a>
		</p>
	</div>
	@endif
</div>
<!-- /.row -->
@endsection