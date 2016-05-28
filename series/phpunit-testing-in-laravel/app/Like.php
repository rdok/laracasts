<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    /**
     * Get the posts of this likes
     */
    public function posts()
    {
        return $this->morphTo();
    }

    /**
     * Get the users of this likes
     */
    public function users()
    {
        return $this->morphTo();
    }

    /**
     * Get all the owning likeable models.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function likeable()
    {
        return $this->morphTo();
    }
}
