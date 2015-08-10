<?php

namespace App\Services\Datatable\Contracts;

interface Repository
{
    /**
     * Returns object mapping datatables response (https://www.datatables.net/manual/server-side).
     *
     * @param array $input
     * @return \StdClass
     */
    public function dataTable($input);
}
