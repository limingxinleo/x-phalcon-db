<?php
// +----------------------------------------------------------------------
// | TestCase.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Tests;

use PHPUnit\Framework\TestCase as UnitTestCase;
use Phalcon\DI\FactoryDefault;
use Phalcon\Db\Adapter\Pdo\Mysql;
use PDO;

class TestCase extends UnitTestCase
{
    protected $table = 'test';

    public function setUp()
    {
    }
}
