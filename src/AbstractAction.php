<?php

namespace TaskForce;

abstract class AbstractAction
{
    abstract public function getActionName():string;
    abstract public function getActionInnerName():string;
    abstract public function checkAccessRights(int $customerID, int $executorID, int $userID):bool;
}
