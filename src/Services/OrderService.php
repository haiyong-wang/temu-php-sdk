<?php
declare(strict_types=1);

namespace Lensen\Temu\Services;

use Exewen\Config\Contract\ConfigInterface;
use Exewen\Http\Contract\HttpClientInterface;
use Lensen\Temu\Constants\TemuEnum;
use Lensen\Temu\Contract\OrderInterface;

class OrderService extends BaseService implements OrderInterface
{
    private $httpClient;
    private $driver;
    private $detailDriver;

    public function __construct(HttpClientInterface $httpClient, ConfigInterface $config)
    {
        $this->httpClient   = $httpClient;
        $this->driver       = $config->get('temu.' . temuEnum::CHANNEL_API);
        $this->detailDriver = $config->get('temu.' . temuEnum::CHANNEL_API);
    }

    public function getOrder(array $params, array $header = []): array
    {
        // bg.order.list.v2.get
        $params['type'] = 'bg.order.list.v2.get';
        $response = $this->httpClient->post($this->driver, '', $params, $header);
        $result   = json_decode($response->getBody()->getContents(), true);
        $this->checkResponse($result);
        return $result['result'] ?? [];
    }

    // bg.order.detail.v2.get
    public function getOrderDetail(string $orderId,$header = []): array
    {
        $params   = [
            'parentOrderSn' => $orderId,
            'type' =>'bg.order.detail.v2.get'
        ];
        $response = $this->httpClient->post($this->detailDriver, '', $params, $header);
        $result   = json_decode($response->getBody()->getContents(), true);
        $this->checkResponse($result);
        return $result['result'] ?? [];
    }


    //bg.order.shippinginfo.v2.get
    public function getOrderShippingInfo(string $orderId, array $header = []): array
    {
        $params   = [
            'parentOrderSn' => $orderId,
            'type' =>'bg.order.shippinginfo.v2.get'
        ];
        $response = $this->httpClient->post($this->detailDriver, '', $params, $header);
        $result   = json_decode($response->getBody()->getContents(), true);
        $this->checkResponse($result);
        return $result['result'] ?? [];
    }

    //bg.order.amount.query
    public function getOrderAmount(string $orderId, array $header = []): array
    {
        $params   = [
            'parentOrderSn' => $orderId,
            'type' =>'bg.order.amount.query'
        ];
        $response = $this->httpClient->post($this->detailDriver, '', $params, $header);
        $result   = json_decode($response->getBody()->getContents(), true);
        $this->checkResponse($result);
        return $result['result'] ?? [];
    }

}