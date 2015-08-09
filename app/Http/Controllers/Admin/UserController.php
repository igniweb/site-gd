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
     * Returns data for dataTable.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function dataTable(Request $request)
    {
        return response()->json($data);
    }

    /**
     * Edit page.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.user.index');
    }
}
