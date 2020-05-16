<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Factory;
use Illuminate\Support\Str;

class BooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for($i=0; $i<10; $i++) {
            DB::table('books')->insert([
                'user_id' => $i,
                'title' => Str::random(20),
                'description' => Str::random(100),
            ]);
        }
    }
}
