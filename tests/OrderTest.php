<?php
declare(strict_types=1);
namespace LensenTest\Temu;

use Lensen\Temu\Facade\OrderFacade;

class OrderTest extends Base
{
    public function testOrder()
    {
        // 测试获取订单列表功能
        $params = [
            'pageNumber' => 1,
            'pageSize' => 10,
            'createAfter' => date("Y-m-d H:i:s", strtotime('-1 day')),
            'createBefore' => date("Y-m-d H:i:s"),
        ];
        
        $response = OrderFacade::getOrder($params);
        
        $this->assertNotEmpty($response);
    }

    public function testOrderDetail()
    {
        // 测试获取订单详情功能
        $orderId = '302-1734531-6885123';
        $response = OrderFacade::getOrderDetail($orderId);
        
        $this->assertNotEmpty($response);
    }
    
    public function testGetOrderShippingInfo()
    {
        // 测试获取订单物流信息功能
        $orderId = '302-1734531-6885123';
        $response = OrderFacade::getOrderShippingInfo($orderId);
        
        $this->assertNotEmpty($response);
    }
}