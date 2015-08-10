<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * User repository.
     *
     * @var \App\Repositories\Contracts\UserRepository
     */
    protected $users;

    /**
     * Class constructor.
     *
     * @param \App\Repositories\Contracts\UserRepository $users
     * @return void
     */
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    /**
     * List users page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.user.index');
    }

    /**
     * Returns data for dataTable.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function dataTable(Request $request)
    {
        $input = $request->all();

        return response()->json($this->users->dataTable($input));
    }

    /**
     * Create user page.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = $this->users->newInstance();

        $roles = $this->users->roles();

        return view('admin.user.edit', compact('user', 'roles'));
    }

    /**
     * Create new user.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // @TODO Handle backend validation
        
        $user = $this->users->create($request->get('user'));

        return redirect()->route('admin.user.edit', ['id' => $user['id']]);
    }

    /**
     * Edit user page.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->users->byId($id);

        $roles = $this->users->roles();

        return view('admin.user.edit', compact('user', 'roles'));
    }

    /**
     * Update existing user.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        // @TODO Handle backend validation

        $user = $this->users->update($id, $request->get('user'));

        return redirect()->route('admin.user.edit', ['id' => $user['id']]);
    }

    /**
     * Destroy user.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $user = $this->users->delete($id);

        return redirect()->route('admin.user.index');
    }
}
