<?php

declare(strict_types=1);

namespace Struct\DataType\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Struct\DataType\Amount;
use Struct\DataType\Month;

class AmountTest extends TestCase
{
    public function testSerializeToString(): void
    {
        $amount = new Amount('18.76 EUR');
        self::assertSame('18.76 EUR', $amount->serializeToString());

        $amount = new Amount('0.02 EUR');
        self::assertSame('0.02 EUR', $amount->serializeToString());

        $amount = new Amount('0.02 CHF');
        self::assertSame('0.02 CHF', $amount->serializeToString());
    }

    public function testSerializeToStringNegative(): void
    {
        $amount = new Amount('-18.76 EUR');
        self::assertSame('-18.76 EUR', $amount->serializeToString());

        $amount = new Amount('-0.02 EUR');
        self::assertSame('-0.02 EUR', $amount->serializeToString());

        $amount = new Amount('-0.02 CHF');
        self::assertSame('-0.02 CHF', $amount->serializeToString());
    }

    public function testDeserializeFromString(): void
    {
        $amount = new Amount('-0.001 EUR');
        self::assertSame('-0.001 EUR', $amount->serializeToString());
    }

    public function testSum01(): void
    {
        $amount01 = new Amount('1256.95 EUR');
        $amount02 = new Amount('241.47 EUR');
        $amountResult = Amount::sum([$amount01, $amount02]);
        self::assertSame('1498.42 EUR', $amountResult->serializeToString());
    }

    public function testSum02(): void
    {
        $amount01 = new Amount('1256.95 EUR');
        $amount02 = new Amount('241.4712 EUR');
        $amountResult = Amount::sum([$amount01, $amount02]);
        self::assertSame('1498.4212 EUR', $amountResult->serializeToString());
    }

    public function testSum03(): void
    {
        $amount01 = new Amount('1256.95 EUR');
        $amount02 = new Amount('-241.47 EUR');
        $amountResult = Amount::sum([$amount01, $amount02]);
        self::assertSame('1015.48 EUR', $amountResult->serializeToString());
    }

    public function testSum04(): void
    {
        $amount01 = new Amount('1256.95 EUR');
        $amount02 = new Amount('241.47 EUR');
        $amount03 = new Amount('789.45 EUR');
        $amountResult = Amount::sum([$amount01, $amount02, $amount03]);
        self::assertSame('2287.87 EUR', $amountResult->serializeToString());
    }

    public function testSumException01(): void
    {
        self::expectExceptionCode(1696344427);
        $amount01 = new Amount('1256.95 EUR');
        $amount02 = new Month('2013-12');
        Amount::sum([$amount01, $amount02]); // @phpstan-ignore-line
    }

    public function testSumException02(): void
    {
        self::expectExceptionCode(1696344461);
        $amount01 = new Amount('1256.95 EUR');
        $amount02 = new Amount('241.47 CHF');
        Amount::sum([$amount01, $amount02]);
    }

    public function testSignChange(): void
    {
        $amount01 = new Amount('1256.95 EUR');
        $amountResult = Amount::signChange($amount01);
        self::assertSame('-1256.95 EUR', $amountResult->serializeToString());
    }
}
