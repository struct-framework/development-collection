<?php

declare(strict_types=1);

namespace Struct\DataType\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Struct\DataType\Month;

class MonthTest extends TestCase
{
    public function testSerializeToString(): void
    {
        $month = new Month();
        $month->setYear(2023);
        $month->setMonth(8);
        $serializedMonth = $month->serializeToString();
        self::assertSame('2023-08', $serializedMonth);
    }

    public function testDeserializeToString(): void
    {
        $serializedMonth = '2023-08';
        $month = new Month();
        $month->deserializeFromString($serializedMonth);
        self::assertSame(2023, $month->getYear());
        self::assertSame(8, $month->getMonth());
    }

    public function testExceptions(): void
    {
        $serializedMonth = '202308';
        self::expectExceptionCode(1696227826);
        $month = new Month();
        $month->deserializeFromString($serializedMonth);
    }

    public function testSerializeToInt(): void
    {
        $month = new Month();
        $month->setYear(2023);
        $month->setMonth(8);
        self::assertSame(24283, $month->serializeToInt());
    }

    public function testDeserializeFromInt(): void
    {
        $month = new Month();
        $month->deserializeFromInt(24283);
        self::assertSame(2023, $month->getYear());
        self::assertSame(8, $month->getMonth());
    }
}
