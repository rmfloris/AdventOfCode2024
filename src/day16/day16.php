<?php

namespace day16;

use common\CreateMap;
use common\Day;
use common\Position;
use SplPriorityQueue;

enum CellType: string {
    case WALL = '#';
    case START = 'S';
    case END = 'E';
}


class Day16 extends Day {
    private CreateMap $map;
    private Position $startPosition;
    private array $visited = [];
    private array $directions = [
        [0, 1],
        [1, 0],
        [0, -1],
        [-1, 0],
    ];
    private const MOVE_COST = 1;
    private const TURN_COST = 1000;

    protected function loadData(): void {
        parent::loadData();
        $this->map = new CreateMap();

        $this->map->createMapWithValue(count($this->inputData), strlen($this->inputData[0]), ".");

        foreach ($this->inputData as $row => $rowValues) {
            for($column=0;$column<strlen($rowValues);$column++) {
                if($rowValues[$column] == CellType::START->value) $this->startPosition = new Position($column, $row);

                $this->map->setPointValue($row, $column, $rowValues[$column]);
            }
        }
    } 

    private function startMoving() {
        $moves = new SplPriorityQueue();
        // row, col, path
        // State: [row, col, direction, score, path]
        // Starting facing east (direction 0)
        $path = $this->startPosition->getPosition();
        $moves->insert([$path[0], $path[1], 0, 0, [$path]], 0);

        $i = 0;
        while(!$moves->isEmpty()) {
            [$row, $column, $direction, $score, $path] = $moves->extract();
            
            $stateKey = "$row,$column,$direction";
            if(isset($this->visited[$stateKey])) {
                continue;
            }
            $this->visited[$stateKey] = true;

            if ($this->map->getPointValue($row, $column) == CellType::END->value) {
                return ['score' => $score, 'path' => $path];
            }

            // check valid moves
            for ($newDirection = 0; $newDirection < 4; $newDirection++) {
                [$dX, $dY] = $this->directions[$newDirection];
                $newRow = $row + $dY;
                $newColumn = $column + $dX;
                
                if($this->isValidMove($newRow, $newColumn)) {
                    $turnCost = $this->calculateTurnCost($direction, $newDirection);
                    $newScore = $score + self::MOVE_COST + $turnCost;

                    $newPath = $path;
                    $newPath[] = [$newRow, $newColumn];
                    
                    $moves->insert([$newRow, $newColumn, $newDirection, $newScore, $newPath], -$newScore);
                    // echo "adding: ". $newRow ." - ". $newColumn ."\n";
                }
            }
            
            // $i++;
            // if($i == 5000) {
            //     exit;
            // }
        }
    }

    private function isValidMove($row, $column): bool {
        return $this->map->getPointValue($row, $column)!= CellType::WALL->value;
    }

    private function calculateTurnCost($currentDirection, $newDirection): int {
        if($currentDirection == $newDirection) return 0;
        return SELF::TURN_COST;
    }

    public function part1(): int {
        $result = $this->startMoving();
       
        return $result["score"];
    }

    public function part2(): int {
        $result = $this->startMoving();
        return count($result["path"]);
    }
    
}
