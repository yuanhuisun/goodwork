<?php

namespace App\Core\Repositories;

use App\Core\Models\Task;
use App\Core\Models\User;

class TaskRepository
{
    protected $model;

    public function __construct(Task $task)
    {
        $this->model = $task;
    }

    public function getAllTaskWithAssignee($type, $entityId)
    {
        $query = request('cycle_id') ? $this->model->where('cycle_id', request('cycle_id')) : $this->model->whereNull('cycle_id');
        $query = request('status_id') ? $query->where('status_id', request('status_id')) : $query;
        $query = request('assigned_to') ? $query->where('assigned_to', request('assigned_to')) : $query;
        $query = request('due_on') ? $query->where('due_on', request('due_on')) : $query;
        $query = request('tag_id') ? $query->whereHas('tags', function ($query) {
            $query->where('id', request('tag_id'));
        })->with('tags') : $query;

        return $query->where(['taskable_type' => $type, 'taskable_id' => $entityId])
                     ->with('assignee:id,avatar,username,name')
                     ->with('creator:id,avatar')
                     ->with('related:id,name')
                     ->with('status:id,name,color')
                     ->with('tags:id,label')
                     ->get(['id', 'name', 'notes', 'assigned_to', 'due_on', 'related_to', 'completed', 'parent_id', 'status_id', 'created_by', 'created_at']);
    }

    /**
     * @param  mixed $task
     *
     * @return bool
     */
    public static function create($task): bool
    {
        return Task::insert([
            'uuid'              => $task->taskId(),
            'name'              => $task->taskDetails()->title(),
            'assigned_to'       => $task->assignee()->userId() ?? null,
            'created_by'        => $task->creator()->userId(),
            'notes'             => $task->taskDetails()->description(),
            'due_on'            => $task->dueDate()->toString(),
            'taskable_type'     => $task->group()->type()->name(),
            'taskable_id'       => $task->group()->groupId(),
            'status_id'         => 1,
        ]);
    }

    public function userCurrentlyWorkingOn(int $userId)
    {
        return $this->model->where('assigned_to', $userId)
                           ->whereHas('status', function ($query) {
                               $query->where('name', 'In Progress');
                           })
                           ->with('taskable:id,name')
                           ->with('steps')
                           ->orderBy('due_on')
                           ->get();
    }

    public static function getUserById($userId)
    {
        return User::where('id', $userId)->select('id', 'name', 'username', 'avatar')->first();
    }
}
