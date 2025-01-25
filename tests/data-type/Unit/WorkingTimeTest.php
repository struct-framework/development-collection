<?php

declare(strict_types=1);

namespace Struct\DataType\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Struct\DataType\WorkingTime;

class WorkingTimeTest extends TestCase
{
    public function testSerializeToString(): void
    {
        $workingTime = new WorkingTime(200);
        self::assertSame('3h 20m', $workingTime->serializeToString());
    }

    public function testDeserializeFromString(): void
    {
        $workingTime = new WorkingTime('3h 20m');
        self::assertSame(200, $workingTime->minutes);
    }

    public function testFull(): void
    {
        for ($i = -100000; $i < 100000; $i++) {
            $workingTime = new WorkingTime($i);
            $workingTimeString = $workingTime->serializeToString();
            $newWorkingTime = new WorkingTime($workingTimeString);
            self::assertSame($i, $newWorkingTime->minutes, $workingTimeString);
        }
    }

    public function testSum(): void
    {
        $workingTime01 = new WorkingTime('20m');
        $workingTime02 = new WorkingTime('3m');
        $workingTime03 = new WorkingTime('10m');

        $workingTimeSum = WorkingTime::sum([$workingTime01, $workingTime02, $workingTime03]);
        self::assertSame(33, $workingTimeSum->minutes);
    }

    public function testSignChange(): void
    {
        $workingTime01 = new WorkingTime('20m');
        $result = WorkingTime::signChange($workingTime01);
        self::assertSame(-20, $result->minutes);
    }
}
