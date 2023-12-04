<?php

declare(strict_types=1);

namespace Struct\TestData\Fixtures\Struct\Query;

enum TimeFilterType: string
{
    case Resource = 'resource';
    case ResourceEntity = 'resource-entity';
    case Project = 'project';
    case ProjectEntity = 'project-entity';
    case Type = 'type';
    case Task = 'task';
}
