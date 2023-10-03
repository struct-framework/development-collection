<?php

declare(strict_types=1);

namespace Struct\DataType\Tests\Unit\Factory;

use PHPUnit\Framework\TestCase;
use Struct\Struct\Factory\StructFactory;
use Struct\TestData\Fixtures\Struct\DataTypeFactory;

class StructureFactoryTest extends TestCase
{
    public function testCreateDataType(): void
    {
        $sataTypeFactory = StructFactory::create(DataTypeFactory::class);
        self::assertNull($sataTypeFactory->monthNull);
        self::assertSame('2013-07', $sataTypeFactory->month->serializeToString());
        self::assertSame('1258.25 TEUR', $sataTypeFactory->amount->serializeToString());
    }
}
