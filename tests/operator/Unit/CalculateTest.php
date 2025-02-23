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
        self::assertInstanceOf(Month::class, $moth01);
        self::assertSame('2023-11', $moth01->serializeToString());

        $i = 100;
        O::increment($i);
        self::assertSame(101, $i);
    }

    public function testDecrement(): void
    {
        $moth01 = new Month('2023-10');
        O::decrement($moth01);
        self::assertInstanceOf(Month::class, $moth01);
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
            self::assertInstanceOf(Date::class, $moth01);
        } while (O::lessThanOrEquals($moth01, $mothTo));
        self::assertCount(366, $output);
    }

    public function testSum(): void
    {
        $amount01 = new Amount('1256.95 EUR');
        $amount02 = new Amount('241.47 EUR');
        $amountResult = O::sum([$amount01, $amount02]);
        self::assertInstanceOf(Amount::class, $amountResult);
        self::assertSame('1498.42 EUR', $amountResult->serializeToString());
    }

    public function testAdd(): void
    {
        $amount01 = new Amount('1256.95 EUR');
        $amount02 = new Amount('241.47 EUR');
        $amountResult = O::add($amount01, $amount02);
        self::assertInstanceOf(Amount::class, $amountResult);
        self::assertSame('1498.42 EUR', $amountResult->serializeToString());
    }

    public function testSub(): void
    {
        $amount01 = new Amount('1256.95 EUR');
        $amount02 = new Amount('241.47 EUR');
        $amountResult = O::sub($amount01, $amount02);
        self::assertInstanceOf(Amount::class, $amountResult);
        self::assertSame('1015.48 EUR', $amountResult->serializeToString());
    }
}
