<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PemeriksaanResource\Pages;
use App\Models\Pemeriksaan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PemeriksaanResource extends Resource
{
    protected static ?string $model = Pemeriksaan::class;

    protected static ?string $navigationGroup = 'Pelayanan Pasien';
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';
    protected static ?string $navigationLabel = 'Pemeriksaan';
    protected static ?string $modelLabel = 'Pemeriksaan';
    protected static ?string $pluralModelLabel = 'Data Pemeriksaan';
    protected static ?int $navigationSort = 2;

        public static function getNavigationBadge(): ?string
        {
            return static::getModel()::count();
        }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Data Pemeriksaan')
                    ->schema([
                        Forms\Components\Select::make('pendaftaran_id')
                            ->label('Pendaftaran Pasien')
                            ->relationship('pendaftaran', 'id')
                            ->getOptionLabelFromRecordUsing(fn ($record) =>
                                "{$record->pasien->nama} - {$record->tanggal_daftar} - {$record->keluhan}"
                            )
                            ->searchable()
                            ->preload()
                            ->required(),

                        Forms\Components\Select::make('dokter_id')
                            ->label('Dokter Pemeriksa')
                            ->relationship('dokter', 'nama')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Forms\Components\TextInput::make('tekanan_darah')
                            ->label('Tekanan Darah')
                            ->placeholder('Contoh: 120/80')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('berat_badan')
                            ->label('Berat Badan')
                            ->numeric()
                            ->suffix('kg'),

                        Forms\Components\TextInput::make('tinggi_badan')
                            ->label('Tinggi Badan')
                            ->numeric()
                            ->suffix('cm'),

                        Forms\Components\TextInput::make('suhu_tubuh')
                            ->label('Suhu Tubuh')
                            ->numeric()
                            ->suffix('°C'),

                        Forms\Components\Textarea::make('catatan')
                            ->label('Catatan Pemeriksaan')
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
                Tables\Columns\TextColumn::make('pendaftaran.pasien.nama')
                    ->label('Nama Pasien')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('pendaftaran.tanggal_daftar')
                    ->label('Tanggal Daftar')
                    ->date('d M Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('dokter.nama')
                    ->label('Dokter')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('tekanan_darah')
                    ->label('Tekanan Darah')
                    ->searchable(),

                Tables\Columns\TextColumn::make('berat_badan')
                    ->label('BB')
                    ->suffix(' kg')
                    ->sortable(),

                Tables\Columns\TextColumn::make('tinggi_badan')
                    ->label('TB')
                    ->suffix(' cm')
                    ->sortable(),

                Tables\Columns\TextColumn::make('suhu_tubuh')
                    ->label('Suhu')
                    ->suffix(' °C')
                    ->sortable(),

                Tables\Columns\TextColumn::make('catatan')
                    ->label('Catatan')
                    ->limit(35)
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
            'index' => Pages\ListPemeriksaans::route('/'),
            'create' => Pages\CreatePemeriksaan::route('/create'),
            'edit' => Pages\EditPemeriksaan::route('/{record}/edit'),
        ];
    }
}