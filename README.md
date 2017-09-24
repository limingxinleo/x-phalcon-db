# X-Phalcon-DB

## 安装
~~~
composer require limingxinleo/x-phalcon-db
~~~

## 使用
~~~php
<?php
use Phalcon\DI\FactoryDefault;
use Phalcon\Db\Adapter\Pdo\Mysql;
use PDO;
use Xin\DB;

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

$sql = "SELECT * FROM `test` WHERE `name` = ? LIMIT 1;";
$res = DB::query($sql, ['limx']);
~~~