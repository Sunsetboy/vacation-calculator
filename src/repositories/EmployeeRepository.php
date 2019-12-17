<?php

namespace Vacation\repositories;

use Vacation\entities\Employee;

class EmployeeRepository
{
    /**
     * @return Employee[]
     * @throws \Exception
     */
    public function fetchAll():array
    {
        $employees = [];

        $employeesData = include __DIR__ . '/../data/employees.php';
        if (!is_array($employeesData)) {
            return [];
        }

        foreach ($employeesData as $employeeDataItem) {
            $employee = new Employee();
            $employee->setName($employeeDataItem['name']);
            $employee->setBirthDate(new \DateTime($employeeDataItem['birthDate']));
            $employee->setContractStartDate(new \DateTime($employeeDataItem['contractStartDate']));
            $employee->setSpecialContractVacationDays($employeeDataItem['specialContractVacationDays']);
            $employees[] = $employee;
        }

        return $employees;
    }
}
