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
     * Returns new empty User instance.
     *
     * @return array
     */
    public function newInstance();

    /**
     * Returns user data matching specified ID.
     *
     * @param int $id
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     * @return array
     */
    public function byId($id);

    /**
     * Create new User instance.
     *
     * @param array $input
     * @return array
     */
    public function create($input);

    /**
     * Update existing User instance.
     *
     * @param int $id
     * @param array $input
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     * @return array
     */
    public function update($id, $input);

    /**
     * Delete user with specified ID.
     *
     * @param int $id
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     * @return bool
     */
    public function delete($id);
}
