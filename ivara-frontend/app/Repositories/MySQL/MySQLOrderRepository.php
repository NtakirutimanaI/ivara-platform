<?php

namespace App\Repositories\MySQL;

use App\Contracts\Repositories\OrderRepositoryInterface;
use App\Models\Order;
use Illuminate\Support\Collection;
use Carbon\Carbon;

/**
 * MySQL Implementation of Order Repository
 */
class MySQLOrderRepository implements OrderRepositoryInterface
{
    protected $model;

    public function __construct(Order $model)
    {
        $this->model = $model;
    }

    public function all(array $filters = []): Collection
    {
        $query = $this->model->query();

        if (isset($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (isset($filters['user_id'])) {
            $query->where('user_id', $filters['user_id']);
        }

        return $query->get();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $order = $this->find($id);
        if ($order) {
            $order->update($data);
            return $order;
        }
        return null;
    }

    public function delete($id): bool
    {
        $order = $this->find($id);
        return $order ? $order->delete() : false;
    }

    public function getByStatus(string $status): Collection
    {
        return $this->model->where('status', $status)->get();
    }

    public function getByUserId($userId): Collection
    {
        return $this->model->where('user_id', $userId)->get();
    }

    public function getTotalEarnings(): float
    {
        return (float) $this->model
            ->whereIn('status', ['completed', 'Delivered', 'Confirmed', 'paid', 'Approved'])
            ->sum('total_amount');
    }

    public function getMonthlyEarnings(int $months = 6): array
    {
        return $this->model
            ->selectRaw('MONTHNAME(created_at) as month, SUM(total_amount) as total')
            ->where('created_at', '>=', Carbon::now()->subMonths($months))
            ->groupBy('month')
            ->orderBy('created_at')
            ->get()
            ->pluck('total', 'month')
            ->toArray();
    }

    public function getStatusCounts(): array
    {
        return $this->model
            ->selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->get()
            ->pluck('count', 'status')
            ->toArray();
    }
}
