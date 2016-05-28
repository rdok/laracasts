<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Likes extends Model
{
    /**
     * Get the files of this events.
     */
    public function posts()
    {
        return $this->morphTo();
    }
}
