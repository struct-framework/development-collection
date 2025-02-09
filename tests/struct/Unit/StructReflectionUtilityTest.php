<?php

declare(strict_types=1);

namespace Struct\Struct\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Struct\DataType\Amount;
use Struct\Reflection\MemoryCache;
use Struct\Struct\Internal\Struct\StructSignature\DataType\StructUnderlyingArrayType;
use Struct\Struct\Internal\Struct\StructSignature\DataType\StructUnderlyingDataType;
use Struct\Struct\StructReflectionUtility;
use Struct\TestData\Fixtures\Struct\Base\ReflectionStruct;
use Struct\TestData\Fixtures\Struct\Company;
use Struct\TestData\Fixtures\Struct\Tag;

class StructReflectionUtilityTest extends TestCase
{
    public function testReflectionStruct(): void
    {
        MemoryCache::clear();

        $signature = StructReflectionUtility::readSignature(ReflectionStruct::class);
        self::assertCount(8, $signature->structElements);

        $structElement  = $signature->structElements[0];
        self::assertSame('name', $structElement->name);
        self::assertCount(1, $structElement->structDataTypeCollection->structDataTypes);
        self::assertSame(StructUnderlyingDataType::String, $structElement->structDataTypeCollection->structDataTypes[0]->structUnderlyingDataType);
        self::assertSame(null, $structElement->structDataTypeCollection->structDataTypes[0]->className);

        $structElement  = $signature->structElements[1];
        self::assertSame('age', $structElement->name);
        self::assertSame(false, $structElement->isAllowsNull);
        self::assertCount(1, $structElement->structDataTypeCollection->structDataTypes);
        self::assertSame(StructUnderlyingDataType::Integer, $structElement->structDataTypeCollection->structDataTypes[0]->structUnderlyingDataType);
        self::assertSame(null, $structElement->structDataTypeCollection->structDataTypes[0]->className);

        $structElement  = $signature->structElements[2];
        self::assertSame('ageNull', $structElement->name);
        self::assertSame(true, $structElement->isAllowsNull);
        self::assertCount(1, $structElement->structDataTypeCollection->structDataTypes);
        self::assertSame(StructUnderlyingDataType::Integer, $structElement->structDataTypeCollection->structDataTypes[0]->structUnderlyingDataType);
        self::assertSame(null, $structElement->structDataTypeCollection->structDataTypes[0]->className);

        $structElement  = $signature->structElements[3];
        self::assertSame('turnover', $structElement->name);
        self::assertCount(2, $structElement->structDataTypeCollection->structDataTypes);
        self::assertSame(StructUnderlyingDataType::String, $structElement->structDataTypeCollection->structDataTypes[0]->structUnderlyingDataType);
        self::assertSame(null, $structElement->structDataTypeCollection->structDataTypes[0]->className);
        self::assertSame(StructUnderlyingDataType::Integer, $structElement->structDataTypeCollection->structDataTypes[1]->structUnderlyingDataType);
        self::assertSame(null, $structElement->structDataTypeCollection->structDataTypes[1]->className);

        $structElement  = $signature->structElements[4];
        self::assertSame('company', $structElement->name);
        self::assertCount(2, $structElement->structDataTypeCollection->structDataTypes);
        self::assertSame(StructUnderlyingDataType::Struct, $structElement->structDataTypeCollection->structDataTypes[0]->structUnderlyingDataType);
        self::assertSame(Company::class, $structElement->structDataTypeCollection->structDataTypes[0]->className);
        self::assertSame(StructUnderlyingDataType::String, $structElement->structDataTypeCollection->structDataTypes[1]->structUnderlyingDataType);
        self::assertSame(null, $structElement->structDataTypeCollection->structDataTypes[1]->className);

        $structElement  = $signature->structElements[5];
        self::assertSame('amount', $structElement->name);
        self::assertSame(false, $structElement->structDataTypeCollection->unclearInt);
        self::assertSame(true, $structElement->structDataTypeCollection->unclearString);
        self::assertSame(false, $structElement->structDataTypeCollection->unclearArray);
        self::assertCount(2, $structElement->structDataTypeCollection->structDataTypes);
        self::assertSame(StructUnderlyingDataType::DataType, $structElement->structDataTypeCollection->structDataTypes[0]->structUnderlyingDataType);
        self::assertSame(Amount::class, $structElement->structDataTypeCollection->structDataTypes[0]->className);
        self::assertSame(StructUnderlyingDataType::String, $structElement->structDataTypeCollection->structDataTypes[1]->structUnderlyingDataType);
        self::assertSame(null, $structElement->structDataTypeCollection->structDataTypes[1]->className);

        $structElement  = $signature->structElements[6];
        self::assertSame('tags', $structElement->name);
        self::assertCount(1, $structElement->structDataTypeCollection->structDataTypes);
        self::assertSame(StructUnderlyingDataType::Array, $structElement->structDataTypeCollection->structDataTypes[0]->structUnderlyingDataType);
        self::assertSame(null, $structElement->structDataTypeCollection->structDataTypes[0]->className);
        self::assertNotNull($structElement->structElementArray);
        self::assertSame(StructUnderlyingArrayType::ArrayKeyList, $structElement->structElementArray->structUnderlyingArrayType);

        $structDataTypeCollection = $structElement->structElementArray->structDataTypeCollection;
        self::assertNotNull($structDataTypeCollection);
        self::assertCount(2, $structDataTypeCollection->structDataTypes);
        self::assertSame(StructUnderlyingDataType::Struct, $structDataTypeCollection->structDataTypes[0]->structUnderlyingDataType);
        self::assertSame(Tag::class, $structDataTypeCollection->structDataTypes[0]->className);
        self::assertSame(StructUnderlyingDataType::String, $structDataTypeCollection->structDataTypes[1]->structUnderlyingDataType);
        self::assertSame(null, $structDataTypeCollection->structDataTypes[1]->className);

        $structElement  = $signature->structElements[7];
        self::assertSame('category', $structElement->name);
        self::assertCount(1, $structElement->structDataTypeCollection->structDataTypes);
        self::assertSame(StructUnderlyingDataType::EnumString, $structElement->structDataTypeCollection->structDataTypes[0]->structUnderlyingDataType);
        self::assertSame(null, $structElement->structDataTypeCollection->structDataTypes[0]->className);
        self::assertNotNull($structElement->structElementArray);
        self::assertSame(StructUnderlyingArrayType::ArrayKeyList, $structElement->structElementArray->structUnderlyingArrayType);
    }
}
