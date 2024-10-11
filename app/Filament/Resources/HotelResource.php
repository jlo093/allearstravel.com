<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HotelResource\Pages;
use App\Filament\Resources\HotelResource\RelationManagers;
use App\Models\Hotel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HotelResource extends Resource
{
    protected static ?string $model = Hotel::class;

    protected static ?string $navigationIcon = 'heroicon-o-home-modern';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('ratehawk_id')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('category')
                    ->required(),
                Forms\Components\TextInput::make('stars')
                    ->required()
                    ->numeric()
                    ->default(2),
                Forms\Components\Toggle::make('has_bus')
                    ->required(),
                Forms\Components\Toggle::make('has_boat')
                    ->required(),
                Forms\Components\Toggle::make('has_skyliner')
                    ->required(),
                Forms\Components\TextInput::make('area_description')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('address')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('description')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('meta_policy')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('latitude')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('longitude')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('checkin_time')
                    ->maxLength(8)
                    ->default(null),
                Forms\Components\TextInput::make('checkout_time')
                    ->maxLength(8)
                    ->default(null),
                Forms\Components\TextInput::make('region_id')
                    ->numeric()
                    ->default(null),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('category')
                    ->formatStateUsing(),
                Tables\Columns\TextColumn::make('stars')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('has_bus')
                    ->label('Bus')
                    ->boolean(),
                Tables\Columns\IconColumn::make('has_boat')
                    ->label('Boat')
                    ->boolean(),
                Tables\Columns\IconColumn::make('has_skyliner')
                    ->label('Skyliner')
                    ->boolean(),
                Tables\Columns\TextColumn::make('checkin_time')
                    ->searchable(),
                Tables\Columns\TextColumn::make('checkout_time')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListHotels::route('/'),
            'create' => Pages\CreateHotel::route('/create'),
            'edit' => Pages\EditHotel::route('/{record}/edit'),
        ];
    }
}
