<?php

namespace day1;

use common\Day;

class Day1 extends Day {

    /** @var array<int> */
    private array $list1 = array();
    /** @var array<int> */
    private array $list2 = array();
    private int $score = 0;
    
    protected function loadData(): void
    {
        parent::loadData();
        foreach($this->inputData as $y => $row) {
            [$list1Id, $list2Id] = explode("   ", $row);
            $this->list1[] = $list1Id;
            $this->list2[] = $list2Id;
        }
    }

    protected function calculateScore(): void {
        sort($this->list1);
        sort($this->list2);

        for($i=0;$i<count($this->list1);$i++) {
            $this->score += abs(intval($this->list1[$i]) - intval($this->list2[$i]));
        }
    }

    protected function countMatches(): void {
        $list2Count = array_count_values($this->list2);
        foreach($this->list1 as $value) {
            if(isset($list2Count[$value]) && $list2Count[$value] > 0) {
                $this->score += $value * $list2Count[$value];
            }
        }
    }

    public function part1(): int {
        $this->calculateScore();
        return $this->score;
    }

    public function part2(): int {
        $this->countMatches();
        return $this->score;
    }
    
}
