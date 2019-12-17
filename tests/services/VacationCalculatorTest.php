<?php

namespace tests\services;

use DateTime;
use PHPUnit\Framework\TestCase;
use Vacation\entities\Employee;
use Vacation\services\VacationCalculator;

class VacationCalculatorTest extends TestCase
{
    /**
     * @dataProvider calculatorProvider
     * @param Employee $employee
     * @param integer $year
     * @param integer $expectedVacationDays
     * @throws \Exception
     */
    public function testCalculateEmployeeVacationDays($employee, $year, $expectedVacationDays)
    {
        $vacationCalculator = new VacationCalculator($employee, $year);
        $this->assertEquals($expectedVacationDays, $vacationCalculator->calculateEmployeeVacationDays());
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function calculatorProvider(): array
    {
        return [
            'senior person, 60 years old, worked full year' => [
                'employee' => (new Employee())->setBirthDate(new DateTime('1958-04-02'))
                    ->setContractStartDate(new DateTime('2000-12-19')),
                'year' => 2019,
                'expectedVacationDays' => (26+7),
            ],
            'freshman, 20 years old, worked 4 months' => [
                'employee' => (new Employee())->setBirthDate(new DateTime('1998-04-02'))
                    ->setContractStartDate(new DateTime('2019-09-01')),
                'year' => 2019,
                'expectedVacationDays' => 9, // round(26 * 4/12)
            ],
            'started working next year' => [
                'employee' => (new Employee())->setBirthDate(new DateTime('1998-04-02'))
                    ->setContractStartDate(new DateTime('2019-09-01')),
                'year' => 2018,
                'expectedVacationDays' => 0,
            ],
            'works full year, age 29' => [
                'employee' => (new Employee())->setBirthDate(new DateTime('1999-04-20'))
                    ->setContractStartDate(new DateTime('2019-01-01')),
                'year' => 2019,
                'expectedVacationDays' => 26,
            ],
        ];
    }
}
