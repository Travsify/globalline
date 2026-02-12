<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SupportTicketResource\Pages;
use App\Models\SupportTicket;
use App\Models\SupportMessage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Notifications\Notification;
use Filament\Resources\RelationManagers\RelationManager;

class SupportTicketResource extends Resource
{
    protected static ?string $model = SupportTicket::class;
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?string $navigationGroup = 'Support';
    protected static ?string $navigationLabel = 'Tickets';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Ticket Information')->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->required()
                    ->label('Customer'),
                Forms\Components\TextInput::make('subject')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('category')
                    ->options([
                        'payment' => 'Payment Issue',
                        'shipment' => 'Shipment Issue',
                        'kyb' => 'KYB / Verification',
                        'marketplace' => 'Marketplace',
                        'account' => 'Account',
                        'general' => 'General Inquiry',
                    ])
                    ->required(),
            ])->columns(3),
            Forms\Components\Section::make('Status & Priority')->schema([
                Forms\Components\Select::make('status')
                    ->options([
                        'open' => 'Open',
                        'in_progress' => 'In Progress',
                        'waiting_customer' => 'Waiting on Customer',
                        'resolved' => 'Resolved',
                        'closed' => 'Closed',
                    ])
                    ->required()
                    ->default('open'),
                Forms\Components\Select::make('priority')
                    ->options([
                        'low' => 'Low',
                        'medium' => 'Medium',
                        'high' => 'High',
                        'urgent' => 'Urgent',
                    ])
                    ->required()
                    ->default('medium'),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable()->label('#'),
                Tables\Columns\TextColumn::make('subject')
                    ->searchable()
                    ->sortable()
                    ->limit(40)
                    ->tooltip(fn (SupportTicket $record) => $record->subject),
                Tables\Columns\TextColumn::make('user.name')
                    ->searchable()
                    ->sortable()
                    ->label('Customer'),
                Tables\Columns\BadgeColumn::make('category')
                    ->colors([
                        'danger' => 'payment',
                        'warning' => 'shipment',
                        'info' => 'kyb',
                        'primary' => 'marketplace',
                        'success' => 'account',
                        'secondary' => 'general',
                    ]),
                Tables\Columns\BadgeColumn::make('priority')
                    ->colors([
                        'secondary' => 'low',
                        'info' => 'medium',
                        'warning' => 'high',
                        'danger' => 'urgent',
                    ]),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'open',
                        'info' => 'in_progress',
                        'primary' => 'waiting_customer',
                        'success' => 'resolved',
                        'secondary' => 'closed',
                    ]),
                Tables\Columns\TextColumn::make('messages_count')
                    ->counts('messages')
                    ->label('Replies')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Opened')
                    ->description(fn (SupportTicket $record) => $record->created_at?->diffForHumans()),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')->options([
                    'open' => 'Open',
                    'in_progress' => 'In Progress',
                    'waiting_customer' => 'Waiting on Customer',
                    'resolved' => 'Resolved',
                    'closed' => 'Closed',
                ])->multiple(),
                Tables\Filters\SelectFilter::make('priority')->options([
                    'low' => 'Low',
                    'medium' => 'Medium',
                    'high' => 'High',
                    'urgent' => 'Urgent',
                ]),
                Tables\Filters\SelectFilter::make('category')->options([
                    'payment' => 'Payment',
                    'shipment' => 'Shipment',
                    'kyb' => 'KYB',
                    'marketplace' => 'Marketplace',
                    'account' => 'Account',
                    'general' => 'General',
                ]),
            ])
            ->actions([
                Tables\Actions\Action::make('reply')
                    ->label('Reply')
                    ->icon('heroicon-m-chat-bubble-left')
                    ->color('primary')
                    ->form([
                        Forms\Components\Textarea::make('message')
                            ->label('Admin Response')
                            ->required()
                            ->rows(4),
                    ])
                    ->action(function (SupportTicket $record, array $data) {
                        SupportMessage::create([
                            'support_ticket_id' => $record->id,
                            'user_id' => filament()->auth()->id(),
                            'message' => $data['message'],
                            'is_admin' => true,
                        ]);
                        if ($record->status === 'open') {
                            $record->update(['status' => 'in_progress']);
                        }
                        Notification::make()->success()->title('Reply sent')->send();
                    }),
                Tables\Actions\Action::make('resolve')
                    ->label('Resolve')
                    ->icon('heroicon-m-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->action(fn (SupportTicket $record) => $record->update(['status' => 'resolved']))
                    ->visible(fn (SupportTicket $record) => !in_array($record->status, ['resolved', 'closed'])),
                Tables\Actions\Action::make('escalate')
                    ->label('Escalate')
                    ->icon('heroicon-m-arrow-up-circle')
                    ->color('danger')
                    ->action(fn (SupportTicket $record) => $record->update(['priority' => 'urgent']))
                    ->visible(fn (SupportTicket $record) => $record->priority !== 'urgent'),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('bulk_close')
                        ->label('Close Selected')
                        ->icon('heroicon-m-x-circle')
                        ->color('secondary')
                        ->requiresConfirmation()
                        ->action(fn (\Illuminate\Database\Eloquent\Collection $records) =>
                            $records->each(fn ($r) => $r->update(['status' => 'closed']))
                        )
                        ->deselectRecordsAfterCompletion(),
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
            'index' => Pages\ListSupportTickets::route('/'),
            'create' => Pages\CreateSupportTicket::route('/create'),
            'edit' => Pages\EditSupportTicket::route('/{record}/edit'),
        ];
    }
}
