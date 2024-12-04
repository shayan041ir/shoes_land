<?php
require_once __DIR__ . '/../models/Order.php';

class OrderController {
    public function listOrders() {
        $order = new Order();
        return $order->getAll();
    }

    public function getOrderDetails($orderId) {
        $order = new Order();
        return $order->getDetails($orderId);
    }

    public function updateStatus($orderId, $status) {
        $order = new Order();
        return $order->updateStatus($orderId, $status);
    }
}
