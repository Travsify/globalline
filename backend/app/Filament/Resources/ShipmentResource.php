<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ShipmentResource\Pages;
use App\Models\Shipment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Notifications\Notification;

class ShipmentResource extends Resource
{
    protected static ?string $model = Shipment::class;
    protected static ?string $navigationIcon = 'heroicon-o-truck';
    protected static ?string $navigationGroup = 'Logistics';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Customer & Tracking')->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make('tracking_number')
                    ->default(fn () => Shipment::generateTrackingNumber())
                    ->required()
                    ->unique(ignoreRecord: true),
                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'picked_up' => 'Picked Up',
                        'in_transit' => 'In Transit',
                        'customs' => 'Customs',
                        'out_for_delivery' => 'Out for Delivery',
                        'delivered' => 'Delivered',
                        'cancelled' => 'Cancelled',
                    ])
                    ->required()
                    ->default('pending'),
            ])->columns(3),
            Forms\Components\Section::make('Route Information')->schema([
                Forms\Components\TextInput::make('origin')->required(),
                Forms\Components\TextInput::make('origin_country')->required(),
                Forms\Components\TextInput::make('destination')->required(),
                Forms\Components\TextInput::make('destination_country')->required(),
            ])->columns(2),
            Forms\Components\Section::make('Shipment Details')->schema([
                Forms\Components\TextInput::make('weight')->numeric()->step(0.01),
                Forms\Components\TextInput::make('weight_unit')->default('kg'),
                Forms\Components\TextInput::make('price')->numeric()->prefix('$')->required(),
                Forms\Components\TextInput::make('receiver_name')->required(),
                Forms\Components\TextInput::make('receiver_phone'),
                Forms\Components\Textarea::make('description')->columnSpanFull(),
            ])->columns(3),
            Forms\Components\Section::make('Milestones Timeline')
                ->description('Track key events in the shipment lifecycle')
                ->schema([
                    Forms\Components\Repeater::make('milestones')
                        ->schema([
                            Forms\Components\DateTimePicker::make('timestamp')
                                ->label('Date & Time')
                                ->default(now())
                                ->required(),
                            Forms\Components\TextInput::make('event')
                                ->label('Event')
                                ->placeholder('e.g. Cleared customs at Lagos port')
                                ->required(),
                            Forms\Components\Select::make('type')
                                ->options([
                                    'info' => 'Information',
                                    'success' => 'Completed',
                                    'warning' => 'Attention Required',
                                    'danger' => 'Issue / Delay',
                                ])
                                ->default('info')
                                ->required(),
                            Forms\Components\TextInput::make('location')
                                ->placeholder('e.g. Lagos, Nigeria'),
                        ])
                        ->columns(4)
                        ->collapsible()
                        ->itemLabel(fn (array $state): ?string =>
                            ($state['timestamp'] ?? '') . ' — ' . ($state['event'] ?? 'New Milestone')
                        )
                        ->defaultItems(0)
                        ->addActionLabel('Add Milestone')
                        ->columnSpanFull(),
                ]),
            Forms\Components\Section::make('Internal Notes')->schema([
                Forms\Components\Textarea::make('internal_notes')
                    ->label('Ops Notes (internal only)')
                    ->placeholder('Add notes visible only to admin team...')
                    ->columnSpanFull(),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tracking_number')->searchable()->sortable()->copyable(),
                Tables\Columns\TextColumn::make('user.name')->searchable()->sortable()->label('Customer'),
                Tables\Columns\TextColumn::make('origin_country')->sortable()->label('Origin'),
                Tables\Columns\TextColumn::make('destination_country')->sortable()->label('Dest'),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'pending',
                        'info' => fn ($state) => in_array($state, ['picked_up', 'in_transit', 'customs', 'out_for_delivery']),
                        'success' => 'delivered',
                        'danger' => 'cancelled',
                    ]),
                Tables\Columns\TextColumn::make('price')->money('USD')->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->description(fn (Shipment $record) => $record->created_at?->diffForHumans()),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')->options([
                    'pending' => 'Pending',
                    'picked_up' => 'Picked Up',
                    'in_transit' => 'In Transit',
                    'customs' => 'Customs',
                    'delivered' => 'Delivered',
                    'cancelled' => 'Cancelled',
                ])->multiple(),
                Tables\Filters\Filter::make('delayed')
                    ->label('Delayed (>7 days in transit)')
                    ->query(fn ($query) => $query->where('status', 'in_transit')->where('updated_at', '<', now()->subDays(7)))
                    ->toggle(),
            ])
            ->actions([
                Tables\Actions\Action::make('advance_status')
                    ->label('Advance')
                    ->icon('heroicon-m-arrow-right-circle')
                    ->color('primary')
                    ->action(function (Shipment $record) {
                        $flow = ['pending', 'picked_up', 'in_transit', 'customs', 'out_for_delivery', 'delivered'];
                        $currentIndex = array_search($record->status, $flow);
                        if ($currentIndex !== false && $currentIndex < count($flow) - 1) {
                            $record->update(['status' => $flow[$currentIndex + 1]]);
                            Notification::make()->success()->title('Status advanced to ' . $flow[$currentIndex + 1])->send();
                        }
                    })
                    ->visible(fn (Shipment $record) => !in_array($record->status, ['delivered', 'cancelled'])),
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
            'index' => Pages\ListShipments::route('/'),
            'create' => Pages\CreateShipment::route('/create'),
            'edit' => Pages\EditShipment::route('/{record}/edit'),
        ];
    }
}
