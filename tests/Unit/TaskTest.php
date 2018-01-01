<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TaskTest extends TestCase
{
    use DatabaseMigrations;

    protected $task;

    public function setUp()
    {
        parent::setUp();

        $board = factory(\App\Board::class)->create();
        $card = factory(\App\Card::class)->create(['board_id' => $board->id]);
        $this->task = factory(\App\Task::class)->create(['card_id' => $card->id]);
    }

    /** @test */
    public function task_belongs_to_card()
    {
        $this->assertInstanceOf(\App\Card::class, $this->task->card);
    }
}
