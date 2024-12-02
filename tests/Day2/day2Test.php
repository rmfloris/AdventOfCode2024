<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use day2\Day2;

final class day2Test extends TestCase
{
    private mixed $day;
    private mixed $sampleDay;

    protected function setUp(): void
    {
        $this->day = new Day2();
        $this->sampleDay = new Day2(true);
    }
    
    public function testPart1Sample(): void
    {
        $this->assertSame(2, $this->sampleDay->part1());
    }

    public function testPart1(): void
    {
        $this->assertSame(472, $this->day->part1());
    }

    public function testPart2Sample(): void
    {
        $this->assertSame(4, $this->sampleDay->part2());
    }

    public function testPart2(): void
    {
        $this->assertSame(520, $this->day->part2());
    }
}