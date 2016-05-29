<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    /**
     * Get all the owning likeable models.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function likeable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
