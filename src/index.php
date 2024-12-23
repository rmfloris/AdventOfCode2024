<?php

use day16\Day16;

include 'autoload.php';


$day = new Day16(true);
echo "Game Total: #". $day->part1();

echo "\n";
echo "memory: ". $day->getMemoryUsage() ."\n";
echo "time: ". $day->getElapsedTime();