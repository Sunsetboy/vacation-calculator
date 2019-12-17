<?php

namespace Vacation\services\strategies;

use Vacation\entities\Employee;

class SpecialContractStrategy implements BaseVacationDaysStrategyInterface
{
    public function getBaseVacationDays(Employee $employee, $year)
    {
        return $employee->getSpecialContractVacationDays();
    }
}
