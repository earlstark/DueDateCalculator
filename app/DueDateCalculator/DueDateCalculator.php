<?php
namespace app\DueDateCalculator;

use common\ArgumentValueException;
use common\ArgumentTypeException;

class DueDateCalculator
{
    private $submitDate;
    private $turnaroundTime;

    public function __construct($submitDate, $turnaroundTime) {
        try {
            $this->submitDate = new DueDateCalculatorDateTime(str_replace("_", " ", $submitDate));
        } catch (ArgumentValueException $e) {
            throw $e;
        }
        if (!is_numeric($turnaroundTime)) {
            throw new ArgumentTypeException("Turnaround time is not a valid number!");
        }
        $this->turnaroundTime = $turnaroundTime;
    }

    public function get() {
        if (!$this->submitDate->isInWorkingTime()) {
            throw new ArgumentValueException("Submitted date is not in working time!");
        }
        $this->submitDate->addWorkingHours($this->turnaroundTime);
        return $this->submitDate->getTime();
    }
}