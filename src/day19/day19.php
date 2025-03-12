<?php

namespace day19;

use common\Day;

class Day19 extends Day {

    private string $towels;
    private array $designs;
    // private array $designs = [
    //     "brwrr",
    // "bggr",
    // "gbbr",
    // "rrbgbr",
    // "ubwu",
    // "bwurrg",
    // "brgr",
    // "bbrgwb"
    //     ];

    protected function loadData(): void {
        parent::loadData();


        $lines = explode("\n", $this->getInputFile());
        $this->towels = $lines[0];
        $this->designs = array_slice($lines, 2);

        
    }

    private function findPossibleDesigns() {
        // foreach($this->designs as $design) {
        //     echo "Design: ". $design ." - ". preg_match("/^(".str_replace(", ", "|", $this->towels).")+$/", $design) ."\n";

        // }
        return preg_grep("/^(".str_replace(", ", "|", $this->towels).")+$/", $this->designs);
    }

    public function part1(): int {
        // print_r($this->designs);
        print_r($this->findPossibleDesigns());
        return count($this->findPossibleDesigns());
    }

    public function part2(): int {
        return 1;
    }
    
}
