@extends('admin.layouts.main')
@section('content')
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
		<h1 class="h2">{{$page_add_title}}</h1>
	</div>



	<!-- <h2>Movies</h2> -->

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
	{!! Form::open(['url' => '/admin/movies', 'class'=>'form-horizontal', 'method' => 'post', 'id'=>'movie-create', 'files' => true]) !!}
	<div class="row">
		<div class="col-sm-6">
			<div class="row mb-3">
				<label for="colFormLabel" class="col-sm-2 col-form-label">Title</label>
				<div class="col-sm-10">
					<input type="text"  name="title" class="form-control" id="title" placeholder="Title">
				</div>
			</div>
			<div class="row mb-3">
				<label for="colFormLabel" class="col-sm-2 col-form-label">Genre</label>
				<div class="col-sm-10">
					<input type="text" name="genre" class="form-control" id="genre" placeholder="Genre">
				</div>
			</div>
			<div class="row mb-3">
				<label for="colFormLabel" class="col-sm-2 col-form-label">Duration</label>
				<div class="col-sm-10">
					<input type="text" name="duration" class="form-control" id="duration" placeholder="Duration">
				</div>
			</div>
			<div class="row mb-3">
				<label for="colFormLabel" class="col-sm-2 col-form-label">Description</label>
				<div class="col-sm-10">
					<textarea name="description" class="form-control" rows="5"></textarea>
				</div>
			</div>
			<div class="row mb-3">
				<label for="colFormLabel" class="col-sm-2 col-form-label">Image</label>
				<div class="col-sm-10">
					<input id="image_url" type="file" name="image_url" id="image_url" class="form-control">
				</div>
			</div>
			<div class="card-footer">
				<button class="btn btn-sm btn-primary" type="submit">
					<i class="fa fa-dot-circle-o"></i> Submit</button>
					<button class="btn btn-sm btn-danger" type="reset">
						<i class="fa fa-ban"></i> Reset</button>
					</div>
				</div>
			</div>
			<!-- /.row-->
			{!! Form::close() !!}
		</main>
		@endsection