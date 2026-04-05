<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Str;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()->schema([
                    Section::make('Fields')
                        ->description('Fill all the fields')
                        ->icon(Heroicon::RocketLaunch)
                        ->schema([

                            Group::make()->schema([
                                TextInput::make('title')->placeholder('Title..')
                                    ->rules('required|string|max:288')
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                                TextInput::make('slug')->placeholder('slug...')
                                    ->unique()
                                    ->rule('required')
                                    ->readOnly(),

                                ColorPicker::make('color')->placeholder('Color Pick...'),
                                Select::make('category_id')
                                    ->relationship('category', 'name')
                                    ->rule('required')
                                    ->label('Category'),

                            ])->columns(2),

                            RichEditor::make('content')
                                ->fileAttachmentsDisk('public')
                                ->fileAttachmentsDirectory('posts')
                                ->extraAttributes(['style' => 'min-height:300px;'])
                                ->placeholder('Content...'),
                        ]),

                ])->columnSpan(2),
                Group::make()->schema([
                    Section::make('Image')->schema([
                        FileUpload::make('image')->disk('public')->directory('posts'),
                    ]),

                    Section::make('Meta')->schema([
                        TagsInput::make('tags')->rule('required'),
                        Checkbox::make('published'),
                        DatePicker::make('published_at')->minDate(now())->label('Published Date'),
                    ]),

                ])->columnSpan(1),

            ])->columns(3);
    }
}
