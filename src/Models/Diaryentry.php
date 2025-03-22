<?php

namespace Bishopm\Hub\Models;

use Illuminate\Database\Eloquent\Model;
use Guava\Calendar\Contracts\Eventable;
use Guava\Calendar\ValueObjects\Event;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Bishopm\Hub\Models\Venue;
use Bishopm\Hub\Models\Tenant;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Diaryentry extends Model implements Eventable
{
    public $table = 'diaryentries';
    protected $guarded = ['id'];
    protected $connection = 'church';

    public function toEvent(): Event|array {
        $colour="#14B8A6";
        if ($this->details==''){
            if ($this->diarisable_type=="tenant"){
                if (isset($this->diarisable->tenant)){
                    $this->details=$this->diarisable->tenant;
                }
                if ($this->diarisable_id==setting('admin.church_tenant')){
                    $colour="blue";    
                }
            } elseif ($this->diarisable_type=="group"){
                $colour="blue";
                if (isset($this->diarisable->groupname)){
                    $this->details=$this->diarisable->groupname;
                }
            } elseif ($this->diarisable_type=="event"){
                $colour="red";
                if (isset($this->diarisable->event)){
                    $this->details=$this->diarisable->event;
                }    
            } elseif ($this->diarisable_type=="course"){
                $colour="green";
                if (isset($this->diarisable->course)){
                    $this->details=$this->diarisable->course;
                }    
            }
        } else {
            if ($this->diarisable_type=="tenant"){
                if (isset($this->diarisable->tenant)){
                    $this->details=$this->diarisable->tenant . " (" . $this->details . ")";
                }
                if ($this->diarisable_id==setting('admin.church_tenant')){
                    $colour="blue";    
                }
            } elseif ($this->diarisable_type=="group"){
                $colour="blue";
                if (isset($this->diarisable->groupname)){
                    $this->details=$this->diarisable->groupname . " (" . $this->details . ")";
                }
            } elseif ($this->diarisable_type=="event"){
                $colour="red";
                if (isset($this->diarisable->event)){
                    $this->details=$this->diarisable->event . " (" . $this->details . ")";
                }
            } elseif ($this->diarisable_type=="course"){
                $colour="green";
                if (isset($this->diarisable->course)){
                    $this->details=$this->diarisable->course . " (" . $this->details . ")";
                }
            }
        }
        if (!$this->details){
            $this->details = "-";
        }

        $event = Event::make($this)
            ->title($this->details)
            ->backgroundColor($colour)
            ->start($this->diarydatetime)
            ->end(date('Y-m-d',strtotime($this->diarydatetime)) . " " . $this->endtime)
            ->extendedProp('tenant', $this->diarisable_type);
        if ($this->venue_id) {
            $event->resourceId($this->venue_id);
        }
        return $event;        
    }

    public function diarisable(): MorphTo
    {
        return $this->morphTo();
    }

    public function venue(): BelongsTo
    {
        return $this->belongsTo(Venue::class);
    }

}
