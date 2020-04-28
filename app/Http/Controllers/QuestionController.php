<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use App\UserQuestions;
use Carbon\Carbon;
use Illuminate\Auth\Events\Validated;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class QuestionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $type = request('type');
        $questions = (new Question)->newQuery();
        $questions->orderBy("isFresh", 'DESC');
        $questions->orderBy("id", 'DESC');

        if ($type == "today") {
            $questions->whereDate('created_at', Carbon::now()->format('Y-m-d'));
            $questions->whereNotIn('questions.id', function (Builder $query) {
                $query->select('user_questions.question_id')
                    ->from('user_questions')
                    ->where('user_questions.user_id', auth()->user()->id);
            });
        }
        $user = auth()->user();
        $today = Carbon::now()->format('Y-m-d');
        $questions->select('*');
        $questions->addSelect(DB::raw("(questions.id not in (select user_questions.question_id from user_questions where user_questions.user_id = '$user->id') and Date(questions.created_at) = CURDATE() ) as isFresh"));
//        dd($questions->get());
        $questions = $questions->paginate(10);
        return view('Question.questions', ['questions' => $questions, 'title' => 'الاسئلة']);
    }


    public function myAnswers()
    {
        $user_questions = (new UserQuestions)->newQuery();
        $user_questions->join('answers', 'answers.id', '=', 'user_questions.answer_id');
        $user_questions->join('questions', 'questions.id', '=', 'user_questions.question_id');
        $user_questions->where('user_questions.user_id', '=', auth()->user()->id);
        $user_questions->selectRaw('user_questions.* ,
         answers.content as answerContent ,
         questions.content as questionContent ,
          answers.isTrue');
        $user_questions->orderBy('user_questions.id','DESC');
        $user_questions = $user_questions->paginate(10);
        return view('Question.myanswers', ['user_questions' => $user_questions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        if (!auth()->user()->isAdmin()) {
            return abort(404);
        }
        return view('Question.create_question');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return void
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'question' => 'required|string|min:1',
            'answers' => 'required',
            'right' => 'required'
        ]);

        $question = Question::create([
            'content' => request('question')
        ]);

        foreach (request('answers') as $answer => $content) {

            Answer::create([
                'content' => $content,
                'question_id' => $question->id,
                'isTrue' => request('right') == $content ? true : false,
            ]);
        }
        return redirect()->back()->with('s_alert_success', 'تم اضافة السوال بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param Question $question
     * @return void
     */
    public function show(Question $question)
    {
        if (!$question->created_at->isToday())
            return redirect(route('question.solution', ['question' => $question]));
        return view('Question.show_question', ['question' => $question]);
    }

    public function answer(Question $question)
    {
        $this->validate(request(), [
            'answer' => 'required|exists:answers,id'
        ]);
        $questionAnswer = $question->answers()->where('answers.id', '=', request('answer'))->first();
        if (is_null($questionAnswer)) {
            return redirect(route('question.show', ['question' => $question]))->withErrors(['error' => 'الاجابة غير مرتبطة بالسوال']);
        }
        $answerBefore = UserQuestions::Where(['user_id' => auth()->user()->id, 'question_id' => $question->id])->first();
        if (!is_null($answerBefore)) {
            return view('Question.solution', ['question' => $question])->withErrors(['error' => 'لقد تم الاجابة علي هذا السوال من قبل']);
        }
        UserQuestions::create([
            'user_id' => auth()->user()->id,
            'question_id' => $question->id,
            'answer_id' => request('answer'),
        ]);
        $answer = Answer::find(request('answer'));
        if ($answer->isTrue == '1') {
            return redirect(route('question.solution', ['question' => $question]))->with('s_alert_success', "احسن ان الاجابة كانت صحيحة");
        } else {
            return redirect(route('question.solution', ['question' => $question]))->withErrors(['error' => "للاسف الاجابة كانت خاطئة"]);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Question $question
     * @return void
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Question $question
     * @return void
     */
    public function update(Request $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Question $question
     * @return void
     * @throws \Exception
     */
    public function destroy(Question $question)
    {
        if (!auth()->user()->isAdmin())
        {
            return abort(404);
        }
        $question->delete();
        return redirect(route('question.index'))->with('s_alert_success','تم مسح السؤال');
    }

    /**
     * show only solution for specific question
     *
     * @param Question $question
     * @return Factory|View
     */
    public function solution(Question $question)
    {
        $answerBefore = UserQuestions::Where(['user_id' => auth()->user()->id, 'question_id' => $question->id])->first();
        $isToday = $question->created_at->isToday();
        if ($isToday and is_null($answerBefore)) {
            return redirect(route('question.show', ['question' => $question->id]));
        }
        return view('Question.solution', ['question' => $question]);
    }
}
