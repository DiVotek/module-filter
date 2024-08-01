<?php

namespace Modules\Filter\Admin\SeoFilterResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Modules\Filter\Admin\SeoFilterResource;

class ListSeoFilters extends ListRecords
{
    protected static string $resource = SeoFilterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
