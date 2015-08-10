<?php

namespace App\Services\Search\Contracts;

interface Repository
{
    /**
     * Returns object mapping Semantic UI search response (http://semantic-ui.com/modules/search.html#/usage).
     *
     * @param string $q
     * @return array
     */
    public function search($q);
}
