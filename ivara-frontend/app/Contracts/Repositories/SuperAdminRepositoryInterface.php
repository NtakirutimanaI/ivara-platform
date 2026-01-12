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
     * Get users by specific roles.
     * @param array $roles
     * @return mixed
     */
    public function getUsersByRole(array $roles);

    /**
     * Get system-wide statistics for the Super Admin dashboard.
     * @return array
     */
    public function getSystemOverview();

    /**
     * Find a user by ID.
     */
    public function findUserById($id);

    /**
     * Update a user's status.
     */
    public function updateUserStatus($id, $status);

    /**
     * Get ALL users across the system.
     */
    public function getAllUsers();

    /**
     * Get Marketplace intelligence and listings.
     * @return array
     */
    public function getMarketplaceData();

    /**
     * Moderate a marketplace listing.
     * @param string $id
     * @param string $action (approve|reject|delete)
     * @return bool
     */
    public function moderateProductListing($id, $action);

    /**
     * Get system role registry.
     * @return array
     */
    public function getRoleRegistry();
}
