<?php

use day19\Day19;

include 'autoload.php';


$day = new Day19();
// $day = new Day19(true);
echo "Game Total: # ". $day->part1();

echo "\n";
echo "memory: ". $day->getMemoryUsage() ."\n";
echo "time: ". $day->getElapsedTime();