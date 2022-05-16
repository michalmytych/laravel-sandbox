<?php

namespace App\Services\Shop;

use App\Models\Shop\Order;
use Illuminate\Support\Facades\DB;
use App\Enums\Shop\OrderStatusType;
use App\Services\Shop\Payment\PaymentService;

class OrderService
{
    public function __construct(private PaymentService $paymentService) { }

    public function create(array $orderData): Order
    {
        // orderData: cart_id, address, user_id
        $orderData += ['status' => OrderStatusType::CREATED];

        $order = Order::create($orderData);

        // dispatch OrderCreated(order) event

        return $order;
    }

    public function initCheckOut(Order $order)
    {
        // Validate if order can be checked out

        DB::transaction(function () use ($order) {
            $order->update(['status' => OrderStatusType::PAYMENT_INITIALIZED]);

            $this->paymentService->initPayment($order);
            // Payment request is processed in the background task
            // If it succeeds, status of order is set to paid,
            // and order is passed to service which accepts order

            // dispatch PaymentInitialized(order) event
        });
    }
}