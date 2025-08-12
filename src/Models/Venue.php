<?php

namespace Bishopm\Hub\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Venue extends Model
{
    public $table = 'venues';
    protected $guarded = ['id'];
    protected $connection = 'church';

    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
