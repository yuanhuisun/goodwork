<?php

namespace App\TaskManager;

use Carbon\CarbonImmutable;
use InvalidArgumentException;

class DueDate
{
    const FORMAT = 'Y-m-d';
    private $value;

    public function __construct(string $date)
    {
        $this->value = $this->validDate($date);
    }

    public function validDate(string $date): CarbonImmutable
    {
        $this->formatIsValid($date);

        return $this->dateNotInThePast($date);
    }

    public function formatIsValid($date): void
    {
        if (validator([$date], ['date_format:' . self::FORMAT])->fails()) {
            throw new InvalidArgumentException('Invalid date format', 0);
        }
    }

    public function dateNotInThePast($date): CarbonImmutable
    {
        $date = CarbonImmutable::parse($date);
        if ($date->lessThan(CarbonImmutable::today())) {
            throw new DueDateCantBeInThePast();
        }

        return $date;
    }

    public function value(): CarbonImmutable
    {
        return $this->value;
    }

    public function toString()
    {
        return $this->value->toDateString();
    }
}
