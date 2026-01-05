<?php

namespace App\Repositories\MongoDB;

use App\Contracts\Repositories\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

/**
 * MongoDB Implementation of User Repository
 * 
 * This implementation uses MongoDB Laravel package.
 * Will be activated when we switch to MongoDB.
 */
class MongoDBUserRepository implements UserRepositoryInterface
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * Get all users
     */
    public function all(array $filters = []): Collection
    {
        $query = $this->model->query();

        if (isset($filters['role'])) {
            $query->where('role', $filters['role']);
        }

        if (isset($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (isset($filters['search'])) {
            // MongoDB supports regex search
            $query->where(function($q) use ($filters) {
                $q->where('name', 'regex', "/{$filters['search']}/i")
                  ->orWhere('email', 'regex', "/{$filters['search']}/i")
                  ->orWhere('username', 'regex', "/{$filters['search']}/i");
            });
        }

        return $query->get();
    }

    /**
     * Find user by ID
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * Find user by email
     */
    public function findByEmail(string $email)
    {
        return $this->model->where('email', $email)->first();
    }

    /**
     * Create a new user
     */
    public function create(array $data)
    {
        // Hash password if provided
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        return $this->model->create($data);
    }

    /**
     * Update user
     */
    public function update($id, array $data)
    {
        $user = $this->find($id);
        
        if (!$user) {
            return null;
        }

        // Hash password if being updated
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $user->update($data);
        return $user->fresh();
    }

    /**
     * Delete user
     */
    public function delete($id): bool
    {
        $user = $this->find($id);
        
        if (!$user) {
            return false;
        }

        return $user->delete();
    }

    /**
     * Get users by role
     */
    public function getByRole(string $role): Collection
    {
        return $this->model->where('role', $role)->get();
    }

    /**
     * Get user statistics
     */
    public function getStatistics(): array
    {
        // MongoDB aggregation
        $total = $this->model->count();
        
        // Group by role
        $byRole = $this->model->raw(function($collection) {
            return $collection->aggregate([
                [
                    '$group' => [
                        '_id' => '$role',
                        'count' => ['$sum' => 1]
                    ]
                ]
            ]);
        })->pluck('count', '_id')->toArray();

        // Group by status
        $byStatus = $this->model->raw(function($collection) {
            return $collection->aggregate([
                [
                    '$group' => [
                        '_id' => '$status',
                        'count' => ['$sum' => 1]
                    ]
                ]
            ]);
        })->pluck('count', '_id')->toArray();

        return [
            'total' => $total,
            'by_role' => $byRole,
            'by_status' => $byStatus,
        ];
    }

    /**
     * Search users
     */
    public function search(string $query, array $fields = ['name', 'email']): Collection
    {
        $search = $this->model->query();

        $search->where(function($q) use ($query, $fields) {
            foreach ($fields as $field) {
                // MongoDB regex search (case-insensitive)
                $q->orWhere($field, 'regex', "/{$query}/i");
            }
        });

        return $search->get();
    }
}
