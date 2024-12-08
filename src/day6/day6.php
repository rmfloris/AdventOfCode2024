<?php

namespace day6;

use common\Day;
use common\Helper;

class Day6 extends Day {
    private array $map = [];
    private $guardLocation = ["x" => 0, "y" => 0];
    private int $width = 0;
    private int $height = 0;
    private array $direction = ["dX" => 0, "dY" => -1];
    private array $visitedLocations = [];
    private const BLOCKER = '#';


    protected function loadData(): void {
        parent::loadData();

        $this->width = strlen($this->inputData[0]);
        $this->height = count($this->inputData);

        for($y=0; $y<$this->height;$y++) {
            for($x=0; $x<$this->width; $x++) {
                $this->map[$x][$y] = $this->inputData[$y][$x];
                if($this->inputData[$y][$x] == "^") {
                    $this->guardLocation = ["x" => $x, "y" => $y];
                    $this->addVisitedLocation($x, $y);
                }
            }
        }
    }

    private function addVisitedLocation($x, $y) {
        $this->visitedLocations[Helper::getKey($x, $y)] = 1;
    }

    private function guardPatrol() {
        // $i=0;
        while($this->guardIsOnMapWithNextMove()) {
            $this->moveGuard();
            // if($i>100) break;
            // $i++;

        }
    }

    private function moveGuard() {
        [$dX, $dY] = $this->getCurrentDirection();

        $nextX = $this->guardLocation["x"]+$dX;
        $nextY = $this->guardLocation["y"]+$dY;

        if($this->map[$nextX][$nextY] != SELF::BLOCKER) {
            $this->guardLocation = ["x" => $nextX, "y" => $nextY];
            $this->addVisitedLocation($nextX, $nextY);
            return;
        } 
        if($this->map[$nextX][$nextY] == SELF::BLOCKER) {
            $this->rotateDirectionClockwise();
            return;
        } 
    }

    function rotateDirectionClockwise() {
        [$dX, $dY] = $this->getCurrentDirection();
        $this->direction = [ "dX" => -$dY, "dY" => $dX];
    }

    function getCurrentDirection() {
        ["dX" => $dX, "dY" => $dY] = $this->direction;
        return [$dX, $dY];
    }


    private function guardIsOnMapWithNextMove(): bool {
        [$dX, $dY] = $this->getCurrentDirection();

        $nextX = $this->guardLocation["x"]+$dX;
        $nextY = $this->guardLocation["y"]+$dY;
        return isset($this->map[$nextX][$nextY]);
    }

    public function part1(): int {
        $this->guardPatrol();
        // echo count($this->visitedLocations);
        // print_r($this->visitedLocations);
        return count($this->visitedLocations);
    }

    public function part2(): int {
        return 1;
    }
    
}
