<?php

declare(strict_types=1);

namespace Struct\Operator\Tests\Unit;

use PHPUnit\Framework\TestCase;
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
}
