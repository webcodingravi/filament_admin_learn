<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()
                    ->schema([
                        Section::make()
                            ->schema([
                                TextInput::make('name')->placeholder('Enter Category Name....')
                                    ->rules('required|max:288')
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))
                                    ),
                                TextInput::make('slug')
                                    ->readOnly()
                                    ->unique()
                                    ->rule('required')
                                    ->placeholder('Enter Slug...'),

                            ])->columns(2),

                    ])->columnSpanFull(),
            ]);
    }
}
