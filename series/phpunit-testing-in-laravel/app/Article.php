<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public function scopeTrending(Builder $query)
    {
        return $query->orderBy('reads', 'desc');
    }
}
