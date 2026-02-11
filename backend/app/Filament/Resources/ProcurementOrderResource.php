<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProcurementOrderResource\Pages;
use App\Models\ProcurementOrder;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProcurementOrderResource extends Resource
{
    protected static ?string $model = ProcurementOrder::class;
    protected static ?string $navigationIcon = 'heroicon-o-magnifying-glass-circle';
    protected static ?string $navigationGroup = 'Marketplace';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Customer & Product')->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make('product_url')->url()->required(),
                Forms\Components\TextInput::make('product_name')->required(),
                Forms\Components\TextInput::make('quantity')->numeric()->required()->default(1),
            ])->columns(2),
            Forms\Components\Section::make('Pricing & Status')->schema([
                Forms\Components\TextInput::make('unit_price')->numeric()->prefix('¥'),
                Forms\Components\TextInput::make('total_price')->numeric()->prefix('¥'),
                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'quoted' => 'Quoted',
                        'ordered' => 'Ordered',
                        'received_at_warehouse' => 'Warehouse',
                        'shipped' => 'Shipped',
                        'delivered' => 'Delivered',
                        'cancelled' => 'Cancelled',
                    ])
                    ->required()
                    ->default('pending'),
            ])->columns(3),
            Forms\Components\Section::make('Instructions & Notes')->schema([
                Forms\Components\KeyValue::make('specifications'),
                Forms\Components\Textarea::make('instructions')->columnSpanFull(),
                Forms\Components\TextInput::make('admin_notes')->columnSpanFull(),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('product_name')->searchable()->limit(30),
                Tables\Columns\TextColumn::make('quantity')->sortable(),
                Tables\Columns\TextColumn::make('total_price')->money('CNY')->sortable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'pending',
                        'info' => ['quoted', 'ordered', 'received_at_warehouse'],
                        'success' => 'delivered',
                        'danger' => 'cancelled',
                    ]),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')->options([
                    'pending' => 'Pending',
                    'ordered' => 'Ordered',
                    'delivered' => 'Delivered',
                ]),
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
            'index' => Pages\ListProcurementOrders::route('/'),
            'create' => Pages\CreateProcurementOrder::route('/create'),
            'edit' => Pages\EditProcurementOrder::route('/{record}/edit'),
        ];
    }
}
