<?php

namespace App\Services\Datatable\Contracts;

interface Repository
{
    /**
     * Returns object mapping jQuery Datatables response (https://www.datatables.net/manual/server-side).
     *
     * @param array $input
     * @return array
     */
    public function dataTable($input);
}
