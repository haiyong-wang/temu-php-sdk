<?php
declare(strict_types=1);
namespace LensenTest\Temu;

use Lensen\Temu\Facade\ProductFacade;

class ProductTest extends Base
{
    public function testList()
    {
        // 测试获取订单列表功能
        $params = [
            'pageNumber' => 1,
            'pageSize' => 10,
            'goodsSearchType' => 1,
            'goodsStatusFilterType' => 1,
        ];
        $response = ProductFacade::getProductSkuListings($params);

        $this->assertNotEmpty($response);
    }
    public function testSkuList()
    {
        // 测试获取订单列表功能
        $params = [
            'pageNumber' => 1,
            'pageSize' => 10,
            'skuSearchType' => 1,
            'skuStatusFilterType' => 1,
        ];
        $response = ProductFacade::getProductSkuListings($params);

        $this->assertNotEmpty($response);
    }
}