<?php

namespace App\Contracts\Repositories;

use Illuminate\Support\Collection;

/**
 * Order Repository Interface
 * 
 * Defines operations for Order management.
 * Works with both MySQL and MongoDB.
 */
interface OrderRepositoryInterface
{
    /**
     * Get all orders
     */
    public function all(array $filters = []): Collection;

    /**
     * Find order by ID
     */
    public function find($id);

    /**
     * Create a new order
     */
    public function create(array $data);

    /**
     * Update order
     */
    public function update($id, array $data);

    /**
     * Delete order
     */
    public function delete($id): bool;

    /**
     * Get orders by status
     */
    public function getByStatus(string $status): Collection;

    /**
     * Get orders by user ID
     */
    public function getByUserId($userId): Collection;

    /**
     * Get total earnings (sum of total_amount for completed orders)
     */
    public function getTotalEarnings(): float;

    /**
     * Get monthly earnings stats (for charts)
     * Returns array ['January' => 1000, 'February' => 2000, ...]
     */
    public function getMonthlyEarnings(int $months = 6): array;

    /**
     * Get order counts by status
     */
    public function getStatusCounts(): array;
}
