<?php

namespace App\Services\Search;

trait Model
{
    /**
     * Returns collection matching specified $q parameter.
     *
     * @param string $q
     * @param string $orderBy
     * @param string $orderType
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function search($q = '', $orderBy = '', $orderType = 'desc')
    {
        $q = $this->cleanSearchQuery($q);
        if (empty($q)) {
            return $this->newCollection();
        }

        $query = $this->newQueryWithoutScopes();
        foreach ($this->searchableColumns() as $column) {
            $query = $query->orWhere($column, 'LIKE', '%' . $q .'%');
        }

        $orderBy = $orderBy ?: $this->primaryKey;

        return $query->orderBy($orderBy, $orderType)->get();
    }

    /**
     * Clean search query.
     *
     * @param string $q
     * @return string
     */
    private function cleanSearchQuery($q)
    {
        return trim($q);
    }

    /**
     * Returns searchable columns. If not specified in $this->searchables
     * it will returns non hidden fillable attributes.
     *
     * @return array
     */
    private function searchableColumns()
    {
        return empty($this->searchables) ? array_diff($this->fillable, $this->hidden) : $this->searchables;
    }
}
