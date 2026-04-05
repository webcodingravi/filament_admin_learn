<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class ProductInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Tabs')
                    ->tabs([
                        Tab::make('Product Info')
                            ->icon(Heroicon::AcademicCap)
                            ->schema([
                                TextEntry::make('name')
                                    ->label('Product Name')
                                    ->weight('bold')
                                    ->color('primary'),
                                TextEntry::make('sku')
                                    ->label('Product SKU')
                                    ->weight('bold')
                                    ->badge()
                                    ->color('success'),
                                TextEntry::make('description')
                                    ->weight('bold')
                                    ->html()
                                    ->color('primary'),

                                TextEntry::make('created_at')
                                    ->label('Product Creation Date')
                                    ->weight('bold')
                                    ->date()
                                    ->color('danger'),
                            ]),
                        Tab::make('Pricing & Stock')
                            ->icon(Heroicon::CurrencyRupee)
                            ->schema([
                                TextEntry::make('price')
                                    ->weight('bold')
                                    ->money('INR')
                                    ->color('primary'),
                                TextEntry::make('stock')
                                    ->weight('bold')->color('primary'),
                            ]),

                        Tab::make('Media & Status')
                            ->icon(Heroicon::Photo)
                            ->schema([
                                ImageEntry::make('image')->disk('public'),
                                IconEntry::make('is_active')
                                    ->label('Is Active ?')->boolean(),

                                IconEntry::make('is_featured')
                                    ->label('Is Featured ?')->boolean(),
                            ]),
                    ])->columnSpanFull()->vertical(),

            ]);
    }
}
