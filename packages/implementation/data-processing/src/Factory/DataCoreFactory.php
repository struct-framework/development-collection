<?php

declare(strict_types=1);

namespace Struct\DataProcessing\Factory;

use Struct\DataProcessing\DataCore;
use Struct\DataProcessing\Internal\Well;

final class DataCoreFactory
{

    protected static ?DataCore $dataCore = null;

    public static function build(): DataCore
    {
        $dataCore = new DataCore(new Well());
        return $dataCore;
    }

    public static function buildSingleton(): DataCore
    {
        if(self::$dataCore === null) {
            self::$dataCore = self::build();
        }
        return self::$dataCore;
    }
}
