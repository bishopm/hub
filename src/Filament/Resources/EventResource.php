<?php

namespace Bishopm\Hub\Filament\Resources;

use Bishopm\Hub\Filament\Resources\EventResource\Pages;
use Bishopm\Hub\Filament\Resources\EventResource\RelationManagers;
use Bishopm\Hub\Models\Event;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EventResource extends Resource
{    
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('event')
                    ->required(),
                Forms\Components\Select::make('venue_id')
                    ->label('Venue')
                    ->relationship('venue', 'venue')
                    ->required(),
                Forms\Components\DateTimePicker::make('eventdate')
                    ->label('Date and time')
                    ->native(true)
                    ->displayFormat('Y-m-d H:i')
                    ->format('Y-m-d H:i')
                    ->required(),
                Forms\Components\TimePicker::make('endtime')
                    ->label('End time')
                    ->native(true)
                    ->seconds(false)
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->required(),
                Forms\Components\FileUpload::make('image')
                    ->directory('images/event')
                    ->previewable(false)
                    ->image(),
                Forms\Components\Checkbox::make('calendar')->label('Add to church calendar'),
                Forms\Components\Toggle::make('published'),
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('event')
                    ->sortable(),
                Tables\Columns\TextColumn::make('eventdate')
                    ->dateTime()
                    ->label('Date and time')
                    ->sortable(),
                Tables\Columns\IconColumn::make('calendar')
                    ->boolean(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->defaultSort('eventdate','DESC')
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
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}
