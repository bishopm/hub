<?php

namespace Bishopm\Hub\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Group extends Model
{
    public $table = 'groups';
    protected $guarded = ['id'];
    protected $connection = 'church';

    public function diaryentries(): MorphMany
    {
        return $this->morphMany(Diaryentry::class,'diarisable');
    }

}