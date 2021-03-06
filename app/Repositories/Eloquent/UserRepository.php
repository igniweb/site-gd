<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Contracts\UserRepository as UserContract;
use App\Services\Datatable\Contracts\Repository as DatatableContract;
use App\Services\Search\Contracts\Repository as SearchContract;
use App\Services\Search\SearchEngine;

class UserRepository implements DatatableContract, SearchContract, UserContract
{
    /**
     * Returns key-label roles.
     *
     * @return array
     */
    public function roles()
    {
        return trans('app.roles');
    }

    /**
     * Returns new empty User instance.
     *
     * @return array
     */
    public function newInstance()
    {
        $instance = ['id' => null];
        
        foreach ((new User)->getFillable() as $fillable) {
            $instance[$fillable] = null;
        }

        return $instance;
    }

    /**
     * Returns user data matching specified ID.
     *
     * @param int $id
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     * @return array
     */
    public function byId($id)
    {
        $user = User::find($id);
        if (empty($user)) {
            abort(404);
        }

        return $user->toArray();
    }

    /**
     * Create new User instance.
     *
     * @param array $input
     * @return array
     */
    public function create($input)
    {
        $input = $this->handlePassword($input);
        
        $user = User::create($input);

        return $user->toArray();
    }

    /**
     * Update existing User instance.
     *
     * @param int $id
     * @param array $input
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     * @return array
     */
    public function update($id, $input)
    {
        $user = User::find($id);
        if (empty($user)) {
            abort(404);
        }

        $input = $this->handlePassword($input);
        foreach ($input as $field => $value) {
            if (isset($user->$field)) {
                $user->$field = $value;
            }
        }
        $user->save();

        return $user->toArray();
    }

    /**
     * Delete user with specified ID.
     *
     * @param int $id
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     * @return bool
     */
    public function delete($id)
    {
        $user = User::find($id);
        if (empty($user)) {
            abort(404);
        }

        return $user->delete();
    }

    /**
     * Returns object mapping jQuery Datatables response (https://www.datatables.net/manual/server-side).
     *
     * @param array $input
     * @return array
     */
    public function dataTable($input)
    {   // Default query
        $query = User::select(
            app('db')->raw('SQL_CALC_FOUND_ROWS `users`.`id`'),
            'users.id',
            'users.first_name',
            'users.last_name',
            'users.email',
            'users.role'
        )->withTrashed();
        // Search
        $searchFields = ['users.first_name', 'users.last_name', 'users.email', 'users.role'];
        // Order (important to fit dataTable column order)
        $orderColumns = ['users.id', ['users.first_name', 'users.last_name'], 'users.email', 'users.role'];

        $default = User::defaultDataTable($query, $input, $searchFields, $orderColumns);

        // Build response data set
        $dataTable = $default['dataTable'];
        foreach ($default['dataSet'] as $user) {
            $dataTable['data'][] = [
                $user->id,
                $user->first_name . ' ' . $user->last_name,
                $user->email,
                trans('app.roles.' . $user->role),
                view('admin.user.actions', compact('user'))->render(),
            ];
        }

        return $dataTable;
    }

    /**
     * Returns object mapping Semantic UI search response (http://semantic-ui.com/modules/search.html#/usage).
     *
     * @param string $q
     * @return array
     */
    public function search($q)
    {
        $data = [
            'name' => trans('app.search.user'),
            'results' => [],
        ];

        $results = (new User)->search($q, 'first_name', 'asc');
        foreach ($results as $result) {
            $data['results'][] = [
                'title' => $result->first_name . ' ' . $result->last_name,
                'url' => route('admin.user.edit', ['id' => $result->id]),
                'image' => app('gravatar')->get($result->email, 48),
                //'price' => null,
                'description' => trans('app.roles.' . $result->role),
            ];
        }

        return $data;
    }

    /**
     * Handles password related fields.
     * 
     * @param array
     * @return array
     */
    private function handlePassword($input)
    {
        if (isset($input['password_confirm'])) {
            unset($input['password_confirm']);
        }

        if (empty($input['password'])) {
            unset($input['password']);
        } else {
            $input['password'] = app('hash')->make($input['password']);
        }

        return $input;
    }
}
