<?php

declare(strict_types=1);

namespace Struct\Operator\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Struct\DataType\Month;
use Struct\Operator\O;

class CompareTest extends TestCase
{
    public function testEquals(): void
    {
        $moth01 = new Month('2023-10');
        $moth02 = new Month('2023-10');
        $moth03 = new Month('2023-08');

        self::assertTrue(O::equals($moth01, $moth02));
        self::assertFalse(O::equals($moth01, $moth03));
    }

    public function testNotEquals(): void
    {
        $moth01 = new Month('2023-10');
        $moth02 = new Month('2023-10');
        $moth03 = new Month('2023-08');

        self::assertFalse(O::notEquals($moth01, $moth02));
        self::assertTrue(O::notEquals($moth01, $moth03));
    }

    public function testLessThan(): void
    {
        $moth01 = new Month('2023-10');
        $moth02 = new Month('2023-10');
        $moth03 = new Month('2023-08');

        self::assertFalse(O::lessThan($moth01, $moth02));
        self::assertFalse(O::lessThan($moth01, $moth03));
        self::assertTrue(O::lessThan($moth03, $moth01));
    }

    public function testGreaterThan(): void
    {
        $moth01 = new Month('2023-10');
        $moth02 = new Month('2023-10');
        $moth03 = new Month('2023-08');

        self::assertFalse(O::greaterThan($moth01, $moth02));
        self::assertTrue(O::greaterThan($moth01, $moth03));
        self::assertFalse(O::greaterThan($moth03, $moth01));
    }

    public function testLessThanOrEquals(): void
    {
        $moth01 = new Month('2023-10');
        $moth02 = new Month('2023-10');
        $moth03 = new Month('2023-08');

        self::assertTrue(O::lessThanOrEquals($moth01, $moth02));
        self::assertFalse(O::lessThanOrEquals($moth01, $moth03));
        self::assertTrue(O::lessThanOrEquals($moth03, $moth01));
    }

    public function testGreaterThanOrEquals(): void
    {
        $moth01 = new Month('2023-10');
        $moth02 = new Month('2023-10');
        $moth03 = new Month('2023-08');

        self::assertTrue(O::greaterThanOrEquals($moth01, $moth02));
        self::assertTrue(O::greaterThanOrEquals($moth01, $moth03));
        self::assertFalse(O::greaterThanOrEquals($moth03, $moth01));
    }
}
