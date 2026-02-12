<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AddressResource\Pages;
use App\Models\Address;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AddressResource extends Resource
{
    protected static ?string $model = Address::class;
    protected static ?string $navigationIcon = 'heroicon-o-map-pin';
    protected static ?string $navigationGroup = 'Customers';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('user_id')
                ->relationship('user', 'name')
                ->searchable()
                ->required(),
            Forms\Components\TextInput::make('label')->placeholder('Home, Office, etc.')->required(),
            Forms\Components\TextInput::make('recipient_name')->required(),
            Forms\Components\TextInput::make('street')->required(),
            Forms\Components\TextInput::make('city')->required(),
            Forms\Components\TextInput::make('country')->required(),
            Forms\Components\TextInput::make('zip_code'),
            Forms\Components\TextInput::make('phone')->tel()->required(),
            Forms\Components\Toggle::make('is_default')->default(false),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('label')->searchable(),
                Tables\Columns\TextColumn::make('recipient_name')->searchable(),
                Tables\Columns\TextColumn::make('city')->sortable(),
                Tables\Columns\TextColumn::make('country')->sortable(),
                Tables\Columns\IconColumn::make('is_default')->boolean(),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('country'),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAddresses::route('/'),
            'create' => Pages\CreateAddress::route('/create'),
            'edit' => Pages\EditAddress::route('/{record}/edit'),
        ];
    }
}
