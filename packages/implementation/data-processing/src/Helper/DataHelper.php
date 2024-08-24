<?php

declare(strict_types=1);

namespace Struct\DataProcessing\Helper;

use Exception\Unexpected\UnexpectedException;
use Struct\Contracts\DataTypeInterface;

final readonly class DataHelper
{
    public static function toFullyQualifiedString(
        int|float|bool|null|string|\DateTimeInterface|DataTypeInterface|\UnitEnum $value
    ): string {
        $prefix = self::readPrefix($value);
        $valueAsString = self::toString($value);
        $fullyQualifiedString = $prefix . ':' . $valueAsString;
        return $fullyQualifiedString;
    }

    public static function toString(
        int|float|bool|null|string|\DateTimeInterface|DataTypeInterface|\UnitEnum $value
    ): string {
        if ($value instanceof \DateTimeInterface) {
            return $value->format('c');
        }
        if ($value === null) {
            return 'null';
        }
        if ($value === true) {
            return 'true';
        }
        if ($value === false) {
            return 'false';
        }
        if ($value instanceof \BackedEnum) {
            return (string) $value->value;
        }
        if ($value instanceof \UnitEnum) {
            return $value->name;
        }
        return (string) $value;
    }

    public static function readPrefix(
        int|float|bool|string|null|\DateTimeInterface|DataTypeInterface|\UnitEnum $value
    ): string {
        if (is_int($value) === true) {
            return 'int';
        }
        if (is_float($value) === true) {
            return 'float';
        }
        if (is_bool($value) === true) {
            return 'bool';
        }
        if (is_string($value) === true) {
            return 'string';
        }
        if (is_null($value) === true) {
            return 'null';
        }
        if ($value instanceof \DateTimeInterface) {
            return 'dateTime';
        }
        if ($value instanceof DataTypeInterface) {
            $className = $value::class;
            if (\str_starts_with($className, 'Struct\DataType') === true) {
                $className = substr($className, 16);
            }
            return $className;
        }
        if ($value instanceof \UnitEnum) {
            $className = $value::class;
            return $className;
        }
        throw new UnexpectedException(1724323899);
    }
}
