<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Cinema;
use App\Models\CinemaLocation;
use App\Models\Show;
use Illuminate\Http\Request;

class AdminCinemaLocationController extends Controller {
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
		$page_data['list'] = CinemaLocation::with(['cinema'])->get();

		return view('admin.location-list', $page_data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$page_data = $this->pageMetaData();

		$page_data['locations'] = Cinema::pluck('name', 'id');
		return view('admin.location-create', $page_data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {

		$data = $request->all();
		$cinema_id = $request->get('cinema_id', 1);

		$cinema_location = CinemaLocation::create($data);

		$cinema_location->cinema()->associate(trim($cinema_id))->save();

		session()->flash('success', "Location with ID {$cinema_location->id} was created!");

		return redirect('/admin/locations');
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

		$cinema_location = CinemaLocation::with(['cinema'])->where('id', $id)->first();
		$page_data = $this->pageMetaData();
		$page_data['edit'] = $cinema_location;
		$page_data['locations'] = Cinema::pluck('name', 'id');

		return view('admin.location-edit', $page_data);
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
		$cinema_id = $request->get('cinema_id', 1);

		$cinema_location = CinemaLocation::findOrFail($id);
		$cinema_location->update($data);

		$cinema_location->cinema()->associate(trim($cinema_id))->save();

		session()->flash('success', "Location with ID {$cinema_location->id} was updated!");

		return redirect('/admin/locations');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		$cinema_location = CinemaLocation::findOrFail($id);
		$cinema_location->delete();
		return response('item removed from the data base', 200);
	}

	public function pageMetaData() {
		return [
			'page' => 'locations',
			'page_html_title' => 'Location',
			'pagination' => 20,
			'page_list_title' => 'Location List',
			'page_edit_title' => 'Edit Location',
			'page_add_title' => 'Add New Location',
			'list_link' => '/admin/locations',
			'edit_link' => '/admin/locations/edit',
			'add_link' => '/admin/locations/create',
		];
	}
}