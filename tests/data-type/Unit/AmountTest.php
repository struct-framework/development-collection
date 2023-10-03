<?php

declare(strict_types=1);

namespace Struct\DataType\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Struct\DataType\Amount;
use Struct\DataType\Enum\AmountVolume;

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
}
