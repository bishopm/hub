<?php

namespace Bishopm\Hub\Filament\Widgets;

use Bishopm\Hub\Models\Individual;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\DB;

class NewMembers extends Widget
{
    protected static string $view = 'hub::widgets.new-members';

    public ?array $memberdata;

    function mount() {
        $this->memberdata['individuals']=Individual::orderBy('created_at','DESC')->take(5)->get();
        $this->memberdata['duplicates']=DB::table('individuals')->select('firstname','surname', DB::raw('COUNT(*) as `count`'))->groupBy('firstname', 'surname')->having('count', '>', 1)->get()->take(15);
        $this->memberdata['whatsapp']=setting('messages.welcome_whatsapp');
    }

    public static function canView(): bool 
    { 
        $roles =auth()->user()->roles->toArray(); 
        $permitted = array('Office','Finance');
        foreach ($roles as $role){
            if ((in_array($role['name'],$permitted)) or (auth()->user()->isSuperAdmin())){
                return true;
            }
        }
        return false;
    }
}
