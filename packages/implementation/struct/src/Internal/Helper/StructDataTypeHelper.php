<?php

declare(strict_types=1);

namespace Struct\Struct\Internal\Helper;

use DateTimeInterface;
use IntBackedEnum;
use LogicException;
use Struct\Contracts\DataTypeInterface;
use Struct\Contracts\StructInterface;
use Struct\Reflection\Internal\Struct\ObjectSignature\Parts\NamedType;
use Struct\Struct\Internal\Struct\StructSignature\DataType\PhpDataType;
use Struct\Struct\Internal\Struct\StructSignature\DataType\StructUnderlyingDataType;
use UnitEnum;

/**
 * @internal
 */
class StructDataTypeHelper
{
    public static function findUnderlyingDataTypeFromValue(mixed $value): StructUnderlyingDataType
    {
        if($value === null) {
            throw new LogicException('Value must not be null', 1739024555);
        }
        if(is_array($value) === true) {
            if(array_is_list($value) === true) {
                return StructUnderlyingDataType::ArrayList;
            }
            return StructUnderlyingDataType::Array;
        }
        if(is_object($value) === true) {
            $result = self::checkForClassType($value);
            if($result !== null) {
                return $result;
            }
        }
        $dataType = gettype($value);
        $result = self::checkForBuildInType($dataType);
        if($result !== null) {
            return $result;
        }
        throw new LogicException('The type is not supported', 1739024555);
    }

    public static function findPhpDataType(StructUnderlyingDataType $structBaseDataType): PhpDataType
    {
        $phpDataType = match ($structBaseDataType) {
            StructUnderlyingDataType::Boolean => PhpDataType::Boolean,
            StructUnderlyingDataType::Integer,
            StructUnderlyingDataType::EnumInt => PhpDataType::Integer,
            StructUnderlyingDataType::Float => PhpDataType::Float,
            StructUnderlyingDataType::String,
            StructUnderlyingDataType::DateTime,
            StructUnderlyingDataType::DataType,
            StructUnderlyingDataType::Enum,
            StructUnderlyingDataType::EnumString => PhpDataType::String,
            StructUnderlyingDataType::Array => PhpDataType::Array,
            StructUnderlyingDataType::ArrayList,
            StructUnderlyingDataType::Struct => PhpDataType::ArrayList,
        };
        return $phpDataType;
    }

    public static function findUnderlyingDataType(string $dataType): StructUnderlyingDataType
    {
        $result = self::checkForClassType($dataType);
        if($result !== null) {
            return $result;
        }
        $result = self::checkForBuildInType($dataType);
        if($result !== null) {
            return $result;
        }
        throw new LogicException('The type: ' . $dataType . ' is not supported', 1738258655);
    }

    protected static function checkForClassType(object|string $dataType): ?StructUnderlyingDataType
    {
        if (is_a($dataType, IntBackedEnum::class, true) === true) {
            return StructUnderlyingDataType::EnumInt;
        }
        if (is_a($dataType, \StringBackedEnum::class, true) === true) {
            return StructUnderlyingDataType::EnumString;
        }
        if (is_a($dataType, UnitEnum::class, true) === true) {
            return StructUnderlyingDataType::Enum;
        }
        if (is_a($dataType, DataTypeInterface::class, true) === true) {
            return StructUnderlyingDataType::DataType;
        }
        if (is_a($dataType, StructInterface::class, true) === true) {
            return StructUnderlyingDataType::Struct;
        }
        if (is_a($dataType, DateTimeInterface::class, true) === true) {
            return StructUnderlyingDataType::DateTime;
        }
        return null;
    }

    protected static function checkForBuildInType(string $dataType): ?StructUnderlyingDataType
    {
        if ($dataType === 'array') {
            return StructUnderlyingDataType::Array;
        }
        if ($dataType === 'bool') {
            return StructUnderlyingDataType::Boolean;
        }
        if ($dataType === 'string') {
            return StructUnderlyingDataType::String;
        }
        if ($dataType === 'int') {
            return StructUnderlyingDataType::Integer;
        }
        if ($dataType === 'float') {
            return StructUnderlyingDataType::Float;
        }
        return null;
    }
}
