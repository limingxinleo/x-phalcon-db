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
    public static function query($sql, $params = [])
    {
        $db = static::dbInstance();
        $status = $db->query($sql, $params);
        $result = [];
        if ($status) {
            $status->setFetchMode(PDO::FETCH_ASSOC);
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
    public static function fetch($sql, $params = [])
    {
        $db = static::dbInstance();
        $status = $db->query($sql, $params);
        $result = [];
        if ($status) {
            $status->setFetchMode(PDO::FETCH_ASSOC);
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
            return $status->affectedRows();
            // $sql = "SELECT ROW_COUNT() AS row_count;";
            // $res = self::fetch($sql);
            // if ($res) {
            //     return $res['row_count'];
            // }
            // return 0;
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
        return $di->getShared(static::$dbServiceName);
    }

}