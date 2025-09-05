<?php
declare(strict_types=1);

namespace Lensen\Temu\Contract;

interface OrderInterface
{
    public function getOrder(array $params, array $header = []);

    public function getOrderDetail(string $orderId);

    public function getOrderShippingInfo(string $orderId, array $header = []);

}
