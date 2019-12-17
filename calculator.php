<?php

use Vacation\repositories\EmployeeRepository;
use Vacation\services\VacationCalculator;

require_once 'vendor/autoload.php';

if (!isset($argv[1])) {
    die('Please enter the year' . PHP_EOL);
}

$year = (int)$argv[1];

$employeeRepository = new EmployeeRepository();
$employees = $employeeRepository->fetchAll();
//var_dump($employees);

foreach ($employees as $employee) {
    $vacationDaysCalculator = new VacationCalculator($employee, $year);
    $vacationDays = $vacationDaysCalculator->calculateEmployeeVacationDays();

    echo $employee->getName() . ' (age ' . $employee->getAge($year) . '):' . $vacationDays . ' days' . PHP_EOL;
}
