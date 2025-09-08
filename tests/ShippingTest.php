<?php
declare(strict_types=1);
namespace LensenTest\Temu;

use Lensen\Temu\Facade\ShippingFacade;

class ShippingTest extends Base
{
    public function testsetShipment()
    {
        // 测试s上传跟踪号
        $params = [
            'sendType' => 1,
            'sendRequestList' => [
                'carrierId' => 1,
                'trackingNumber' =>'testnumber',
                'orderSendInfoList' => [
                    'parentOrderSn' => 'po-192929',
                    'orderSn'       => '10293209',
                    'goodsId'       => 123,
                    'quantity'      => 1,
                ] 
            ]
        ];
        
        $response = ShippingFacade::setShipments($params);
        
        $this->assertNotEmpty($response);
    }
}