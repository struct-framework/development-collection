<?php

declare(strict_types=1);

namespace Struct\DataType\Tests\Unit\Factory;

use PHPUnit\Framework\TestCase;
use Struct\DataType\Month;
use Struct\Struct\Factory\StructFactory;
use Struct\TestData\Fixtures\Struct\DataType;

class StructureFactoryTest extends TestCase
{
    public function testCreateDataType(): void
    {
        $dataType = StructFactory::create(DataType::class);
        self::assertNull($dataType->monthNull);
        self::assertInstanceOf(Month::class, $dataType->month);
        $month = $dataType->month;
        self::assertSame('2013-07', $month->serializeToString());
    }
}
