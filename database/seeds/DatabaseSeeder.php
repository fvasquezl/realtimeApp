<?php

use App\Model\Category;
use App\Model\Like;
use App\Model\Question;
use App\Model\Reply;
use App\User;
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
        factory(User::class)->create([
            'name' => 'Faustino Vasquez',
            'email' =>'fvasquez@local.com',
        ]);

        factory(User::class)->create([
            'name' => 'Sebastian Vasquez',
            'email' =>'svasquez@local.com',
        ]);

        factory(User::class,10)->create();
        factory(Category::class,5)->create();
        factory(Question::class,10)->create();
        factory(Reply::class,10)->create()->each(function ($reply){
            return $reply->like()->save(factory(Like::class)->make());
        });
    }
}
