# Vacation calculator
Calculates number of vacation days for dummy employees defined in src/data/employees.php

I tried to realize this task following DDD concept, Strategy pattern and SOLID principles. 

### Assumptions
In my implementation if employee has special contract, contract vacation days overwrites bonus days added for age over 30. For example, if I have a special contract with 28 vacation days and my age is 45, I will have 28 vacation days. 

## Requirements
PHP 7.2+
Composer

## Installation
Run from this folder
```
composer install
```

## Running the script
Run calculator.php specifying a year:
```
php calculator.php 2019
```

## Tests execution
```
vendor/bin/phpunit tests
```