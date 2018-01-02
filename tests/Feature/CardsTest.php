<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CardsTest extends TestCase
{

    use DatabaseMigrations;

    /** @test */
    public function user_can_create_card()
    {
        $this->signIn();

        $board = factory(\App\Board::class)->create(['user_id' => auth()->user()->id]);
        $card = factory(\App\Card::class)->make(['board_id' => $board->id]);

        $this->post('/card', $card->toArray())
             ->assertStatus(201);

        $this->get('/card/1')
             ->assertJson(['data' => [
                'id'   => 1,
                'name' => $card->name
             ]]);
    }
}
