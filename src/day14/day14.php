<?php

namespace day14;

use common\Day;
use common\Helper;

class Day14 extends Day {

    private array $robots = [];
    private int $width = 0;
    private int $height = 0;
    private array $map = [];

    protected function loadData(): void {
        parent::loadData();

        foreach($this->inputData as $robotData) {
            preg_match_all('/[-\d]+/', $robotData, $matches);
            $this->robots[] = [
                'positionX' => $matches[0][0],
                'positionY' => $matches[0][1],
                'vectorX' => $matches[0][2],
                'vectorY' => $matches[0][3]
            ];
        }
    }

    private function mathematicalMod($a, $b) {
        return ($a % $b + $b) % $b;
    }

    private function moveRobots(int $seconds): void {
        foreach($this->robots as $robot) {
            // echo "x: ". $robot['positionX'] ."\n";
            // echo "vX: ". $robot['vectorX'] ."\n";
            // echo "y: ". $robot['positionY'] ."\n";
            // echo "vY: ". $robot['vectorY'] ."\n";
            
            $finalX = $this->mathematicalMod($robot['positionX'] + $seconds * $robot['vectorX'], $this->width);
            $finalY = $this->mathematicalMod($robot['positionY'] + $seconds * $robot['vectorY'], $this->height);
            
            // echo "width: ". $this->width ."\n";
            // echo "height: ". $this->height ."\n";
            // echo "valueX: ". ($robot['positionX'] + $seconds * $robot['vectorX']) ."\n";
            // echo "valueY: ". ($robot['positionY'] + $seconds * $robot['vectorY']) ."\n";
            // echo "final: ". $finalX ." - ". $finalY ."\n";

            $key = Helper::getKey($finalX, $finalY);
            if(isset($this->map[$key])) {
                $this->map[$key]++;
            } else {
                $this->map[$key] = 1;
            }
        }
    }

    private function calculateSafetyFactor(): int {

        // print_r($this->map);

        $splitWidth = floor($this->width / 2);
        $splitHeigth = floor($this->height / 2);

        $topLeft = 0;
        $topRight = 0;
        $bottomLeft = 0;
        $bottomRight = 0;


        foreach($this->map as $key => $value) {
            [$x, $y] = Helper::getCoordsFromKey($key);
            if($x < $splitWidth && $y < $splitHeigth) $topLeft += $value;
            if($x > $splitWidth && $y < $splitHeigth) $topRight += $value;
            if($x < $splitWidth && $y > $splitHeigth) $bottomLeft += $value;
            if($x > $splitWidth && $y > $splitHeigth) $bottomRight += $value;
        }

        return $topLeft * $topRight * $bottomLeft * $bottomRight;

    }

    public function setDimensions(int $width, int $height): void {
        $this->width = $width;
        $this->height = $height;
    }

    public function part1(): int {
        $this->moveRobots(100);
        return $this->calculateSafetyFactor();
    }

    public function part2(): int {
        return 1;
    }
    
}
