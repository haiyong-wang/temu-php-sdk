<?php
declare(strict_types=1);

namespace LensenTest\Temu;

use Lensen\Temu\Facade\AuthFacade;
use PHPUnit\Framework\TestCase;
use Exewen\Di\Context\ApplicationContext;
use Exewen\Config\Contract\ConfigInterface;
use Lensen\Temu\ConfigRegister;

class Base extends TestCase
{
    public function __construct()
    {
        parent::__construct();
        !defined('BASE_PATH_PKG') && define('BASE_PATH_PKG', dirname(__DIR__, 1));
    }


}