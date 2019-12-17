<?php


namespace Vacation\services\strategies;


use Vacation\entities\Employee;

class StandardDaysStrategy implements BaseVacationDaysStrategyInterface
{
    const STANDARD_VACATION_DAYS = 26;

    public function getBaseVacationDays(Employee $employee, $year)
    {
        return self::STANDARD_VACATION_DAYS;
    }
}
