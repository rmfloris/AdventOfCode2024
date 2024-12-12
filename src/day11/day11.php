<?php

namespace day11;

use common\Day;

class Day11 extends Day {
    private array $stones = [];
    private array $cache = [];

    private int $score = 0;

    protected function loadData(): void {
        parent::loadData();
        // print_r($this->inputData);
        $this->stones = explode(" ", $this->inputData[0]);
    }

    private function countStones($blinks) {
        foreach($this->stones as $stone) {
            $this->score += $this->blink($stone, $blinks);
        }
    }

    private function blink($stone, $blinks) {
        if($blinks == 0) return 1;
        
        $cacheKey = $stone . '-' . $blinks;
		if ( isset( $this->cache[ $cacheKey ] ) ) return $this->cache[ $cacheKey ];

        if($stone == 0) {
            $result = $this->blink(1, $blinks -1);
        } elseif(strlen($stone) % 2 == 0) {
            $mid = strlen($stone) / 2;
            $result = $this->blink((int) substr($stone, 0, $mid), $blinks-1) + $this->blink((int) substr($stone, $mid), $blinks-1);
        } else {
            $result = $this->blink($stone * 2024, $blinks -1);
        }

        return $this->cache[ $cacheKey ] = $result;
    }

    public function part1(): int {
        $this->countStones(25);
        return $this->score;
    }

    public function part2(): int {
        $this->countStones(75);
        // echo "Score (6x): ". $this->score;
        return $this->score;
    }
    
}
