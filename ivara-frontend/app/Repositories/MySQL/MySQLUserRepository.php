<?php

namespace App\Repositories\MySQL;

use App\Contracts\Repositories\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

/**
 * MySQL Implementation of User Repository
 * 
 * This implementation uses Eloquent ORM for MySQL.
 * When we switch to MongoDB, we'll create MongoDBUserRepository.
 */
class MySQLUserRepository implements UserRepositoryInterface
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
            $query->where(function($q) use ($filters) {
                $q->where('name', 'like', "%{$filters['search']}%")
                  ->orWhere('email', 'like', "%{$filters['search']}%")
                  ->orWhere('username', 'like', "%{$filters['search']}%");
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
        $total = $this->model->count();
        
        $byRole = $this->model
            ->selectRaw('role, COUNT(*) as count')
            ->groupBy('role')
            ->get()
            ->pluck('count', 'role')
            ->toArray();

        $byStatus = $this->model
            ->selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->get()
            ->pluck('count', 'status')
            ->toArray();

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
                $q->orWhere($field, 'like', "%{$query}%");
            }
        });

        return $search->get();
    }
}
