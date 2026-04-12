<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('S.NO.')
                    ->rowIndex()
                    ->toggleable(),
                ImageColumn::make('image')->disk('public')->toggleable(),
                TextColumn::make('name')->searchable()->sortable()->toggleable(),
                TextColumn::make('sku')->searchable()->sortable()->toggleable(),
                TextColumn::make('created_at')->label('Created Date')->dateTime()->sortable()->toggleable(),
            ])->defaultSort('id', 'desc')
            ->filters([
                TrashedFilter::make('Trashed'),
                Filter::make('created_at')
                    ->label('creation_date')
                    ->schema([
                        DatePicker::make('created_at')
                            ->label('Select Date:'),
                    ])->query(function ($query, $data) {
                        return $query
                            ->when($data['created_at'], function ($q, $date) {
                                $q->whereDate('created_at', $date);
                            });
                    }),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
                RestoreAction::make(),
                ForceDeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                ]),
            ]);
    }
}
