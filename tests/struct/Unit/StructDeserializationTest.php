<?php

declare(strict_types=1);

namespace Struct\Struct\Tests\Unit;

use Struct\Struct\Factory\StructFactory;
use Struct\TestData\Fixtures\Struct\Base\SerializeStruct;
use function file_get_contents;
use PHPUnit\Framework\TestCase;
use Struct\Struct\StructSerializeUtility;
use Struct\TestData\Fixtures\Struct\Company;
use Struct\TestData\Preparer\CompanyPreparer;

class StructDeserializationTest extends TestCase
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


    public function testFullSerializeCompany(): void
    {
        $firstCompany = $this->company;
        $companyArray = StructSerializeUtility::serialize($firstCompany);
        $companyStruct = StructFactory::create(Company::class, $companyArray);
        $companyJson = StructSerializeUtility::serializeToJson($companyStruct);
        self::assertSame($this->expectation, $companyJson);
    }
}
