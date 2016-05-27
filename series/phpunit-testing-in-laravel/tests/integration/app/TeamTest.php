<?php

use App\Team;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TeamTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     * @param $teamName
     * @dataProvider teamNamesProvider
     */
    public function a_team_has_a_name($teamName)
    {
        $team = new Team(['name' => $teamName]);

        $this->assertSame($teamName, $team->name);
    }

    public function teamNamesProvider()
    {
        return [['TeamName1',], ['TeamName2']];
    }

    /** @test */
    public function a_team_can_add_members()
    {
        $team = factory(Team::class)->create();
        $users = factory(User::class, 2)->create();

        $team->add($users->get(0));
        $team->add($users->get(1));

        $this->assertSame(2, $team->count());
    }
}
