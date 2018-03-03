<?php
// +----------------------------------------------------------------------
// | DB.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Xin;

use PDO;
use Phalcon\Di\FactoryDefault;

/**
 * Class DB
 * @package Xin
 * @see     https://docs.phalconphp.com/en/3.2/api/Phalcon_Db_Adapter_Pdo_Mysql
 */
class DB
{
    /**
     * @var string 定义DB服务名
     */
    protected static $dbServiceName = 'db';

    /**
     * @desc   查询结果集合
     * @author limx
     * @param       $sql
     * @param array $params
     * @return array
     */
    public static function query($sql, $params = [], $fetchMode = PDO::FETCH_ASSOC)
    {
        $db = static::dbInstance();
        $status = $db->query($sql, $params);
        $result = [];
        if ($status) {
            $status->setFetchMode($fetchMode);
            $result = $status->fetchAll();
        }
        return $result;
    }

    /**
     * @desc   查询一条数据
     * @author limx
     * @param       $sql
     * @param array $params
     * @return array
     */
    public static function fetch($sql, $params = [], $fetchMode = PDO::FETCH_ASSOC)
    {
        $db = static::dbInstance();
        $status = $db->query($sql, $params);
        $result = [];
        if ($status) {
            $status->setFetchMode($fetchMode);
            $result = $status->fetch();
        }
        return $result;
    }

    /**
     * @desc   更新数据
     * @author limx
     * @param       $sql          SQL语句
     * @param array $params       参数
     * @param bool  $withRowCount 是否返回影响的行数
     * @return int|mixed
     */
    public static function execute($sql, $params = [], $withRowCount = false)
    {
        $db = static::dbInstance();
        $status = $db->execute($sql, $params);
        if ($status && $withRowCount) {
            return $db->affectedRows();
        }
        return $status;
    }

    /**
     * @desc   执行Sql并返回影响的行数
     * @author limx
     * @param       $sql
     * @param array $params
     * @return int|mixed
     */
    public static function execWithRowCount($sql, $params = [])
    {
        return self::execute($sql, $params, true);
    }

    /**
     * @desc   事务开始
     * @author limx
     * @return mixed
     */
    public static function begin()
    {
        return static::dbInstance()->begin();
    }

    /**
     * @desc   事务回滚
     * @author limx
     * @return mixed
     */
    public static function rollback()
    {
        return static::dbInstance()->rollback();
    }

    /**
     * @desc   事务提交
     * @author limx
     * @return mixed
     */
    public static function commit()
    {
        return static::dbInstance()->commit();
    }

    protected static function dbInstance()
    {
        $di = FactoryDefault::getDefault();
        $db = $di->getShared(static::$dbServiceName);
        return $db;
    }

    public static function __callStatic($name, $arguments)
    {
        return static::dbInstance()->$name(...$arguments);
    }
}
