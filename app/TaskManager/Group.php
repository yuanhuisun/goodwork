<?php

namespace App\TaskManager;

class Group
{
    private $groupId;
    private $type;

    function __construct(int $groupId, GroupType $type)
    {
        $this->groupId = $groupId;
        $this->type = $type;
    }

    public function groupId()
    {
        return $this->groupId;
    }

    public function type()
    {
        return $this->type;
    }
}
