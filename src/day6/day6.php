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
    private array $extraObstructions = [];


    protected function loadData(): void {
        parent::loadData();

        $this->width = strlen($this->inputData[0]);
        $this->height = count($this->inputData);

        for($y=0; $y<$this->height;$y++) {
            for($x=0; $x<$this->width; $x++) {
                $this->map[$x][$y] = $this->inputData[$y][$x];
                if($this->inputData[$y][$x] == "^") {
                    $this->guardLocation = ["x" => $x, "y" => $y];
                    $this->addVisitedLocation($x, $y, $this->direction);
                }
            }
        }
    }

    private function addVisitedLocation(int $x, int $y) {
        $this->visitedLocations[Helper::getKey($x, $y)] = $this->direction;
    }

    private function getVisitedLocation(int $x, int $y) {
        return isset($this->visitedLocations[Helper::getKey($x, $y)]) ? $this->visitedLocations[Helper::getKey($x, $y)] : null;
    }

    private function guardPatrol() {
        while($this->guardIsOnMapWithNextMove()) {
            $this->moveGuard();
        }
    }

    private function moveGuard() {
        [$dX, $dY] = $this->getCurrentDirection();

        $nextX = $this->guardLocation["x"]+$dX;
        $nextY = $this->guardLocation["y"]+$dY;

        $this->willNewBlockerCreateLoop($this->guardLocation["x"], $this->guardLocation["y"]);

        if($this->map[$nextX][$nextY] != SELF::BLOCKER) {
            $this->guardLocation = ["x" => $nextX, "y" => $nextY];
            $this->addVisitedLocation($nextX, $nextY);
            return;
        } 
        if($this->map[$nextX][$nextY] == SELF::BLOCKER) {
            $this->direction = $this->rotateDirectionClockwise();
            return;
        } 
    }

    private function willNewBlockerCreateLoop(int $x, int $y) {
        echo "check loop creation: ". $x ." - ". $y .", dir: \n";
        if($direction = $this->getVisitedLocation($x, $y)) {
            echo "Prev Direction: ";
            print_r($direction);
            echo "\n";
            if($this->rotateDirectionClockwise() == $direction) {
                echo "Add blocker\n";
                print_r($this->rotateDirectionClockwise());

                $this->extraObstructions[Helper::getKey($x, $y)] = 1;
            }
        }
    }

    function rotateDirectionClockwise() {
        [$dX, $dY] = $this->getCurrentDirection();
        return [ "dX" => -$dY, "dY" => $dX];
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
        $this->guardPatrol();
        return count($this->extraObstructions);
    }
    
}
