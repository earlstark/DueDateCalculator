<?php
namespace common;

use common\ArgumentValueException;

class DateTime
{
    private $timeStamp;

    public function __construct($strTime) {
        $this->timeStamp = strtotime($strTime);
        if (!$this->timeStamp) {
            throw new ArgumentValueException("Not valid time string!");
        }
    }

    public function addDays($dayNumber) {
        $this->timeStamp += $dayNumber*24*60*60;
    }

    public function addHours($hoursNumber) {
        $this->timeStamp += $hoursNumber*60*60;
    }

    public function getDayIndex() { //1.: Monday
        return date("N", $this->timeStamp);
    }

    public function getHour() {
        return date("H", $this->timeStamp);
    }

    public function getTimeStamp() {
        return $this->timeStamp;
    }

    public function getTime() {
        return date("Y-m-d H:i:s", $this->timeStamp);
    }

}