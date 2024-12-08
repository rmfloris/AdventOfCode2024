<?php

namespace day7;

use common\Day;

class Day7 extends Day {
    private int $totalCalibrationResult = 0;
    private array $operatorCombinations = [];

    private function processTestOptions($operators) {
        for($i=0;$i<count($this->inputData); $i++) {
            // echo $this->inputData[$i] ."\n";
            $values = $this->parseLine($this->inputData[$i]);
            $this->generateOperatorCombinations(count($values) - 2, $operators);
            // $result = $this->evaluateOperatorCombinations($values);
            // echo "Adding result: ". $result ."\n";
            $this->totalCalibrationResult += $this->evaluateOperatorCombinations($values);
            // $this->totalCalibrationResult += $result;
        }
    }

    private function generateOperatorCombinations($length, $operators) {
        $combinations = [[]];
        
        for ($i = 0; $i < $length; $i++) {
            $newCombinations = [];
            foreach ($combinations as $combination) {
                foreach ($operators as $operator) {
                    $newCombinations[] = array_merge($combination, [$operator]);
                }
            }
            $combinations = $newCombinations;
        }
        $this->operatorCombinations = $combinations;
    }

    private function evaluateOperatorCombinations($values) {
        $total = array_shift($values);
        foreach ($this->operatorCombinations as $operators) {
            $result = $values[0];
            for($i=1;$i<count($values);$i++) {
                if($operators[$i-1] === "+") {
                    $result += $values[$i];
                }
                if($operators[$i-1] === "*") {
                    $result *= $values[$i];
                }
                if($operators[$i-1] === "||") {
                    $result = intval($result . $values[$i]);
                }
            }

            // print_r($operators);
            // echo "Results ". $result ."\n";

            if($result == $total) return $total;
            
        }

    }

    private function parseLine($line) {
        preg_match_all('/\d+/', $line, $matches);
        return $matches[0];
    }

    public function part1(): int {
        $operators = ['+', '*'];
        $this->processTestOptions($operators);
        return $this->totalCalibrationResult;
    }

    public function part2(): int {
        $operators = ['+', '*', '||'];
        $this->processTestOptions($operators);
        return $this->totalCalibrationResult;
    }
    
}
