<?php

namespace day3;

use common\Day;

class Day3 extends Day {

    private array $instructions = array();
    private int $score = 0;
    private bool $processing = true;

    protected function loadData(): void {
        $inputData = $this->getInputFile();
        $pattern = '/(mul\(\d{1,3},\d{1,3}\))|(do\(\))|(don\'t\(\))/';
        preg_match_all($pattern, $inputData, $matches);
        $this->instructions = $matches[0];
    }

    private function calculate(?bool $conditionalStatement = false) {
        for($i=0;$i<count($this->instructions);$i++) {
            if($this->instructions[$i] == "do()") {
                $this->processing = true; 
                continue;
            }
            if($this->instructions[$i] == "don't()") {
                $this->processing = false; 
                continue;
            }

            if($this->processing === false && $conditionalStatement) continue;

            $pattern = '/\((?<first>\d{1,3}),(?<second>\d{1,3})\)/';
            preg_match_all($pattern, $this->instructions[$i], $matches);
            $this->score += $matches['first'][0] * $matches['second'][0];
        }
    }

    public function part1(): int {
        $this->calculate();
        return $this->score;
    }

    public function part2(): int {
        $this->calculate(true);
        return $this->score;
    }
    
}
