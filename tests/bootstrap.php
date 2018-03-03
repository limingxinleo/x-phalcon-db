<?php
// +----------------------------------------------------------------------
// | bootstrap.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
use Phalcon\DI\FactoryDefault;
use Phalcon\Db\Adapter\Pdo\Mysql;

require __DIR__ . '/../vendor/autoload.php';
define('TESTS_PATH', __DIR__);

$config = include TESTS_PATH . '/_ci/config.php';

$di = new FactoryDefault();
$di->setShared('db', function () use ($config) {
    return new Mysql(
        [
            'host' => $config['host'],
            'username' => $config['username'],
            'password' => $config['password'],
            'dbname' => $config['dbname'],
            'charset' => $config['charset'],
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

// php5.6下，在DB.php中第一次实例化DB服务，会报错
$db = $di->getShared('db');
