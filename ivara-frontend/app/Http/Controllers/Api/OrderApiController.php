<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

/**
 * API Gateway: Order Controller
 */
class OrderApiController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * Get all orders
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $filters = $request->only(['status', 'user_id']);
            $orders = $this->orderService->getAllOrders($filters);

            return response()->json([
                'success' => true,
                'data' => $orders,
                'count' => $orders->count(),
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch orders',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get order by ID
     */
    public function show($id): JsonResponse
    {
        try {
            $order = $this->orderService->getOrderById($id);

            if (!$order) {
                return response()->json([
                    'success' => false,
                    'message' => 'Order not found',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $order,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch order',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Create new order
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'user_id' => 'required|exists:users,id',
                'order_number' => 'required|string|unique:orders,order_number',
                'total_amount' => 'required|numeric|min:0',
                'status' => 'required|string',
                'payment_status' => 'required|string',
            ]);

            $order = $this->orderService->createOrder($validated);

            return response()->json([
                'success' => true,
                'message' => 'Order created successfully',
                'data' => $order,
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create order',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update order
     */
    public function update(Request $request, $id): JsonResponse
    {
        try {
            $validated = $request->validate([
                'status' => 'sometimes|string',
                'payment_status' => 'sometimes|string',
                'total_amount' => 'sometimes|numeric',
            ]);

            $order = $this->orderService->updateOrder($id, $validated);

            if (!$order) {
                return response()->json([
                    'success' => false,
                    'message' => 'Order not found',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Order updated successfully',
                'data' => $order,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update order',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Delete order
     */
    public function destroy($id): JsonResponse
    {
        try {
            $deleted = $this->orderService->deleteOrder($id);

            if (!$deleted) {
                return response()->json([
                    'success' => false,
                    'message' => 'Order not found',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Order deleted successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete order',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
