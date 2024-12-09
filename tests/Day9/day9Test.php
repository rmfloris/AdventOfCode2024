<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use day9\Day9;

final class day9Test extends TestCase
{
    private mixed $day;
    private mixed $sampleDay;

    protected function setUp(): void
    {
        $this->day = new Day9();
        $this->sampleDay = new Day9(true);
    }
    
    public function testPart1Sample(): void
    {
        $this->assertSame(1928, $this->sampleDay->part1());
    }

    public function testPart1(): void
    {
        $this->assertSame(6337367222422, $this->day->part1());
    }

    public function testPart2Sample(): void
    {
        $this->markTestIncomplete("To be done");
        // $this->assertSame(-1, $this->sampleDay->part2());
    }

    public function testPart2(): void
    {
        $this->markTestIncomplete("To be done");
        // $this->assertSame(-1, $this->day->part2());
    }
}