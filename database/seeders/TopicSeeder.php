<?php

namespace Database\Seeders;

use App\Models\Topic;
use Illuminate\Database\Seeder;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Topic::insert([
            ['title' => 'topic1', 'created_at' => Now(), 'updated_at' => Now()],
            ['title' => 'topic2', 'created_at' => Now(), 'updated_at' => Now()],
        ]);
    }
}
