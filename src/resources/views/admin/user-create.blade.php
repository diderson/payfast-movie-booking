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
	{!! Form::open(['url' => '/admin/users', 'class'=>'form-horizontal', 'method' => 'post', 'id'=>'user-create', 'files' => true]) !!}
	<div class="row">
		<div class="col-sm-6">
			<div class="row mb-3">
				<label for="colFormLabel" class="col-sm-2 col-form-label">Name</label>
				<div class="col-sm-10">
					<input type="text"  name="name" class="form-control" id="name" placeholder="Name">
				</div>
			</div>
			<div class="row mb-3">
				<label for="colFormLabel" class="col-sm-2 col-form-label">Email</label>
				<div class="col-sm-10">
					<input type="text" name="email" class="form-control" id="email" placeholder="Email">
				</div>
			</div>
			<div class="row mb-3">
				<label for="colFormLabel" class="col-sm-2 col-form-label">Telephone</label>
				<div class="col-sm-10">
					<input type="text" name="telephone" class="form-control" id="telephone" placeholder="Telephone">
				</div>
			</div>
			<div class="row mb-3">
				<label for="colFormLabel" class="col-sm-2 col-form-label">Password</label>
				<div class="col-sm-10">
					<input type="text" name="password" class="form-control" id="password" placeholder="Password">
					<small class="text-muted">8 characters minimum</small>
				</div>
			</div>
			<div class="row mb-3">
				<label for="colFormLabel" class="col-sm-2 col-form-label"><strong>Roles</strong> & Permission</label>
				<div class="col-sm-10">
					{{ Form::select('role_id', $roles, '', array_merge(['class' => 'form-control select-chosen'], ['placeholder' => 'Select Role...'])) }}
				</div>
			</div>

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