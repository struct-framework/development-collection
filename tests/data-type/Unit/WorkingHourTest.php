<?php

declare(strict_types=1);

namespace Struct\DataType\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Struct\DataType\WorkingHour;

class WorkingHourTest extends TestCase
{
    public function testSerializeToString(): void
    {
        $workingHour = new WorkingHour(180);
        self::assertSame('3.00', $workingHour->serializeToString());

        $workingHour = new WorkingHour(15);
        self::assertSame('0.25', $workingHour->serializeToString());

        $workingHour = new WorkingHour(3);
        self::assertSame('0.05', $workingHour->serializeToString());

        $workingHour = new WorkingHour(0);
        self::assertSame('0.00', $workingHour->serializeToString());

        $workingHour = new WorkingHour(-255);
        self::assertSame('- 4.25', $workingHour->serializeToString());
    }

    public function testDeserializeFromString(): void
    {
        $workingHour = new WorkingHour('0.25');
        self::assertSame(15, $workingHour->minutes);

        $workingHour = new WorkingHour('- 4.25');
        self::assertSame(-255, $workingHour->minutes);
    }

    public function testSum(): void
    {
        $workingHour01 = new WorkingHour('20.00');
        $workingHour02 = new WorkingHour('3.00');
        $workingHour03 = new WorkingHour('10.00');

        $workingTimeSum = WorkingHour::sum([$workingHour01, $workingHour02, $workingHour03]);
        self::assertSame(33 * 60, $workingTimeSum->minutes);
    }

    public function testSignChange(): void
    {
        $workingHour = new WorkingHour('20.00');
        $result = WorkingHour::signChange($workingHour);
        self::assertSame(-20 * 60, $result->minutes);
    }
}
