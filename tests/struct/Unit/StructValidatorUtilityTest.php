<?php

declare(strict_types=1);

namespace Struct\Struct\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Struct\Struct\StructValidatorUtility;
use Struct\TestData\Fixtures\Struct\Company;
use Struct\TestData\Fixtures\StructInvalid\ArrayAttribute;
use Struct\TestData\Fixtures\StructInvalid\NoStruct;
use Struct\TestData\Fixtures\StructInvalid\ReadOnlyStruct;
use Struct\TestData\Fixtures\StructInvalid\WithMethod;

class StructValidatorUtilityTest extends TestCase
{
    public function testRight(): void
    {
        StructValidatorUtility::isValidStruct(Company::class);
        self::assertTrue(true);
    }

    public function testArrayAttribute(): void
    {
        self::expectExceptionCode(1737830644);
        StructValidatorUtility::isValidStruct(ArrayAttribute::class);
    }

    public function testReadOnlyStruct(): void
    {
        self::expectExceptionCode(1737829582);
        StructValidatorUtility::isValidStruct(ReadOnlyStruct::class);
    }

    public function testNoStruct(): void
    {
        self::expectExceptionCode(1737828376);
        StructValidatorUtility::isValidStruct(NoStruct::class);
    }

    public function testWithMethod(): void
    {
        self::expectExceptionCode(1737828924);
        StructValidatorUtility::isValidStruct(WithMethod::class);
    }
}
