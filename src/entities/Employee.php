<?php

namespace Vacation\entities;

use Vacation\services\strategies\BaseVacationDaysStrategyInterface;

class Employee
{
    /** @var \DateTime $birthDate */
    protected $birthDate;
    /** @var string $name */
    protected $name;
    /** @var \DateTime $contractStartDate */
    protected $contractStartDate;
    /** @var integer|null $specialContractVacationDays */
    protected $specialContractVacationDays = null;

    /**
     * @return \DateTime
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * @param \DateTime $birthDate
     * @return Employee
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Employee
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getContractStartDate()
    {
        return $this->contractStartDate;
    }

    /**
     * @param \DateTime $contractStartDate
     * @return Employee
     */
    public function setContractStartDate($contractStartDate)
    {
        $this->contractStartDate = $contractStartDate;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getSpecialContractVacationDays()
    {
        return $this->specialContractVacationDays;
    }

    /**
     * @param int|null $specialContractVacationDays
     * @return Employee
     */
    public function setSpecialContractVacationDays($specialContractVacationDays)
    {
        $this->specialContractVacationDays = $specialContractVacationDays;
        return $this;
    }

    /**
     * Returns employee's age at the beginning of the year or null if employee was born after it
     * @param int $currentYear
     * @return int|null
     * @throws \Exception
     */
    public function getAge($currentYear): ?int
    {
        $yearStart = (new \DateTime())->setDate($currentYear, 1, 1);

        return ($yearStart > $this->birthDate) ? $yearStart->diff($this->birthDate)->y : null;
    }
}
