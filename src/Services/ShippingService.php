<?php
declare(strict_types=1);

namespace Lensen\Temu\Services;

use Exewen\Config\Contract\ConfigInterface;
use Exewen\Http\Contract\HttpClientInterface;
use Lensen\Temu\Constants\TemuEnum;
use Lensen\Temu\Contract\ShippingInterface;

class ShippingService extends BaseService implements ShippingInterface
{
    private $httpClient;
    private $driver;

    public function __construct(HttpClientInterface $httpClient, ConfigInterface $config)
    {
        $this->httpClient   = $httpClient;
        $this->driver       = $config->get('temu.' . temuEnum::CHANNEL_API);
    }

    // bg.logistics.shipment.v2.confirm 上传跟踪号
    public function setShipments(array $params, array $header = []): array
    {
        // $todayMidnightTimestamp = strtotime('today');
        $params['type'] = 'bg.logistics.shipment.v2.confirm';
        // $params['app_key'] = 'test_app_key';
        // $params['access_token'] = 'test_access_token';
        // $params['timestamp'] = $todayMidnightTimestamp;
        $response = $this->httpClient->post($this->driver, '', $params, $header);
        $result   = json_decode($response->getBody()->getContents(), true);
        $this->checkResponse($result);
        return $result['data'] ?? [];
    }

}