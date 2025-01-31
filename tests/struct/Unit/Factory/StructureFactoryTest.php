<?php

declare(strict_types=1);

namespace Struct\Struct\Tests\Unit\Factory;

use PHPUnit\Framework\TestCase;
use Struct\Struct\Factory\StructFactory;
use Struct\TestData\Fixtures\Struct\Address;
use Struct\TestData\Fixtures\Struct\Company;
use Struct\TestData\Fixtures\Struct\CompanyReadOnly;

class StructureFactoryTest extends TestCase
{
    public function testCreate(): void
    {
        /** @var Company $company */
        $company = StructFactory::create(Company::class);
        self::assertInstanceOf(Address::class, $company->address);
        self::assertInstanceOf(Company::class, $company);
    }

    public function testCreateReadOnly(): void
    {
        $company = StructFactory::create(CompanyReadOnly::class, ['age' => 10]);
        self::assertInstanceOf(CompanyReadOnly::class, $company);
        self::assertEquals(10, $company->age);
    }
}
