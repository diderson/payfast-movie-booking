<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\CinemaLocation;
use App\Models\Show;
use App\Models\Theatre;
use Illuminate\Http\Request;

class AdminTheatreController extends Controller {
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
		$page_data['list'] = Theatre::with(['location'])->get();

		return view('admin.theatre-list', $page_data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$page_data = $this->pageMetaData();

		$page_data['locations'] = CinemaLocation::pluck('name', 'id');
		return view('admin.theatre-create', $page_data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {

		$data = $request->all();
		$location_id = $request->get('location_id', '');

		$theatre = Theatre::create($data);

		$theatre->location()->associate(trim($location_id))->save();

		session()->flash('success', "Theatre with ID {$theatre->id} was created!");

		return redirect('/admin/theatres');
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

		$theatre = Theatre::with(['location'])->where('id', $id)->first();
		$page_data = $this->pageMetaData();
		$page_data['edit'] = $theatre;
		$page_data['locations'] = CinemaLocation::pluck('name', 'id');

		return view('admin.theatre-edit', $page_data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		$data = $request->all();
		$location_id = $request->get('location_id', '');

		$theatre = Theatre::findOrFail($id);
		$theatre->update($data);

		$theatre->location()->associate(trim($location_id))->save();

		session()->flash('success', "Theatre with ID {$theatre->id} was updated!");

		return redirect('/admin/theatres');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		$theatre = Theatre::findOrFail($id);
		$theatre->delete();
		return response('item removed from the data base', 200);
	}

	public function pageMetaData() {
		return [
			'page' => 'theatres',
			'page_html_title' => 'theatres',
			'pagination' => 20,
			'page_list_title' => 'Theatre List',
			'page_edit_title' => 'Edit Theatre',
			'page_add_title' => 'Add New Theatre',
			'list_link' => '/admin/theatres',
			'edit_link' => '/admin/theatres/edit',
			'add_link' => '/admin/theatres/create',
		];
	}
}