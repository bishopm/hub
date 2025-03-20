<?php

namespace Bishopm\Hub\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\Tags\HasTags;

class Tenant extends Model
{
    use HasTags;

    public $table = 'tenants';
    protected $guarded = ['id'];
    protected $connection = 'church';

    /*
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function diaryentries(): MorphMany
    {
        return $this->morphMany(Diaryentry::class,'diarisable');
    }
    */
}
