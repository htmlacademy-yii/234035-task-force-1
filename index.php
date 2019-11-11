<?php

use TaskForce\Task\Task;

require_once 'vendor/autoload.php';

$customer['id'] = 1;

$task = new Task($customer['id']);

var_dump($task->getNextStatus('cancel action'));
die();
