<?php
declare(strict_types=1);

namespace Lensen\Temu\Facade;

use Exewen\Facades\AppFacade;
use Exewen\Facades\Facade;
use Exewen\Http\HttpProvider;
use Exewen\Logger\LoggerProvider;
use Lensen\Temu\Contract\OrderInterface;
use Lensen\Temu\Services\OrderService;

/**
 * @method static array getOrder(array $params, array $header = [])
 * @method static array getOrderDetail(string $orderId)
 */
class OrderFacade extends Facade
{
    public static function getFacadeAccessor(): string
    {
        return OrderInterface::class;
    }

    public static function getProviders(): array
    {
        AppFacade::getContainer()->singleton(OrderInterface::class);

        return [
            LoggerProvider::class,
            HttpProvider::class,
        ];
    }
}