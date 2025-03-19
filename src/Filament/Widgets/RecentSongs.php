<?php

namespace Bishopm\Hub\Filament\Widgets;

use Bishopm\Hub\Models\Household;
use Bishopm\Hub\Models\Song;
use Filament\Widgets\Widget;

class RecentSongs extends Widget
{
    protected static string $view = 'hub::widgets.recent-songs';

    public ?array $widgetdata;

    function mount() {
        $this->widgetdata['songs']=Song::orderBy('created_at','DESC')->take(5)->get();
    }

    public static function canView(): bool 
    { 
        $roles =auth()->user()->roles->toArray(); 
        $permitted = array('Office','Finance','Worship');
        foreach ($roles as $role){
            if ((in_array($role['name'],$permitted)) or (auth()->user()->isSuperAdmin())){
                return true;
            }
        }
        return false;
    }
}
