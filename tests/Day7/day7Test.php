<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use day7\Day7;

final class day7Test extends TestCase
{
    private mixed $day;
    private mixed $sampleDay;

    protected function setUp(): void
    {
        $this->day = new Day7();
        $this->sampleDay = new Day7(true);
    }
    
    public function testPart1Sample(): void
    {
        $this->assertSame(3749, $this->sampleDay->part1());
    }

    public function testPart1(): void
    {
        $this->assertSame(2501605301465, $this->day->part1());
    }

    public function testPart2Sample(): void
    {
        $this->assertSame(11387, $this->sampleDay->part2());
    }

    public function testPart2(): void
    {
        $this->assertSame(44841372855953, $this->day->part2());
    }
}