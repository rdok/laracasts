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
        $this->guardAgainstTooManyMembers($this->extractNewUsersCount($users));

        if ($users instanceof User) {
            return $this->members()->save($users);
        }

        return $this->members()->saveMany($users);
    }

    private function guardAgainstTooManyMembers($numberOfMembersToAdd)
    {
        if ($this->count() >= $this->size) {
            throw new Exception("Team cannot hold any more members.");
        }

        if ($this->count() + $numberOfMembersToAdd > $this->size) {
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

    /**
     * @param $newMembers
     * @return int
     */
    private function extractNewUsersCount($newMembers)
    {
        $numberOfMembersToAdd = $newMembers instanceof User ? 1 : $newMembers->count();

        return $numberOfMembersToAdd;
    }

    public function removeMembers()
    {
        return $this->members()->update(['team_id' => null]);
    }

    public function remove($users)
    {
        if ($users instanceof User) {
            return $users->leaveTeam();
        }

        return $this->removeMany($users);
    }

    public function removeMany(Collection $users)
    {
        return $this
            ->members()
            ->whereIn('id', $users->pluck('id'))
            ->update(['team_id' => null]);
    }
}
