<?php

namespace day4;

use common\Day;
use common\Helper;
use common\Queue;


class Day4 extends Day {

    private $map = [];
    private int $width = 0;
    private int $height = 0;
    private Queue $queue;
    private string $startLetter = "X";
    private string $startLetterPart2 = "M";
    private int $foundStrings = 0;

    protected function loadData(): void {
        parent::loadData();
        $this->width = strlen($this->inputData[0]);
        $this->height = count($this->inputData);
        $this->queue = new Queue();

        for ($y = 0; $y < $this->height; $y++) {    
            for ($x = 0; $x < $this->width; $x++) {
                $this->map[$x][$y] = $this->inputData[$y][$x];
                $this->queue->insert([Helper::getKey($x, $y), $this->inputData[$y][$x]]);
            }
        }
    }

    private function findXmas() {
        while ($this->queue->isNotEmpty()) {
            [$key, $value] = $this->queue->shift();

            if($value !== $this->startLetter) continue;

            [$x, $y] = Helper::getCoordsFromKey($key);

            $searchString = "XMAS";
            $this->foundStrings += $this->searchInDirection($x, $y, 1, 0, $searchString);  // Horizontal
            $this->foundStrings += $this->searchInDirection($x, $y, 0, 1, $searchString);  // Vertical
            $this->foundStrings += $this->searchInDirection($x, $y, 1, 1, $searchString);  // Diagonal down-right
            $this->foundStrings += $this->searchInDirection($x, $y, 1, -1, $searchString); // Diagonal up-right
        }
    }

    private function searchInDirection($x, $y, $dx, $dy, $searchString): int {
        $count = 0;
        $directions = [
            [-$dx, -$dy],
            [$dx, $dy]
        ];

        foreach ($directions as [$offsetX, $offsetY]) {
            $valid = true;
            for ($i = 1; $i < strlen($searchString); $i++) {
                $checkX = $x + $i * $offsetX;
                $checkY = $y + $i * $offsetY;
    
                // Boundary check
                if ($checkX < 0 || $checkX >= $this->width || 
                    $checkY < 0 || $checkY >= $this->height ||
                    $this->map[$checkX][$checkY] !== $searchString[$i]) {
                    $valid = false;
                    break;
                }
            }
            if ($valid) $count++;
        }
        return $count;
    }

    private function searchInSpecificDirection($x, $y, $dx, $dy, $searchString): int {
        $count = 0;
        $directions = [
            [$dx, $dy]
        ];

        foreach ($directions as [$offsetX, $offsetY]) {
            $valid = true;
            for ($i = 1; $i < strlen($searchString); $i++) {
                $checkX = $x + $i * $offsetX;
                $checkY = $y + $i * $offsetY;
    
                // Boundary check
                if ($checkX < 0 || $checkX >= $this->width || 
                    $checkY < 0 || $checkY >= $this->height ||
                    $this->map[$checkX][$checkY] !== $searchString[$i]) {
                    $valid = false;
                    break;
                }
            }
            if ($valid) $count++;
        }
        return $count;
    }

    private function findMas() {
        while ($this->queue->isNotEmpty()) {
            $count = 0;
            [$key, $value] = $this->queue->shift();

            if($value !== $this->startLetterPart2) continue;

            [$x, $y] = Helper::getCoordsFromKey($key);

            if(isset($this->map[$x+2][$y]) && $this->map[$x+2][$y] == $this->startLetterPart2) {
                if($this->searchInSpecificDirection($x, $y, 1, 1, "MAS") == 1 && $this->searchInSpecificDirection($x+2, $y, -1, 1, "MAS") == 1) $count += 2;
                if($this->searchInSpecificDirection($x, $y, 1, -1, "MAS") == 1 && $this->searchInSpecificDirection($x+2, $y, -1, -1, "MAS") == 1) $count += 2;
            }

            if(isset($this->map[$x][$y+2]) && $this->map[$x][$y+2] == $this->startLetterPart2) {
                // check righ down
                if($this->searchInSpecificDirection($x, $y, 1, 1, "MAS") == 1 && $this->searchInSpecificDirection($x, $y+2, 1, -1, "MAS")) $count += 2;
                if($this->searchInSpecificDirection($x, $y, -1, 1, "MAS") == 1 && $this->searchInSpecificDirection($x, $y+2, -1, -1, "MAS")) $count += 2;
            }

            if($count % 2 == 0 && $count > 0) {
                $this->foundStrings += $count / 2; 
            }
        }
    }

    public function part1(): int {
        $this->findXmas();
        return $this->foundStrings;
    }

    public function part2(): int {
        $this->findMas();
        return $this->foundStrings;
    }
    
}
