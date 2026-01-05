<?php

namespace App\Contracts\Repositories;

use Illuminate\Support\Collection;

/**
 * User Repository Interface
 * 
 * This interface defines all user-related database operations.
 * Implementations can use MySQL, MongoDB, or any other database.
 */
interface UserRepositoryInterface
{
    /**
     * Get all users
     * 
     * @param array $filters Optional filters (role, status, etc.)
     * @return Collection
     */
    public function all(array $filters = []): Collection;

    /**
     * Find user by ID
     * 
     * @param mixed $id
     * @return mixed
     */
    public function find($id);

    /**
     * Find user by email
     * 
     * @param string $email
     * @return mixed
     */
    public function findByEmail(string $email);

    /**
     * Create a new user
     * 
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * Update user
     * 
     * @param mixed $id
     * @param array $data
     * @return mixed
     */
    public function update($id, array $data);

    /**
     * Delete user
     * 
     * @param mixed $id
     * @return bool
     */
    public function delete($id): bool;

    /**
     * Get users by role
     * 
     * @param string $role
     * @return Collection
     */
    public function getByRole(string $role): Collection;

    /**
     * Get user statistics
     * 
     * @return array
     */
    public function getStatistics(): array;

    /**
     * Search users
     * 
     * @param string $query
     * @param array $fields
     * @return Collection
     */
    public function search(string $query, array $fields = ['name', 'email']): Collection;
}
