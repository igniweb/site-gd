<?php

namespace App\Repositories\Contracts;

interface UserRepository
{
    /**
     * Returns key-label roles.
     *
     * @return array
     */
    public function roles();

    /**
     * Returns user data matching specified ID.
     *
     * @param int $id
     * @return array|bool
     */
    public function byId($id);
}
