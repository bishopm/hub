<?php

namespace Bishopm\Hub\Models;

use Spatie\Tags\Tag as BaseTags;

class Tag extends BaseTags
{
    public $table = 'tags';
    protected $connection = 'church';
}
