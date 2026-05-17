<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\DetailResepResource\Pages;
use App\Models\DetailResep;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class DetailResepResource extends Resource
{
    protected static ?string $model = DetailResep::class;

    protected static ?string $navigationGroup = 'Farmasi';
    protected static ?string $navigationIcon = 'heroicon-o-list-bullet';
    protected static ?string $navigationLabel = 'Detail Resep';
    protected static ?string $modelLabel = 'Detail Resep';
    protected static ?string $pluralModelLabel = 'Data Detail Resep';
    protected static ?int $navigationSort = 3;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Data Detail Resep')
                    ->schema([
                        Forms\Components\Select::make('resep_id')
                            ->label('Resep')
                            ->relationship('resep', 'id')
                            ->getOptionLabelFromRecordUsing(fn ($record) =>
                                "{$record->rekamMedis->pasien->nama} - {$record->rekamMedis->diagnosa} - {$record->tanggal_resep}"
                            )
                            ->searchable()
                            ->preload()
                            ->required(),

                        Forms\Components\Select::make('obat_id')
                            ->label('Obat')
                            ->relationship('obat', 'nama_obat')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Forms\Components\TextInput::make('jumlah')
                            ->label('Jumlah')
                            ->required()
                            ->numeric()
                            ->minValue(1),

                        Forms\Components\TextInput::make('dosis')
                            ->label('Dosis')
                            ->placeholder('Contoh: 3x1')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\Textarea::make('aturan_pakai')
                            ->label('Aturan Pakai')
                            ->placeholder('Contoh: Diminum setelah makan')
                            ->required()
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
                Tables\Columns\TextColumn::make('resep.rekamMedis.pasien.nama')
                    ->label('Nama Pasien')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('resep.rekamMedis.diagnosa')
                    ->label('Diagnosa')
                    ->limit(35)
                    ->searchable(),

                Tables\Columns\TextColumn::make('obat.nama_obat')
                    ->label('Nama Obat')
                    ->searchable()
                    ->sortable()
                    ->badge(),

                Tables\Columns\TextColumn::make('jumlah')
                    ->label('Jumlah')
                    ->sortable(),

                Tables\Columns\TextColumn::make('dosis')
                    ->label('Dosis')
                    ->searchable(),

                Tables\Columns\TextColumn::make('aturan_pakai')
                    ->label('Aturan Pakai')
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
                Tables\Filters\SelectFilter::make('obat_id')
                    ->label('Obat')
                    ->relationship('obat', 'nama_obat')
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
            'index' => Pages\ListDetailReseps::route('/'),
            'create' => Pages\CreateDetailResep::route('/create'),
            'edit' => Pages\EditDetailResep::route('/{record}/edit'),
        ];
    }
}