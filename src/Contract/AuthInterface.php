<?php
declare(strict_types=1);

namespace Lensen\Temu\Contract;

use Lensen\Temu\Constants\TemuEnum;

interface AuthInterface
{

    public function setAuth(string $appKey, string $appSecret, string $accessToken, string $channel = TemuEnum::CHANNEL_API);

}