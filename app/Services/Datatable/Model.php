<?php

namespace App\Services\Datatable;

use DB, StdClass;

trait Model
{
    /**
     * Returns an object with data set and default dataTable awaited response.
     *
     * @param \Illuminate\Database\Query\Builder $query
     * @param array $input
     * @param array $searchFields
     * @param array $orderColumns
     * @return \StdClass
     */
    protected function defaultDataTable($query, $input, $searchFields, $orderColumns)
    {
        $default = new StdClass;

        // Search
        $query = $this->searchDataTable($query, $input['search']['value'], $searchFields);
        // Order
        $query = $this->orderDataTable($query, $input['order'], $orderColumns);
        // Paginate
        $default->dataSet = $query->skip($input['start'])->take($input['length'])->get();
        // Total
        $total = static::select(DB::raw('SELECT FOUND_ROWS() AS `total`'));

        // Build dataTable response
        $default->dataTable = new StdClass;
        $default->dataTable->draw = intval($input['draw']);
        $default->dataTable->recordsTotal = $total[0]->total;
        $default->dataTable->recordsFiltered = $default->dataTable->recordsTotal;
        $default->dataTable->data = [];

        return $default;
    }

    /**
     * Handle search field in dataTables.
     *
     * @param \Illuminate\Database\Query\Builder $query
     * @param string $search
     * @param array $searchFields
     * @return \Illuminate\Database\Query\Builder
     */
    private function searchDataTable($query, $search, $searchFields)
    {
        $search = trim($search);
        if (!empty($search)) {
            $search = '%' . $search . '%';
            if (count($searchFields) === 1) {
                $query = $query->where($searchFields[0], 'LIKE', $search);
            } else {
                $query = $query->where(function ($query) use ($search, $searchFields) {
                    $query = $query->where($searchFields[0], 'LIKE', $search);
                    for ($i = 1 ; $i < count($searchFields) ; $i++) {
                        $query->orWhere($searchFields[$i], 'LIKE', $search);
                    }
                });
            }
        }

        return $query;
    }

    /**
     * Handle order parameter from dataTables.
     *
     * @param \Illuminate\Database\Query\Builder $query
     * @param array $orders
     * @param array $orderColumns
     * @return \Illuminate\Database\Query\Builder
     */
    private function orderDataTable($query, $orders, $orderColumns)
    {
        foreach ($orders as $order) {
            $orderFields = [];
            if (isset($orderColumns[$order['column']])) {
                $orderFields = is_array($orderColumns[$order['column']]) ? $orderColumns[$order['column']] : [$orderColumns[$order['column']]];
            }

            foreach ($orderFields as $orderField) {
                $query = $query->orderBy($orderField, $order['dir']);
            }
        }

        return $query;
    }
}
