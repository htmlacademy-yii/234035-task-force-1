<?php

namespace TaskForce;

class RespondAction extends AbstractAction
{
    private $actionName = 'Откликнуться';
    private $actionInnerName = 'respondAction';

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
