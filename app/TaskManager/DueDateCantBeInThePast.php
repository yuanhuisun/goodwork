<?php

namespace App\TaskManager;

use Exception;

class DueDateCantBeInThePast extends Exception
{
    public function render()
    {
        return response()->json([
            'status'   => 'error',
            'message'  => 'Due date cant be in the past',
        ], 400);
    }
}
