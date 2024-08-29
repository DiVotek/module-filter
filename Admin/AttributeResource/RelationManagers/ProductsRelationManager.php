<?php

namespace Modules\Filter\Admin\AttributeResource\RelationManagers;

use App\Models\Language;
use App\Services\Schema;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Modules\Product\Admin\ProductResource;
use Modules\Product\Models\Product;

class ProductsRelationManager extends RelationManager
{
    protected static string $relationship = 'products';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public function table(Table $table): Table
    {
        $language = Hidden::make('language_id');
        if (is_multi_lang()) {
            $language = Schema::getSelect('language_id', Language::query()->pluck('name', 'id')->toArray() ?? []);
        }
        $language = $language->default(main_lang_id());

        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->url(fn ($record): string => ProductResource::getUrl('edit', ['record' => $record->id])),
                Tables\Columns\TextColumn::make('value')
                    ->formatStateUsing(function ($record) {
                        return $record->pivot->value;
                    }),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()
                    ->preloadRecordSelect()
                    ->recordSelectOptionsQuery(fn (Builder $query) => $query->orderBy('name'))
                    ->recordSelectSearchColumns(['name'])
                    ->form([
                        $language,
                        Hidden::make('attribute_id')->default(fn () => $this->ownerRecord->id),
                        Schema::getSelect('product_id', Product::query()->pluck('name', 'id')->toArray() ?? []),
                        TextInput::make('value')->string()->required(),
                    ])
                    ->action(function ($record, $data) {
                        DB::table('attribute_products')->insert([
                            'product_id' => $data['product_id'],
                            'attribute_id' => $data['attribute_id'],
                            'language_id' => $data['language_id'],
                            'value' => $data['value'],
                        ]);
                    })
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label(__('Edit'))
                    ->modalHeading(__('Edit record'))
                    ->modalWidth('lg')
                    ->form([
                        TextInput::make('value')
                    ])
                    ->action(function ($record, $data) {
                        DB::table('attribute_products')
                            ->where('product_id', $record->pivot->product_id)
                            ->where('attribute_id', $record->pivot->attribute_id)
                            ->where('language_id', $record->pivot->language_id)
                            ->update([
                                'value' => $data['value'],
                            ]);
                    }),
                Tables\Actions\DetachAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
