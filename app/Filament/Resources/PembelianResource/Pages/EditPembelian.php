<?php

namespace App\Filament\Resources\PembelianResource\Pages;

use App\Filament\Resources\PembelianResource;
use Filament\Resources\Pages\EditRecord;

class EditPembelian extends EditRecord
{
    protected static string $resource = PembelianResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['total_harga'] = $data['jumlah'] * $data['harga_satuan'];
        return $data;
    }
}
