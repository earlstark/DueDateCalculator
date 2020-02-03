<?php

use common\ArgumentValueException;
use PHPUnit\Framework\TestCase;
use common\DateTime;

class DateTimeTest extends TestCase
{
    public function testTimeStamp()
    {
        $dateTime = new DateTime('2020-03-03 11:30');
        $this->assertEquals($dateTime->getTimeStamp(), 1583231400);
    }

    public function testInvalidDate() {
        $this->expectException(ArgumentValueException::class);
        $dateTime = new DateTime('2020-03-asd03 11:30');
    }

}