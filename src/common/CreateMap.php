<?php

namespace common;

use InvalidArgumentException;

class CreateMap {

    private array $map = [];

    public function createMap(int $rows, int $columns): void {
        $this->map = array_fill(0, $rows, array_fill(0, $columns, null));
    }

    public function createMapWithValue(int $rows, int $columns, int|string $value): void {
        $this->map = array_fill(0, $rows, array_fill(0, $columns, $value));
    }

    public function setPointValue(int $row, int $column, $value) {
        if($this->isInvalidCoordinate($row, $column)) throw new InvalidArgumentException("Invalid map coordinates");
        
        $this->map[$row][$column] = $value;
    }

    public function addRowWithValue(int $row, array $value) {
        if(!$this->isValidRow($row)) throw new InvalidArgumentException("Invalid row");
        
        $this->map[$row] = $value;
    }

    public function getPointValue(int $row, int $column) {
        if($this->isInvalidCoordinate($row, $column)) throw new InvalidArgumentException("Invalid map coordinates");
        return $this->map[$row][$column];
    }

    public function isInvalidCoordinate(int $row, int $column): bool {
        return !$this->isValidRow($row) || !isset($this->map[$row][$column]);
    }

    private function isValidRow($row) {
        return isset($this->map[$row]);
    }

    public function getRow($row) {
        if (!$this->isValidRow($row)) {
            throw new InvalidArgumentException("Row index out of bounds");
        }
        return $this->map[$row];
    }

    public function getColumn($inputColumn) {
        $column = [];
        foreach ($this->map as $row) {
            if (!isset($row[$inputColumn])) {
                throw new InvalidArgumentException("Column index out of bounds");
            }
            $column[] = $row[$inputColumn];
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