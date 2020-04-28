<?php

use Illuminate\Support\Facades\Route;
use App\UserQuestions;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/testlogAdmin', 'LoginController@testlogAdmin');
Route::get('/answerQuestion/{question}', 'QuestionController@answer')->name('question.answer');
Route::get('/myAnswers', 'QuestionController@myAnswers')->name('question.myAnswers');
Route::get('/QuestionSolution/{question}', 'QuestionController@solution')->name('question.solution');
Route::resource('question', 'QuestionController');


View::composer(['*'], function ($view) {
    $user = auth()->user();
    if (!is_null($user)) {
        $user_questions = (new UserQuestions)->newQuery();
        $user_questions->join('answers', 'answers.id', '=', 'user_questions.answer_id');
        $user_questions->where('answers.isTrue', '=', '1');
        $user_questions->where('user_questions.user_id', '=', auth()->user()->id);
        $score = $user_questions->count();
        $view->with('score', $score);
    }
});
