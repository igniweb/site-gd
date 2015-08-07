<?php

namespace App\Services\Search;

use Illuminate\Database\Eloquent\Collection;

class SearchEngine
{
    /**
     * Returns an array of matching results depending of the specified parameters.
     *
     * @param string $q
     * @param bool $isAjax
     * @return array
     */
    public function search($q, $isAjax)
    {
        $results = [];       

        $searchableRepositories = $this->classesImplementingRepository();
        foreach ($searchableRepositories as $searchableRepository) {
            $method = $isAjax ? 'searchForSelect2' : 'searchForPage';
            foreach (app($searchableRepository)->$method($q) as $result) {
                $results[] = $result;
            }
        }

        return $results;
    }

    private function classesImplementingRepository()
    {
        /*
        $searchRepositories = [];

        foreach (get_declared_classes() as $className) {
            if (in_array('App\Services\Search\Repository', class_implements($className))) {
                $searchRepositories[] = $className;
            }
        }

        return $searchRepositories;
        */
        return ['App\Repositories\Eloquent\UserRepository'];
    }

}
