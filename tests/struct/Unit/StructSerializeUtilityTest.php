<?php

declare(strict_types=1);

namespace Struct\Struct\Tests\Unit;

use function file_get_contents;
use PHPUnit\Framework\TestCase;
use Struct\Contracts\StructInterface;
use Struct\Exception\InvalidStructException;
use Struct\Struct\Enum\KeyConvert;
use Struct\Struct\Factory\StructFactory;
use Struct\Struct\StructHashUtility;
use Struct\Struct\StructSerializeUtility;
use Struct\TestData\Fixtures\Struct\Company;
use Struct\TestData\Fixtures\Struct\DataType;
use Struct\TestData\Fixtures\Struct\Wrong;
use Struct\TestData\Preparer\CompanyPreparer;

class StructSerializeUtilityTest extends TestCase
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

    public function testDataType(): void
    {
        $dataType = StructFactory::create(DataType::class);
        self::assertInstanceOf(DataType::class, $dataType);
    }

    public function testFullSerialize(): void
    {
        $companyJson = StructSerializeUtility::serializeToJson($this->company);
        self::assertSame($this->expectation, $companyJson);
    }

    public function testFullSerializeSnakeCase(): void
    {
        $companyJson = StructSerializeUtility::serializeToJson($this->company, KeyConvert::snakeCase);
        self::assertSame($this->expectationSnakeCase, $companyJson);
    }

    public function testFullDeserialize(): void
    {
        $companyArrayExpectation = StructSerializeUtility::serialize($this->company);
        $companyUnSerialize = StructSerializeUtility::deserialize($companyArrayExpectation, Company::class);
        self::assertSame(8.0, $companyUnSerialize->longitude);

        $companyJson = StructSerializeUtility::serialize($companyUnSerialize);
        self::assertSame($this->expectation, $companyJson);
    }

    public function testFullUnSerializeSnakeCase(): void
    {
        $companyUnSerialize = StructSerializeUtility::deserializeFromJson($this->expectationSnakeCase, Company::class, KeyConvert::snakeCase);
        $companyJson = StructSerializeUtility::serializeToJson($companyUnSerialize);
        self::assertSame($this->expectation, $companyJson);
    }

    public function testInvalidValueException(): void
    {
        $wrong = new Wrong();
        $this->expectException(InvalidStructException::class);
        StructSerializeUtility::serialize($wrong);
    }

    public function testDeserializeFromJsonBadType(): StructInterface
    {
        $this->expectExceptionCode(1737885869);
        return StructSerializeUtility::deserializeFromJson($this->expectation, 'ImNotAnStructure'); // @phpstan-ignore-line
    }

    public function testDeserializeFromJson(): void
    {
        $company = StructSerializeUtility::deserializeFromJson($this->expectation, Company::class);
        self::assertInstanceOf(Company::class, $company);
    }

    public function testDeserializeObject(): void
    {
        $companyDeSerialize = StructSerializeUtility::deserialize($this->company, Company::class);

        $hashExpectation = StructHashUtility::buildHash($this->company);
        $hash = StructHashUtility::buildHash($companyDeSerialize);
        self::assertSame(bin2hex($hashExpectation), bin2hex($hash));
    }
}
