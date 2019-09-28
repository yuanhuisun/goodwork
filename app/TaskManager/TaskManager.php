<?php

namespace App\TaskManager;

use App\Core\Repositories\TaskRepository;

class TaskManager
{
    public static function createTask($request)
    {
        $creator = auth()->user();
        $assignee = $request->assigned_to ? TaskRepository::getUserById($request->assigned_to) : null;
        $task = new Task(
            TaskId::generate(),
            new TaskDetails($request->name, $request->description),
            new Creator($creator->id, $creator->name, $creator->username, $creator->avatar),
            new Assignee($assignee->id, $assignee->name, $assignee->username, $assignee->avatar),
            new Group(
                $request->group_id,
                new GroupType($request->group_type)
            ),
            new DueDate($request->due_on),
            new Status()
        );

        TaskRepository::create($task);

        return $task;
    }
}
