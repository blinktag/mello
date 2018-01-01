<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class BoardTest extends TestCase
{
    use DatabaseMigrations;

    protected $board;

    public function setUp()
    {
        parent::setUp();

        $user = factory(\App\User::class)->create();
        $this->board = factory(\App\Board::class)->create(['user_id' => $user]);
    }

    /** @test */
    public function board_belongs_to_user()
    {
        $this->assertInstanceOf(\App\User::class, $this->board->user);
    }

    /** @test */
    public function board_has_cards()
    {
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $this->board->cards);
    }
}
