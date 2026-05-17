<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PembayaranResource\Pages;
use App\Models\Pembayaran;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PembayaranResource extends Resource
{
    protected static ?string $model = Pembayaran::class;

    protected static ?string $navigationGroup = 'Keuangan';
    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    protected static ?string $navigationLabel = 'Pembayaran';
    protected static ?string $modelLabel = 'Pembayaran';
    protected static ?string $pluralModelLabel = 'Data Pembayaran';
    protected static ?int $navigationSort = 1;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Data Pembayaran')
                    ->schema([
                        Forms\Components\Select::make('pasien_id')
                            ->label('Pasien')
                            ->relationship('pasien', 'nama')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Forms\Components\Select::make('pendaftaran_id')
                            ->label('Pendaftaran')
                            ->relationship('pendaftaran', 'id')
                            ->getOptionLabelFromRecordUsing(fn ($record) =>
                                "{$record->pasien->nama} - {$record->tanggal_daftar} - {$record->keluhan}"
                            )
                            ->searchable()
                            ->preload()
                            ->required(),

                        Forms\Components\Select::make('metode_pembayaran')
                            ->label('Metode Pembayaran')
                            ->options([
                                'Cash' => 'Cash',
                                'Transfer' => 'Transfer',
                                'QRIS' => 'QRIS',
                            ])
                            ->native(false)
                            ->required(),

                        Forms\Components\TextInput::make('total_bayar')
                            ->label('Total Bayar')
                            ->required()
                            ->numeric()
                            ->prefix('Rp')
                            ->minValue(0),

                        Forms\Components\Select::make('status_pembayaran')
                            ->label('Status Pembayaran')
                            ->options([
                                'Belum Bayar' => 'Belum Bayar',
                                'Lunas' => 'Lunas',
                            ])
                            ->default('Belum Bayar')
                            ->native(false)
                            ->required(),

                        Forms\Components\DatePicker::make('tanggal_pembayaran')
                            ->label('Tanggal Pembayaran')
                            ->default(now())
                            ->native(false)
                            ->required(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('pasien.nama')
                    ->label('Nama Pasien')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('pendaftaran.tanggal_daftar')
                    ->label('Tanggal Daftar')
                    ->date('d M Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('pendaftaran.keluhan')
                    ->label('Keluhan')
                    ->limit(35)
                    ->toggleable(),

                Tables\Columns\TextColumn::make('metode_pembayaran')
                    ->label('Metode')
                    ->badge(),

                Tables\Columns\TextColumn::make('total_bayar')
                    ->label('Total Bayar')
                    ->money('IDR')
                    ->sortable(),

                Tables\Columns\TextColumn::make('status_pembayaran')
                    ->label('Status')
                    ->badge(),

                Tables\Columns\TextColumn::make('tanggal_pembayaran')
                    ->label('Tanggal Bayar')
                    ->date('d M Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diubah')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status_pembayaran')
                    ->label('Status Pembayaran')
                    ->options([
                        'Belum Bayar' => 'Belum Bayar',
                        'Lunas' => 'Lunas',
                    ]),

                Tables\Filters\SelectFilter::make('metode_pembayaran')
                    ->label('Metode Pembayaran')
                    ->options([
                        'Cash' => 'Cash',
                        'Transfer' => 'Transfer',
                        'QRIS' => 'QRIS',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('tanggal_pembayaran', 'desc');
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
            'index' => Pages\ListPembayarans::route('/'),
            'create' => Pages\CreatePembayaran::route('/create'),
            'edit' => Pages\EditPembayaran::route('/{record}/edit'),
        ];
    }
}