<?php

namespace TaskForce\Task;

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

    public const ACTION_ADD = 'add action'; //создать/добавить задание
    public const ACTION_RESPOND = 'respond action'; //откликнуться на задание
    public const ACTION_WORK = 'work action'; //отдать на выполнение
    public const ACTION_DONE = 'done action'; //задание завершено
    public const ACTION_CANCEL = 'cancel action'; // задание отменено
    public const ACTION_WRITE = 'write action'; //написать сообщение

    private const ACTIONS = [
        self::ACTION_ADD,
        self::ACTION_RESPOND,
        self::ACTION_WORK,
        self::ACTION_DONE,
        self::ACTION_CANCEL,
        self::ACTION_WRITE
    ];

    private const RELATIONS = [
        self::ACTION_ADD => self::STATUS_NEW,
        self::ACTION_WORK => self::STATUS_WORK,
        self::ACTION_DONE => self::STATUS_DONE,
        self::ACTION_CANCEL => self::STATUS_CANCEL
    ];

    private $customerID = null;
    private $executorID = null;
    private $completionDate = null;
    private $activeStatus = null;

    public function __construct($customerID)
    {
        $this->customerID = $customerID;
        $this->activeStatus = self::STATUS_NEW;
    }

    public function getActions(): array
    {
        return self::ACTIONS;
    }

    public function getStatuses(): array
    {
        return self::STATUSES;
    }

    public function getNextStatus(string $action): string
    {
        if (!isset(self::RELATIONS[$action])) {
            throw new \DomainException("The {$action} is not defined");
        }

        return self::RELATIONS[$action];
    }

    public function respondTask(int $executorID): void
    {
        //...
    }

    public function cancelTask(int $customerID): void
    {
        //...
    }

    public function writeMessage(): void
    {
        //...
    }
}
