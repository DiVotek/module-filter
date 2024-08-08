<?php

namespace Modules\Filter\Admin;

use App\Filament\Resources\TranslateResource\RelationManagers\TranslatableRelationManager;
use Filament\Forms\Components\Fieldset;
use Filament\Resources\RelationManagers\RelationGroup;
use Filament\Tables\Actions\Action;
use Modules\Filter\Admin\AttributeResource\Pages;
use App\Services\Schema;
use App\Services\TableSchema;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Modules\Filter\Models\Attribute;

class AttributeResource extends Resource
{
    protected static ?string $model = Attribute::class;

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
        return __('Attribute');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Attributes');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Schema::getName(),
                        Schema::getSorting(),
                        Schema::getImage()
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TableSchema::getName(),
                TableSchema::getImage(),
                TableSchema::getSorting(),
                TableSchema::getUpdatedAt()
            ])
            ->headerActions([
                Action::make(__('Help'))
                    ->iconButton()
                    ->icon('heroicon-o-question-mark-circle')
                    ->modalDescription(__('Summary'))
                    ->modalFooterActions([]),

            ])
            ->reorderable('sorting')
            ->filters([
                TableSchema::getFilterStatus(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->headerActions([
                Tables\Actions\Action::make('Attribute')
                    ->slideOver()
                    ->icon('heroicon-o-cog')
                    ->modal()
                    ->fillForm(function (): array {
                        return [
                            'filter_attributes' => setting(config('settings.filter_attributes')),
                        ];
                    })
                    ->action(function (array $data): void {
                        setting([
                            config('settings.filter_attributes') => $data['filter_attributes'] ?? '',
                        ]);
                    })
                    ->form(function ($form) {
                        return $form
                            ->schema([
                                Section::make('')->schema([
                                    Schema::getSelect('attributes', Attribute::query()
                                        ->pluck('name', 'id')
                                        ->toArray() ?? []
                                    )->multiple()
                                ]),
                            ]);
                    }),
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
            ]),
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAttributes::route('/'),
            'create' => Pages\CreateAttribute::route('/create'),
            'edit' => Pages\EditAttribute::route('/{record}/edit'),
        ];
    }
}
