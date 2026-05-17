<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\RekamMedisResource\Pages;
use App\Models\RekamMedis;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class RekamMedisResource extends Resource
{
    protected static ?string $model = RekamMedis::class;

    protected static ?string $navigationGroup = 'Pelayanan Pasien';
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Rekam Medis';
    protected static ?string $modelLabel = 'Rekam Medis';
    protected static ?string $pluralModelLabel = 'Data Rekam Medis';
    protected static ?int $navigationSort = 3;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Data Rekam Medis')
                    ->schema([
                        Forms\Components\Select::make('pasien_id')
                            ->label('Pasien')
                            ->relationship('pasien', 'nama')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Forms\Components\Select::make('dokter_id')
                            ->label('Dokter')
                            ->relationship('dokter', 'nama')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Forms\Components\Select::make('pemeriksaan_id')
                            ->label('Data Pemeriksaan')
                            ->relationship('pemeriksaan', 'id')
                            ->getOptionLabelFromRecordUsing(fn ($record) =>
                                "{$record->pendaftaran->pasien->nama} - {$record->dokter->nama} - {$record->created_at->format('d M Y')}"
                            )
                            ->searchable()
                            ->preload()
                            ->required(),

                        Forms\Components\Textarea::make('diagnosa')
                            ->label('Diagnosa')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),

                        Forms\Components\Textarea::make('tindakan')
                            ->label('Tindakan')
                            ->rows(4)
                            ->columnSpanFull(),

                        Forms\Components\Textarea::make('catatan')
                            ->label('Catatan Tambahan')
                            ->rows(4)
                            ->columnSpanFull(),
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

                Tables\Columns\TextColumn::make('dokter.nama')
                    ->label('Dokter')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('pemeriksaan.pendaftaran.tanggal_daftar')
                    ->label('Tanggal Daftar')
                    ->date('d M Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('diagnosa')
                    ->label('Diagnosa')
                    ->limit(40)
                    ->searchable(),

                Tables\Columns\TextColumn::make('tindakan')
                    ->label('Tindakan')
                    ->limit(40)
                    ->toggleable(),

                Tables\Columns\TextColumn::make('catatan')
                    ->label('Catatan')
                    ->limit(40)
                    ->toggleable(),

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
                Tables\Filters\SelectFilter::make('pasien_id')
                    ->label('Pasien')
                    ->relationship('pasien', 'nama')
                    ->searchable()
                    ->preload(),

                Tables\Filters\SelectFilter::make('dokter_id')
                    ->label('Dokter')
                    ->relationship('dokter', 'nama')
                    ->searchable()
                    ->preload(),
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
            ->defaultSort('created_at', 'desc');
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
            'index' => Pages\ListRekamMedis::route('/'),
            'create' => Pages\CreateRekamMedis::route('/create'),
            'edit' => Pages\EditRekamMedis::route('/{record}/edit'),
        ];
    }
}