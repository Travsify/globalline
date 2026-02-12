<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'Customers';
    protected static ?string $navigationLabel = 'Businesses';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Contact Information')->schema([
                Forms\Components\TextInput::make('name')->required()->maxLength(255)->label('Contact Name'),
                Forms\Components\TextInput::make('email')->email()->required()->maxLength(255)->unique(ignoreRecord: true),
                Forms\Components\TextInput::make('phone')->tel()->maxLength(20),
                Forms\Components\TextInput::make('password')->password()->required()->minLength(8)->dehydrated(fn($state) => filled($state))->required(fn(string $operation): bool => $operation === 'create'),
            ])->columns(2),
            Forms\Components\Section::make('Business Profile')->schema([
                Forms\Components\TextInput::make('business_name')->maxLength(255),
                Forms\Components\Select::make('business_type')->options([
                    'importer' => 'Importer / Retailer',
                    'manufacturer' => 'Manufacturer',
                    'logistics' => 'Logistics Provider',
                    'retailer' => 'Wholesaler',
                ]),
            ])->columns(2),
            Forms\Components\Section::make('Access & Permissions')->schema([
                Forms\Components\Select::make('role')->options(['user' => 'User', 'admin' => 'Admin'])->default('user')->required(),
                Forms\Components\Select::make('admin_role')
                    ->options(User::ADMIN_ROLES)
                    ->visible(fn (Forms\Get $get) => $get('role') === 'admin')
                    ->label('Admin Role'),
                Forms\Components\TextInput::make('wallet_balance')->numeric()->prefix('$')->default(0)->disabled(),
                Forms\Components\Toggle::make('is_active')->default(true),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable()->label('#'),
                Tables\Columns\TextColumn::make('name')->searchable()->sortable()->label('Contact'),
                Tables\Columns\TextColumn::make('business_name')->searchable()->sortable()->label('Business'),
                Tables\Columns\TextColumn::make('email')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('phone')->searchable()->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\BadgeColumn::make('business_type')
                    ->colors([
                        'primary' => 'importer',
                        'success' => 'manufacturer',
                        'warning' => 'logistics',
                        'info' => 'retailer',
                    ])->label('Track'),
                Tables\Columns\BadgeColumn::make('role')->colors(['primary' => 'user', 'danger' => 'admin']),
                Tables\Columns\BadgeColumn::make('admin_role')
                    ->label('Admin Role')
                    ->formatStateUsing(fn (?string $state) => $state ? User::ADMIN_ROLES[$state] ?? $state : '—')
                    ->colors(['warning'])
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('wallet_balance')->money('USD')->sortable(),
                Tables\Columns\IconColumn::make('is_active')->boolean(),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('role')->options(['user' => 'User', 'admin' => 'Admin']),
                Tables\Filters\SelectFilter::make('business_type')->options([
                    'importer' => 'Importer',
                    'manufacturer' => 'Manufacturer',
                    'logistics' => 'Logistics',
                    'retailer' => 'Wholesaler',
                ]),
                Tables\Filters\TernaryFilter::make('is_active'),
            ])
            ->actions([
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
