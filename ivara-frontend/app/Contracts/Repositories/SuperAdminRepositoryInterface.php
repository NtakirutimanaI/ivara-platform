<?php

namespace App\Contracts\Repositories;

interface SuperAdminRepositoryInterface
{
    /**
     * Get all administrators across the system.
     * @return mixed
     */
    public function getAllAdmins();

    /**
     * Create a new administrator.
     * @param array $data
     * @return mixed
     */
    public function createAdmin(array $data);

    /**
     * Update an administrator's details.
     * @param string|int $id
     * @param array $data
     * @return mixed
     */
    public function updateAdmin($id, array $data);

    /**
     * Delete an administrator.
     * @param string|int $id
     * @return bool
     */
    public function deleteAdmin($id);

    /**
     * Get system-wide statistics for the Super Admin dashboard.
     * @return array
     */
    public function getSystemOverview();
}
