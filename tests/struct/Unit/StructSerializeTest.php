<?php

declare(strict_types=1);

namespace Struct\Struct\Tests\Unit;

use function file_get_contents;
use PHPUnit\Framework\TestCase;
use Struct\DataType\Amount;
use Struct\Struct\Factory\StructFactory;
use Struct\Struct\StructSerializeUtility;
use Struct\TestData\Fixtures\Struct\Base\UnionStruct;
use Struct\TestData\Fixtures\Struct\Company;
use Struct\TestData\Preparer\CompanyPreparer;

class StructSerializeTest extends TestCase
{
    protected Company $company;
    protected string $expectation;

    protected string $expectationSnakeCase;

    protected function prepare(): void
    {
        $companyPreparer = new CompanyPreparer();
        $this->company = $companyPreparer->buildCompany();
        $this->expectation = (string) file_get_contents(__DIR__ . '/../../test-data/Expectation/Company.json');
        $this->expectationSnakeCase = (string) file_get_contents(__DIR__ . '/../../test-data/Expectation/CompanySnakeCase.json');
    }

    public function testFullSerializeUnionStruct(): void
    {
        $struct01 = StructFactory::create(UnionStruct::class, ['turnOverTest' => '695']);
        $struct02 = StructFactory::create(UnionStruct::class, ['turnOverTest' => new Amount('125.58 EUR')]);
        self::assertSame($struct01->turnOverTest, '695');
        self::assertSame($struct02->turnOverTest->serializeToString(), '125.58 EUR');
    }

    public function testFullSerializeCompany(): void
    {
        $this->prepare();
        $firstCompany = $this->company;
        $companyArray = StructSerializeUtility::serialize($firstCompany);
        $companyStruct = StructFactory::create(Company::class, $companyArray);
        $companyJson = StructSerializeUtility::serializeToJson($companyStruct);
        self::assertSame($this->expectation, $companyJson);
    }
}
