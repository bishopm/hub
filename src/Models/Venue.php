<?php

namespace Bishopm\Hub\Models;

use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    public $table = 'venues';
    protected $guarded = ['id'];
    protected $connection = 'church';
}
