<?php

declare(strict_types=1);

namespace Struct\Struct\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Struct\DataType\Amount;
use Struct\Reflection\MemoryCache;
use Struct\Struct\Internal\Struct\StructSignature\DataType\StructUnderlyingDataType;
use Struct\Struct\StructReflectionUtility;
use Struct\TestData\Fixtures\Struct\Base\ReflectionStruct;
use Struct\TestData\Fixtures\Struct\Company;

class StructReflectionUtilityTest extends TestCase
{

    public function testReflectionStruct(): void
    {
        MemoryCache::clear();

        $signature = StructReflectionUtility::readSignature(ReflectionStruct::class);
        self::assertCount(7, $signature->structElements);

        $structElement  = $signature->structElements[0];
        self::assertSame('name', $structElement->name);
        self::assertCount(1, $structElement->structDataTypes);
        self::assertSame(StructUnderlyingDataType::String, $structElement->structDataTypes[0]->structUnderlyingDataType);
        self::assertSame(null, $structElement->structDataTypes[0]->isClearlyDefined);
        self::assertSame(null, $structElement->structDataTypes[0]->className);

        $structElement  = $signature->structElements[1];
        self::assertSame('age', $structElement->name);
        self::assertSame(false, $structElement->isAllowsNull);
        self::assertCount(1, $structElement->structDataTypes);
        self::assertSame(StructUnderlyingDataType::Integer, $structElement->structDataTypes[0]->structUnderlyingDataType);
        self::assertSame(null, $structElement->structDataTypes[0]->isClearlyDefined);
        self::assertSame(null, $structElement->structDataTypes[0]->className);

        $structElement  = $signature->structElements[2];
        self::assertSame('ageNull', $structElement->name);
        self::assertSame(true, $structElement->isAllowsNull);
        self::assertCount(1, $structElement->structDataTypes);
        self::assertSame(StructUnderlyingDataType::Integer, $structElement->structDataTypes[0]->structUnderlyingDataType);
        self::assertSame(null, $structElement->structDataTypes[0]->isClearlyDefined);
        self::assertSame(null, $structElement->structDataTypes[0]->className);

        $structElement  = $signature->structElements[3];
        self::assertSame('turnover',$structElement->name);
        self::assertCount(2, $structElement->structDataTypes);
        self::assertSame(StructUnderlyingDataType::String, $structElement->structDataTypes[0]->structUnderlyingDataType);
        self::assertSame(null, $structElement->structDataTypes[0]->isClearlyDefined);
        self::assertSame(null, $structElement->structDataTypes[0]->className);
        self::assertSame(StructUnderlyingDataType::Integer, $structElement->structDataTypes[1]->structUnderlyingDataType);
        self::assertSame(null, $structElement->structDataTypes[1]->isClearlyDefined);
        self::assertSame(null, $structElement->structDataTypes[1]->className);

        $structElement  = $signature->structElements[4];
        self::assertSame('company',$structElement->name);
        self::assertCount(2, $structElement->structDataTypes);
        self::assertSame(StructUnderlyingDataType::Struct, $structElement->structDataTypes[0]->structUnderlyingDataType);
        self::assertSame(true, $structElement->structDataTypes[0]->isClearlyDefined);
        self::assertSame(Company::class, $structElement->structDataTypes[0]->className);
        self::assertSame(StructUnderlyingDataType::String, $structElement->structDataTypes[1]->structUnderlyingDataType);
        self::assertSame(null, $structElement->structDataTypes[1]->isClearlyDefined);
        self::assertSame(null, $structElement->structDataTypes[1]->className);

        $structElement  = $signature->structElements[5];
        self::assertSame('amount',$structElement->name);
        self::assertCount(2, $structElement->structDataTypes);
        self::assertSame(StructUnderlyingDataType::DataType, $structElement->structDataTypes[0]->structUnderlyingDataType);
        self::assertSame(false, $structElement->structDataTypes[0]->isClearlyDefined);
        self::assertSame(Amount::class, $structElement->structDataTypes[0]->className);
        self::assertSame(StructUnderlyingDataType::String, $structElement->structDataTypes[1]->structUnderlyingDataType);
        self::assertSame(null, $structElement->structDataTypes[1]->isClearlyDefined);
        self::assertSame(null, $structElement->structDataTypes[1]->className);

        $structElement  = $signature->structElements[6];
        self::assertSame('tags',$structElement->name);
        self::assertCount(1, $structElement->structDataTypes);
        self::assertSame(StructUnderlyingDataType::Array, $structElement->structDataTypes[0]->structUnderlyingDataType);
        self::assertSame(null, $structElement->structDataTypes[0]->isClearlyDefined);
        self::assertSame(null, $structElement->structDataTypes[0]->className);
    }



}
