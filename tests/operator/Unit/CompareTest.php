<?php

declare(strict_types=1);

namespace Struct\Operator\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Struct\DataType\Month;
use Struct\Exception\Operator\DataTypeException;
use Struct\Operator\O;
use Struct\TestData\Fixtures\Struct\Enum\Category;

class CompareTest extends TestCase
{
    public function testEquals(): void
    {
        $moth01 = new Month('2023-10');
        $moth02 = new Month('2023-10');
        $moth03 = new Month('2023-08');

        self::assertTrue(O::equals($moth01, $moth02));
        self::assertFalse(O::equals($moth01, $moth03));

        self::assertTrue(O::equals(55, 55));
        self::assertTrue(O::equals(55.3, 55.3));
        self::assertTrue(O::equals('bla', 'bla'));
        self::assertTrue(O::equals(Category::Technology, Category::Technology));

        self::assertFalse(O::equals(55, 56));
        self::assertFalse(O::equals(55.3, 56.3));
        self::assertFalse(O::equals('bla', 'blu'));
        self::assertFalse(O::equals(Category::Technology, Category::Healthcare));
    }

    public function testNotEquals(): void
    {
        $moth01 = new Month('2023-10');
        $moth02 = new Month('2023-10');
        $moth03 = new Month('2023-08');

        self::assertFalse(O::notEquals($moth01, $moth02));
        self::assertTrue(O::notEquals($moth01, $moth03));

        self::assertFalse(O::notEquals(55, 55));
        self::assertFalse(O::notEquals(55.3, 55.3));
        self::assertFalse(O::notEquals('bla', 'bla'));
        self::assertFalse(O::notEquals(Category::Technology, Category::Technology));

        self::assertTrue(O::notEquals(55, 56));
        self::assertTrue(O::notEquals(55.3, 56.3));
        self::assertTrue(O::notEquals('bla', 'blu'));
        self::assertTrue(O::notEquals(Category::Technology, Category::Healthcare));
    }

    public function testLessThan(): void
    {
        $moth01 = new Month('2023-10');
        $moth02 = new Month('2023-10');
        $moth03 = new Month('2023-08');

        self::assertFalse(O::lessThan($moth01, $moth02));
        self::assertFalse(O::lessThan($moth01, $moth03));
        self::assertTrue(O::lessThan($moth03, $moth01));

        self::assertTrue(O::lessThan(10, 20));
        self::assertFalse(O::lessThan(20, 20));
        self::assertFalse(O::lessThan(20, 10));
    }

    public function testGreaterThan(): void
    {
        $moth01 = new Month('2023-10');
        $moth02 = new Month('2023-10');
        $moth03 = new Month('2023-08');

        self::assertFalse(O::greaterThan($moth01, $moth02));
        self::assertTrue(O::greaterThan($moth01, $moth03));
        self::assertFalse(O::greaterThan($moth03, $moth01));

        self::assertTrue(O::greaterThan(20, 10));
        self::assertFalse(O::greaterThan(20, 20));
        self::assertFalse(O::greaterThan(10, 20));
    }

    public function testLessThanOrEquals(): void
    {
        $moth01 = new Month('2023-10');
        $moth02 = new Month('2023-10');
        $moth03 = new Month('2023-08');

        self::assertTrue(O::lessThanOrEquals($moth01, $moth02));
        self::assertFalse(O::lessThanOrEquals($moth01, $moth03));
        self::assertTrue(O::lessThanOrEquals($moth03, $moth01));

        self::assertTrue(O::lessThanOrEquals(10, 20));
        self::assertTrue(O::lessThanOrEquals(20, 20));
        self::assertFalse(O::lessThanOrEquals(20, 10));
    }

    public function testGreaterThanOrEquals(): void
    {
        $moth01 = new Month('2023-10');
        $moth02 = new Month('2023-10');
        $moth03 = new Month('2023-08');

        self::assertTrue(O::greaterThanOrEquals($moth01, $moth02));
        self::assertTrue(O::greaterThanOrEquals($moth01, $moth03));
        self::assertFalse(O::greaterThanOrEquals($moth03, $moth01));

        self::assertTrue(O::greaterThanOrEquals(20, 10));
        self::assertTrue(O::greaterThanOrEquals(20, 20));
        self::assertFalse(O::greaterThanOrEquals(10, 20));
    }

    public function testDataTypeException(): void
    {
        $moth01 = new Month('2023-10');
        self::expectException(DataTypeException::class);
        O::equals($moth01, 'dsgsdg');
    }
}
