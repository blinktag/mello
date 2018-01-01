<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CardTest extends TestCase
{
    use DatabaseMigrations;

    protected $card;

    public function setUp()
    {
        parent::setUp();

        $board = factory(\App\Board::class)->create();
        $this->card = factory(\App\Card::class)->create(['board_id' => $board]);
    }

    /** @test */
    public function card_belongs_to_board()
    {
        $this->assertInstanceOf(\App\Board::class, $this->card->board);
    }

    /** @test */
    public function card_has_tasks()
    {
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $this->card->tasks);
    }
}
