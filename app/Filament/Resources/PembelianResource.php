<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PembelianResource\Pages;
use App\Filament\Resources\PembelianResource\RelationManagers;
use App\Models\Pembelian;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PembelianResource extends Resource
{
    protected static ?string $model = Pembelian::class;

    protected static ?string $navigationGroup = 'Manajemen Inventori';
    
    protected static ?int $navigationSort = 1;


    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_produk')
                ->label('Nama Produk')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('jumlah')
                ->label('Jumlah')
                ->numeric()
                ->required(),
            Forms\Components\TextInput::make('harga_satuan')
                ->label('Harga Satuan')
                ->numeric()
                ->required(),
            Forms\Components\TextInput::make('total_harga')
                ->label('Total Harga')
                ->disabled() // Tidak dapat diisi langsung
                ->helperText('Total harga dihitung otomatis berdasarkan jumlah dan harga satuan.')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_produk')
                    ->label('Nama Produk'),
                Tables\Columns\TextColumn::make('jumlah')
                    ->label('Jumlah'),
                Tables\Columns\TextColumn::make('harga_satuan')
                    ->label('Harga Satuan')
                    ->money('IDR'),
                Tables\Columns\TextColumn::make('total_harga')
                    ->label('Total Harga')
                    ->money('IDR'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Pembelian')
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPembelians::route('/'),
            'create' => Pages\CreatePembelian::route('/create'),
            'edit' => Pages\EditPembelian::route('/{record}/edit'),
        ];
    }
}
