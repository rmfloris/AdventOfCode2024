<?php

namespace day10;

use common\Day;
use common\Helper;

class Day10 extends Day {

    private array $scores = [];
    private array $trailheads = [];
    private const TRAILHEAD = 0;
    private int $width;
    private int $height;
    private array $visitedLocations = [];

    protected function loadData(): void {
        parent::loadData();
        $this->width = strlen($this->inputData[0]);
        $this->height = count($this->inputData);
    }

    private function findTrailheads() {
        for($y=0;$y<count($this->inputData);$y++) {
            for($x=0; $x<strlen($this->inputData[0]); $x++) {
                if(intval($this->inputData[$y][$x]) == SELF::TRAILHEAD) $this->trailheads[] = Helper::getKey($x, $y);
            }
        }
    }

    private function findPaths() {
        foreach($this->trailheads as $id => $startPosition) {
            $positions[] = Helper::getCoordsFromKey($startPosition);
            $this->visitedLocations = [];

            while(!empty($positions)) {
                $currentPosition = array_shift($positions);
                $x = $currentPosition[0];
                $y = $currentPosition[1];

                if(isset($this->visitedLocations[Helper::getKey($x, $y)])) continue;
                $this->visitedLocations[Helper::getKey($x, $y)] = true;

                if($this->inputData[$y][$x] == 9) {
                    // echo "adding score\n\n";
                    $this->scores[$id] = ($this->scores[$id] ?? 0) + 1;
                    continue;
                }
                $positions = array_merge($positions, $this->checkValidNextSteps($x, $y));
            }
        }
    }

    private function findUniquePaths() {
        foreach($this->trailheads as $id => $startPosition) {
            $positions[] = Helper::getCoordsFromKey($startPosition);
            $this->visitedLocations = [];

            while(!empty($positions)) {
                $currentPosition = array_shift($positions);
                $x = $currentPosition[0];
                $y = $currentPosition[1];

                // if(isset($this->visitedLocations[Helper::getKey($x, $y)])) continue;
                // $this->visitedLocations[Helper::getKey($x, $y)] = true;

                if($this->inputData[$y][$x] == 9) {
                    // echo "adding score\n\n";
                    $this->scores[$id] = ($this->scores[$id] ?? 0) + 1;
                    continue;
                }
                $positions = array_merge($positions, $this->checkValidNextSteps($x, $y));
            }
        }
    }

    private function checkValidNextSteps($x, $y) {
        $directions = [
            [-1, 0],
            [1, 0],
            [0, -1],
            [0, 1]
        ];
        $positions = [];
        // echo "current location: " . $x . " " . $y ."\n";
        foreach($directions as [$dx, $dy]) {
            $newX = $x + $dx;
            $newY = $y + $dy;
            
            if(
                $newX >= 0 && $newX < $this->width && 
                $newY >= 0 && $newY < $this->height && 
                $this->inputData[$newY][$newX] == $this->inputData[$y][$x]+1 && 
                !isset($this->visitedLocations[Helper::getKey($newX, $newY)])
            ) {
                // echo "new valid location: " . $newX . " " . $newY ."\n";
                $positions[] = [$newX, $newY];
            }
        }
        return $positions;
    }

    public function part1(): int {
        $this->findTrailheads();
        $this->findPaths();
        // print_r($this->trailheads);
        // print_r($this->scores);
        return array_sum($this->scores);
    }

    public function part2(): int {
        $this->findTrailheads();
        $this->findUniquePaths();
        return array_sum($this->scores);
    }
    
}
