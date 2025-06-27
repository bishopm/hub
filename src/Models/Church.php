<?php

namespace Bishopm\Hub\Models;

use Illuminate\Database\Eloquent\Model;

class Church extends Model
{
    public $table = 'churches';
    protected $guarded = ['id'];
    public $timestamps = false;

}
