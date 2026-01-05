<?php

namespace App\Services;

use App\Contracts\Repositories\UserRepositoryInterface;
use Illuminate\Support\Collection;

/**
 * User Service
 * 
 * This service layer handles all user-related business logic.
 * It uses the repository pattern, so it works with both MySQL and MongoDB.
 */
class UserService
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Get all users with optional filters
     */
    public function getAllUsers(array $filters = []): Collection
    {
        return $this->userRepository->all($filters);
    }

    /**
     * Get user by ID
     */
    public function getUserById($id)
    {
        return $this->userRepository->find($id);
    }

    /**
     * Get user by email
     */
    public function getUserByEmail(string $email)
    {
        return $this->userRepository->findByEmail($email);
    }

    /**
     * Create a new user
     */
    public function createUser(array $data)
    {
        // Validate and sanitize data
        $validated = $this->validateUserData($data);
        
        // Create user
        return $this->userRepository->create($validated);
    }

    /**
     * Update user
     */
    public function updateUser($id, array $data)
    {
        // Validate and sanitize data
        $validated = $this->validateUserData($data, true);
        
        // Update user
        return $this->userRepository->update($id, $validated);
    }

    /**
     * Delete user
     */
    public function deleteUser($id): bool
    {
        return $this->userRepository->delete($id);
    }

    /**
     * Get users by role
     */
    public function getUsersByRole(string $role): Collection
    {
        return $this->userRepository->getByRole($role);
    }

    /**
     * Get user statistics
     */
    public function getUserStatistics(): array
    {
        return $this->userRepository->getStatistics();
    }

    /**
     * Search users
     */
    public function searchUsers(string $query, array $fields = ['name', 'email']): Collection
    {
        return $this->userRepository->search($query, $fields);
    }

    /**
     * Validate user data
     */
    protected function validateUserData(array $data, bool $isUpdate = false): array
    {
        $validated = [];

        // Name
        if (isset($data['name'])) {
            $validated['name'] = trim($data['name']);
        }

        // Username
        if (isset($data['username'])) {
            $validated['username'] = trim($data['username']);
        }

        // Email
        if (isset($data['email'])) {
            $validated['email'] = filter_var($data['email'], FILTER_VALIDATE_EMAIL) 
                ? trim($data['email']) 
                : null;
        }

        // Phone
        if (isset($data['phone'])) {
            $validated['phone'] = trim($data['phone']);
        }

        // Country code
        if (isset($data['country_code'])) {
            $validated['country_code'] = trim($data['country_code']);
        }

        // Location
        if (isset($data['location'])) {
            $validated['location'] = trim($data['location']);
        }

        // Role
        if (isset($data['role'])) {
            $validated['role'] = in_array($data['role'], ['admin', 'manager', 'supervisor', 'technician', 'user']) 
                ? $data['role'] 
                : 'user';
        }

        // Status
        if (isset($data['status'])) {
            $validated['status'] = in_array($data['status'], ['active', 'inactive', 'suspended']) 
                ? $data['status'] 
                : 'active';
        }

        // Password (only if provided)
        if (isset($data['password']) && !empty($data['password'])) {
            $validated['password'] = $data['password']; // Will be hashed in repository
        }

        return $validated;
    }
}
