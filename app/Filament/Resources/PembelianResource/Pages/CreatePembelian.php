<?php

namespace App\Filament\Resources\PembelianResource\Pages;

use App\Filament\Resources\PembelianResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePembelian extends CreateRecord
{
    protected static string $resource = PembelianResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['total_harga'] = $data['jumlah'] * $data['harga_satuan'];
        return $data;
    }
}
