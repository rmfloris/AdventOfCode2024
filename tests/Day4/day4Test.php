<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use day4\Day4;

final class day4Test extends TestCase
{
    private mixed $day;
    private mixed $sampleDay;

    protected function setUp(): void
    {
        $this->day = new Day4();
        $this->sampleDay = new Day4(true);
    }
    
    public function testPart1Sample(): void
    {
        $this->assertSame(18, $this->sampleDay->part1());
    }

    public function testPart1(): void
    {
        $this->assertSame(2633, $this->day->part1());
    }

    public function testPart2Sample(): void
    {
        
        $this->assertSame(9, $this->sampleDay->part2());
    }

    public function testPart2(): void
    {
        $this->assertSame(1936, $this->day->part2());
    }
}