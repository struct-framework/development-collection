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
        self::assertSame('98da0ec1a76e9dba5b14594957a8330f98046030', $companyHash);

        $companyHash = StructSignatureUtility::readPropertySignatureHash(Company::class, true);
        self::assertSame('3d193a33f804e7453c7584cb969883fbea7de329', $companyHash);
    }

    public function testReadValueSignature(): void
    {
        $objectSignature = StructSignatureUtility::readValueSignature($this->company);
    }
}
