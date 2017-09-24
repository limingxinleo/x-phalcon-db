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
        $sql = "INSERT INTO {$this->table} (`name`,`age`) VALUES (?,?)";
        $res = DB::execute($sql, ['limx', 26]);
        $this->assertTrue($res);
    }

    public function testQuery()
    {
        $sql = "SELECT * FROM `{$this->table}` WHERE `name` = ? LIMIT 1;";
        $res = DB::query($sql, ['limx']);
        $this->assertTrue(count($res) > 0);
        $this->assertTrue(is_array($res));
    }

    public function testFetch()
    {
        $sql = "SELECT * FROM `{$this->table}` WHERE `name` = ? LIMIT 1;";
        $res = DB::fetch($sql, ['limx']);
        $this->assertTrue(is_array($res));

        $res = DB::fetch($sql, ['limx'], PDO::FETCH_OBJ);
        $this->assertTrue(is_object($res));
    }

    public function testExecute()
    {
        $sql = "INSERT INTO {$this->table} (`name`,`age`) VALUES (?,?)";
        $res = DB::execute($sql, ['Agnes', 25]);
        $this->assertTrue($res);

        $res = DB::execute($sql, ['Agnes', 25], true);
        $this->assertEquals(1, $res);

        $sql = "UPDATE {$this->table} SET age=? WHERE name =?";
        $res = DB::execute($sql, [26, 'Agnes'], true);
        $this->assertTrue(is_numeric($res));
    }

    public function testTableExist()
    {
        $this->assertTrue(DB::tableExists($this->table));
        $this->assertFalse(DB::tableExists('sss'));
    }

}