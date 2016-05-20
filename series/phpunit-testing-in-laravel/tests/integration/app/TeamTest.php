<?php

use App\Team;
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

        $this->assertSame($teamName, $team->name());
    }

    public function teamNamesProvider()
    {
        return [
            ['TeamName1',],
            ['TeamName2']
        ];
    }
}
