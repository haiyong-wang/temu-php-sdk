<?php
declare(strict_types=1);

namespace Lensen\Temu\Contract;

interface ShippingInterface
{
    public function setShipments(array $params, array $header = []);

}
