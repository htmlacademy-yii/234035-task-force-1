<?php
declare(strict_types=1);

namespace TaskForce;

use TaskForce\Actions\AbstractAction;
use TaskForce\Actions\CancelAction;
use TaskForce\Actions\DoneAction;
use TaskForce\Actions\RefuseAction;
use TaskForce\Actions\RespondAction;
use TaskForce\Exceptions\TaskException;

class Task
{
    public const STATUS_NEW = 'new status';
    public const STATUS_WORK = 'work status';
    public const STATUS_DONE = 'done status';
    public const STATUS_CANCEL = 'cancel status';

    private const STATUSES = [
        self::STATUS_NEW,
        self::STATUS_WORK,
        self::STATUS_DONE,
        self::STATUS_CANCEL
    ];

    public const ROLE_CUSTOMER = 'customer role';
    public const ROLE_EXECUTOR = 'executor role';

    private const ROLES = [
        self::ROLE_CUSTOMER,
        self::ROLE_EXECUTOR
    ];

    public const ACTION_CANCEL = 'cancel action';
    public const ACTION_RESPOND = 'respond action';
    public const ACTION_DONE = 'done action';
    public const ACTION_REFUSE = 'refuse action';

    private const ACTIONS = [
        self::ACTION_CANCEL,
        self::ACTION_RESPOND,
        self::ACTION_DONE,
        self::ACTION_REFUSE
    ];

    private const RELATIONS = [
        self::ACTION_CANCEL => self::STATUS_NEW,
        self::ACTION_RESPOND => self::STATUS_NEW,
        self::ACTION_DONE => self::STATUS_WORK,
        self::ACTION_REFUSE => self::STATUS_WORK
    ];

    private ?int $customerID;
    private ?int $executorID;
    private ?string $completionDate;
    private ?string $activeStatus;

    public function __construct(int $customerID, int $executorID, int $userID)
    {
        if (empty($customerID) or empty($executorID) or empty($userID))
        {
            throw new TaskException('The role is empty');
        }
        $this->customerID = $customerID;
        $this->executorID = $executorID;
        $this->userID = $userID;

        $this->cancelAction = new CancelAction();
        $this->doneAction = new DoneAction();
        $this->respondAction = new RespondAction();
        $this->refuseAction = new RefuseAction();
    }

    public function getActions(string $status): AbstractAction
    {
        if ($status === self::STATUS_NEW)
        {
            if ($this->cancelAction->checkAccessRights($this->customerID, $this->executorID, $this->userID))
                $result = $this->cancelAction;
            else {
                $result = $this->respondAction;
            }
        }
        elseif ($status === self::STATUS_WORK)
        {
            if ($this->doneAction->checkAccessRights($this->customerID, $this->executorID, $this->userID))
                $result = $this->doneAction;
            else {
                $result = $this->refuseAction;
            }
        }
        else
        {
            throw new TaskException('Status not found');
        }

        return $result;
    }
}
