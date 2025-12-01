<?php

namespace day5;

use common\Day;

class Day5 extends Day {
    private $validUpdates = [];
    private $invalidUpdates = [];
    private $rules = [];
    private $rulesOrginal = [];
    private $updates = [];

    protected function loadData(): void {
        parent::loadData();
       
        $break = array_search("", $this->inputData, true);

        $this->rulesOrginal = array_flip(array_slice($this->inputData,0, $break));

        for($ruleId=0; $ruleId<$break; $ruleId++) {
            [$ruleX, $ruleY] = explode("|", $this->inputData[$ruleId]);
            $this->rules[trim($ruleX)][] = trim($ruleY);
        }

        for($updateId=$break+1; $updateId<count($this->inputData); $updateId++) {
            $this->updates[] = explode(",", $this->inputData[$updateId]);
        }
    }

    private function checkUpdates() {
        foreach($this->updates as $key => $update) {
            $validUpdate = true;

            foreach($update as $pageId => $page) {
                if($pageId === 0) continue;

                if(!array_key_exists($page, $this->rules)) continue;
                
                $ruleList = $this->rules[$page];
                foreach($ruleList as $rule) {
                    if(array_search($rule, array_slice($update, 0, $pageId)) !== false) {
                        $validUpdate = false;
                        $this->invalidUpdates[$key] = $update;
                        break;
                    } 
                }                 
            }
            if($validUpdate) $this->validUpdates[] = $update;
        }
    }

    private function calculateMiddlePage($inputs) {
        $sum = 0;
        foreach($inputs as $input) {
            $middle = round(count($input) / 2, 0,PHP_ROUND_HALF_DOWN);
            $sum += $input[$middle];
        }
        return $sum;
    }

    private function makeInvalidValid() {
        foreach($this->invalidUpdates as $key => $invalid) {
            usort($invalid, function($a, $b) {
                if(isset($this->rulesOrginal["$a|$b"])) {
                    return -1;
                }
                if(isset($this->rulesOrginal["$b|$a"])) {
                    return 1;
                }
    
                return 0;
            });

            $this->invalidUpdates[$key] = $invalid;
        }
    }

    public function part1(): int {
        $this->checkUpdates();
        $result = $this->calculateMiddlePage($this->validUpdates);
        
        return $result;
    }

    public function part2(): int {
        $this->checkUpdates();
        $this->makeInvalidValid();

        $result = $this->calculateMiddlePage($this->invalidUpdates);
        
        return $result;
    }
    
}
