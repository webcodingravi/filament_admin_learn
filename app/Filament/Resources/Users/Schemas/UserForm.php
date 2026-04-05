<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()->schema([
                    Section::make()->schema([
                        TextInput::make('name')
                            ->placeholder('Enter Name...')
                            ->rules('required|string|max:248'),

                        TextInput::make('email')
                            ->placeholder('user@example.com')
                            ->rules('required|email')
                            ->unique(),

                        TextInput::make('password')
                            ->password()
                            ->placeholder('••••••••')
                            ->rules('required|min:6|max:10')
                            ->revealable()
                            ->confirmed(),

                        TextInput::make('password_confirmation')
                            ->password()
                            ->revealable()
                            ->placeholder('••••••••'),
                    ])->columns(2),

                ])->columnSpanFull(),

            ]);
    }
}
