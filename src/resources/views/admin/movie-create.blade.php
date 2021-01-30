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
	<div class="row mb-3">
		<label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Email</label>
		<div class="col-sm-10">
			<input type="email" class="form-control form-control-sm" id="colFormLabelSm" placeholder="col-form-label-sm">
		</div>
	</div>
	<div class="row mb-3">
		<label for="colFormLabel" class="col-sm-2 col-form-label">Email</label>
		<div class="col-sm-10">
			<input type="email" class="form-control" id="colFormLabel" placeholder="col-form-label">
		</div>
	</div>
	<div class="row">
		<label for="colFormLabelLg" class="col-sm-2 col-form-label col-form-label-lg">Email</label>
		<div class="col-sm-10">
			<input type="email" class="form-control form-control-lg" id="colFormLabelLg" placeholder="col-form-label-lg">
		</div>
	</div>
</main>
@endsection