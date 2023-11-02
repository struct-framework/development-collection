<?php

declare(strict_types=1);

namespace Struct\Struct\Tests\Unit\Factory;

use PHPUnit\Framework\TestCase;
use Struct\Struct\Factory\StructFactory;
use Struct\TestData\Fixtures\Struct\Company;
use Struct\TestData\Fixtures\Struct\RoleCollection;

class StructureFactoryTest extends TestCase
{
    public function testCreate(): void
    {
        /** @var Company $company */
        $company = StructFactory::create(Company::class);
        $company->address->city = 'hello';
        self::assertInstanceOf(Company::class, $company);
        self::assertInstanceOf(RoleCollection::class, $company->roleCollection);
    }
}
