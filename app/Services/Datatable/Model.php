<?php

namespace App\Services\Datatable;

trait Model
{
    /**
     * Returns an object with data set and default dataTable awaited response.
     *
     * @param \Illuminate\Database\Query\Builder $query
     * @param array $input
     * @param array $searchFields
     * @param array $orderColumns
     * @return array
     */
    protected static function defaultDataTable($query, $input, $searchFields, $orderColumns)
    {
        $default = [];

        // Search
        $query = static::searchDataTable($query, $input['search']['value'], $searchFields);
        // Order
        $query = static::orderDataTable($query, $input['order'], $orderColumns);
        // Paginate
        $default['dataSet'] = $query->skip($input['start'])->take($input['length'])->get();
        // Total
        $data = app('db')->select(app('db')->raw('SELECT FOUND_ROWS() AS `total`'));
        $total = intval($data[0]->total);

        // Build dataTable response
        $default['dataTable'] = [
            'data' => [],
            'draw' => intval($input['draw']),
            'recordsTotal' => $total,
            'recordsFiltered' => $total,
        ];

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
    private static function searchDataTable($query, $search, $searchFields)
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
    private static function orderDataTable($query, $orders, $orderColumns)
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
