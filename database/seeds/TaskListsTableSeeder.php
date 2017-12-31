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
        return [
            'board_id' => 1,
            'name'     => 'Tasks'
        ];
    }
}
