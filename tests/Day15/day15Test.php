<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use day15\Day15;

final class day15Test extends TestCase
{
    private mixed $day;
    private mixed $sampleDay;

    protected function setUp(): void
    {
        $this->day = new Day15();
        $this->sampleDay = new Day15(true);
    }
    
    public function testPart1Sample(): void
    {
        $this->assertSame(10092, $this->sampleDay->part1());
    }

    public function testPart1(): void
    {
        $this->assertSame(1486930, $this->day->part1());
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