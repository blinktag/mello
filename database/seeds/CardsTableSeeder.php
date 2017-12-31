<?php

use Illuminate\Database\Seeder;

class CardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Card::class, 3)->create([
            'board_id' => function() {
                return factory(App\Board::class)->create()->id;
            }
        ]);
    }
}
