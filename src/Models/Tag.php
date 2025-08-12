<?php

namespace Bishopm\Hub\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Tag extends Model
{
    public $table = 'tags';
    protected $guarded = ['id'];
    protected $connection = 'church';

    public function projects(): MorphToMany
    {
        return $this->morphToMany(Project::class,'taggable');
    }

    public function venues(): MorphToMany
    {
        return $this->morphToMany(Venue::class,'taggable');
    }

    public function tenants(): MorphToMany
    {
        return $this->morphToMany(Tenant::class,'taggable');
    }
}
