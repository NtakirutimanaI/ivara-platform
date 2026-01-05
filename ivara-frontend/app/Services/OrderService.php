<?php

namespace App\Services;

use App\Contracts\Repositories\OrderRepositoryInterface;
use Illuminate\Support\Collection;

/**
 * Order Service
 */
class OrderService
{
    protected $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function getAllOrders(array $filters = []): Collection
    {
        return $this->orderRepository->all($filters);
    }

    public function getOrderById($id)
    {
        return $this->orderRepository->find($id);
    }

    public function createOrder(array $data)
    {
        return $this->orderRepository->create($data);
    }

    public function updateOrder($id, array $data)
    {
        return $this->orderRepository->update($id, $data);
    }

    public function deleteOrder($id): bool
    {
        return $this->orderRepository->delete($id);
    }

    public function calculateTotalEarnings(): float
    {
        return $this->orderRepository->getTotalEarnings();
    }

    public function getMonthlyEarningsData(): array
    {
        return $this->orderRepository->getMonthlyEarnings();
    }

    public function getActiveOrdersCount(): int
    {
        $counts = $this->orderRepository->getStatusCounts();
        return $counts['Pending'] ?? 0;
    }

    public function getTotalOrdersCount(): int
    {
        return $this->orderRepository->all()->count();
    }
}
