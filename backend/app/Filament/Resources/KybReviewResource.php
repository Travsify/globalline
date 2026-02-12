<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KybReviewResource\Pages;
use App\Models\KycVerification;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Notifications\Notification;

class KybReviewResource extends Resource
{
    protected static ?string $model = KycVerification::class;
    protected static ?string $navigationIcon = 'heroicon-o-identification';
    protected static ?string $navigationGroup = 'Compliance';
    protected static ?string $navigationLabel = 'KYB Review Queue';
    protected static ?int $navigationSort = 1;
    protected static ?string $modelLabel = 'KYB Review';
    protected static ?string $pluralModelLabel = 'KYB Reviews';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Applicant Information')->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->required()
                    ->label('Business / Applicant'),
                Forms\Components\Select::make('id_type')
                    ->options([
                        'nin' => 'National ID (NIN)',
                        'passport' => 'International Passport',
                        'drivers_license' => 'Driver\'s License',
                        'cac' => 'CAC Certificate',
                        'utility_bill' => 'Utility Bill',
                    ])
                    ->required()
                    ->label('Document Type'),
                Forms\Components\TextInput::make('id_number')
                    ->required()
                    ->label('Document Number'),
            ])->columns(3),

            Forms\Components\Section::make('Document & Verification')->schema([
                Forms\Components\TextInput::make('document_url')
                    ->url()
                    ->label('Document URL'),
                Forms\Components\TextInput::make('provider_reference')
                    ->label('Provider Reference')
                    ->disabled(),
                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'Pending Review',
                        'in_review' => 'In Review',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                        'more_info' => 'More Info Required',
                    ])
                    ->required()
                    ->default('pending'),
                Forms\Components\Textarea::make('reason')
                    ->label('Review Notes / Rejection Reason')
                    ->columnSpanFull(),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable()->label('#'),
                Tables\Columns\TextColumn::make('user.name')->searchable()->sortable()->label('Applicant'),
                Tables\Columns\TextColumn::make('user.business_name')->searchable()->label('Business'),
                Tables\Columns\BadgeColumn::make('id_type')
                    ->formatStateUsing(fn (string $state) => match($state) {
                        'nin' => 'NIN',
                        'passport' => 'Passport',
                        'drivers_license' => 'Driver\'s License',
                        'cac' => 'CAC Cert',
                        'utility_bill' => 'Utility Bill',
                        default => ucfirst($state),
                    })
                    ->label('Doc Type')
                    ->color('primary'),
                Tables\Columns\TextColumn::make('id_number')->label('Doc #')->searchable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'pending',
                        'info' => 'in_review',
                        'success' => 'approved',
                        'danger' => 'rejected',
                        'primary' => 'more_info',
                    ]),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Submitted'),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')->options([
                    'pending' => 'Pending',
                    'in_review' => 'In Review',
                    'approved' => 'Approved',
                    'rejected' => 'Rejected',
                    'more_info' => 'More Info Required',
                ]),
                Tables\Filters\SelectFilter::make('id_type')->options([
                    'nin' => 'NIN',
                    'passport' => 'Passport',
                    'drivers_license' => 'Driver\'s License',
                    'cac' => 'CAC Certificate',
                ]),
            ])
            ->actions([
                Tables\Actions\Action::make('approve')
                    ->label('Approve')
                    ->icon('heroicon-m-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Approve KYB Application')
                    ->modalDescription('This will mark the applicant as verified.')
                    ->action(fn (KycVerification $record) => $record->update(['status' => 'approved']))
                    ->after(fn () => Notification::make()->success()->title('KYB Approved')->send())
                    ->visible(fn (KycVerification $record) => in_array($record->status, ['pending', 'in_review'])),
                Tables\Actions\Action::make('request_info')
                    ->label('Request Info')
                    ->icon('heroicon-m-question-mark-circle')
                    ->color('warning')
                    ->form([
                        Forms\Components\Textarea::make('reason')->label('What information is needed?')->required(),
                    ])
                    ->action(fn (KycVerification $record, array $data) => $record->update(['status' => 'more_info', 'reason' => $data['reason']]))
                    ->visible(fn (KycVerification $record) => in_array($record->status, ['pending', 'in_review'])),
                Tables\Actions\Action::make('reject')
                    ->label('Reject')
                    ->icon('heroicon-m-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->form([
                        Forms\Components\Textarea::make('reason')->label('Rejection Reason')->required(),
                    ])
                    ->action(fn (KycVerification $record, array $data) => $record->update(['status' => 'rejected', 'reason' => $data['reason']]))
                    ->visible(fn (KycVerification $record) => in_array($record->status, ['pending', 'in_review'])),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKybReviews::route('/'),
            'create' => Pages\CreateKybReview::route('/create'),
            'edit' => Pages\EditKybReview::route('/{record}/edit'),
        ];
    }
}
