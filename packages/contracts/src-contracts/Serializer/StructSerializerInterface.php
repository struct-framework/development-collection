<?php

declare(strict_types=1);

namespace Struct\Contracts\Serializer;

use Struct\Contracts\StructInterface;

interface StructSerializerInterface
{
    /**
     * @param StructInterface $structure
     * @return mixed[]
     */
    public function serialize(StructInterface $structure): array;

    /**
     * @param mixed[] $data
     * @param class-string<StructInterface> $type
     * @return StructInterface
     */
    public function deserialize(array $data, string $type): StructInterface;

    /**
     * @param StructInterface $structure
     * @return string
     */
    public function serializeToJson(StructInterface $structure): string;

    /**
     * @param string $dataJson
     * @param class-string<StructInterface> $type
     * @return StructInterface
     */
    public function deserializeFromJson(string $dataJson, string $type): StructInterface;
}
