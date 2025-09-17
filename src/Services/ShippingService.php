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
        $params['type'] = 'bg.logistics.shipment.v2.confirm';
        $response = $this->httpClient->post($this->driver, '/openapi/router', $params, $header);
        $result   = json_decode($response->getBody()->getContents(), true);
        $this->checkResponse($result);
        return $result['result'] ?? [];
    }

    // bg.logistics.companies.get 物流服务提供商
    public function getLogisticsCompanies(array $params, array $header = []): array
    {
        $params['type'] = 'bg.logistics.companies.get';
        $response = $this->httpClient->post($this->driver, '/openapi/router', $params, $header);
        $result   = json_decode($response->getBody()->getContents(), true);
        $this->checkResponse($result);
        return $result['result'] ?? [];
    }

}