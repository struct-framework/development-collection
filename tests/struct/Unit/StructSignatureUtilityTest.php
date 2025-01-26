<?php

declare(strict_types=1);

namespace Struct\Struct\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Struct\Struct\StructSignatureUtility;
use Struct\TestData\Fixtures\Struct\Company;
use Struct\TestData\Preparer\CompanyPreparer;

class StructSignatureUtilityTest extends TestCase
{
    protected Company $company;

    protected function setUp(): void
    {
        parent::setUp();
        $companyPreparer = new CompanyPreparer();
        $this->company = $companyPreparer->buildCompany();
    }

    public function testReadPropertySignature(): void
    {
        $objectSignature = StructSignatureUtility::readPropertySignature(Company::class);

        $companyHash = StructSignatureUtility::readPropertySignatureHash(Company::class);
        self::assertSame('c5afcc02e3790f5727a9e5fd67bc04ddc242f880', $companyHash);

        $companyHash = StructSignatureUtility::readPropertySignatureHash(Company::class, true);
        self::assertSame('ac67ab0f7e066ed8010533894208871ce89d15a8', $companyHash);
    }

}
