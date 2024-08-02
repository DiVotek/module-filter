<?php

namespace Modules\Filter\Admin\AttributeResource\Pages;

use Modules\Filter\Admin\AttributeResource;
use Filament\Resources\Pages\CreateRecord;

class CreateAttribute extends CreateRecord
{
    protected static string $resource = AttributeResource::class;
}
