<?php

namespace TaskForce\Actions;

class RefuseAction extends AbstractAction
{
    public function getActionName(): string
    {
        return 'Отказаться';
    }

    public function getActionInnerName(): string
    {
        return 'refuseAction';
    }

    public function checkAccessRights(int $customerID, int $executorID, int $userID): bool
    {
        return $customerID === $userID;
    }
}
