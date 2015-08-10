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
     * Index page (list).
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.user.index');
    }

    /**
     * Create page.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = [];

        return view('admin.user.edit', compact('user'));
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
     * Edit page.
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
}
