<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Filament\Resources\BookingResource\RelationManagers;
use App\Models\Booking;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('type')
                    ->required(),
                Forms\Components\TextInput::make('price_net')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('price_gross')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('supplier_reference')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('external_reference')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\DatePicker::make('start_date')
                    ->required(),
                Forms\Components\DatePicker::make('end_date')
                    ->required(),
                Forms\Components\Toggle::make('has_free_cancellation')
                    ->required(),
                Forms\Components\DatePicker::make('free_cancellation_deadline'),
                Forms\Components\DatePicker::make('payment_deadline')
                    ->required(),
                Forms\Components\TextInput::make('hotel_id')
                    ->tel()
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('order_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('adults')
                    ->required()
                    ->numeric()
                    ->default(2),
                Forms\Components\TextInput::make('children')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\Textarea::make('detail')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('supplier_price')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('reference_price')
                    ->numeric()
                    ->default(null),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('type'),
                Tables\Columns\TextColumn::make('price_net')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('price_gross')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('supplier_reference')
                    ->searchable(),
                Tables\Columns\TextColumn::make('external_reference')
                    ->searchable(),
                Tables\Columns\TextColumn::make('start_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\IconColumn::make('has_free_cancellation')
                    ->boolean(),
                Tables\Columns\TextColumn::make('free_cancellation_deadline')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('payment_deadline')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('hotel_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('order_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('adults')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('children')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('supplier_price')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('reference_price')
                    ->numeric()
                    ->sortable(),
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
            'index' => Pages\ListBookings::route('/'),
            'create' => Pages\CreateBooking::route('/create'),
            'edit' => Pages\EditBooking::route('/{record}/edit'),
        ];
    }
}
