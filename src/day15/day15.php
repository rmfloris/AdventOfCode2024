<?php
namespace day15;

use common\CreateMap;
use common\Day;
use common\Helper;
use common\Queue;

class Day15 extends Day {
    private CreateMap $map;
    private Queue $moves;
    private int $height;
    private string $currentLocationRobot = "";
    private array $directions = [
        "^" => [0, -1],
        "v" => [0, 1],
        ">" => [1, 0],
        "<" => [-1, 0],
    ];
    private const WALL = "#";
    private const BOX = "O";
    private const ROBOT = "@";
    private const EMPTY = ".";

    protected function loadData(): void {
        $this->map = new CreateMap();
        $this->moves = new Queue();

        $parts = preg_split('/\n\s*\n/', $this->getInputFile());
        preg_match_all('/[<>v^]/', $parts[1], $matches);
        foreach($matches[0] as $move) {
            $this->moves->insert([$move]);
        }        

        $mapLines = explode("\n", $parts[0]);
        $this->height = count($mapLines);
        $this->map->createMap(count($mapLines), strlen(trim($mapLines[0])));
        foreach ($mapLines as $y => $line) {
            $values = preg_split('//', trim($line), -1, PREG_SPLIT_NO_EMPTY);
            $this->map->addRowWithValue($y, $values);
            for($i=0; $i<count($values); $i++) {
                if($values[$i] == SELF::ROBOT) $this->currentLocationRobot = Helper::getKey($i, $y);
            }
        }      
    }

    private function moveRobot() {
        while($this->moves->isNotEmpty()) {
            [$move] = $this->moves->shift();
            $this->moveRobotAndBoxes($move);
        }
    }

    private function moveRobotAndBoxes(string $direction): void {
        [$x, $y] = Helper::getCoordsFromKey($this->currentLocationRobot);
        [$dX, $dY] = $this->directions[$direction];
        $newX = $x + $dX;
        $newY = $y + $dY;

        if($this->map->isInvalidCoordinate($newY, $newX)) return;

        $nextBlock = $this->map->getPointValue($newY, $newX);
        if($nextBlock == SELF::WALL) return;
        if($nextBlock == SELF::EMPTY) {
            $this->markEmpty($x, $y);
            $this->setCurrentLocationOfRobot($newX, $newY);
            return;
        }
        
        if($direction == "<") $data = array_reverse(array_slice($this->map->getRow($newY), 0, $x));
        if($direction == ">") $data = array_slice($this->map->getRow($newY), $x+1);
        if($direction == "^") $data = array_reverse(array_slice($this->map->getColumn($newX), 0, $y));
        if($direction == "v") $data = array_slice($this->map->getColumn($newX), $y+1);
        
        $firstEmpty = array_search(SELF::EMPTY, $data);
        $firstWall = array_search(SELF::WALL, $data);
        
        if(!$firstEmpty) return;
        if($firstEmpty > $firstWall) return;
 
        /**
         * only the first and the empty needs updating. The middle part stays the same
         * #..OO@..#
         * #.OO@...#
         */
        $this->markEmpty($x, $y);
        $this->setCurrentLocationOfRobot($newX, $newY);
        if($direction == "<" || $direction == ">") {
            $pushX = $x + ($firstEmpty + 1) * $dX;
            $pushY = $y;    
        }
        if($direction == "^" || $direction == "v") {
            $pushX = $x;
            $pushY = $y + ($firstEmpty + 1) * $dY;    
        }
        $this->markBox($pushX, $pushY);
    }

    private function setCurrentLocationOfRobot(int $x, int $y) {
        $this->currentLocationRobot = Helper::getKey($x, $y);
        $this->markRobot($x, $y);
    }

    private function markEmpty(int $x, int $y) {
        $this->map->setPointValue($y, $x, SELF::EMPTY);
    }

    private function markBox(int $x, int $y) {
        $this->map->setPointValue($y, $x, SELF::BOX);
    }

    private function markRobot(int $x, int $y) {
        $this->map->setPointValue($y, $x, SELF::ROBOT);
    }
    
    private function sumOfAllBoxes() {
        $sum = 0;
        for($row=0; $row<$this->height; $row++) {
            for($column=0; $column<count($this->map->getRow($row)); $column++) {
                if($this->map->getPointValue($row, $column) == SELF::BOX) {
                    $sum += $row * 100 + $column;
                }
            }  
        }
        return $sum;
    }

    public function part1(): int {
        $this->moveRobot();
        return $this->sumOfAllBoxes();
    }

    public function part2(): int {
        return 1;
    }
    
}
