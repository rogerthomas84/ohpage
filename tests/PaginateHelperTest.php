<?php
namespace tests\OhPageTests;

use OhPage\PaginateHelper;

class PaginateHelperTest extends \PHPUnit_Framework_TestCase
{
    public function testBasicData()
    {
        $perPage = 10;
        $currentPage = 1;
        $totalResults = 9;
        $instance = new PaginateHelper($perPage, $currentPage, $totalResults);
        $this->assertEquals($perPage, $instance->getQueryLimit());
        $this->assertEquals($currentPage, $instance->getCurrentPage());
        $this->assertEquals($totalResults, $instance->getTotalResults());
        $this->assertEquals(0, $instance->getQueryOffset());
        $this->assertEquals(1, $instance->getTotalPages());
    }

    public function testInvalidData()
    {
        $perPage = -1;
        $currentPage = -1;
        $totalResults = -1;
        $instance = new PaginateHelper($perPage, $currentPage, $totalResults);
        $this->assertEquals(10, $instance->getQueryLimit());
        $this->assertEquals(0, $instance->getCurrentPage());
        $this->assertEquals(0, $instance->getTotalResults());
        $this->assertEquals(0, $instance->getQueryOffset());
        $this->assertEquals(0, $instance->getTotalPages());
    }

    public function testPagedCeils()
    {
        $perPage = 10;
        $currentPage = 1;
        $totalResults = 2;
        $instance = new PaginateHelper($perPage, $currentPage, $totalResults);
        $this->assertEquals(10, $instance->getQueryLimit());
        $this->assertEquals(1, $instance->getTotalPages());
    }

    public function testMultiplePages()
    {
        $perPage = 10;
        $currentPage = 4;
        $totalResults = 31;
        $instance = new PaginateHelper($perPage, $currentPage, $totalResults);
        $this->assertEquals(30, $instance->getQueryOffset());
        $this->assertEquals(10, $instance->getQueryLimit());
        $this->assertEquals(4, $instance->getTotalPages());
    }
}
