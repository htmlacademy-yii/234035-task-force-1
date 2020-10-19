<?php

use TaskForce\Task;
use TaskForce\CsvToSql;
require_once 'vendor/autoload.php';

$converter = new CsvToSql();
$converter->toSql("data/categories.csv");
$converter->toSql("data/cities.csv");
$converter->toSql("data/opinions.csv");
$converter->toSql("data/replies.csv");
$converter->toSql("data/tasks.csv");
$converter->toSql("data/users.csv");

$task = new Task(1, 2, 1);
//$task = new Task(2, 1, 1);

//$status = 'new status';
$status = 'work status';

echo '<pre>' . print_r($task->getActions($status), true) . '</pre>';
die();
