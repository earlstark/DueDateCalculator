<?php

use \PHPUnit\Framework\TestCase;
use app\DueDateCalculator\DueDateCalculator;
use common\ArgumentValueException;
use common\ArgumentTypeException;

class DueDateCalculatorTest extends TestCase
{

    public function testValidSubmitDate() {
        $dueDateCalculator = new DueDateCalculator('2020-03-06 11:00', 10);
        $this->assertEquals($dueDateCalculator->get(), '2020-03-09 13:00:00');
    }

    public function testValidSubmitDateSkipWeekend_12() {
        $dueDateCalculator = new DueDateCalculator('2020-03-06 11:00', 12);
        $this->assertEquals($dueDateCalculator->get(), '2020-03-09 15:00:00');
    }

    public function testValidSubmitDateSkipWeekend_40() {
        $dueDateCalculator = new DueDateCalculator('2020-03-06 11:00', 40);
        $this->assertEquals($dueDateCalculator->get(), '2020-03-13 11:00:00');
    }

    public function testValidSubmitDateSkipWeekend_88() {
        $dueDateCalculator = new DueDateCalculator('2020-03-06 11:00', 88);
        $this->assertEquals($dueDateCalculator->get(), '2020-03-23 11:00:00');
    }

    public function testValidSubmitDateSkipWeekend_100() {
        $dueDateCalculator = new DueDateCalculator('2020-03-06 11:00', 100);
        $this->assertEquals($dueDateCalculator->get(), '2020-03-24 15:00:00');
    }

    public function testInvalidSubmitDate() {
        $this->expectException(ArgumentValueException::class);
        $dueDateCalculator = new DueDateCalculator('2020-asd03-03 11:30', 10);
    }

    public function testInvalidTurnaroundTime() {
        $this->expectException(ArgumentTypeException::class);
        $dueDateCalculator = new DueDateCalculator('2020-03-03 11:30', 'asd3');
    }

    public function testSubmitDateNotInWorkingTime0() {
        $this->expectException(ArgumentValueException::class);
        $dueDateCalculator = new DueDateCalculator('2020-03-08 11:30', 10);
        $dueDateCalculator->get();
    }

    public function testSubmitDateNotInWorkingTime1() {
        $this->expectException(ArgumentValueException::class);
        $dueDateCalculator = new DueDateCalculator('2020-03-03 05:30', 10);
        $dueDateCalculator->get();
    }

}