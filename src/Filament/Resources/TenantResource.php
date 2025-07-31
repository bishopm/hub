<?php

namespace Bishopm\Hub\Filament\Resources;

use Bishopm\Hub\Filament\Resources\TenantResource\Pages;
use Bishopm\Hub\Filament\Resources\TenantResource\RelationManagers;
use Bishopm\Hub\Jobs\SendEmail;
use Bishopm\Hub\Mail\HubMail;
use Bishopm\Hub\Models\Tenant;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class TenantResource extends Resource
{
    protected static ?string $model = Tenant::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'Community hub';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('tenant')
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                    ->required()
                    ->maxLength(191),
                Forms\Components\TextInput::make('email')->email()
                    ->suffixAction(
                        Action::make('emailForm')->label('Send an email')
                        ->icon('heroicon-m-envelope')
                        ->form([
                            Forms\Components\TextInput::make('subject')->label('Subject')->required(),
                            FileUpload::make('attachment')->preserveFilenames()->directory('attachments'),
                            MarkdownEditor::make('body'),
                            Forms\Components\Select::make('sender')
                                ->options(function () {
                                    $name=(auth()->user()->name);
                                    return [$name=>$name];
                                })
                        ])
                        ->action(function (array $data, Tenant $record): void {
                            self::sendEmail($data,$record);
                        })),
                Forms\Components\TextInput::make('contact_firstname')->label('First name of contact person')
                    ->maxLength(255),
                Forms\Components\TextInput::make('contact_surname')->label('Surname of contact person')
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone'),
                Forms\Components\RichEditor::make('description')
                    ->columnSpanFull(),
                Forms\Components\Toggle::make('active'),
                Forms\Components\Toggle::make('publish'),
                Forms\Components\TextInput::make('slug')
                    ->maxLength(199),
                Forms\Components\FileUpload::make('image')
                    ->image(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tenant')
                    ->searchable(),
                Tables\Columns\TextColumn::make('contact'),
                Tables\Columns\IconColumn::make('active')
                    ->icon(fn (string $state): string => match ($state) {
                        '0' => 'heroicon-o-x-circle',
                        '1' => 'heroicon-o-check-circle'
                    }),
                Tables\Columns\TextColumn::make('contact_firstname')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('contact_surname')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTenants::route('/'),
            'create' => Pages\CreateTenant::route('/create'),
            'edit' => Pages\EditTenant::route('/{record}/edit'),
        ];
    }

    public static function sendEmail($data, $tenant){
        if ($tenant['email']){
            $template = new HubMail($data,$tenant);
            SendEmail::dispatch($tenant['email'], $template);
        }
        Notification::make('Email sent')->title('Email sent to ' . $tenant['tenant'])->send();
    }
}
