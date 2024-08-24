<?php

declare(strict_types=1);

namespace Struct\DataProcessing\Helper;

use Struct\DataProcessing\Generator\Uuid;
use Struct\DataProcessing\ObjectType\EntityObject;
use Struct\DataProcessing\ObjectType\ReferenceObject;
use Struct\DataProcessing\ObjectType\ValueObject;
use Struct\Struct\StructHashUtility;

final readonly class ObjectHelper
{

    public static function readIdentifier(EntityObject|ValueObject|ReferenceObject $object): string
    {
        if($object instanceof ReferenceObject) {
            $identifier =  $object->identifier;
        }
        if($object instanceof EntityObject) {
            $identifier = $object->identifier;
        }
        if($object instanceof ValueObject) {
            $hash = StructHashUtility::buildHash($object);
            $identifier =  Uuid::buildNamespacedUuid('bc19486a-3218-4dcd-8fa9-46a15a3d7ebd', $hash);
        }
        return $identifier;
    }
}
