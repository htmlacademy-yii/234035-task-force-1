<?php

namespace TaskForce\Actions;

class CancelAction extends AbstractAction
{
    public function getActionName(): string
    {
        return 'Отменить';
    }

    public function getActionInnerName(): string
    {
        return 'cancelAction';
    }

    public function checkAccessRights(int $customerID, int $executorID, int $userID): bool
    {
        return $customerID === $userID;
    }
}
