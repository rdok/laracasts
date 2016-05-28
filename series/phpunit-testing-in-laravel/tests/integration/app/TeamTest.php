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
    public function it_has_a_name($teamName)
    {
        $team = new Team(['name' => $teamName]);

        $this->assertSame($teamName, $team->name);
    }

    public function teamNamesProvider()
    {
        return [['TeamName1',], ['TeamName2']];
    }

    /** @test */
    public function it_can_add_a_member()
    {
        $team = factory(Team::class)->create();

        $user = factory(User::class)->create();

        $team->add($user);

        $this->assertSame(1, $team->count());
    }

    /** @test */
    public function it_can_add_members()
    {
        $team = factory(Team::class)->create();
        $users = factory(User::class, 2)->create();

        $team->add($users);

        $this->assertSame(2, $team->count());
    }

    /** @test */
    public function it_has_a_maximum_size()
    {
        $team = factory(Team::class)->create(['size' => 2]);

        $users = factory(User::class, 2)->create();

        $team->add($users);

        $this->setExpectedException(Exception::class, "Team cannot hold any more members.");

        $users = factory(User::class, 2)->create();

        $team->add($users);
    }

    /** @test */
    public function it_has_a_maximum_size_when_members_to_add_are_greater_than_max()
    {
        $team = factory(Team::class)->create(['size' => 2]);

        $this->setExpectedException(Exception::class, "Team maximum size is exceeded.");

        $users = factory(User::class, 3)->create();

        $team->add($users);
    }

    /** @test */
    public function it_can_add_multiple_members_at_once()
    {
        $team = factory(Team::class)->create();

        $users = factory(User::class, 2)->create();

        $team->add($users);

        $this->assertSame(2, $team->count());
    }

    /** @test */
    public function removes_a_member()
    {
        $team = factory(Team::class)->create();

        $users = factory(User::class, 2)->create();

        $team->add($users);

        $team->remove($users->get(0));

        $this->assertSame(1, $team->count());

        $actualMember = $team->members()->get()->get(0);

        $this->assertEquals($users->get(1)->id, $actualMember->id);
    }

    /** @test */
    public function reset_members()
    {
        $team = factory(Team::class)->create();

        $users = factory(User::class, 2)->create();

        $team->add($users);

        $team->resetMembers();

        $this->assertSame(0, $team->count());
    }
}
