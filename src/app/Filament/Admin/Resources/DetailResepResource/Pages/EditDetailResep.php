<?php

namespace App\Filament\Admin\Resources\DetailResepResource\Pages;

use App\Filament\Admin\Resources\DetailResepResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDetailResep extends EditRecord
{
    protected static string $resource = DetailResepResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
