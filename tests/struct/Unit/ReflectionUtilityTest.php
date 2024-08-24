<?php

declare(strict_types=1);

namespace Struct\Struct\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Struct\Struct\Private\Struct\ObjectStruct\Parts\Visibility;
use Struct\Struct\ReflectionUtility;
use Struct\TestData\Fixtures\CompanyProperty;


class ReflectionUtilityTest extends TestCase
{
    public function testReadObjectStruct(): void
    {
        $objectStruct = ReflectionUtility::readObjectStruct(CompanyProperty::class);
        $properties = $objectStruct->properties;
        self::assertCount(23, $properties);
        self::assertSame('isActive', $properties[2]->parameter->name);
        self::assertTrue($properties[5]->isReadOnly);
        self::assertSame(Visibility::public, $properties[20]->visibility);
        self::assertSame(Visibility::private, $properties[21]->visibility);
        self::assertSame(Visibility::protected, $properties[22]->visibility);
    }
}
