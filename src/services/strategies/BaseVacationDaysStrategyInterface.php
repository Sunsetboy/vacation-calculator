<?php

namespace Vacation\services\strategies;

use Vacation\entities\Employee;

interface BaseVacationDaysStrategyInterface
{
    public function getBaseVacationDays(Employee $employee, $year);
}
