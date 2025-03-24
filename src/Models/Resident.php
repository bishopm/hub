<?php

namespace Bishopm\Hub\Models;

use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    public $table = 'residents';
    protected $guarded = ['id'];
    public $timestamps = false;

}
