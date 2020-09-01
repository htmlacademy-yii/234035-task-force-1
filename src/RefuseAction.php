<?php

namespace TaskForce;

class RefuseAction extends AbstractAction
{
    private $actionName = 'Отказаться';
    private $actionInnerName = 'refuseAction';

    public function getActionName(): string
    {
        return $this->actionName;
    }

    public function getActionInnerName(): string
    {
        return $this->actionInnerName;
    }

    public function checkAccessRights(int $customerID, int $executorID, int $userID): bool
    {
        return $customerID === $userID;
    }
}
