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
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     * @return array
     */
    public function byId($id);
}
