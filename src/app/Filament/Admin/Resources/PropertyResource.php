<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PropertyResource\Pages;
use App\Models\Property;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PropertyResource extends Resource
{
    protected static ?string $model = Property::class;

    protected static ?string $navigationIcon = 'heroicon-o-home-modern';
    protected static ?string $navigationGroup = 'Properti';
    protected static ?string $modelLabel = 'Properti Rumah';
    protected static ?string $pluralModelLabel = 'Properti Rumah';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nama Properti')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('location')
                    ->label('Lokasi')
                    ->required(),

                Forms\Components\TextInput::make('price')
                    ->label('Harga')
                    ->numeric()
                    ->prefix('Rp')
                    ->required(),

                Forms\Components\TextInput::make('type')
                    ->label('Tipe')
                    ->placeholder('Rumah / Apartemen / Tanah')
                    ->required(),

                Forms\Components\TextInput::make('bedrooms')
                    ->label('Kamar Tidur')
                    ->numeric()
                    ->required(),

                Forms\Components\TextInput::make('bathrooms')
                    ->label('Kamar Mandi')
                    ->numeric()
                    ->required(),

                Forms\Components\TextInput::make('land_area')
                    ->label('Luas Tanah (m²)')
                    ->numeric()
                    ->required(),

                Forms\Components\Textarea::make('description')
                    ->label('Deskripsi')
                    ->rows(4),

                Forms\Components\FileUpload::make('image')
                    ->label('Gambar Properti')
                    ->image()
                    ->directory('properties')
                    ->imagePreviewHeight('150')
                    ->maxSize(2048),

                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        'available' => 'Tersedia',
                        'sold' => 'Terjual',
                    ])
                    ->default('available')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Foto')
                    ->height(80)
                    ->circular(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('location')
                    ->label('Lokasi'),

                Tables\Columns\TextColumn::make('price')
                    ->label('Harga')
                    ->money('IDR'),

                Tables\Columns\TextColumn::make('type')
                    ->label('Tipe'),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->colors([
                        'success' => 'available',
                        'danger' => 'sold',
                    ]),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Filter Status')
                    ->options([
                        'available' => 'Tersedia',
                        'sold' => 'Terjual',
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
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // relasi buyer bisa ditambahkan di sini nanti
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProperties::route('/'),
            'create' => Pages\CreateProperty::route('/create'),
            'edit' => Pages\EditProperty::route('/{record}/edit'),
        ];
    }
}
