<?php
declare(strict_types=1);

namespace Lensen\Temu\Facade;

use Exewen\Facades\AppFacade;
use Exewen\Facades\Facade;
use Exewen\Http\HttpProvider;
use Exewen\Logger\LoggerProvider;
use Lensen\Temu\Contract\ShippingInterface;
use Lensen\Temu\Services\ShippingService;

/**
 * @method static array setShipments(array $params, array $header = [])
 */
class ShippingFacade extends Facade
{
    public static function getFacadeAccessor(): string
    {
        return ShippingInterface::class;
    }

    public static function getProviders(): array
    {
        AppFacade::getContainer()->singleton(ShippingInterface::class);

        return [
            LoggerProvider::class,
            HttpProvider::class,
        ];
    }
}