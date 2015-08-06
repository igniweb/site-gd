<?php

namespace App\Services\Search;

use Illuminate\Database\Eloquent\Collection;

class SearchEngine
{
    /**
     * Returns Eloquent models searched with specified parameters.
     *
     * @param string $q
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function search($q)
    {
        $results = new Collection;       

        $searchableModels = ['App\Models\User'];
        foreach ($searchableModels as $searchableModel) {
            $model = new $searchableModel;
            foreach ($model->search($q) as $result) {
                $results->push($result);
            }
        }

        return $results;
    }
}
