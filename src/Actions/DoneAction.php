<?php

namespace TaskForce\Actions;

class DoneAction extends AbstractAction
{
    public function getActionName(): string
    {
        return 'Выполнено';
    }

    public function getActionInnerName(): string
    {
        return 'doneAction';
    }

    public function checkAccessRights(int $customerID, int $executorID, int $userID): bool
    {
        return $customerID === $userID;
    }
}
