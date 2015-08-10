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

        $searchableRepositories = $this->repositoriesImplementingSearch();
        foreach ($searchableRepositories as $searchableRepository) {
            $results[str_slug($searchableRepository)] = app($searchableRepository)->search($q);
        }

        return $results;
    }

    /**
     * Returns repositories implementing Search repository (use 60 minutes cache).
     *
     * @return array
     */
    private function repositoriesImplementingSearch()
    {
        $keyCache = 'repositoriesImplementingSearch';
        $repositories = app('cache')->get($keyCache);

        if ($repositories === null) {
            $repositories = [];

            foreach (glob(base_path('app/Repositories/Contracts/*.php')) as $contract) {
                $class = trim(str_replace([base_path(), '.php', 'app', '/'], ['', '', 'App', '\\'], $contract), '\\');
                if (app($class) instanceof \App\Services\Search\Contracts\Repository) {
                    $repositories[] = $class;
                }
            }

            app('cache')->put($keyCache, $repositories, 60);
        }
        
        return $repositories;
    }

}
