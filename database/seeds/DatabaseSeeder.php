<?php

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
        // $this->call(UsersTableSeeder::class);

        // 30 tag
        $tags = factory(App\Tag::class, 30)->create();

        // 10 categorie
        $categories = factory(App\Category::class, 10)->create();

        // 10 utenti
        $users = factory(App\User::class, 10)->create();

        foreach ($users as $user) {
            // 15 post per utente
            $posts = factory(App\Post::class, 15)->create([
                'user_id' => $user->id,
                // 1 categoria random fra quelle create
                'category_id' => $categories->random()->id,
            ]);
            // 3 tag random fra quelli create

            foreach ($posts as $post) {
                $post->tags()->sync($tags->random(3));
            }
        }
    }
}
