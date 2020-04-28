<?php

use Faker\Factory;
use Illuminate\Database\Seeder;
use App\Question;
use App\Answer;

class Question_Answers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        for ($i = 0; $i < 99; $i++) {
            $question = Question::create([
                'content' => $faker->sentence(10),
            ]);
            Answer::create(['question_id' => $question->id, 'content' => $faker->sentence(2), 'isTrue' => false,]);
            Answer::create(['question_id' => $question->id, 'content' => $faker->sentence(2), 'isTrue' => false,]);
            Answer::create(['question_id' => $question->id, 'content' => $faker->sentence(2), 'isTrue' => false,]);
            Answer::create(['question_id' => $question->id, 'content' => $faker->sentence(2), 'isTrue' => true,]);
        }
    }
}
