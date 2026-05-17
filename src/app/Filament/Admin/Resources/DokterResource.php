<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\DokterResource\Pages;
use App\Models\Dokter;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class DokterResource extends Resource
{
    protected static ?string $model = Dokter::class;

    protected static ?string $navigationGroup = 'Master Data';
    protected static ?string $navigationIcon = 'heroicon-o-user-circle';
    protected static ?string $navigationLabel = 'Dokter';
    protected static ?string $modelLabel = 'Dokter';
    protected static ?string $pluralModelLabel = 'Data Dokter';
    protected static ?int $navigationSort = 2;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Data Dokter')
                    ->schema([
                        Forms\Components\TextInput::make('nama')
                            ->label('Nama Dokter')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\Select::make('spesialis')
                            ->label('Spesialis')
                            ->options([
                                'Umum' => 'Dokter Umum',
                                'Anak' => 'Spesialis Anak',
                                'Gigi' => 'Dokter Gigi',
                                'Penyakit Dalam' => 'Spesialis Penyakit Dalam',
                                'Kandungan' => 'Spesialis Kandungan',
                                'Bedah' => 'Spesialis Bedah',
                                'Mata' => 'Spesialis Mata',
                                'THT' => 'Spesialis THT',
                                'Kulit' => 'Spesialis Kulit',
                            ])
                            ->searchable()
                            ->native(false)
                            ->required(),

                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),

                        Forms\Components\TextInput::make('no_telepon')
                            ->label('No. Telepon')
                            ->tel()
                            ->required()
                            ->maxLength(20),

                        Forms\Components\Textarea::make('alamat')
                            ->label('Alamat')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama Dokter')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('spesialis')
                    ->label('Spesialis')
                    ->badge()
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('no_telepon')
                    ->label('No. Telepon')
                    ->searchable(),

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
                Tables\Filters\SelectFilter::make('spesialis')
                    ->label('Spesialis')
                    ->options([
                        'Umum' => 'Dokter Umum',
                        'Anak' => 'Spesialis Anak',
                        'Gigi' => 'Dokter Gigi',
                        'Penyakit Dalam' => 'Spesialis Penyakit Dalam',
                        'Kandungan' => 'Spesialis Kandungan',
                        'Bedah' => 'Spesialis Bedah',
                        'Mata' => 'Spesialis Mata',
                        'THT' => 'Spesialis THT',
                        'Kulit' => 'Spesialis Kulit',
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
            ->defaultSort('nama');
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
            'index' => Pages\ListDokters::route('/'),
            'create' => Pages\CreateDokter::route('/create'),
            'edit' => Pages\EditDokter::route('/{record}/edit'),
        ];
    }
}