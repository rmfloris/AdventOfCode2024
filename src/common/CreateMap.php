<?php

namespace common;

use InvalidArgumentException;

use function PHPUnit\Framework\throwException;

class CreateMap {

    private array $map = [];

    public function createMapWithValue(int $rows, int $columns, int|string $value): void {
        $this->map = array_fill(0, $rows, array_fill(0, $columns, $value));
        print_r($this->map);
    }

    public function setPointValue(int $x, int $y, $value) {
        if($this->isInvalidCoordinate($x, $y)) throw new InvalidArgumentException("Invalid map coordinates");
        
        $this->map[$x][$y] = $value;
    }

    public function getPointValue(int $x, int $y) {
        if($this->isInvalidCoordinate($x, $y)) throw new InvalidArgumentException("Invalid map coordinates");

        return $this->map[$x][$y];
    }

    private function isInvalidCoordinate(int $x, int $y): bool {
        if(!isset($this->map[$x])) echo "row not found";
        if(!isset($this->map[$x][$y])) echo "cell not found";
        return !isset($this->map[$x]) && !isset($this->map[$x][$y]);
    }

    public function getRow($x) {
        if (!isset($map[$x])) {
            throw new InvalidArgumentException("Row index out of bounds");
        }
        return $this->map[$x];
    }

    public function getColumn($y) {
        $column = [];
        foreach ($this->map as $row) {
            if (!isset($row[$y])) {
                throw new InvalidArgumentException("Column index out of bounds");
            }
            $column[] = $row[$y];
        }
        return $column;
    }

    public function printMap() {
        foreach ($this->map as $row) {
            echo implode("\t", array_map(function($value) {
                return $value === null ? '.' : $value;
            }, $row)) . "\n";
        }
    }
}