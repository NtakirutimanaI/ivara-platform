<?php

namespace App\Services;

use App\Contracts\Repositories\SuperAdminRepositoryInterface;

class SuperAdminService
{
    protected $repository;

    public function __construct(SuperAdminRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAllAdmins()
    {
        return $this->repository->getAllAdmins();
    }

    public function createAdmin(array $data)
    {
        // Add business logic for creating admins (validation, notifications, etc.)
        return $this->repository->createAdmin($data);
    }

    public function updateAdmin($id, array $data)
    {
        return $this->repository->updateAdmin($id, $data);
    }

    public function deleteAdmin($id)
    {
        return $this->repository->deleteAdmin($id);
    }

    public function getUsersByRole(array $roles)
    {
        return $this->repository->getUsersByRole($roles);
    }

    public function getSystemOverview()
    {
        return $this->repository->getSystemOverview();
    }

    public function findUserById($id)
    {
        return $this->repository->findUserById($id);
    }

    public function updateUserStatus($id, $status)
    {
        return $this->repository->updateUserStatus($id, $status);
    }

    public function getAllUsers()
    {
        return $this->repository->getAllUsers();
    }
}
