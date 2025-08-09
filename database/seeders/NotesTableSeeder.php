<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("notes")->insert([
            [
                "user_id" => 1,
                "title" => "First Note",
                "content" => "This is the content of the first note.",
                "created_at" => now()
            ],
            [
                "user_id" => 1,
                "title" => "Second Note",
                "content" => "This is the content of the second note.",
                "created_at" => now()
            ],
            [
                "user_id" => 2,
                "title" => "Third Note",
                "content" => "This is the content of the third note.",
                "created_at" => now()
            ]
        ]);
    }
}
