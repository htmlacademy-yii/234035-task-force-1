<?php

use TaskForce\Task;
require_once 'vendor/autoload.php';

$task = new Task(1, 2, 1);
//$task = new Task(2, 1, 1);

//$status = 'new status';
$status = 'work status';

echo '<pre>' . print_r($task->getActions($status), true) . '</pre>';
die();
