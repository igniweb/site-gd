<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Contracts\UserRepository as UserContract;
use App\Services\Datatable\Repository as DatatableRepository;
use App\Services\Search\Repository as SearchRepository;
use App\Services\Search\SearchEngine;

class UserRepository implements UserContract, DatatableRepository, SearchRepository
{
    /**
     * Returns user data matching specified ID.
     *
     * @param int $id
     * @return array|bool
     */
    public function byId($id)
    {
        $user = User::find($id);

        return !empty($user) ? $user->toArray() : false;
    }

    /**
     * Returns object mapping datatables response (https://www.datatables.net/manual/server-side).
     *
     * @param array $input
     * @return \StdClass
     */
    public function dataTable($input)
    {   // Default query
        $query = User::select(
            DB::raw('SQL_CALC_FOUND_ROWS `users`.`id`'),
            'users.ipn',
            'users.status',
            'users.first_name',
            'users.last_name',
            'businesses.common_name',
            'businesses.trading_name',
            'users.email',
            'users.backend_role',
            'users.frontend_role',
            'users.locale'
        )->withTrashed()->join('businesses', 'users.business_id', '=', 'businesses.id');
        // Filter locale depending of backend role
        if ( ! Roles::isSuperAdmin())
        {
            $authUser = Auth::user();
            $query = $query->where('users.locale', '=', $authUser->locale);
        }
        // Search
        $searchFields = ['users.ipn', 'users.email', 'users.first_name', 'users.last_name', 'businesses.common_name', 'businesses.trading_name', 'businesses.code_rrf'];
        // Order (important to fit dataTable column order)
        $orderColumns = ['users.ipn', 'users.status', ['users.first_name', 'users.last_name'], 'users.email', ['businesses.common_name', 'businesses.trading_name'], ['users.backend_role', 'users.frontend_role']];
        if (Roles::isSuperAdmin())
        {
            $orderColumns[] = 'users.locale';
        }

        $default = $this->defaultDataTable($query, $input, $searchFields, $orderColumns);

        // Build response data set
        $dataTable = $default->dataTable;
        foreach ($default->dataSet as $user)
        {
            $data = [
                $user->ipn,
                trans('sva.statuses.' . $user->status),
                $user->first_name . ' ' . $user->last_name,
                $user->email,
                $user->common_name . ' ' . $user->trading_name,
                Roles::toString($user->toArray()),
            ];
            if (Roles::isSuperAdmin())
            {
                $data[] = '<i class="' . $user->locale . ' flag"></i>';
            }
            $data[] = view('admin.user.actions', compact('user'))->render();

            $dataTable->data[] = $data;
        }

        return $dataTable;
    }

    /**
     * Returns an array of HTML formatted data for results
     * corresponding to specified query for search page.
     *
     * @param string $q
     * @return array
     */
    public function searchForPage($q)
    {
        $html = [];

        $results = $this->searchResults($q);
        foreach ($results as $result) {
            $html[] = '<a href="' . route('admin.user.edit', ['id' => $result->id]) . '">' . $result->first_name . ' ' . $result->last_name . '</a>';
        }

        return $html;
    }

    /**
     * Returns an indexed array of HTML formatted data for results
     * corresponding to specified query for select2 dropdown.
     *
     * @param string $q
     * @return array
     */
    public function searchForSelect2($q)
    {
        $data = [];

        $results = $this->searchResults($q);
        foreach ($results as $result) {
            $view = [
                'link' => route('admin.user.edit', ['id' => $result->id]),
                'image' => app('gravatar')->get($result->email, 48),
                'header' => $result->first_name . ' ' . $result->last_name,
                'extra' => trans('app.roles.' . $result->role),
            ];

            // Do not provide 'id' key, so that Select2 will not allow item to be selected
            $data[] = [
                'templateResult' => view('layouts.backend._search_result', $view)->render(),
                'templateSelection' => $result->first_name . ' ' . $result->last_name,
            ];
        }

        return $data;
    }

    /**
     * Returns a collection of Eloquent models for
     * results corresponding to specified query.
     *
     * @param string $q
     * @return array
     */
    private function searchResults($q)
    {
        $model = new User;

        return $model->search($q, 'first_name', 'asc');
    }
}
