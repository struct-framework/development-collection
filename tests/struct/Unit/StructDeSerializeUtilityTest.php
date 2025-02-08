<?php

declare(strict_types=1);

namespace Struct\Struct\Tests\Unit;

use function file_get_contents;
use PHPUnit\Framework\TestCase;
use Struct\Struct\StructSerializeUtility;
use Struct\TestData\Fixtures\Struct\Company;
use Struct\TestData\Preparer\CompanyPreparer;

class StructDeSerializeUtilityTest extends TestCase
{
    protected Company $company;
    protected string $expectation;

    protected string $expectationSnakeCase;

    protected function setUp(): void
    {
        parent::setUp();
        $companyPreparer = new CompanyPreparer();
        $this->company = $companyPreparer->buildCompany();
        $this->expectation = (string) file_get_contents(__DIR__ . '/../../test-data/Expectation/Company.json');
        $this->expectationSnakeCase = (string) file_get_contents(__DIR__ . '/../../test-data/Expectation/CompanySnakeCase.json');
    }


    public function testFullDeserialize(): void
    {
        $companyUnSerialize = StructSerializeUtility::deserialize($companyArrayExpectation, Company::class);
        self::assertSame(8.0, $companyUnSerialize->longitude);


        $companyJson = StructSerializeUtility::serialize($companyUnSerialize);
        self::assertSame($this->expectation, $companyJson);
    }

}
