<?php

declare(strict_types=1);

namespace Struct\Operator\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Struct\DataType\Amount;
use Struct\DataType\Date;
use Struct\DataType\Month;
use Struct\Operator\O;

class CalculateTest extends TestCase
{
    public function testIncrement(): void
    {
        $moth01 = new Month('2023-10');
        O::increment($moth01);
        self::assertSame('2023-11', $moth01->serializeToString());

        $i = 100;
        O::increment($i);
        self::assertSame(101, $i);
    }

    public function testDecrement(): void
    {
        $moth01 = new Month('2023-10');
        O::decrement($moth01);
        self::assertSame('2023-09', $moth01->serializeToString());

        $i = 100;
        O::decrement($i);
        self::assertSame(99, $i);
    }

    public function testLoopOfYear2024(): void
    {
        $output = [];
        $moth01 = new Date('2024-01-01');
        $mothTo = $moth01->lastDayOfTheYear();
        do {
            $output[] = $moth01->serializeToString();
            O::increment($moth01);
        } while (O::lessThanOrEquals($moth01, $mothTo));
        self::assertCount(366, $output);
    }

    public function testSum(): void
    {
        $amount01 = new Amount('1256.95 EUR');
        $amount02 = new Amount('241.47 EUR');
        $amountResult = O::sum([$amount01, $amount02]);
        self::assertSame('1498.42 EUR', $amountResult->serializeToString());

        self::assertSame(22, O::sum([10, 5, 7]));
        self::assertSame(23.0, O::sum([10.5, 5.5, 7]));
    }

    public function testAdd(): void
    {
        $amount01 = new Amount('1256.95 EUR');
        $amount02 = new Amount('241.47 EUR');
        $amountResult = O::add($amount01, $amount02);
        self::assertSame('1498.42 EUR', $amountResult->serializeToString());
        self::assertSame(11, O::add(5, 6));
        self::assertSame(12.0, O::add(5.5, 6.5));
    }

    public function testSub(): void
    {
        $amount01 = new Amount('1256.95 EUR');
        $amount02 = new Amount('241.47 EUR');
        $amountResult = O::sub($amount01, $amount02);
        self::assertSame('1015.48 EUR', $amountResult->serializeToString());
        self::assertSame(-1, O::sub(5, 6));
        self::assertSame(-1.0, O::sub(5.5, 6.5));
    }
}
