<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SupplierPaymentResource\Pages;
use App\Models\SupplierPayment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Notifications\Notification;

class SupplierPaymentResource extends Resource
{
    protected static ?string $model = SupplierPayment::class;
    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    protected static ?string $navigationGroup = 'Finance';
    protected static ?string $navigationLabel = 'Payments Queue';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Customer & Supplier')->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make('supplier_name')->required(),
            ])->columns(2),
            Forms\Components\Section::make('Payment Details')->schema([
                Forms\Components\TextInput::make('amount')->numeric()->prefix('$')->required(),
                Forms\Components\TextInput::make('local_amount')->numeric()->prefix('₦'),
                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'processing' => 'Processing',
                        'approved' => 'Approved',
                        'on_hold' => 'On Hold',
                        'completed' => 'Completed',
                        'failed' => 'Failed',
                        'cancelled' => 'Cancelled',
                    ])
                    ->required()
                    ->default('pending'),
            ])->columns(3),
            Forms\Components\Section::make('Banking Info')->schema([
                Forms\Components\TextInput::make('bank_name'),
                Forms\Components\TextInput::make('account_number'),
                Forms\Components\TextInput::make('swift_code'),
            ])->columns(3),
            Forms\Components\Section::make('Attachments & Notes')->schema([
                Forms\Components\TextInput::make('invoice_url')->url()->label('Invoice URL'),
                Forms\Components\TextInput::make('proof_url')->url()->label('Proof of Payment'),
                Forms\Components\Textarea::make('notes')->columnSpanFull(),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable()->label('#'),
                Tables\Columns\TextColumn::make('user.name')->searchable()->sortable()->label('Customer'),
                Tables\Columns\TextColumn::make('supplier_name')->searchable()->label('Vendor'),
                Tables\Columns\TextColumn::make('amount')->money('USD')->sortable(),
                Tables\Columns\TextColumn::make('local_amount')
                    ->money('NGN')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'pending',
                        'info' => 'processing',
                        'success' => fn ($state) => in_array($state, ['approved', 'completed']),
                        'danger' => fn ($state) => in_array($state, ['failed', 'cancelled']),
                        'primary' => 'on_hold',
                    ]),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Submitted')
                    ->description(fn (SupplierPayment $record) => $record->created_at?->diffForHumans()),
                Tables\Columns\TextColumn::make('updated_at')
                    ->since()
                    ->label('Last Update')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')->options([
                    'pending' => 'Pending',
                    'processing' => 'Processing',
                    'approved' => 'Approved',
                    'on_hold' => 'On Hold',
                    'completed' => 'Completed',
                    'failed' => 'Failed',
                    'cancelled' => 'Cancelled',
                ])->multiple(),
            ])
            ->actions([
                Tables\Actions\Action::make('approve')
                    ->label('Approve')
                    ->icon('heroicon-m-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Approve Payment')
                    ->modalDescription('Confirm vendor is verified and amount is within limits.')
                    ->action(fn (SupplierPayment $record) => $record->update(['status' => 'approved']))
                    ->after(fn () => Notification::make()->success()->title('Payment Approved')->send())
                    ->visible(fn (SupplierPayment $record) => in_array($record->status, ['pending', 'processing'])),
                Tables\Actions\Action::make('hold')
                    ->label('Hold')
                    ->icon('heroicon-m-pause-circle')
                    ->color('warning')
                    ->form([
                        Forms\Components\Textarea::make('notes')->label('Hold Reason')->required(),
                    ])
                    ->action(fn (SupplierPayment $record, array $data) => $record->update([
                        'status' => 'on_hold',
                        'notes' => ($record->notes ? $record->notes . "\n---\n" : '') . '[HOLD] ' . $data['notes'],
                    ]))
                    ->visible(fn (SupplierPayment $record) => in_array($record->status, ['pending', 'processing'])),
                Tables\Actions\Action::make('cancel')
                    ->label('Cancel')
                    ->icon('heroicon-m-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->form([
                        Forms\Components\Textarea::make('notes')->label('Cancellation Reason')->required(),
                    ])
                    ->action(fn (SupplierPayment $record, array $data) => $record->update([
                        'status' => 'cancelled',
                        'notes' => ($record->notes ? $record->notes . "\n---\n" : '') . '[CANCELLED] ' . $data['notes'],
                    ]))
                    ->visible(fn (SupplierPayment $record) => !in_array($record->status, ['completed', 'cancelled'])),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('bulk_approve')
                        ->label('Approve Selected')
                        ->icon('heroicon-m-check-circle')
                        ->color('success')
                        ->requiresConfirmation()
                        ->action(fn (\Illuminate\Database\Eloquent\Collection $records) =>
                            $records->each(fn ($r) => $r->update(['status' => 'approved']))
                        )
                        ->deselectRecordsAfterCompletion(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSupplierPayments::route('/'),
            'create' => Pages\CreateSupplierPayment::route('/create'),
            'edit' => Pages\EditSupplierPayment::route('/{record}/edit'),
        ];
    }
}
