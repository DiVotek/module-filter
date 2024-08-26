<?php

namespace Modules\Filter\Admin;

use App\Filament\Resources\TranslateResource\RelationManagers\TranslatableRelationManager;
use Filament\Resources\RelationManagers\RelationGroup;
use Filament\Tables\Actions\Action;
use Modules\Filter\Admin\SeoFilterResource\Pages;
use App\Services\Schema;
use App\Services\TableSchema;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Modules\Filter\Models\SeoFilter;
use Modules\Seo\Admin\SeoResource\Pages\SeoRelationManager;

class SeoFilterResource extends Resource
{
    protected static ?string $model = SeoFilter::class;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationGroup(): ?string
    {
        return __('Filter');
    }

    public static function getModelLabel(): string
    {
        return __('SEO filter');
    }

    public static function getPluralModelLabel(): string
    {
        return __('SEO filters');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Schema::getName(),
                        Schema::getOldUrl(),
                        Schema::getNewUrl(),
                        Schema::getStatus()
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TableSchema::getName(),
                TableSchema::getStatus(),
                TableSchema::getUpdatedAt()
            ])
            ->headerActions([
                Schema::helpAction('Seo filter help'),
            ])
            ->reorderable('sorting')
            ->filters([
                TableSchema::getFilterStatus(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationGroup::make('Seo and translates', [
                TranslatableRelationManager::class,
                SeoRelationManager::class,
            ]),
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSeoFilters::route('/'),
            'create' => Pages\CreateSeoFilter::route('/create'),
            'edit' => Pages\EditSeoFilter::route('/{record}/edit'),
        ];
    }
}
