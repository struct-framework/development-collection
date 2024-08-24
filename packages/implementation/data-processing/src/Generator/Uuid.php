<?php

declare(strict_types=1);

namespace Struct\DataProcessing\Generator;

use Random\Engine\Secure;
use Random\Randomizer;
use Struct\DataProcessing\Exception\UuidException;


class Uuid
{

    public function isValidUuid(string $uuid): bool
    {
        try {
            $uuidBytes = self::uuidToBytes($uuid);
        } catch (UuidException) {
            return false;
        }
        return true;
    }

    public static function baseUuidToUuid(string $baseUuid): string
    {
        if (\strlen($baseUuid) !== 32) {
            throw new UuidException('Can not parse base UUID bytes: ' . $baseUuid . ' base UUID must be 32 characters long', 1721140551);
        }

        $uuid  = \substr($baseUuid, 0, 8);
        $uuid .= '-' . \substr($baseUuid, 8, 4);
        $uuid .= '-' . \substr($baseUuid, 12, 4);
        $uuid .= '-' . \substr($baseUuid, 16, 4);
        $uuid .= '-' . \substr($baseUuid, 20, 12);
        return $uuid;
    }

    public static function uuidToBytes(string $uuid): string
    {
        if (\strlen($uuid) !== 36) {
            throw new UuidException('Can not parse UUID: ' . $uuid . ' UUID must be 36 characters long', 1698696075);
        }

        $uuidHex = \str_replace('-', '', $uuid);
        $uuidBytes = \hex2bin($uuidHex);
        if ($uuidBytes === false) {
            throw new UuidException('Can not parse UUID: ' . $uuid . ' invalid hex characters', 1721140322);
        }

        if (\strlen($uuidBytes) !== 16) {
            throw new UuidException('Can not parse UUID: ' . $uuid . ' UUID bytes must be 16 characters long', 1721140325);
        }

        return $uuidBytes;
    }

    public static function byteUuidToBaseUuid(string $byteUuid): string
    {
        if (\strlen($byteUuid) !== 16) {
            throw new UuidException('Can not parse Byte-UUID: ' . $byteUuid . ' Byte-UUID must be 16 characters long', 1721140551);
        }

        $baseUuid = \bin2hex($byteUuid);
        return $baseUuid;
    }

    public static function byteUuidToUuid(string $byteUuid): string
    {
        $baseUuid = self::byteUuidToBaseUuid($byteUuid);
        $uuid = self::baseUuidToUuid($baseUuid);
        return $uuid;
    }

    public static function buildNamespacedUuid(string $namespace, string $name): string
    {
        $namespaceBytes = self::uuidToBytes($namespace);
        $baseUuidHash = \hash('sha1', $namespaceBytes . $name);
        $baseUuidRaw = substr($baseUuidHash, 0, 32);
        $baseUuid = self::setVersion($baseUuidRaw, '5');
        $uuid = self::baseUuidToUuid($baseUuid);
        return $uuid;
    }

    public static function buildRandomUuid(): string
    {
        $randomizer = new Randomizer(new Secure());
        $randomBytes = $randomizer->getBytes(16);
        $rawUuid = \bin2hex($randomBytes);
        $baseUuidWithVersion = self::setVersion($rawUuid, '4');

        $r = \substr($baseUuidWithVersion, 16, 1);
        if ($r === '0' || $r === '4' || $r === 'c') {
            $r = '8';
        }

        if ($r === '1' || $r === '5' || $r === 'd') {
            $r = '9';
        }

        if ($r === '2' || $r === '6' || $r === 'e') {
            $r = 'a';
        }

        if ($r === '3' || $r === '7' || $r === 'f') {
            $r = 'b';
        }

        $baseUuid  = \substr($baseUuidWithVersion, 0, 16);
        $baseUuid .= $r;
        $baseUuid .= \substr($baseUuidWithVersion, 17);

        $uuid = self::baseUuidToUuid($baseUuid);
        return $uuid;
    }

    protected static function setVersion(string $baseUuid, string $version): string
    {
        return \substr($baseUuid, 0, 12) . $version . \substr($baseUuid, 13);
    }

}
