<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Contracts\UserRepository as UserContract;
use App\Services\Search\Repository as SearchRepository;
use App\Services\Search\SearchEngine;

class UserRepository implements UserContract, SearchRepository
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

            $data[] = [
                //'id' => '',
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
