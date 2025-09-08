<?php
declare(strict_types=1);

namespace Lensen\Temu\Services;

use Exewen\Config\Contract\ConfigInterface;
use Exewen\Http\Contract\HttpClientInterface;
use Lensen\Temu\Constants\TemuEnum;
use Lensen\Temu\Contract\AuthInterface;
use Lensen\Temu\Exception\TemuException;

class AuthService implements AuthInterface
{
    private $httpClient;
    private $driver;
    private $config;

    public function __construct(HttpClientInterface $httpClient, ConfigInterface $config)
    {
        $this->httpClient = $httpClient;
        $this->driver     = $config->get('temu.' . TemuEnum::CHANNEL_API);
        $this->config     = $config;
    }


    public function setAuth(string $appKey, string $appSecret, string $accessToken, string $channel = TemuEnum::CHANNEL_API)
    {
        $this->config->set('http.channels.' . $channel . '.extra.app_key', $appKey);
        $this->config->set('http.channels.' . $channel . '.extra.app_secret', $appSecret);
        $this->config->set('http.channels.' . $channel . '.extra.access_token', $accessToken);
    }

}