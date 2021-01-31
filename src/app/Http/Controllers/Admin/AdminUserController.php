<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller {
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
		$page_data['list'] = User::with(['roles'])->get();

		return view('admin.user-list', $page_data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$page_data = $this->pageMetaData();

		$page_data['roles'] = Role::pluck('name', 'id');
		return view('admin.user-create', $page_data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {

		$data = $request->all();
		$role_id = $request->get('role_id', '');

		$data['password'] = Hash::make($data['password']);
		$user = User::create($data);

		if ($role_id > 0) {
			$user->roles()->attach(trim($role_id));
		}

		session()->flash('success', "User with ID {$user->id} was created!");

		return redirect('/admin/users');
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

		$user = User::with(['roles'])->where('id', $id)->first();
		$page_data = $this->pageMetaData();
		$page_data['edit'] = $user;

		$page_data['roles'] = Role::pluck('name', 'id');
		$page_data['role_id'] = '';

		if (count($user->roles) > 0) {
			$page_data['role_id'] = $user->roles[0]['id'];
		}

		return view('admin.user-edit', $page_data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		$user = User::findOrFail($id);
		$role_id = $request->get('role_id', '');
		$data = $request->all();

		if ($data['password'] != '') {
			$data['password'] = Hash::make($data['password']);
		}

		$user->update($data);

		if ($role_id > 0) {
			$user->roles()->sync($role_id);
		}

		session()->flash('success', "User with ID {$user->id} was updated!");

		return redirect('/admin/users');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		$user = User::findOrFail($id);
		$user->delete();
		return response('item removed from the data base', 200);
	}

	public function pageMetaData() {
		return [
			'page' => 'users',
			'page_html_title' => 'User',
			'pagination' => 20,
			'page_list_title' => 'User List',
			'page_edit_title' => 'Edit User',
			'page_add_title' => 'Add New User',
			'list_link' => '/admin/users',
			'edit_link' => '/admin/users/edit',
			'add_link' => '/admin/users/create',
		];
	}
}