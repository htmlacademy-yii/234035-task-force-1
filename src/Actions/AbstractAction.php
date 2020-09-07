<?php

namespace TaskForce\Actions;

abstract class AbstractAction
{
    abstract public function getActionName():string;
    abstract public function getActionInnerName():string;
    abstract public function checkAccessRights(int $customerID, int $executorID, int $userID):bool;
}
