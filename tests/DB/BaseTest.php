<?php
// +----------------------------------------------------------------------
// | BaseTest.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Tests\DB;

use Tests\TestCase;
use Xin\DB;
use PDO;

class BaseTest extends TestCase
{
    public function testInsert()
    {
        $sql = "INSERT INTO `user` (`name`,`role_id`) VALUES (?,?)";
        $res = DB::execute($sql, [uniqid(), 1]);
        $this->assertTrue($res);
    }

    public function testQuery()
    {
        $sql = "SELECT * FROM `user` WHERE `name` = ? LIMIT 1;";
        $res = DB::query($sql, ['limx']);
        $this->assertEquals(1, $res[0]['id']);
        $this->assertEquals(1, count($res));
        $this->assertTrue(is_array($res));
    }

    public function testFetch()
    {
        $sql = "SELECT * FROM `user` WHERE `name` = ? LIMIT 1;";
        $res = DB::fetch($sql, ['limx']);
        $this->assertTrue(is_array($res));

        $res = DB::fetch($sql, ['limx'], PDO::FETCH_OBJ);
        $this->assertTrue(is_object($res));
    }

    public function testExecute()
    {
        $sql = "INSERT INTO `user` (`name`,`role_id`) VALUES (?,?)";
        $res = DB::execute($sql, [uniqid(), 2]);
        $this->assertTrue($res);

        $res = DB::execute($sql, [uniqid(), 1], true);
        $this->assertEquals(1, $res);

        $sql = "UPDATE `user` SET role_id=? WHERE name =?";
        $res = DB::execute($sql, [2, 'limx'], true);
        $this->assertTrue(is_numeric($res));
    }

    public function testTableExist()
    {
        $this->assertTrue(DB::tableExists('user'));
        $this->assertFalse(DB::tableExists('sss'));
    }
}
