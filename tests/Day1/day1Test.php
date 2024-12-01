<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use day1\Day1;

final class day1Test extends TestCase
{
    private mixed $day;
    private mixed $sampleDay;

    protected function setUp(): void
    {
        $this->day = new Day1();
        $this->sampleDay = new Day1(true);
    }
    
    public function testPart1Sample(): void
    {
        $this->assertSame(11, $this->sampleDay->part1());
    }

    public function testPart1(): void
    {
        $this->assertSame(1319616, $this->day->part1());
    }

    public function testPart2Sample(): void
    {
            $this->assertSame(31, $this->sampleDay->part2());
    }

    public function testPart2(): void
    {
        $this->assertSame(27267728, $this->day->part2());
    }
}