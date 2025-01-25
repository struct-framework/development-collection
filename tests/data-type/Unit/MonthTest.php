<?php

declare(strict_types=1);

namespace Struct\DataType\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Struct\DataType\Month;

class MonthTest extends TestCase
{
    public function testSerializeToString(): void
    {
        $month = new Month('2023-08');
        $serializedMonth = $month->serializeToString();
        self::assertSame('2023-08', $serializedMonth);
    }

    public function testDeserializeToString(): void
    {
        $serializedMonth = '2023-08';
        $month = new Month($serializedMonth);
        self::assertSame(2023, $month->getYear());
        self::assertSame(8, $month->getMonth());
    }

    public function testExceptions(): void
    {
        $serializedMonth = '202308';
        self::expectExceptionCode(1696227826);
        new Month($serializedMonth);
    }

    public function testSerializeToInt(): void
    {
        $month = new Month('2023-08');
        self::assertSame(24283, $month->serializeToInt());
    }

    public function testDeserializeFromInt(): void
    {
        $month = new Month(24283);
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

    public function testIncrement(): void
    {
        $month = new Month('2024-02');
        $month = $month->increment();
        self::assertSame('2024-03', $month->serializeToString());
    }

    public function testDecrement(): void
    {
        $month = new Month('2024-01');
        $month = $month->decrement();
        self::assertSame('2023-12', $month->serializeToString());
    }
}
