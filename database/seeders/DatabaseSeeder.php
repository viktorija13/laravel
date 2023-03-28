<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Book;
use App\Models\Genre;
use App\Models\User;
use App\Models\Writer;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        Writer::truncate();
        Genre::truncate();
        Book::truncate();

        User::factory(5)->create();

        $writer1 = Writer::factory()->create();
        $writer2 = Writer::factory()->create();
        $writer3 = Writer::factory()->create();

        $genre1 = Genre::factory()->create();
        $genre2 = Genre::factory()->create();
        $genre3 = Genre::factory()->create();
        $genre4 = Genre::factory()->create();
        $genre5 = Genre::factory()->create();

        Book::factory(2)->create([
            'writer_id' => $writer1->id,
            'genre_id' => $genre1->id
        ]);
        Book::factory(4)->create([
            'writer_id' => $writer1->id,
            'genre_id' => $genre2->id
        ]);
        Book::factory(2)->create([
            'writer_id' => $writer1->id,
            'genre_id' => $genre3->id
        ]);
        Book::factory(1)->create([
            'writer_id' => $writer2->id,
            'genre_id' => $genre2->id
        ]);
        Book::factory(2)->create([
            'writer_id' => $writer2->id,
            'genre_id' => $genre3->id
        ]);
        Book::factory(3)->create([
            'writer_id' => $writer2->id,
            'genre_id' => $genre4->id
        ]);
        Book::factory(3)->create([
            'writer_id' => $writer3->id,
            'genre_id' => $genre3->id
        ]);
        Book::factory(1)->create([
            'writer_id' => $writer3->id,
            'genre_id' => $genre4->id
        ]);
        Book::factory(1)->create([
            'writer_id' => $writer3->id,
            'genre_id' => $genre5->id
        ]);
    }
}
