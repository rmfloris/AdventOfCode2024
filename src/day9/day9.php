<?php

namespace day9;

use common\Day;

class Day9 extends Day {

    private bool $isFile = true;
    private int $id = 0;
    private array $disk = [];
    private int $checkSum = 0;


    private function mapToArray() {
        for($i=0; $i<strlen($this->inputData[0]); $i++) {
            $value = (int) $this->inputData[0][$i];

            for($n=0; $n<$value; $n++) {
                $this->disk[] = $this->isFile ? $this->id : '.';
            }

            if($this->isFile) $this->id++;
            $this->flipIsFile();
            
        }
    }

    private function sorting() {
        $fileBlock = [];
        $emptyBlock = [];

        foreach($this->disk as $key => $value) {
            if($value == '.') {
                $emptyBlock[] = $key;
            } else {
                $fileBlock[] = $key;
            }
        }

        while (!empty($fileBlock) && !empty($emptyBlock)) {
            $filePosition = array_pop($fileBlock);
            $emptyPosition = array_shift($emptyBlock);

            if($filePosition > $emptyPosition) {
                $this->disk[$emptyPosition] = $this->disk[$filePosition];
                $this->disk[$filePosition] = '.';

                $emptyBlock[] = $filePosition;
            } else {
                break;
            }
        }
    }

    private function sortingFiles() {
        // toDO;
    }

    private function flipIsFile() {
        $this->isFile =!$this->isFile;
    }

    private function calculateCheckSum() {
        for($i=0;$i<count($this->disk);$i++) {
            if($this->disk[$i] == '.') continue;
            $this->checkSum += $this->disk[$i] * $i;
        }
    }


    public function part1(): int {
        $this->mapToArray();
        $this->sorting();

        $this->calculateCheckSum();
        return $this->checkSum;
    }

    public function part2(): int {
        $this->mapToArray();
        $this->sortingFiles();
        return $this->checkSum;
    }
}
