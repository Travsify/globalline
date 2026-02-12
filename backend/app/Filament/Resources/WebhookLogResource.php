<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WebhookLogResource\Pages;
use App\Models\WebhookLog;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Notifications\Notification;

class WebhookLogResource extends Resource
{
    protected static ?string $model = WebhookLog::class;
    protected static ?string $navigationIcon = 'heroicon-o-arrow-path';
    protected static ?string $navigationGroup = 'Config & Platform';
    protected static ?string $navigationLabel = 'Webhook Logs';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Webhook Details')->schema([
                Forms\Components\TextInput::make('event')->required(),
                Forms\Components\TextInput::make('url'),
                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'success' => 'Success',
                        'failed' => 'Failed',
                    ])
                    ->required()
                    ->default('pending'),
                Forms\Components\TextInput::make('response_code')
                    ->numeric()
                    ->label('HTTP Status'),
                Forms\Components\TextInput::make('retries')
                    ->numeric()
                    ->default(0),
            ])->columns(3),
            Forms\Components\Section::make('Payload & Response')->schema([
                Forms\Components\Textarea::make('payload')
                    ->formatStateUsing(fn ($state) => is_array($state) ? json_encode($state, JSON_PRETTY_PRINT) : $state)
                    ->columnSpanFull()
                    ->rows(8)
                    ->disabled(),
                Forms\Components\Textarea::make('response_body')
                    ->columnSpanFull()
                    ->rows(6)
                    ->disabled(),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable()->label('#'),
                Tables\Columns\TextColumn::make('event')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('primary'),
                Tables\Columns\TextColumn::make('url')
                    ->limit(40)
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'success',
                        'danger' => 'failed',
                    ]),
                Tables\Columns\TextColumn::make('response_code')
                    ->label('HTTP')
                    ->badge()
                    ->color(fn (?int $state) => match(true) {
                        $state >= 200 && $state < 300 => 'success',
                        $state >= 400 => 'danger',
                        default => 'secondary',
                    }),
                Tables\Columns\TextColumn::make('retries')
                    ->sortable(),
                Tables\Columns\TextColumn::make('last_retry_at')
                    ->dateTime()
                    ->label('Last Retry')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->description(fn (WebhookLog $record) => $record->created_at?->diffForHumans()),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')->options([
                    'pending' => 'Pending',
                    'success' => 'Success',
                    'failed' => 'Failed',
                ]),
                Tables\Filters\SelectFilter::make('event')
                    ->options(fn () => WebhookLog::distinct()->pluck('event', 'event')->toArray())
                    ->label('Event Type'),
            ])
            ->actions([
                Tables\Actions\Action::make('retry')
                    ->label('Retry')
                    ->icon('heroicon-m-arrow-path')
                    ->color('warning')
                    ->requiresConfirmation()
                    ->modalHeading('Retry Webhook')
                    ->modalDescription('This will increment the retry counter and mark as pending.')
                    ->action(function (WebhookLog $record) {
                        $record->update([
                            'status' => 'pending',
                            'retries' => $record->retries + 1,
                            'last_retry_at' => now(),
                        ]);
                        Notification::make()->success()->title('Webhook queued for retry')->send();
                    })
                    ->visible(fn (WebhookLog $record) => $record->status === 'failed'),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([]);
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWebhookLogs::route('/'),
            'view' => Pages\ViewWebhookLog::route('/{record}'),
        ];
    }
}
