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

    public function testFirstDayOfMonth(): void
    {
        $month = new Month('2025-12');
        $firstDayOfMonth = $month->firstDayOfMonth();
        self::assertSame('2025-12-01', $firstDayOfMonth->serializeToString());
    }

    public function testLastDayOfMonth(): void
    {
        $month = new Month('2024-02');
        $lastDayOfMonth = $month->lastDayOfMonth();
        self::assertSame('2024-02-29', $lastDayOfMonth->serializeToString());
    }
}
