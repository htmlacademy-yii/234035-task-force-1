<?php

namespace TaskForce;

class DoneAction extends AbstractAction
{
    private $actionName = 'Выполнено';
    private $actionInnerName = 'doneAction';

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
