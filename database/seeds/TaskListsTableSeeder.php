<?php

use Illuminate\Database\Seeder;

class TaskListsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\TaskList::class, 3)->create([
            'board_id' => function() {
                return factory(App\Board::class)->create()->id;
            }
        ]);
    }
}
