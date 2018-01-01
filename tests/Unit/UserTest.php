<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class User extends TestCase
{

    use DatabaseMigrations;

    protected $user;

    public function setUp()
    {
        parent::setUp();
        $this->user = factory(\App\User::class)->create();
    }

    /** @test */
    public function user_has_boards()
    {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->user->boards);
    }

    /** @test */
    public function getGravatarUrl()
    {
        $this->user->email = 'Admin@mello.test';

        $expected = 'https://www.gravatar.com/avatar/0d816f2218515da6033bcd0487ae48ad';
        $this->assertSame($expected, $this->user->getGravatarUrl());
    }

}
