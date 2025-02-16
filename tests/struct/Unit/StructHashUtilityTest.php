<?php

declare(strict_types=1);

namespace Struct\Struct\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Struct\Struct\StructHashUtility;
use Struct\TestData\Fixtures\Struct\Company;
use Struct\TestData\Fixtures\Struct\Role;
use Struct\TestData\Preparer\CompanyPreparer;

class StructHashUtilityTest extends TestCase
{
    protected Company $company;

    protected function setUp(): void
    {
        parent::setUp();
        $companyPreparer = new CompanyPreparer();
        $this->company = $companyPreparer->buildCompany();
    }

    public function testSignatureHash(): void
    {
        $companyHash = StructHashUtility::signatureHash(Company::class);
        self::assertSame('f5ac7742070cd50fa28a1a6f1a325588def4c949', $companyHash);
        $roleHash = StructHashUtility::signatureHash(Role::class);
        self::assertSame('4c13de84cb5eb3c5fa2293c8990eb18f566d5e57', $roleHash);
    }
}
