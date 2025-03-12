<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use day19\Day19;

final class day19Test extends TestCase
{
    private mixed $day;
    private mixed $sampleDay;

    protected function setUp(): void
    {
        $this->day = new Day19();
        $this->sampleDay = new Day19(true);
    }
    
    public function testPart1Sample(): void
    {
        $this->assertSame(6, $this->sampleDay->part1());
    }

    public function testPart1(): void
    {
        // $this->markTestIncomplete("To be done");
        $this->assertSame(287, $this->day->part1());
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