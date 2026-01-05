<?php

namespace App\Repositories\MongoDB;

use App\Contracts\Repositories\OrderRepositoryInterface;
use App\Models\Order;
use Illuminate\Support\Collection;
use Carbon\Carbon;

/**
 * MongoDB Implementation of Order Repository
 */
class MongoDBOrderRepository implements OrderRepositoryInterface
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
        // MongoDB aggregation for monthly earnings
        $startDate = Carbon::now()->subMonths($months);
        
        return $this->model->raw(function($collection) use ($startDate) {
            return $collection->aggregate([
                [
                    '$match' => [
                        'created_at' => ['$gte' => new \MongoDB\BSON\UTCDateTime($startDate)]
                    ]
                ],
                [
                    '$group' => [
                        '_id' => ['$month' => '$created_at'],
                        'total' => ['$sum' => '$total_amount']
                    ]
                ],
                [
                    '$sort' => ['_id' => 1]
                ]
            ]);
        })->mapWithKeys(function ($item) {
            $monthName = Carbon::create()->month($item->_id)->format('F');
            return [$monthName => $item->total];
        })->toArray();
    }

    public function getStatusCounts(): array
    {
        return $this->model->raw(function($collection) {
            return $collection->aggregate([
                [
                    '$group' => [
                        '_id' => '$status',
                        'count' => ['$sum' => 1]
                    ]
                ]
            ]);
        })->pluck('count', '_id')->toArray();
    }
}
