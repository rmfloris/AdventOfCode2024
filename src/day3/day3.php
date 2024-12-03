<?php

namespace day3;

use common\Day;

class Day3 extends Day {

    private array $instructions = array();
    private int $score = 0;

    protected function loadData(): void {
        $inputData = $this->getInputFile();
        $pattern = '/(mul\(\d{1,3},\d{1,3}\))/';
        preg_match_all($pattern, $inputData, $matches);
        $this->instructions = $matches[1];
    }

    private function calculate() {
        // echo "Calculating";
        for($i=0;$i<count($this->instructions);$i++) {
            $pattern = '/\((?<first>\d{1,3}),(?<second>\d{1,3})\)/';
            // echo "instructions: ". $this->instructions[$i]."\n";
            preg_match_all($pattern, $this->instructions[$i], $matches);
            // print_r($matches);
            $this->score += $matches['first'][0] * $matches['second'][0];
        }
    }

    public function part1(): int {
        // print_r($this->instructions);
        $this->calculate();
        return $this->score;
    }

    public function part2(): int {
        return 1;
    }
    
}
