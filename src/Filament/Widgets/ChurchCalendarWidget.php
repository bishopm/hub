<?php

namespace Bishopm\Hub\Filament\Widgets;

use Bishopm\Hub\Models\Course;
use Guava\Calendar\Widgets\CalendarWidget;
use Bishopm\Hub\Models\Diaryentry;
use Bishopm\Hub\Models\Event;
use Bishopm\Hub\Models\Group as GroupModel;
use Bishopm\Hub\Models\Tenant;
use Bishopm\Hub\Models\Venue;
use Carbon\Carbon;
use Filament\Actions\Action;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Notifications\Notification;
use Guava\Calendar\Actions\CreateAction;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;


class ChurchCalendarWidget extends CalendarWidget
{
    protected string $calendarView = 'timeGridWeek';

    protected bool $eventClickEnabled = true;

    protected bool $eventDragEnabled = true;

    protected bool $eventResizeEnabled = true;

    public ?Model $record = null;

    protected bool $dateSelectEnabled = true;

    public function getEvents(array $fetchInfo = []): Collection | array
    {
        if ($this->record->id){
            $collect = collect()
                ->push(...Diaryentry::query()->where('venue_id',$this->record->id)->get())
            ;
        } else {
            $collect = collect()
                ->push(...Diaryentry::query()->get())
            ;
        }
        return $collect;
    }

    public function getResources(): Collection|array
    {
        return collect()
            ->push(...Venue::query()->where('resource',1)->get())
        ;
    }

    public function getEventContent(): null | string | array
    {
        return [
            Diaryentry::class => view('hub::components.diaryentry'),
        ];
    }

    public function getHeaderActions(): array
    {
        return [
            Action::make('report')->label('Weekly report')
                ->form([
                    DatePicker::make('reportdate')
                        ->label('Starting date')
                        ->format('Y-m-d')
                        ->displayFormat('Y-m-d')
                        ->weekStartsOnMonday()
                        ->default(now())
                        ->required(),
                ])
                ->icon('heroicon-o-newspaper')
                ->action(function (array $data): void {
                    redirect()->route('reports.venue', ['id' => $this->record, 'reportdate'=>$data['reportdate']]);
                }),
                CreateAction::make('createDiaryentry')->label('Add a booking')
                    ->icon('heroicon-o-calendar-days')
                    ->model(Diaryentry::class)
                    ->before(function (array $data){
                        for ($i=1;$i<$data['repeats']+1;$i++){
                            $newtime=date('Y-m-d H:i',strtotime($data['diarydatetime'] . ' + ' . $i*$data['interval'] . ' days'));
                            Diaryentry::create([
                                'diarisable_id' => $data['diarisable_id'],
                                'diarisable_type' => 'tenant',
                                'venue_id' => $data['venue_id'],
                                'details' => $data['details'],
                                'diarydatetime' => $newtime,
                                'endtime' => $data['endtime']
                            ]);
                        }
                        return $data;
                    })
        ];
    }

    public function getEventClickContextMenuActions(): array
    {
        return [
            $this->editAction(),
            $this->deleteAction(),
        ];
    }

    public function getDateSelectContextMenuActions(): array
    {
        return [
            CreateAction::make('ctxCreateDiaryentry')
                ->model(Diaryentry::class)->modelLabel('Booking')
                ->mountUsing(function (Form $form, array $arguments) {
                    $getvenue=data_get($arguments, 'resource');
                    if ($getvenue){
                        $venue=$getvenue['id'];
                    } else {
                        $venue=$this->record->id;
                    }
                    $tenant = data_get($arguments, 'diarisable_id');
                    $utype = data_get($arguments, 'diarisable_type');
                    if (!$utype){
                        $utype="tenant";
                    }
                    $diarydatetime = data_get($arguments, 'startStr');
                    $endtime = data_get($arguments, 'endStr');
                    if ($diarydatetime) {
                        $form->fill([
                            'diarisable_id' => $tenant,
                            'diarisable_type' => $utype,
                            'diarydatetime' => Carbon::make($diarydatetime),
                            'endtime' => Carbon::make($endtime),
                            'venue_id' => $venue
                        ]);
                    }
                }),
        ];
    }

    public function getTimeClickContextMenuActions(): array
    {
        return [
            CreateAction::make('ctxCreateDiaryentry')
                ->model(Diaryentry::class)->modelLabel('Booking')
                ->mountUsing(function (Form $form, array $arguments) {
                    $date = data_get($arguments, 'dateStr');
                    if ($date) {
                        $form->fill([
                            'diarydatetime' => Carbon::make($date),
                            'endtime' => Carbon::make($date),
                        ]);
                    }
                }),
        ];
    }


    public function getSchema(?string $model = null): ?array
    {
        return 
            [
                Group::make([
                    Select::make('diarisable_id')
                        ->label('Venue user')
                        ->options(function (Get $get) {
                            if ($get('diarisable_type')=="group") {
                                return GroupModel::orderBy('groupname')->get()->pluck('groupname', 'id');
                            } elseif ($get('diarisable_type')=="event") {
                                return Event::orderBy('event')->get()->pluck('event', 'id');
                            } elseif ($get('diarisable_type')=="course") {
                                return Course::orderBy('course')->get()->pluck('course', 'id');
                            } else {
                                return Tenant::orderBy('tenant')->get()->pluck('tenant', 'id');
                            };
                        })
                        ->searchable()
                        ->required(),
                    Select::make('diarisable_type')
                        ->label('User type')
                        ->options([
                            'tenant' => 'External group',
                            'course' => setting('general.church_abbreviation') . ' course',
                            'event' => setting('general.church_abbreviation') . ' event',
                            'group' => setting('general.church_abbreviation') . ' group'
                        ])
                        ->selectablePlaceholder(false)
                        ->default('tenant')
                ])->columns(),
                Hidden::make('venue_id')
                    ->default($this->record->id),
                Textarea::make('details')
                    ->rows(5),
                Group::make([
                    TextInput::make('repeats')
                        ->label('Number of times to repeat')
                        ->default(0)
                        ->numeric()
                        ->minValue(0)
                        ->maxValue(52),
                    Select::make('interval')
                        ->options([
                            1  => 'daily',
                            7  => 'weekly',
                            14 => 'fortnightly'
                        ])
                        ->default(7)
                        ->label('How often to repeat'),
                Checkbox::make('calendar')->label('Add to church calendar')
                ])->columns(),
                Group::make([
                    DateTimePicker::make('diarydatetime')
                        ->label('Start time and date')
                        ->native(true)
                        ->default(function() {
                            return date('Y-m-d H:00',strtotime('+2 hours'));
                        })
                        ->seconds(false)
                        ->displayFormat('Y-m-d H:i')
                        ->format('Y-m-d H:i')
                        ->required(),
                    TimePicker::make('endtime')
                        ->label('End time')
                        ->default(function() {
                            return date('H:00',strtotime('+3 hours'));
                        })
                        ->native(true)
                        ->seconds(false)
                        ->required(),
                ])->columns(),
            ];
    }

    public function onEventDrop(array $info = []): bool
    {
        parent::onEventDrop($info);

        if (in_array($this->getEventModel(), [Diaryentry::class])) {
            $record = $this->getEventRecord();

            if ($delta = data_get($info, 'delta')) {
                $startsAt = $record->diarydatetime;
                $startsAt = date("Y-m-d H:i",strtotime($startsAt) + $delta['seconds']);
                $endsAt = $record->endtime;
                $endsAt = date("H:i",strtotime($endsAt) + $delta['seconds']);
                $record->update([
                    'diarydatetime' => $startsAt,
                    'endtime' => $endsAt,
                ]);

                Notification::make()
                    ->title('Event date moved!')
                    ->success()
                    ->send()
                ;
            }
            return true;
        }

        return false;
    }

    public function onEventResize(array $info = []): bool
    {
        parent::onEventResize($info);

        if ($this->getEventModel() === Diaryentry::class) {
            $record = $this->getEventRecord();
            if ($delta = data_get($info, 'endDelta')) {
                $endsAt = $record->endtime;
                $endsAt = date("H:i",strtotime($endsAt) + $delta['seconds']);
                $record->update([
                    'endtime' => $endsAt,
                ]);
            }

            Notification::make()
                ->title('Event duration changed!')
                ->success()
                ->send()
            ;

            return true;

        }

        Notification::make()
            ->title('Duration of this event cannot be changed!')
            ->danger()
            ->send()
        ;

        return false;
    }

    public function authorize($ability, $arguments = [])
    {
        return true;
    }

    public function getOptions(): array
    {
        return [
            'slotMinTime' => '07:00:00',
            'slotMaxTime' => '21:00:00',
            'headerToolbar' => [
                'start' => 'title',
                'center' => 'dayGridMonth,timeGridWeek,timeGridDay',
                'end' => 'today prev,next',
            ]
        ];
    }

}