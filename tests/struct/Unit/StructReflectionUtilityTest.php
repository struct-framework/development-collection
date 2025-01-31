<?php

declare(strict_types=1);

namespace Struct\Struct\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Struct\Struct\Internal\Struct\StructSignature\StructArrayTypeOption;
use Struct\Struct\Internal\Struct\StructSignature\StructBaseDataType;
use Struct\Struct\StructReflectionUtility;
use Struct\TestData\Fixtures\Struct\Company;
use Struct\TestData\Fixtures\Struct\Role;

class StructReflectionUtilityTest extends TestCase
{
    public function testReflection(): void
    {
        $signature = StructReflectionUtility::readSignature(Company::class);
        self::assertEquals($signature->structName, Company::class);
        self::assertCount(20, $signature->structElements);
        self::assertFalse($signature->isReadOnly);

        $elementRoleCollection = $signature->structElements[13];
        self::assertEquals('roleCollection', $elementRoleCollection->name);
        self::assertNotNull($elementRoleCollection->structArrayType);
        self::assertCount(1, $elementRoleCollection->structArrayType->structDataTypes);
        self::assertEquals(Role::class, $elementRoleCollection->structArrayType->structDataTypes[0]->className);
        self::assertEquals(StructBaseDataType::Struct, $elementRoleCollection->structArrayType->structDataTypes[0]->structBaseDataType);
        self::assertEquals(StructArrayTypeOption::ArrayList, $elementRoleCollection->structArrayType->structArrayTypeOption);

        $elementAge = $signature->structElements[11];
        self::assertEquals('age', $elementAge->name);
        self::assertCount(1, $elementAge->structDataTypes);
        self::assertNull($elementAge->structArrayType);
        self::assertNotNull($elementAge->defaultValue);
        self::assertEquals(20, $elementAge->defaultValue->valueData);
    }
}
