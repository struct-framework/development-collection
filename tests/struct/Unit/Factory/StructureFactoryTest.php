<?php

declare(strict_types=1);

namespace Struct\Struct\Tests\Unit\Factory;

use PHPUnit\Framework\TestCase;
use Struct\DataType\Month;
use Struct\Struct\Factory\StructFactory;
use Struct\TestData\Fixtures\Struct\Company;

class StructureFactoryTest extends TestCase
{
    public function testCreate(): void
    {
        /** @var Company $company */
        $company = StructFactory::create(Company::class);
        $company->address->city = 'hello';
        self::assertInstanceOf(Company::class, $company);
    }

    public function testCreateDataType(): void
    {
        /** @var Company $company */
        $company = StructFactory::create(Company::class);
        self::assertNull($company->dataType->monthNull);
        self::assertInstanceOf(Month::class, $company->dataType->month);
        #self::assertSame('2013-09', $company->dataType->month->serializeToString());
    }
}
