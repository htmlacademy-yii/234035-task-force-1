<?php

namespace TaskForce\Actions;

class RespondAction extends AbstractAction
{
    public function getActionName(): string
    {
        return 'Откликнуться';
    }

    public function getActionInnerName(): string
    {
        return 'respondAction';
    }

    public function checkAccessRights(int $customerID, int $executorID, int $userID): bool
    {
        return $customerID === $userID;
    }
}
