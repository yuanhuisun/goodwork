<?php

namespace App\TaskManager;

class Assignee
{
    private $userId;
    private $name;
    private $username;
    private $avatar;

    public function __construct($userId, $name, $username, $avatar)
    {
        $this->userId = $userId;
        $this->name = $name;
        $this->username = $username;
        $this->avatar = $avatar;
    }

    public function userId()
    {
        return $this->userId;
    }

    public function name()
    {
        return $this->name;
    }

    public function username()
    {
        return $this->username;
    }

    public function avatar()
    {
        return $this->avatar;
    }
}
