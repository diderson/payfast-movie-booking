<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\CinemaLocation;
use App\Models\Movie;
use App\Models\Show;
use App\Models\Theatre;
use App\Payfast\Interfaces\MovieRepositoryInterface;
use Illuminate\Http\Request;

class AdminShowController extends Controller {
	public $pagination = 20;
	private $movieRepository;
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct(MovieRepositoryInterface $movieRepository) {
		$this->middleware(['auth', 'role:super-admin|admin'], ['except' => ['', '']]);
		$this->movieRepository = $movieRepository;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$page_data = $this->pageMetaData();
		$page_data['list'] = Show::with(['movie', 'theatre', 'theatre.location'])->get();

		return view('admin.show-list', $page_data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$page_data = $this->pageMetaData();

		$page_data['movies'] = Movie::pluck('title', 'id');
		$page_data['locations'] = CinemaLocation::pluck('name', 'id');
		return view('admin.show-create', $page_data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {

		$data = $request->all();
		$movie_id = $request->get('movie_id', '');
		$theatre_id = $request->get('theatre_id', '');

		$show = Show::create($data);

		if ($movie_id > 0 && $theatre_id) {
			$show->movie()->associate(trim($movie_id))->save();
			$show->theatre()->associate(trim($theatre_id))->save();
		}

		session()->flash('success', "Show with ID {$show->id} was created!");

		return redirect('/admin/shows');
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

		$show = Show::with(['movie', 'theatre', 'theatre.location'])->where('id', $id)->first();
		$page_data = $this->pageMetaData();
		$page_data['edit'] = $show;

		$page_data['movies'] = Movie::pluck('title', 'id');
		$page_data['locations'] = CinemaLocation::pluck('name', 'id');
		$page_data['theatres'] = Theatre::where('location_id', $show->theatre->location_id)->pluck('name', 'id');

		return view('admin.show-edit', $page_data);
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
		$movie_id = $request->get('movie_id', '');
		$theatre_id = $request->get('theatre_id', '');

		$show = Show::findOrFail($id);
		$show->update($data);

		if ($movie_id > 0 && $theatre_id) {
			$show->movie()->associate(trim($movie_id))->save();
			$show->theatre()->associate(trim($theatre_id))->save();
		}

		session()->flash('success', "Show with ID {$show->id} was updated!");

		return redirect('/admin/shows');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		$show = Show::findOrFail($id);
		$show->delete();
		return response('item removed from the data base', 200);
	}

	public function pageMetaData() {
		return [
			'page' => 'shows',
			'page_html_title' => 'Show',
			'pagination' => 20,
			'page_list_title' => 'Show List',
			'page_edit_title' => 'Edit Show',
			'page_add_title' => 'Add New Show',
			'list_link' => '/admin/shows',
			'edit_link' => '/admin/shows/edit',
			'add_link' => '/admin/shows/create',
		];
	}
}