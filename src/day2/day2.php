<?php

namespace day2;

use common\Day;

class Day2 extends Day {

    private int $count = 0;

    private function findSafeReports(?bool $dampener = false): void {
        foreach($this->inputData as $reportsList) {
            $reports = explode(" ", $reportsList);
            
            $valid =  $this->isValidSlope($reports);
            if($valid) {
                $this->count++; 
                continue;
            }

            if(!$dampener) continue;
            for ( $i = 0; $i < count( $reports ); $i ++ ) {
				$reportsCopy = $reports;
				unset( $reportsCopy[ $i ] ); // Remove one
				if ( $this->isValidSlope(array_values( $reportsCopy ) ) ) {
				    $this->count++;
					break;
				}
			}
            
        }
    }

    private function calculateDifferences($reports) {
        $differences = array();
        for($i=0;$i<count($reports)-1;$i++) {
            $differences[] = $reports[$i] - $reports[$i+1];
        }

        return $differences;
    }

    private function removeZeroDifference($reports) {
        $differences = $this->calculateDifferences($reports);
        $key = array_find_key($differences, fn($value) => $value === 0);
        unset($reports[$key]);
        return array_values($reports);
    }

    private function removeMaxDelta($reports) {
        // echo "removing max delta";
        $differences = $this->calculateDifferences($reports);
        $min = min($differences);
        $max = max($differences);

        $search = $max;
        if(ABS($min) > 3) $search = $min;
        
        // echo "Min: ". $min ." Max: ".$max ." ";
        // echo "Search: ". $search ."\n";

        $key = array_find_key($differences, fn($value) => $value === $search);
        unset($reports[$key+1]);
        return array_values($reports);
    }

    private function isSameDirection($min, $max) {
        return ($min < 0 && $max < 0) || ($min > 0 && $max > 0);
    }

    private function removeIncorrectSign($reports) {
        // print_r($reports);
        $differences = $this->calculateDifferences($reports);
        $negatives  = array_filter($differences, fn($num) => $num < 0);
        $positives = array_filter($differences, fn($num) => $num > 0);

        $negCount = count($negatives);
        $posCount = count($positives);

        if($negCount < $posCount) {
            $key = array_key_first($negatives);    
        } else {
            $key = array_key_first($positives);
        }
        unset($reports[$key+1]);
        // print_r($reports);
        return array_values($reports);

    }

    private function isValidSlope($reports, $dampener = false) {
        // echo "--reports: ";
        // print_r($reports);
        // echo "--\n";
        $differences = $this->calculateDifferences($reports);
        // echo "--differences: ";
        // print_r($differences);
        // echo "--\n";

        $min = min($differences);
        $max = max($differences);

        // echo $min ."-". $max ."-". $this->isSameDirection($min, $max) ."\n";

        if($min == 0 || $max == 0) return false;
        // {
            // echo "min/max is false\n";
            // return $dampener ? $this->isValidSlope($this->removeZeroDifference($reports), false) : false;
        // }
        if(ABS($min) > 3 || ABS($max) > 3) return false;
        // {
            // echo "removing max delta";
            // return $dampener ? $this->isValidSlope($this->removeMaxDelta($reports), false) : false;
        // }
        
        if(!$this->isSameDirection($min, $max)) return false;
        // {
            // echo "Sign issue\n";
            // return $dampener ? $this->isValidSlope($this->removeIncorrectSign($reports), false) : false;
        // }
        if(ABS($min) > 3 && ABS($max) > 3) return false;
        // {
            // echo "Alles is te groot";
            // return false;
        // }

        return true;
    }

    public function part1(): int {
        $this->findSafeReports();
        return $this->count;
    }

    public function part2(): int {
        $this->findSafeReports(true);
        return $this->count;
    }
    
}
