# Advent of Code 2024

# How to....
- Install dependencies via `sudo composer install`
- create alias `alias dcr='docker-compose run'`
- Run tests via `dcr phpunit` to run them all
- Run specific tests via `dcr phpunit tests/DayX/dayXTest.php`
- Run code quality via `dcr phpstan`

For daily creation of the files and setup:
- ./createDay.sh #dayNumber
This will create the base class, test file and retrieves the input files from the source.

# Common functions
In the Day class the following functions are available:
- loadData() --> retrieves the input and maps it into an array
In other files there are helper functions and queue functions that can be reused.
