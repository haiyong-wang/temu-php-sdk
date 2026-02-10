<?php
declare(strict_types=1);

namespace Lensen\Temu\Facade;

use Exewen\Facades\AppFacade;
use Exewen\Facades\Facade;
use Exewen\Http\HttpProvider;
use Exewen\Logger\LoggerProvider;
use Lensen\Temu\Contract\ProductInterface;

/**
 * @method static array getProductListings(array $params, array $header = [])
 * @method static array getProductSkuListings(array $params, array $header = [])
 */
class ProductFacade extends Facade
{
    public static function getFacadeAccessor(): string
    {
        return ProductInterface::class;
    }

    public static function getProviders(): array
    {
        AppFacade::getContainer()->singleton(ProductInterface::class);

        return [
            LoggerProvider::class,
            HttpProvider::class,
        ];
    }
}
