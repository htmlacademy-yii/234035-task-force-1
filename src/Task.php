<?php

namespace TaskForce;

class Task
{
    public const STATUS_NEW = 'new status'; //новое
    public const STATUS_WORK = 'work status'; //выполняется
    public const STATUS_DONE = 'done status'; //завершено
    public const STATUS_CANCEL = 'cancel status'; //отменено

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

    public const ACTION_CANCEL = 'cancel action'; // отменить задание
    public const ACTION_RESPOND = 'respond action'; //откликнуться на задание
    public const ACTION_DONE = 'done action'; //задание выполнено
    public const ACTION_REFUSE = 'refuse action'; //отказаться от задания

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

    private $customerID = null;
    private $executorID = null;
    private $completionDate = null;
    private $activeStatus = null;

    public function __construct($customerID, $executorID, $userID)
    {
        $this->customerID = $customerID;
        $this->executorID = $executorID;
        $this->userID = $userID;

        $this->cancelAction = new CancelAction();
        $this->doneAction = new DoneAction();
        $this->respondAction = new RespondAction();
        $this->refuseAction = new RefuseAction();
    }

    public function getActions(string $status): object
    {
        if ($status == 'new status') {
            if ($this->cancelAction->checkAccessRights($this->customerID, $this->executorID, $this->userID))
                $result = $this->cancelAction;
            else {
                $result = $this->respondAction;
            }
        }

        if ($status == 'work status') {
            if ($this->doneAction->checkAccessRights($this->customerID, $this->executorID, $this->userID))
                $result = $this->doneAction;
            else {
                $result = $this->refuseAction;
            }
        }

        return $result;
    }
}
