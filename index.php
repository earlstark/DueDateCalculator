<?php

require __DIR__.'/vendor/autoload.php';

use app\DueDateCalculator\DueDateCalculator;
use common\ArgumentValueException;
use common\ArgumentTypeException;

try {
    $dueDateCalculator = new DueDateCalculator($_GET["submitDate"], $_GET["turnaroundTime"]);
    echo $dueDateCalculator->get();
} catch (ArgumentValueException $e) {
    echo 'Argument value exception: '.$e->getMessage();
} catch (ArgumentTypeException $e) {
    echo 'Argument type exception: '.$e->getMessage();
}
