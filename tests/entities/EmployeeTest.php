<?php

namespace tests\services;

use DateTime;
use PHPUnit\Framework\TestCase;
use Vacation\entities\Employee;

class EmployeeTest extends TestCase
{

    public function testSettersAndGetters()
    {
        $employee = new Employee();
        $employee->setName('Donald Trump')
            ->setBirthDate(new DateTime('1946-06-14'))
            ->setContractStartDate(new DateTime('2017-01-20'))
            ->setSpecialContractVacationDays(null);

        $this->assertEquals('Donald Trump', $employee->getName());
        $this->assertEquals(null, $employee->getSpecialContractVacationDays());
        $this->assertEquals('2017-01-20', $employee->getContractStartDate()->format('Y-m-d'));
        $this->assertEquals('1946-06-14', $employee->getBirthDate()->format('Y-m-d'));
    }

    /**
     * @dataProvider ageProvider
     * @param $birthDate
     * @param $year
     * @param $expectedAge
     * @throws \Exception
     */
    public function testGetAge($birthDate, $year, $expectedAge)
    {
        $employee = new Employee();
        $employee->setBirthDate(new DateTime($birthDate));

        $this->assertEquals($expectedAge, $employee->getAge($year));
    }

    public function ageProvider(): array
    {
        return [
            [
                'birthDate' => '1946-06-14',
                'year' => 2019,
                'expectedAge' => 72,
            ],
            [
                'birthDate' => '2018-06-14',
                'year' => 2019,
                'expectedAge' => 0,
            ],
            [
                'birthDate' => '2020-06-14',
                'year' => 2019,
                'expectedAge' => null,
            ],
        ];
    }
}
