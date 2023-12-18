<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\History;
use App\Models\Publisher;
use App\Models\Punish;
use App\Models\Punishment;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'username' => 'user1',
            'password' => bcrypt('password')
        ]);

        User::create([
            'username' => 'user2',
            'password' => bcrypt('password')
        ]);

        Author::create([
            'name' => 'Tere Liye',
            'email' => 'darvisdarvis@yahoo.com'
        ]);

        Publisher::create([
            'name' => 'Gramedia Pustaka Utama',
            'address' => 'Jl. Palmerah Barat 29-37 10270, RT.1/RW.2, Gelora, Tanah Abang, Central Jakarta City, Jakarta 10270'
        ]);

        Category::create([
            'name' => 'Novel'
        ]);

        Book::create([
            'title' => 'Bumi',
            'cover' => 'bumi.jpg',
            'author_id' => 1,
            'publisher_id' => 1,
            'category_id' => 1
        ]);

        Book::create([
            'title' => 'Bulan',
            'cover' => 'bulan.jpg',
            'author_id' => 1,
            'publisher_id' => 1,
            'category_id' => 1
        ]);

        Book::create([
            'title' => 'Matahari',
            'cover' => 'matahari.jpg',
            'author_id' => 1,
            'publisher_id' => 1,
            'category_id' => 1
        ]);

        Book::create([
            'title' => 'Bintang',
            'cover' => 'bintang.jpg',
            'author_id' => 1,
            'publisher_id' => 1,
            'category_id' => 1
        ]);

        History::create([
            'borrow_from' => now(),
            'borrow_until' => now()->next(),
            'user_id' => 1,
            'book_id' => 1
        ]);

        Punishment::create([
            'name' => '~1 Week late returning'
        ]);

        Punish::create([
            'user_id' => 1,
            'punishment_id' => 1
        ]);
    }
}
