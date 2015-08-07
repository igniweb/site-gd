<?php

namespace App\Repositories\Contracts;

interface UserRepository
{
    /**
     * Returns user data matching specified ID.
     *
     * @param int $id
     * @return array|bool
     */
    public function byId($id);
}
