<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Actions\Action;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([
                    Step::make('Product Info')
                        ->description('Fill all the fields')
                        ->schema([
                            Group::make()->schema([
                                TextInput::make('name')->placeholder('Product Name...')->rule('required'),
                                TextInput::make('sku')->placeholder('Product Sku...')->rule('required')->unique(),
                            ])->columns(2),

                            RichEditor::make('description')
                                ->placeholder('Discription')
                                ->extraAttributes(['style' => 'min-height:300px'])
                                ->fileAttachmentsDisk('public')
                                ->fileAttachmentsDirectory('products'),
                        ]),

                    Step::make('Pricing & Stock')
                        ->description('Fill price and stock')
                        ->schema([
                            Group::make()->schema([
                                TextInput::make('price')->placeholder('0.0')->rule('required')->numeric()->step(0.2),
                                TextInput::make('stock')->placeholder('0')->rule('required')->numeric(),
                            ])->columns(2),

                        ]),

                    Step::make('Media & Status')
                        ->description('Fill media and status')
                        ->schema([
                            FileUpload::make('image')->disk('public')->directory('products'),
                            Checkbox::make('is_active'),
                            Checkbox::make('is_featured'),

                        ]),
                ])
                    ->columnSpanFull()
                    ->submitAction(
                        Action::make('save')
                            ->label('Save Product')
                            ->button()
                            ->color('primary')
                            ->submit('save')
                    ),

            ]);
    }
}
