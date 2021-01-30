@extends('layouts.main')
@section('content')
<!-- Jumbotron Header -->
<header class="jumbotron my-4">
	<h1 class="display-3">Book Your Movie Seats!</h1>
	<p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa, ipsam, eligendi, in quo sunt possimus non incidunt odit vero aliquid similique quaerat nam nobis illo aspernatur vitae fugiat numquam repellat.</p>
	{{-- <a href="#" class="btn btn-primary btn-lg">Call to action!</a> --}}
</header>

<!-- Page Features -->
<div class="row text-center">

	@foreach ($movies as $movie)
	<div class="col-lg-3 col-md-6 mb-4">
		<div class="card h-100">
			<a href="/movie/{{$movie->slug}}"><img class="card-img-top" src="{{$movie->image_url}}" alt=""></a>
			<div class="card-body">
				<h4 class="card-title">{{$movie->title}}</h4>
				{{-- <p class="card-text">{{$movie->description}}</p> --}}
			</div>
			<div class="card-footer">
				<a href="/movie/{{$movie->slug}}" class="btn btn-primary">Book Now</a>
			</div>
		</div>
	</div>
	@endforeach

</div>
<!-- /.row -->
@endsection