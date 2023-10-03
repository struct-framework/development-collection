<?php

declare(strict_types=1);

namespace Struct\DataType\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Struct\DataType\Date;

class DateText extends TestCase
{
    public function testSerializeToString(): void
    {
        $date = new Date();
        $date->setYear(2023);
        $date->setMonth(8);
        $date->setDay(15);
        $serializedMonth = $date->serializeToString();
        self::assertSame('2023-08-15', $serializedMonth);
    }

    public function testDeserializeToString(): void
    {
        $serializedMonth = '2023-08-15';
        $date = Date::deserializeFromString($serializedMonth);
        self::assertSame(2023, $date->getYear());
        self::assertSame(8, $date->getMonth());
        self::assertSame(15, $date->getDay());
    }

    public function testDayCheck(): void
    {
        $date = new Date();
        $date->setYear(2023);
        $date->setMonth(2);
        self::expectExceptionCode(1696334057);
        $date->setDay(30);
    }
}
