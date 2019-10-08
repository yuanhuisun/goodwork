<?php

namespace App\TaskManager;

use InvalidArgumentException;

class Status
{
    private $name;
    private $type = [
        'To Do', 'In Progress', 'In Review', 'Completed', 'Canceled',
    ];

    public function __construct(string $name = null)
    {
        $this->name = $this->validStatus($name);
    }

    public function validStatus(self $status = null): string
    {
        if ($status === null) {
            return 'To Do';
        }

        if (in_array($status, $this->type)) {
            return $status;
        }
        throw new InvalidArgumentException('Status type is not valid', 1);
    }
}
