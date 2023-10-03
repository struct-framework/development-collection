<?php

declare(strict_types=1);

namespace Struct\Operator\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Struct\DataType\Amount;
use Struct\DataType\Month;
use Struct\Operator\Calculate;

class CalculateTest extends TestCase
{
    public function testIncrement(): void
    {
        $moth01 = new Month('2023-10');
        Calculate::increment($moth01);
        self::assertSame('2023-11', $moth01->serializeToString());
    }

    public function testDecrement(): void
    {
        $moth01 = new Month('2023-10');
        Calculate::decrement($moth01);
        self::assertSame('2023-09', $moth01->serializeToString());
    }

    public function testSum(): void
    {
        $amount01 = new Amount('1256.95 EUR');
        $amount02 = new Amount('241.47 EUR');
        $amountResult = Calculate::sum([$amount01, $amount02]);
        self::assertSame('1498.42 EUR', $amountResult->serializeToString());
    }
}
