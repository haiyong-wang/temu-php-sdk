<?php
declare(strict_types=1);

namespace Lensen\Temu\Services;

use Lensen\Temu\Exception\TemuException;

class BaseService
{
    private $responseSuccessCode = 1000000;

    /**
     * 通用响应检查
     * @param $result
     * @return void
     */
    protected function checkResponse($result)
    {
        if (!is_array($result)) {
            throw new TemuException('Temu:' . __FUNCTION__ . '响应解析异常');
        }
        if (!isset($result['errorCode'])) {
            throw new TemuException('Temu:' . __FUNCTION__ . '响应格式异常');
        }
        if ($result['errorCode'] !== $this->responseSuccessCode) {
            $msg = $result['msg'] ?? '';
            throw new TemuException('Temu:' . __FUNCTION__ . '响应code异常(' . $result['errorCode'] . ') ' . $msg);
        }
    }

}