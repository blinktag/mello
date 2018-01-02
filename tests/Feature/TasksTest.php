<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TasksTest extends TestCase
{

    use DatabaseMigrations;

    /** @test */
    public function user_can_make_new_task()
    {
        $this->signIn();

        $board = factory(\App\Board::class)->create(['user_id' => auth()->user()->id]);
        $card = factory(\App\Card::class)->create(['board_id' => $board->id]);
        $task = factory(\App\Task::class)->make(['card_id' => $card->id]);

        $this->post('/task', $task->toArray())
             ->assertStatus(201);

        $this->get('/task/1')
             ->assertJson(['data' => [
                'id'        => 1,
                'card_id'   => 1,
                'name'      => $task->name,
                'order_key' => 1
             ]]);
    }

    /** @test */
    public function updateOrder_updates_order_key()
    {
        $this->signIn();

        // Create board, card, and 3 tasks for that card
        $board = factory(\App\Board::class)->create(['user_id' => auth()->user()->id]);
        $card = factory(\App\Card::class)->create(['board_id' => $board->id]);
        $tasks = factory(\App\Task::class, 3)->create(['card_id' => $card->id]);

        $test_data = ['items' => [
            '0' => ['id' => '2'],
            '1' => ['id' => '1'],
            '2' => ['id' => '3']
        ]];

        $this->put("/task/update-order", $test_data)
             ->assertStatus(200);

        $this->assertSame('0', \App\Task::find(2)->order_key);
        $this->assertSame('1', \App\Task::find(1)->order_key);
        $this->assertSame('2', \App\Task::find(3)->order_key);
    }
}
