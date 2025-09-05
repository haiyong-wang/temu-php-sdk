<?php
declare(strict_types=1);

namespace Lensen\Temu\Middleware;

use Exewen\Config\Contract\ConfigInterface;
use Exewen\Facades\AppFacade;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AuthMiddleware
{
//    private string $config;
    private $appConfig;
    private $config;
    private $channel;

    public function __construct(string $channel, array $config)
    {
        $this->appConfig = AppFacade::getContainer()->get(ConfigInterface::class);
        $this->channel   = $channel;
        $this->config    = $config;
    }

    public function __invoke(callable $handler): callable
    {
        return function (RequestInterface  $request, array $options) use ($handler) {
            $body = (string) $request->getBody();
            $jsonData = json_decode($body, true);
            $sign = $this->generateSignature($jsonData,$jsonData['app_key']);
            $jsonData['sign'] = $sign;
            $request = $request->withBody(
                \GuzzleHttp\Psr7\Utils::streamFor(json_encode($jsonData))
            );
            return $handler($request, $options);
        };
        
    }


    /**
     * 生成MD5签名
     * 
     * @param array $params 所有请求参数（包括公共参数和业务参数）
     * @param string $appSecret 应用密钥
     * @return string 签名值（大写MD5）
     */
    private function generateSignature(array $params, string $appSecret): string
    {
        // 1. 移除可能存在的签名参数（如果有）
        if (array_key_exists('sign', $params)) {
            unset($params['sign']);
        }
        
        // 2. 按参数名的ASCII码从小到大排序
        ksort($params);
        
        // 3. 拼接参数名和参数值
        $signString = '';
        foreach ($params as $key => $value) {
            // 跳过空值参数（根据实际需求决定是否跳过）
            if ($value === null || $value === '') {
                continue;
            }
            
            // 将参数值转换为字符串（确保数组和对象也能处理）
            if (is_array($value) || is_object($value)) {
                $value = json_encode($value, JSON_UNESCAPED_UNICODE);
            } else {
                $value = (string)$value;
            }
            
            $signString .= $key . $value;
        }
        
        // 4. 在拼接字符串的首尾加上app_secret
        $signString = $appSecret . $signString . $appSecret;
        
        // 5. 计算MD5并转换为大写
        return strtoupper(md5($signString));
    }

}