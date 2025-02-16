<?php

declare(strict_types=1);

namespace Struct\Reflection\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Struct\Reflection\Internal\Struct\ObjectSignature\Parts\NamedType;
use Struct\Reflection\Internal\Struct\ObjectSignature\Parts\Visibility;
use Struct\Reflection\ReflectionUtility;
use Struct\TestData\Fixtures\Reflection\PersonProperty;
use Struct\TestData\Fixtures\Struct\Company;
use Struct\TestData\Fixtures\Struct\Country\AbstractCountry;

class ReflectionUtilityTest extends TestCase
{
    public function testPersonProperty(): void
    {
        $objectSignature = ReflectionUtility::readSignature(PersonProperty::class);
        self::assertCount(2, $objectSignature->methods);
        self::assertSame(Visibility::public, $objectSignature->methods[0]->visibility);
        self::assertSame('getName', $objectSignature->methods[0]->name);
        self::assertSame(Visibility::protected, $objectSignature->methods[1]->visibility);
        self::assertSame('buildName', $objectSignature->methods[1]->name);
        self::assertIsArray($objectSignature->methods[1]->returnTypes);
        self::assertCount(2, $objectSignature->methods[1]->returnTypes);
        self::assertInstanceOf(NamedType::class, $objectSignature->methods[1]->returnTypes[0]);
        self::assertInstanceOf(NamedType::class, $objectSignature->methods[1]->returnTypes[1]);
        self::assertSame('string', $objectSignature->methods[1]->returnTypes[0]->dataType);
        self::assertTrue($objectSignature->methods[1]->returnTypes[0]->isBuiltin);
        self::assertSame('bool', $objectSignature->methods[1]->returnTypes[1]->dataType);
        self::assertTrue($objectSignature->methods[1]->returnTypes[1]->isBuiltin);
    }

    public function testIsAbstract(): void
    {
        self::assertFalse(ReflectionUtility::isAbstract(Company::class));
        self::assertTrue(ReflectionUtility::isAbstract(AbstractCountry::class));
    }
}
