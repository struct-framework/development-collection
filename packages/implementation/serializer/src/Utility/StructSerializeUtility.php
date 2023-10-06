<?php

declare(strict_types=1);

namespace Struct\Serializer\Utility;

use Struct\Contracts\Serializer\StructSerializerInterface;
use Struct\Contracts\StructInterface;
use Struct\Exception\UnexpectedException;
use Struct\Serializer\Private\Utility\SerializeUtility;
use Struct\Serializer\Private\Utility\UnSerializeUtility;

class StructSerializeUtility implements StructSerializerInterface
{
    protected SerializeUtility $serializeUtility;
    protected UnSerializeUtility $unSerializeUtility;

    public function __construct()
    {
        $this->serializeUtility = new SerializeUtility();
        $this->unSerializeUtility = new UnSerializeUtility();
    }

    /**
     * @return mixed[]
     */
    public function serialize(StructInterface $structure): array
    {
        return $this->serializeUtility->serialize($structure);
    }

    public function deserialize(object|array $data, string $type): StructInterface
    {
        return $this->unSerializeUtility->unSerialize($data, $type);
    }

    public function serializeToJson(StructInterface $structure): string
    {
        $dataArray = $this->serialize($structure);
        $dataJson = \json_encode($dataArray, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        if ($dataJson === false) {
            throw new UnexpectedException(1675972511);
        }
        return $dataJson;
    }

    public function deserializeFromJson(string $dataJson, string $type): StructInterface
    {
        try {
            /** @var mixed[] $dataArray */
            $dataArray = \json_decode($dataJson, true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException $exception) {
            throw new \LogicException('Can not parse the given JSON string', 1675972764, $exception);
        }
        return $this->unSerializeUtility->unSerialize($dataArray, $type);
    }
}
