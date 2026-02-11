<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NotificationResource\Pages;
use App\Models\Notification;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class NotificationResource extends Resource
{
    protected static ?string $model = Notification::class;
    protected static ?string $navigationIcon = 'heroicon-o-bell';
    protected static ?string $navigationGroup = 'System';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('user_id')
                ->relationship('user', 'name')
                ->searchable()
                ->required(),
            Forms\Components\TextInput::make('title')->required(),
            Forms\Components\Textarea::make('message')->required()->columnSpanFull(),
            Forms\Components\Select::make('type')
                ->options([
                    'system' => 'System',
                    'order' => 'Order',
                    'shipment' => 'Shipment',
                    'wallet' => 'Wallet',
                ])
                ->required(),
            Forms\Components\Toggle::make('is_read')->default(false),
            Forms\Components\TextInput::make('action_url')->url(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('title')->searchable()->limit(30),
                Tables\Columns\TextColumn::make('type')->sortable(),
                Tables\Columns\IconColumn::make('is_read')->boolean(),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')->options([
                    'system' => 'System',
                    'order' => 'Order',
                    'shipment' => 'Shipment',
                ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNotifications::route('/'),
            'create' => Pages\CreateNotification::route('/create'),
            'edit' => Pages\EditNotification::route('/{record}/edit'),
        ];
    }
}
