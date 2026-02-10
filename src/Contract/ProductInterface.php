<?php
declare(strict_types=1);

namespace Lensen\Temu\Contract;

interface ProductInterface
{
    /**
     * 查询产品 sku listing
     *
     * @param array $params 请求参数
     * @param array $header 请求头
     * @return array
     */
    public function getProductSkuListings(array $params, array $header = []): array;

    /**
     * 查询产品 listing
     *
     * @param array $params 请求参数
     * @param array $header 请求头
     * @return array
     */
    public function getProductListings(array $params, array $header = []): array;
}