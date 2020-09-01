<?php

namespace TaskForce;

class CancelAction extends AbstractAction
{
    private $actionName = 'Отменить';
    private $actionInnerName = 'cancelAction';

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
