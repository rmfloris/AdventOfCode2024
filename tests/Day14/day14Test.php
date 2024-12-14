<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use day14\Day14;

final class day14Test extends TestCase
{
    private mixed $day;
    private mixed $sampleDay;

    protected function setUp(): void
    {
        $this->day = new Day14();
        $this->sampleDay = new Day14(true);
    }
    
    public function testPart1Sample(): void
    {
        $this->sampleDay->setDimensions(11, 7);
        $this->assertSame(12, $this->sampleDay->part1());
    }

    public function testPart1(): void
    {
        // $this->markTestIncomplete("To be done");
        $this->day->setDimensions(101, 103);
        $this->assertSame(229632480, $this->day->part1());
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