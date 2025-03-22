<?php

namespace Bishopm\Hub\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Spatie\Tags\HasTags;

class Tenant extends Model
{
    use HasTags;

    public $table = 'tenants';
    protected $guarded = ['id'];
    protected $connection = 'church';

    public static function getTagClassName(): string
    {
        return Tag::class;
    }

    public function diaryentries(): MorphMany
    {
        return $this->morphMany(Diaryentry::class,'diarisable');
    }

    public function tags(): MorphToMany
    {
        return $this
            ->morphToMany(self::getTagClassName(), 'taggable', 'taggables', null, 'tag_id')
            ->orderBy('order_column');
    }
}
