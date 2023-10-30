<?php

declare(strict_types=1);

namespace Struct\serializing\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Struct\Contracts\StructInterface;
use Struct\Exception\InvalidStructException;
use Struct\Exception\InvalidValueException;
use Struct\Serializing\Enum\KeyConvert;
use Struct\Serializing\StructSerializing;
use Struct\Struct\Factory\StructFactory;
use Struct\TestData\Fixtures\Struct\Company;
use Struct\TestData\Fixtures\Struct\DataType;
use Struct\TestData\Fixtures\Struct\Wrong;
use Struct\TestData\Preparer\CompanyPreparer;

class StructSerializingTest extends TestCase
{
    protected Company $company;
    protected string $expectation;

    protected string $expectationSnakeCase;

    protected function setUp(): void
    {
        parent::setUp();
        $companyPreparer = new CompanyPreparer();
        $this->company = $companyPreparer->buildCompany();
        $this->expectation = (string) \file_get_contents(__DIR__ . '/../../test-data/Expectation/Company.json');
        $this->expectationSnakeCase = (string) \file_get_contents(__DIR__ . '/../../test-data/Expectation/CompanySnakeCase.json');
        $this->expectation = \substr($this->expectation, 0, -1);
        $this->expectationSnakeCase = \substr($this->expectationSnakeCase, 0, -1);
    }

    public function testDataType(): void
    {
        $dataType = StructFactory::create(DataType::class);
        self::assertInstanceOf(DataType::class, $dataType);
    }

    public function testFullSerialize(): void
    {
        $companyJson = StructSerializing::serializeToJson($this->company);
        self::assertSame($this->expectation, $companyJson);
    }

    public function testFullSerializeSnakeCase(): void
    {
        $companyJson = StructSerializing::serializeToJson($this->company, KeyConvert::snakeCase);
        self::assertSame($this->expectationSnakeCase, $companyJson);
    }

    public function testFullUnSerialize(): void
    {
        $companyArrayExpectation = StructSerializing::serialize($this->company);
        /** @var Company $companyUnSerialize */
        $companyUnSerialize = StructSerializing::deserialize($companyArrayExpectation, Company::class);
        self::assertSame($this->company->name, $companyUnSerialize->name);
    }

    public function testFullUnSerializeSnakeCase(): void
    {
        $companyUnSerialize = StructSerializing::deserializeFromJson($this->expectationSnakeCase, Company::class, KeyConvert::snakeCase);
        $companyJson = StructSerializing::serializeToJson($companyUnSerialize);
        self::assertSame($this->expectation, $companyJson);
    }

    public function testInvalidValueException(): void
    {
        $wrong = new Wrong();
        $this->expectException(InvalidStructException::class);
        StructSerializing::serialize($wrong);
    }

    public function testDeserializeFromJsonBadType(): StructInterface
    {
        $this->expectException(InvalidValueException::class);
        return StructSerializing::deserializeFromJson($this->expectation, 'ImNotAnStructure'); // @phpstan-ignore-line
    }

    public function testDeserializeFromJson(): void
    {
        $company = StructSerializing::deserializeFromJson($this->expectation, Company::class);
        self::assertInstanceOf(Company::class, $company);
    }

    public function testDeserializeObject(): void
    {
        $company = StructSerializing::deserialize($this->company, Company::class);
        self::assertInstanceOf(Company::class, $company);
    }
}
