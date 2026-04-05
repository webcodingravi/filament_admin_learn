<?php

namespace App\Filament\Resources\Posts\Pages;

use App\Filament\Resources\Posts\PostResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePost extends CreateRecord
{
    protected static string $resource = PostResource::class;


    public function canCreateAnother(): bool
    {
        return false;
    }

    public function getBreadcrumbs(): array
    {
        return [];
    }

    public function getRedirectUrl(): string
    {
        return parent::getResource()::getUrl('index');
    }

}
