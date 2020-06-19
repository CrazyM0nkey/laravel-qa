<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Question;
use App\Answer;
class UsersQuestionsAnswersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        DB::table('answers')->delete();
        DB::table('questions')->delete();
        DB::table('users')->delete();

        factory(User::class, 3)->create()->each(function ($user) {
            $user->questions()
                ->saveMany(
                    factory(Question::class, rand(1, 5))->make()
                )
                ->each(function ($question) {
                    $question->answers()->saveMany(factory(Answer::class, rand(1, 5))->make());
                });
        });
    }
}
