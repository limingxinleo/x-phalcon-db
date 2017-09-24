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
use Xin\DB;

class TestCase extends UnitTestCase
{
    protected $table = 'test';

    public function setUp()
    {
        // Your Method To Get DI;
        $di = new FactoryDefault();
        $di->setShared('db', function () {
            return new Mysql(
                [
                    'host' => '127.0.0.1',
                    'username' => 'root',
                    'password' => '910123',
                    'dbname' => 'phalcon',
                    'charset' => 'utf8',
                    'options' => [
                        PDO::ATTR_CASE => PDO::CASE_NATURAL,
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_ORACLE_NULLS => PDO::NULL_NATURAL,
                        PDO::ATTR_STRINGIFY_FETCHES => false,
                        PDO::ATTR_EMULATE_PREPARES => false,
                    ],
                ]
            );
        });

        if (!DB::tableExists('test')) {
            $sql = "CREATE TABLE `{$this->table}` (
              `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
              `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '姓名',
              `age` tinyint(4) NOT NULL DEFAULT '0' COMMENT '年龄',
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
            DB::execute($sql);
        }
    }
}