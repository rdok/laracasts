<?php

namespace App;

use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['name', 'size'];

    public function add($users)
    {
        $this->guardAgainstTooManyMembers($users);

        if ($users instanceof User) {
            return $this->members()->save($users);
        }

        return $this->members()->saveMany($users);
    }

    private function guardAgainstTooManyMembers($newMembers)
    {
        if ($this->count() >= $this->size) {
            throw new Exception("Team cannot hold any more members.");
        }

        if ($this->count() + $newMembers->count() > $this->size) {
            throw new Exception("Team maximum size is exceeded.");
        }
    }

    public function count()
    {
        return $this->members()->count();
    }

    public function members()
    {
        return $this->hasMany(User::class);
    }
}
