<?php

namespace common;

class Picks {
    private float $area = 0;
    private int $boundries = 0;
    private int $interiorPoints = 0;

    public function setArea(float $area): void {
        $this->area = $area;
    }

    public function setBoundries(int $boundries): void {
        $this->boundries = $boundries;
    }

    public function setInteriorPoints(int $interiorPoints): void {
        $this->interiorPoints = $interiorPoints;
    }

    public function calculateArea(): float {
        if($this->boundries === 0 || $this->interiorPoints === 0) return 0;
        return $this->interiorPoints + ($this->boundries / 2) -1;
    }

    public function calculateInteriorPoints():int {
        if($this->boundries === 0 || $this->area === 0) return 0;
        return -($this->boundries / 2) + 1 + $this->area;
    }
}