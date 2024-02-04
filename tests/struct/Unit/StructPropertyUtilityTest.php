<?php

declare(strict_types=1);

namespace Struct\Struct\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Struct\Struct\StructPropertyUtility;
use Struct\TestData\Fixtures\Struct\Company;
use Struct\TestData\Preparer\CompanyPreparer;

/**
 * @todo write tests
 */
class StructPropertyUtilityTest extends TestCase
{
    protected Company $company;

    protected function setUp(): void
    {
        parent::setUp();
        $companyPreparer = new CompanyPreparer();
        $this->company = $companyPreparer->buildCompany();
    }

    public function testReadProperties(): void
    {
        $companyHash = StructPropertyUtility::readProperties($this->company);
        self::assertArrayHasKey('name', $companyHash);
    }
}
