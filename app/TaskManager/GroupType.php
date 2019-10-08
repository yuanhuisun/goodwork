<?php

namespace App\TaskManager;

use InvalidArgumentException;

class GroupType
{
    private $name;
    private $allowed = [
        'project', 'team', 'office',
    ];

    public function __construct(string $name)
    {
        $this->name = $this->typeIsValid($name);
    }

    public function typeIsValid($name): string
    {
        if (in_array($name, $this->allowed)) {
            return $name;
        }
        throw new InvalidArgumentException('Group type is not valid', 1);
    }

    public function name()
    {
        return $this->name;
    }
}
