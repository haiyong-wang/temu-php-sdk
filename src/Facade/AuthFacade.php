<?php
declare(strict_types=1);

namespace Lensen\Temu\Facade;

use Exewen\Facades\AppFacade;
use Exewen\Facades\Facade;
use Exewen\Http\HttpProvider;
use Exewen\Logger\LoggerProvider;
use Lensen\Temu\Constants\TemuEnum;
use Lensen\Temu\Contract\AuthInterface;

/**
 * @method static array setAuth(string $appKey, string $appSecret, string $accessToken, string $channel =TemuEnum::CHANNEL_API)
 */
class AuthFacade extends Facade
{
    public static function getFacadeAccessor(): string
    {
        return AuthInterface::class;
    }

    public static function getProviders(): array
    {
        AppFacade::getContainer()->singleton(AuthInterface::class);

        return [
            LoggerProvider::class,
            HttpProvider::class,
        ];
    }
}