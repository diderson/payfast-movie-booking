<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Movie;

class AdminMovieController extends Controller {
	public $pagination = 20;
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware(['auth', 'role:super-admin|admin'], ['except' => ['', '']]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$page_data = $this->pageMetaData();
		$page_data['list'] = Movie::paginate($this->pagination);

		return view('admin.movie-list', $page_data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$page_data = $this->pageMetaData();
		return view('admin.movie-create', $page_data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(CreateSimpleRequest $request) {
		// $this->validate($request, [
		//     'name' => 'required'
		// ]);

		$movie = Movie::create($request->all());

		session()->flash('success', "Movie with ID {$movie->id} was created!");

		return redirect('/admin/movies');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		$movie = Movie::findOrFail($id);
		$page_data = $this->pageMetaData();
		$page_data['edit'] = $movie;

		return view('admin.movie-edit', $page_data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(CreateSimpleRequest $request, $id) {
		$movie = Movie::findOrFail($id);
		$movie->update($request->all());

		session()->flash('success', "Movie with ID {$movie->id} was updated!");

		return redirect('/admin/movies');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		$movie = Movie::findOrFail($id);
		$movie->delete();
		return response('item removed from the data base', 200);
	}

	public function pageMetaData() {
		return [
			'page' => 'movie',
			'page_html_title' => 'Movie',
			'pagination' => 20,
			'page_list_title' => 'Movie List',
			'page_edit_title' => 'Edit Movie',
			'page_add_title' => 'Add New Movie',
			'list_link' => '/admin/movies',
			'edit_link' => '/admin/movies/edit',
			'add_link' => '/admin/movies/create',
		];
	}
}