<?php

namespace Bishopm\Hub\Filament\Resources;

use Bishopm\Hub\Filament\Resources\ResidentResource\Pages;
use Bishopm\Hub\Filament\Resources\ResidentResource\RelationManagers;
use Bishopm\Hub\Models\Resident;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class ResidentResource extends Resource
{
    protected static ?string $model = Resident::class;

    protected static ?string $navigationIcon = 'heroicon-o-home-modern';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('resident')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                    ->maxLength(191),
                Forms\Components\TextInput::make('slug')
                    ->maxLength(199),
                Forms\Components\TextInput::make('website')
                    ->maxLength(191),
                Forms\Components\TextInput::make('contact')
                    ->maxLength(191),
                Forms\Components\RichEditor::make('description')
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->directory('images/resident'),
                Forms\Components\TextInput::make('monday')
                    ->maxLength(191),
                Forms\Components\TextInput::make('tuesday')
                    ->maxLength(191),
                Forms\Components\TextInput::make('wednesday')
                    ->maxLength(191),
                Forms\Components\TextInput::make('thursday')
                    ->maxLength(191),
                Forms\Components\TextInput::make('friday')
                    ->maxLength(191),
                Forms\Components\TextInput::make('saturday')
                    ->maxLength(191),
                Forms\Components\TextInput::make('sunday')
                    ->maxLength(191),
                Forms\Components\Toggle::make('publish'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('resident')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\TextColumn::make('website')
                    ->searchable(),
                Tables\Columns\TextColumn::make('contact')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('monday')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tuesday')
                    ->searchable(),
                Tables\Columns\TextColumn::make('wednesday')
                    ->searchable(),
                Tables\Columns\TextColumn::make('thursday')
                    ->searchable(),
                Tables\Columns\TextColumn::make('friday')
                    ->searchable(),
                Tables\Columns\TextColumn::make('saturday')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sunday')
                    ->searchable(),
                Tables\Columns\IconColumn::make('publish')
                    ->boolean(),
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
            'index' => Pages\ListResidents::route('/'),
            'create' => Pages\CreateResident::route('/create'),
            'edit' => Pages\EditResident::route('/{record}/edit'),
        ];
    }
}
