<?php
include 'autoload.php';

use common\CreateMap;

$map = new CreateMap;
$map->createMapWithValue(2,3,".");
$map->setPointValue(1,2, "x");
echo $map->getPointValue(1,2);
$map->printMap();