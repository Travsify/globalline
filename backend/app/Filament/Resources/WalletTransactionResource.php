<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WalletTransactionResource\Pages;
use App\Models\WalletTransaction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class WalletTransactionResource extends Resource
{
    protected static ?string $model = WalletTransaction::class;
    protected static ?string $navigationIcon = 'heroicon-o-credit-card';
    protected static ?string $navigationGroup = 'Finance';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('user_id')
                ->relationship('user', 'name')
                ->searchable()
                ->required(),
            Forms\Components\Select::make('type')
                ->options(['credit' => 'Credit', 'debit' => 'Debit'])
                ->required(),
            Forms\Components\TextInput::make('amount')->numeric()->prefix('$')->required(),
            Forms\Components\TextInput::make('balance_after')->numeric()->prefix('$')->required(),
            Forms\Components\TextInput::make('reference')->unique(ignoreRecord: true),
            Forms\Components\Select::make('status')
                ->options(['pending' => 'Pending', 'completed' => 'Completed', 'failed' => 'Failed'])
                ->default('completed')
                ->required(),
            Forms\Components\TextInput::make('description')->required()->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')->searchable()->sortable(),
                Tables\Columns\IconColumn::make('type')
                    ->options([
                        'heroicon-m-arrow-trending-up' => 'credit',
                        'heroicon-m-arrow-trending-down' => 'debit',
                    ])
                    ->colors([
                        'success' => 'credit',
                        'danger' => 'debit',
                    ]),
                Tables\Columns\TextColumn::make('amount')->money('USD')->sortable(),
                Tables\Columns\TextColumn::make('balance_after')->money('USD'),
                Tables\Columns\TextColumn::make('reference')->searchable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'completed',
                        'danger' => 'failed',
                    ]),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')->options(['credit' => 'Credit', 'debit' => 'Debit']),
                Tables\Filters\SelectFilter::make('status')->options(['pending' => 'Pending', 'completed' => 'Completed']),
            ])
            ->actions([])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWalletTransactions::route('/'),
        ];
    }
}
