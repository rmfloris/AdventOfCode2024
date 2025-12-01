<?php

namespace day5;

use common\Day;

class Day5 extends Day {
    private $validUpdates = [];
    private $rules = [];
    private $updates = [];

    protected function loadData(): void {
        parent::loadData();
       
        $break = array_search("", $this->inputData, true);

        for($ruleId=0; $ruleId<$break; $ruleId++) {
            [$ruleX, $ruleY] = explode("|", $this->inputData[$ruleId]);
            $this->rules[trim($ruleX)][] = trim($ruleY);
        }

        for($updateId=$break+1; $updateId<count($this->inputData); $updateId++) {
            $this->updates[] = explode(",", $this->inputData[$updateId]);
        }
        
        // print_r($this->rules);
        // print_r($this->updates);
    }

    private function findCode() {
        forEach($this->updates as $key => $update) {
            $validUpdate = true;

            forEach($update as $pageId => $page) {
                if($pageId === 0) continue;

                if(!array_key_exists($page, $this->rules)) continue;
                
                $ruleList = $this->rules[$page];
                forEach($ruleList as $rule) {
                    if(array_search($rule, array_slice($update,0, $pageId)) !== false) {
                        $validUpdate = false;
                        break;
                    } 
                }                 
            }
            if($validUpdate) $this->validUpdates[] = $update;
        }
    }

    private function calculateMiddlePage() {
        $sum = 0;
        forEach($this->validUpdates as $valid) {
            $middle = round(count($valid) / 2, 0,PHP_ROUND_HALF_DOWN);
            $sum += $valid[$middle];

            print_r($valid);
            echo "middle: ". $middle ."\n";
        }
        return $sum;
    }

    public function part1(): int {
        $this->findCode();
        print_r($this->validUpdates);
        $result = $this->calculateMiddlePage();
        
        // return 1;
        return $result;
    }

    public function part2(): int {
        return 1;
    }
    
}
