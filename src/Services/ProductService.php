<?php
declare(strict_types=1);

namespace Lensen\Temu\Services;

use Exewen\Config\Contract\ConfigInterface;
use Exewen\Http\Contract\HttpClientInterface;
use Lensen\Temu\Constants\TemuEnum;
use Lensen\Temu\Contract\ProductInterface;

class ProductService extends BaseService implements ProductInterface
{
    private $httpClient;
    private $driver;

    public function __construct(HttpClientInterface $httpClient, ConfigInterface $config)
    {
        $this->httpClient = $httpClient;
        $this->driver     = $config->get('temu.' . TemuEnum::CHANNEL_API);
    }

    /**
     * 查询产品 sku listing
     *
     * @param array $params 请求参数
     * @param array $header 请求头
     * @return array
     */
    public function getProductSkuListings(array $params, array $header = []): array
    {
        // 设置请求类型
        $params['type'] = 'bg.local.goods.sku.list.query';

        // 发送 HTTP POST 请求
        $response = $this->httpClient->post($this->driver, '/openapi/router', $params, $header);

        // 解析响应
        $result = json_decode($response->getBody()->getContents(), true);

        // 检查响应合法性
        $this->checkResponse($result);

        // 返回结果数据
        return $result['result'] ?? [];
    }

    /**
     * 查询产品 listing
     *
     * @param array $params 请求参数
     * @param array $header 请求头
     * @return array
     */
    public function getProductListings(array $params, array $header = []): array
    {
        // 设置请求类型
        $params['type'] = 'bg.local.goods.list.query';

        // 发送 HTTP POST 请求
        $response = $this->httpClient->post($this->driver, '/openapi/router', $params, $header);

        // 解析响应
        $result = json_decode($response->getBody()->getContents(), true);

        // 检查响应合法性
        $this->checkResponse($result);

        // 返回结果数据
        return $result['result'] ?? [];
    }
}
