<?php

declare(strict_types=1);

namespace Struct\Operator\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Struct\DataType\Month;
use Struct\Operator\Compare;

class CompareTest extends TestCase
{
    public function testEquals(): void
    {
        $moth01 = new Month('2023-10');
        $moth02 = new Month('2023-10');
        $moth03 = new Month('2023-08');

        self::assertTrue(Compare::equals($moth01, $moth02));
        self::assertFalse(Compare::equals($moth01, $moth03));
    }

    public function testNotEquals(): void
    {
        $moth01 = new Month('2023-10');
        $moth02 = new Month('2023-10');
        $moth03 = new Month('2023-08');

        self::assertFalse(Compare::notEquals($moth01, $moth02));
        self::assertTrue(Compare::notEquals($moth01, $moth03));
    }

    public function testLessThan(): void
    {
        $moth01 = new Month('2023-10');
        $moth02 = new Month('2023-10');
        $moth03 = new Month('2023-08');

        self::assertFalse(Compare::lessThan($moth01, $moth02));
        self::assertFalse(Compare::lessThan($moth01, $moth03));
        self::assertTrue(Compare::lessThan($moth03, $moth01));
    }

    public function testGreaterThan(): void
    {
        $moth01 = new Month('2023-10');
        $moth02 = new Month('2023-10');
        $moth03 = new Month('2023-08');

        self::assertFalse(Compare::greaterThan($moth01, $moth02));
        self::assertTrue(Compare::greaterThan($moth01, $moth03));
        self::assertFalse(Compare::greaterThan($moth03, $moth01));
    }

    public function testLessThanOrEquals(): void
    {
        $moth01 = new Month('2023-10');
        $moth02 = new Month('2023-10');
        $moth03 = new Month('2023-08');

        self::assertTrue(Compare::lessThanOrEquals($moth01, $moth02));
        self::assertFalse(Compare::lessThanOrEquals($moth01, $moth03));
        self::assertTrue(Compare::lessThanOrEquals($moth03, $moth01));
    }

    public function testGreaterThanOrEquals(): void
    {
        $moth01 = new Month('2023-10');
        $moth02 = new Month('2023-10');
        $moth03 = new Month('2023-08');

        self::assertTrue(Compare::greaterThanOrEquals($moth01, $moth02));
        self::assertTrue(Compare::greaterThanOrEquals($moth01, $moth03));
        self::assertFalse(Compare::greaterThanOrEquals($moth03, $moth01));
    }
}
