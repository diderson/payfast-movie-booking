@extends('admin.layouts.main')
@section('content')
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
		<h1 class="h2">{{$page_add_title}}</h1>
	</div>

	@if (session('success'))
	<div class="alert alert-success alert-dismissible fade show" role="alert">
		{{ session('success') }}
		<button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
	</div>
	@endif

	@if (session('failure'))
	<div class="alert alert-danger alert-dismissible fade show" role="alert">
		{{ session('failure') }}
		<button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
	</div>
	@endif
	{!! Form::model($edit, ['route' => ['shows.update', $edit->id], 'method' => 'put', 'class'=>'form-horizontal', 'id'=>'show-edit', 'files' => true]) !!}
	<div class="row">
		<div class="col-sm-6">
			<div class="row mb-3">
				<label for="movie_id" class="col-sm-2 col-form-label">Movie</label>
				<div class="col-sm-10">
					{{ Form::select('movie_id', $movies, $edit->movie_id, array_merge(['class' => 'form-control select-chosen'], ['placeholder' => 'Select Movie...'])) }}
				</div>
			</div>
			<div class="row mb-3">
				<label for="location_id" class="col-sm-2 col-form-label">Location</label>
				<div class="col-sm-10">
					{{ Form::select('location_id', $locations, $edit->theatre->location_id, array_merge(['class' => 'form-control select-chosen'], ['placeholder' => 'Select Location...', 'id' => 'location_id'])) }}
				</div>
			</div>

			<div class="row mb-3">
				<label class="col-md-2 col-form-label" for="theatre_id">Theatre</label>
				<div class="col-md-10">
					{{ Form::select('theatre_id', $theatres, $edit->theatre_id, array_merge(['class' => 'form-control req-input'], ['placeholder' => 'Select Theatre...', 'id' => 'theatre_id'])) }}
				</div>
			</div>

			<div class="row mb-3" id="start_date_container">
				<label class="col-md-2 col-form-label" for="select1">Start Time</label>
				<div class="col-md-10">
					<div class="input-group ">
						<span class="input-group-prepend ">
							<span class="input-group-text req-input">
								<i class="fa fa-calendar"></i>
							</span>
						</span>
						<input class="form-control" name="start_time" type="text" id="start_time" readonly="true" value="{{Carbon\Carbon::parse(date($edit->start_time,))}}">
					</div>
				</div>
			</div>

			<div class="row mb-3" id="end_time_container">
				<label class="col-md-2 col-form-label" for="select1">End Time</label>
				<div class="col-md-10">
					<div class="input-group ">
						<span class="input-group-prepend ">
							<span class="input-group-text req-input">
								<i class="fa fa-calendar"></i>
							</span>
						</span>
						<input class="form-control" name="end_time" type="text" id="end_time" readonly="true" value="{{Carbon\Carbon::parse(date($edit->end_time,))}}">
					</div>
				</div>
			</div>

		</div>
	</div>
	<!-- /.row-->
	<div class="card-footer">
		<button class="btn btn-sm btn-primary" type="submit">
			<i class="fa fa-dot-circle-o"></i> Submit</button>
			<button class="btn btn-sm btn-danger" type="reset">
				<i class="fa fa-ban"></i> Reset</button>
			</div>
		</div>
	</div>
	{!! Form::close() !!}
</main>
@endsection


@section('javascript')
<script src="/js/show.js?v={{date('YmmddHis')}}&d=didi-baka"></script>
<script>
	$(function() {
		//ajax populate Theatre by Location
		$('#location_id').change(function(){
			getTheatreAjax();
		});

		$('#start_time').daterangepicker({
			opens: 'right',
			drops: 'down',
			startDate:  "{{Carbon\Carbon::parse($edit->start_time)}}",
		    //endDate: new Date(new Date().setDate(new Date().getDate() + 42)),
		    minDate:  0,
		    //maxDate: new Date(new Date().setDate(new Date().getDate() + 0)),
		    singleDatePicker: true,
		    showDropdowns: true,
		    timePicker: true,
		    timePicker24Hour: true,
		    locale: {
		    	format: 'YYYY-MM-DD HH:mm:ss',
		    	firstDay: 1
		    }
		});

		$('#end_time').daterangepicker({
			opens: 'right',
			drops: 'down',
			startDate: "{{Carbon\Carbon::parse($edit->end_time)}}",
		    //endDate: new Date(new Date().setDate(new Date().getDate() + 42)),
		    minDate:  0,
		    //maxDate: new Date(new Date().setDate(new Date().getDate() + 0)),
		    singleDatePicker: true,
		    showDropdowns: true,
		    timePicker: true,
		    timePicker24Hour: true,
		    locale: {
		    	format: 'YYYY-MM-DD HH:mm:ss',
		    	firstDay: 1
		    }
		});
	});
</script>
@endsection