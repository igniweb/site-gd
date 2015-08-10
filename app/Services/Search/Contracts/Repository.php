<?php

namespace App\Services\Search\Contracts;

interface Repository
{
    /**
     * Returns an array of HTML formatted data for results
     * corresponding to specified query for search page.
     *
     * @param string $q
     * @return array
     */
    public function searchForPage($q);

    /**
     * Returns an indexed array of HTML formatted data for results
     * corresponding to specified query for select2 dropdown.
     *
     * @param string $q
     * @return array
     */
    public function searchForSelect2($q);
}
