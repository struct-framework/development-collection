<?php

declare(strict_types=1);

namespace Struct\serializing\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Struct\Contracts\StructInterface;
use Struct\Exception\InvalidStructException;
use Struct\Exception\InvalidValueException;
use Struct\Serializing\Enum\KeyConvert;
use Struct\Serializing\StructSerializer;
use Struct\Struct\Factory\StructFactory;
use Struct\Struct\StructHash;
use Struct\TestData\Fixtures\Struct\Company;
use Struct\TestData\Fixtures\Struct\DataType;
use Struct\TestData\Fixtures\Struct\RoleCollection;
use Struct\TestData\Fixtures\Struct\Wrong;
use Struct\TestData\Preparer\CompanyPreparer;
use Struct\TestData\Preparer\StructCollectionPreparer;

class StructSerializerTest extends TestCase
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
    }

    public function testDataType(): void
    {
        $dataType = StructFactory::create(DataType::class);
        self::assertInstanceOf(DataType::class, $dataType);
    }

    public function testFullSerialize(): void
    {
        $companyJson = StructSerializer::serializeToJson($this->company);
        self::assertSame($this->expectation, $companyJson);
    }

    public function testFullSerializeSnakeCase(): void
    {
        $companyJson = StructSerializer::serializeToJson($this->company, KeyConvert::snakeCase);
        self::assertSame($this->expectationSnakeCase, $companyJson);
    }

    public function testFullUnSerialize(): void
    {
        $companyArrayExpectation = StructSerializer::serialize($this->company);
        $companyUnSerialize = StructSerializer::deserialize($companyArrayExpectation, Company::class);

        $hashExpectation = StructHash::buildHash($this->company);
        $hash = StructHash::buildHash($companyUnSerialize);
        self::assertSame(bin2hex($hashExpectation), bin2hex($hash));
    }

    public function testFullUnSerializeSnakeCase(): void
    {
        $companyUnSerialize = StructSerializer::deserializeFromJson($this->expectationSnakeCase, Company::class, KeyConvert::snakeCase);
        $companyJson = StructSerializer::serializeToJson($companyUnSerialize);
        self::assertSame($this->expectation, $companyJson);
    }

    public function testInvalidValueException(): void
    {
        $wrong = new Wrong();
        $this->expectException(InvalidStructException::class);
        StructSerializer::serialize($wrong);
    }

    public function testDeserializeFromJsonBadType(): StructInterface
    {
        $this->expectException(InvalidValueException::class);
        return StructSerializer::deserializeFromJson($this->expectation, 'ImNotAnStructure'); // @phpstan-ignore-line
    }

    public function testDeserializeFromJson(): void
    {
        $company = StructSerializer::deserializeFromJson($this->expectation, Company::class);
        self::assertInstanceOf(Company::class, $company);
    }

    public function testDeserializeObject(): void
    {
        $companyDeSerialize = StructSerializer::deserialize($this->company, Company::class);

        $hashExpectation = StructHash::buildHash($this->company);
        $hash = StructHash::buildHash($companyDeSerialize);
        self::assertSame(bin2hex($hashExpectation), bin2hex($hash));
    }

    public function testBuildHashStructCollection(): void
    {
        $structCollectionPreparer = new StructCollectionPreparer();
        $structCollection = $structCollectionPreparer->buildStructCollection();

        $serializedStructCollection = StructSerializer::serialize($structCollection);
        $unSerializeStructCollection = StructSerializer::deserialize($serializedStructCollection, RoleCollection::class);

        $hashExpectation = StructHash::buildHash($structCollection);
        $hash = StructHash::buildHash($unSerializeStructCollection);
        self::assertSame(bin2hex($hashExpectation), bin2hex($hash));
    }
}
