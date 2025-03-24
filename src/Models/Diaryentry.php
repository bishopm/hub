<?php

namespace Bishopm\Hub\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Bishopm\Hub\Models\Venue;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Diaryentry extends Model
{
    public $table = 'diaryentries';
    protected $guarded = ['id'];
    protected $connection = 'church';

    public function diarisable(): MorphTo
    {
        return $this->morphTo();
    }

    public function venue(): BelongsTo
    {
        return $this->belongsTo(Venue::class);
    }

}
