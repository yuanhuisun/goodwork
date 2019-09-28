<?php

namespace App\TaskManager;

use InvalidArgumentException;

class TaskDetails
{
    private $title;
    private $description;

    function __construct(string $title, string $description = null)
    {
        $this->title = $this->validTitle($title);
        $this->description = $description;
    }

    public function validTitle($title): string
    {
        if (validator([$title], ['max:255'])->fails()) {
            throw new InvalidArgumentException("Title should be 255 character or less", 1);
        }

        return $title;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function description(): ?string
    {
        return $this->description;
    }
}
