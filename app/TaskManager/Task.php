<?php

namespace App\TaskManager;

class Task
{
    private $taskId;
    private $taskDetails;
    private $creator;
    private $assignee;
    private $group;
    private $dueDate;
    private $status;

    public function __construct(
        TaskId $taskId,
        TaskDetails $taskDetails,
        Creator $creator,
        Assignee $assignee,
        Group $group,
        DueDate $dueDate,
        Status $status = null
    ) {
        $this->taskId = $taskId;
        $this->taskDetails = $taskDetails;
        $this->creator = $creator;
        $this->assignee = $assignee;
        $this->group = $group;
        $this->dueDate = $dueDate;
        $this->status = $status;
    }

    public function taskId()
    {
        return $this->taskId;
    }

    public function taskDetails()
    {
        return $this->taskDetails;
    }

    public function creator()
    {
        return $this->creator;
    }

    public function assignee()
    {
        return $this->assignee;
    }

    public function group()
    {
        return $this->group;
    }

    public function dueDate()
    {
        return $this->dueDate;
    }

    public function status()
    {
        return $this->status;
    }
}
