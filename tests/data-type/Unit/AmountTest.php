<?php

declare(strict_types=1);

namespace Struct\DataType\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Struct\DataType\Amount;
use Struct\DataType\Enum\AmountVolume;
use Struct\DataType\Month;

class AmountTest extends TestCase
{
    public function testSerializeToString(): void
    {
        $amount = new Amount();
        $amount->setValue(1876);
        $serializedAmount = $amount->serializeToString();
        self::assertSame('18.76 EUR', $serializedAmount);

        $amount->setValue(2);
        $serializedAmount = $amount->serializeToString();
        self::assertSame('0.02 EUR', $serializedAmount);

        $amount->setValue(0);
        $serializedAmount = $amount->serializeToString();
        self::assertSame('0.00 EUR', $serializedAmount);

        $amount->setValue(6798786);
        $serializedAmount = $amount->serializeToString();
        self::assertSame('67987.86 EUR', $serializedAmount);
    }

    public function testSerializeToStringAmountVolume(): void
    {
        $amount = new Amount();
        $amount->setValue(1876);
        $amount->setAmountVolume(AmountVolume::Million);
        $serializedAmount = $amount->serializeToString();
        self::assertSame('18.76 MEUR', $serializedAmount);

        $amount = new Amount();
        $amount->setValue(1876);
        $amount->setAmountVolume(AmountVolume::Thousand);
        $serializedAmount = $amount->serializeToString();
        self::assertSame('18.76 TEUR', $serializedAmount);
    }

    public function testSerializeToStringNegativ(): void
    {
        $amount = new Amount();
        $amount->setValue(-1876);
        $serializedAmount = $amount->serializeToString();
        self::assertSame('-18.76 EUR', $serializedAmount);

        $amount->setValue(-2);
        $serializedAmount = $amount->serializeToString();
        self::assertSame('-0.02 EUR', $serializedAmount);

        $amount->setValue(-6798786);
        $serializedAmount = $amount->serializeToString();
        self::assertSame('-67987.86 EUR', $serializedAmount);
    }

    public function testDeserializeFromString(): void
    {
        $serializedAmount = '-0.001 EUR';
        $amount = new Amount();
        $amount->deserializeFromString($serializedAmount);
        self::assertSame(-1, $amount->getValue());
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
        $amount02 = new Amount('241.47 TEUR');
        $amountResult = Amount::sum([$amount01, $amount02]);
        self::assertSame('242726.95 EUR', $amountResult->serializeToString());
    }

    public function testSum05(): void
    {
        $amount01 = new Amount('1256.95 TEUR');
        $amount02 = new Amount('241.47 TEUR');
        $amountResult = Amount::sum([$amount01, $amount02]);
        self::assertSame('1498.42 TEUR', $amountResult->serializeToString());
    }

    public function testSum06(): void
    {
        $amount01 = new Amount('12 MEUR');
        $amount02 = new Amount('241.47 EUR');
        $amountResult = Amount::sum([$amount01, $amount02]);
        self::assertSame('12000241.47 EUR', $amountResult->serializeToString());
    }

    public function testSum07(): void
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
}
