<?php

use day15\Day15;

include 'autoload.php';


$day = new Day15(true);
echo "<br>Game Total: #". $day->part1();

echo "memory: ". $day->getMemoryUsage() ."<br>";
echo "time: ". $day->getElapsedTime();