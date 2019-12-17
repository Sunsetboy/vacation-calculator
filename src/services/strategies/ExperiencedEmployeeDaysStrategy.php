<?php

namespace Vacation\services\strategies;

use Vacation\entities\Employee;

class ExperiencedEmployeeDaysStrategy implements BaseVacationDaysStrategyInterface
{
    const AGE_OF_START_GETTING_BONUS_DAYS = 30;

    public function getBaseVacationDays(Employee $employee, $year)
    {
        $employeeAge = $employee->getAge($year);
        $bonusDaysForAge = ceil(($employeeAge + 1 - self::AGE_OF_START_GETTING_BONUS_DAYS) / 5);

        return $bonusDaysForAge + StandardDaysStrategy::STANDARD_VACATION_DAYS;
    }
}
