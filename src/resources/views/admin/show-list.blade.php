@extends('admin.layouts.main')
@section('content')
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
		<h1 class="h2">{{$page_list_title}}</h1> <a href="{{$add_link}}" class="btn btn-primary">{{$page_add_title}}</a>
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
	<div class="table-responsive" id="list-page-datatable">
		<table class="table table-striped table-sm datatable" id="list_table">
			<thead>
				<tr>
					<th>#</th>
					<th>Cover</th>
					<th>Movie</th>
					<th>Date</th>
					<th>Start Time</th>
					<th>End Time</th>
					<th>Cinema</th>
					<th>Theatre</th>
					<th>Seats</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($list as $key => $data)
				<tr id="list_row_{{$data->id}}">
					<td>{{$data->id}}</td>
					<td>
						@if($data->movie)
							<img src="{{$data->movie->image_url}}" width="30">
						@endif
					</td>
					<td>{{$data->movie->title}}</td>
					<td>{{ Carbon\Carbon::parse($data->start_time)->format('d M Y')}} </td>
					<td>{{ Carbon\Carbon::parse($data->start_time)->format('H:i')}}</td>
					<td>{{ Carbon\Carbon::parse($data->end_time)->format('H:i')}}</td>
					<td>
						@if($data->theatre){{$data->theatre->location->name}}@endif
					</td>
					<td>
						@if($data->theatre){{$data->theatre->name}}@endif
					</td>
					<td>
						@if($data->theatre){{$data->theatre->total_seats}}@endif
					</td>
					<td class="action">
						<a class="btn btn-primary btn-sm" href="{{route('shows.edit', $data->id)}}">
							<span class="sr-only">Modify</span><i class="fa fa-pencil"></i>
						</a>

						<a class="btn btn-danger btn-sm item-remove" href="#" data-token="{{ csrf_token() }}" data-link="/admin/shows/{{$data->id}}">
							<span class="sr-only">Remove</span><i class="fa fa-trash"></i>
						</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</main>
@endsection
@section('javascript')
<script>
	$(function() {
});
</script>
@endsection