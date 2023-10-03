<?php

declare(strict_types=1);

namespace Struct\Struct\Tests\Unit\Factory;

use PHPUnit\Framework\TestCase;
use Struct\DataType\Month;
use Struct\Struct\Factory\ModelFactory;

class DataTypeFactoryTest extends TestCase
{
    public function testCreateFromString(): void
    {
        $month = ModelFactory::createFromString(Month::class, '2023-08');
        self::assertSame(2023, $month->getYear());
        self::assertSame(8, $month->getMonth());
    }

    public function testCreateFromInt(): void
    {
        $month = ModelFactory::createFromInt(Month::class, 24283);
        self::assertSame(2023, $month->getYear());
        self::assertSame(8, $month->getMonth());
    }
}
