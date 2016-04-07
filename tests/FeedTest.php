<?php

namespace Zogxray\Feed;
class FeedTest extends \PHPUnit_Framework_TestCase
{
    public $feed;
    public function setUp()
    {
        $this->feed = new Feed;
    }
    public function testConstructorFail()
    {
        $this->feed = new Feed();
    }
}