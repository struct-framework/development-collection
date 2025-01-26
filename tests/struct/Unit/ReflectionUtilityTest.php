<?php

declare(strict_types=1);

namespace Struct\Struct\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Struct\Struct\Internal\Struct\ObjectSignature\Parts\Visibility;
use Struct\Struct\ReflectionUtility;
use Struct\TestData\Fixtures\Reflection\PersonProperty;

class ReflectionUtilityTest extends TestCase
{
    public function testPersonProperty(): void
    {
        $objectSignature = ReflectionUtility::readObjectSignature(PersonProperty::class);
        self::assertCount(2, $objectSignature->methods);
        self::assertSame(Visibility::public, $objectSignature->methods[0]->visibility);
        self::assertSame('getName', $objectSignature->methods[0]->name);
        self::assertSame(Visibility::protected, $objectSignature->methods[1]->visibility);
        self::assertSame('buildName', $objectSignature->methods[1]->name);
        self::assertSame('string', $objectSignature->methods[1]->returnTypes[0]->dataType);
        self::assertTrue($objectSignature->methods[1]->returnTypes[0]->isBuiltin);
        self::assertSame('bool', $objectSignature->methods[1]->returnTypes[1]->dataType);
        self::assertTrue($objectSignature->methods[1]->returnTypes[1]->isBuiltin);
    }
}
