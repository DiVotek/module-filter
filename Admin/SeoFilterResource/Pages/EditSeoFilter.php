<?php

namespace Modules\Filter\Admin\SeoFilterResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Modules\Filter\Admin\SeoFilterResource;

class EditSeoFilter extends EditRecord
{
    protected static string $resource = SeoFilterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
