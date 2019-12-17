<?php

namespace Vacation\services;

use Exception;
use Vacation\entities\Employee;
use Vacation\services\strategies\BaseVacationDaysStrategyInterface;
use Vacation\services\strategies\ExperiencedEmployeeDaysStrategy;
use Vacation\services\strategies\SpecialContractStrategy;
use Vacation\services\strategies\StandardDaysStrategy;

class VacationCalculator
{
    /** @var Employee $employee */
    protected $employee;
    /** @var BaseVacationDaysStrategyInterface $baseVacationDaysStrategy */
    protected $baseVacationDaysStrategy;
    /** @var int $year */
    protected $year;

    public function __construct(Employee $employee, $year)
    {
        $this->employee = $employee;
        $this->year = $year;
        $this->baseVacationDaysStrategy = $this->resolveVacationDaysStrategy();
    }

    public function calculateEmployeeVacationDays(): int
    {
        $baseVacationDays = $this->calculateBaseVacationDays();
        $partOfYearWithContract = $this->calculatePartOfYearWithContract();

        return round($baseVacationDays * $partOfYearWithContract);
    }

    /**
     * Resolves which strategy is suitable for calculating base yearly vacation days for the employee
     * @return BaseVacationDaysStrategyInterface
     */
    protected function resolveVacationDaysStrategy(): BaseVacationDaysStrategyInterface
    {
        if ($this->employee->getSpecialContractVacationDays()) {
            return new SpecialContractStrategy();
        }

        if ($this->employee->getAge($this->year) >= 30) {
            return new ExperiencedEmployeeDaysStrategy();
        }

        return new StandardDaysStrategy();
    }

    protected function calculateBaseVacationDays(): int
    {
        return $this->baseVacationDaysStrategy->getBaseVacationDays($this->employee, $this->year);
    }

    /**
     * Part of year when the employee had an active contract (from 0 to 1)
     * @return float
     * @throws Exception
     */
    protected function calculatePartOfYearWithContract(): float
    {
        $yearStart = (new \DateTime())->setDate($this->year, 1, 1);
        $yearEnd = (new \DateTime())->setDate($this->year, 12, 31);

        // the employee started job after the specified year
        if ($this->employee->getContractStartDate() > $yearEnd) {
            return 0;
        }

        // the employee started job before the specified year (worked full year)
        if ($this->employee->getContractStartDate() < $yearStart) {
            return 1;
        }

        $monthsOfWorkInCurrentYear = $this->employee->getContractStartDate()->diff($yearStart)->m;

        return $monthsOfWorkInCurrentYear / 12;
    }
}
