<?php

namespace common;

final class Position {
    public function __construct(
        private int $x,
        private int $y
    ) {}

    public function getPosition() {
        return [$this->y, $this->x];
    }

    public function setPosition(int $x, int $y) {
        $this->x = $x;
        $this->y = $y;
    }
}