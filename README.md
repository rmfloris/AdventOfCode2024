# Advent of Code 2024

# How to....
- build the container by running `docker-compose build --no-cache`
- login into the container `docker exec -it AdventOfCode bash`
- once in the container `phpunit` and `phpstan` are available to run tests

For daily creation of the files and setup:
- ./createDay.sh #dayNumber
This will create the base class, test file and retrieves the input files from the source.

# Common functions
In the Day class the following functions are available:
- loadData() --> retrieves the input and maps it into an array
In other files there are helper functions and queue functions that can be reused.
