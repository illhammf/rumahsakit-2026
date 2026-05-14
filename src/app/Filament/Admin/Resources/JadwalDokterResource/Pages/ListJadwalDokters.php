<?php

namespace App\Filament\Admin\Resources\JadwalDokterResource\Pages;

use App\Filament\Admin\Resources\JadwalDokterResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJadwalDokters extends ListRecords
{
    protected static string $resource = JadwalDokterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
