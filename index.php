<?php

require_once 'Task.php';

$customer['id'] = 1;

$task = new Task($customer['id']);

var_dump($task->getNextStatus('cancel action'));
die();
