# Vacation calculator
Calculates number of vacation days for dummy employees defined in src/data/employees.php

I tried to realize this task following DDD concept, Strategy pattern and SOLID principles. 

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