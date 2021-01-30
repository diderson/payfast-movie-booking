@extends('layouts.main')
@section('content')
<div class="row">
	@if($movie)
	<div class="col-4">
		<img src="{{$movie->image_url}}">
	</div>
	<div class="col-8">
		<h1>{{$movie->title}}</h1>
		<p>{{$movie->description}}</p>
		<h3>Booking Form</h3>
		{!! Form::open(['url' => '/booking-next-step', 'class'=>'row g-3', 'method' => 'post', 'id'=>'make-booking', 'files' => true]) !!}
		<div class="col-md-6">
			<label for="inputState" class="form-label">Location</label>
			<input type="hidden" name="movie_id" id="movie_id" value="{{$movie->id}}">
			{{ Form::select('location_id', $cinema_locations, 0, array_merge(['class' => 'form-select', 'id' => 'location_id'], ['placeholder' => 'Select Location...'])) }}
		</div>
		<div class="col-md-6">
			<label for="show_id" class="form-label">Show Time</label>
			<select id="show_id" name="show_id" class="form-select">
				<option selected>Select time</option>
				<option>...</option>
			</select>
		</div>
		<div class="col-6">
			<label for="total_seats" class="form-label">Tickets</label>
			<select id="total_seats" name="total_seats" class="form-select">
				<option selected>Select Ticket...</option>
				<option>...</option>
			</select>
		</div>

		<div class="col-12">
			<br>
			<button type="submit" class="btn btn-primary">Next</button>
		</div>
		{!! Form::close() !!}
	</div>
	@endif
</div>
@endsection

@section('javascript')
<script>
	$(function() {
		//ajax getting show time for the specific movie and location
		$('#location_id').change(function(){
			var location_id = $('#location_id').val();
			var movie_id = $('#movie_id').val();
			var url_location_get = '/get-show-time/'+location_id+'/movie/'+movie_id;
			var init_option = '<option value="">Select time</option>';
			$.ajax({
				url: url_location_get,
				type: 'GET',
				success: function(data) {
					console.log('Data from Ajax',data);
					$('#show_id').empty();
					$('#show_id').append(init_option);
					$.each(data,function(key, value)
					{
						$('#show_id').append('<option value=' + key + '>' + value + '</option>');
					});
				},error: function(error) {
					$('#show_id').empty();
					$('#show_id').append(init_option);
					console.log(error);
				}
			});
		});

		$('#show_id').change(function(){
			var location_id = $('#location_id').val();
			var show_id = $('#show_id').val();
			var url_location_get = '/get-available-seat/'+location_id+'/show/'+show_id;
			var init_option = '<option value="">Select Ticket...</option>';
			$.ajax({
				url: url_location_get,
				type: 'GET',
				success: function(data) {
					console.log('Data from Ajax',data);
					$('#total_seats').empty();
					$('#total_seats').append(init_option);
					$.each(data,function(key, value)
					{
						$('#total_seats').append('<option value=' + key + '>' + value + '</option>');
					});
				},error: function(error) {
					$('#total_seats').empty();
					$('#total_seats').append(init_option);
					console.log(error);
				}
			});
		});
	});
</script>
@endsection