<?php
namespace app\DueDateCalculator;

use common\DateTime;

class DueDateCalculatorDateTime extends DateTime
{
    const workingHours = 8;
    const workStart = 9;
    const workEnd = 17;

    public function addWorkingHours($hours) {
        $this->setWorkingDays(floor($hours/self::workingHours));
        $workingHours = $hours % self::workingHours;
        $this->addHours($workingHours);
        $this->validateHours($workingHours);
    }

    private function validateHours($workingHours) {
        if ($this->getHour() > self::workEnd) {
            $this->addWorkingDays(1);
            $this->addHours(self::workEnd-($this->getHour()+$workingHours));
        }
    }

    private function setWorkingDays($workingDays) {
        for ($i = 0; $i < $workingDays; $i++) {
            if ($this->getDayIndex() == 5) { //if Friday: the next day is Monday
                $this->addDays(3);
            } else {
                $this->addDays(1);
            }
        }
    }

    public function addWorkingDays($dayNumber) {
        parent::addDays($dayNumber);
        if ($this->getDayIndex() == 6) { //if Saturday the next day is Monday
            parent::addDays(2);
        }
        if ($this->getDayIndex() == 7) { //if Sunday the next day is Monday
            parent::addDays(1);
        }
    }

    public function isInWorkingTime() {
        if ( ($this->getDayIndex() == 6) || ($this->getDayIndex() == 7) ) { //if the date at weekend: return false
           return false;
        }
        if ( ($this->getHour() < self::workStart) || ($this->getHour() > self::workEnd) ) { //if date is not in working hours: return false
            return false;
        }
        return true; //else in working time
    }

}