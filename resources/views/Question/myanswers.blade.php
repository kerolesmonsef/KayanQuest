@extends('layouts.master')
@section('title', 'اجاباتي')


@section('content')
    <div class="container-fluid">
        <div class="card">

            <div class="card-body">
                @foreach($user_questions as $user_question)
                    <div class="card">
                        <div
                            class="card-header text-right text-white {{ $user_question->isTrue?'bg-success':'bg-danger' }} ">
                            <a style="color: white"
                               href="{{ route('question.show',['question'=>$user_question->question_id]) }}">{{ $user_question->questionContent }}</a>
                            @if($user_question->isTrue == '1')
                                <i class="fas fa-check"></i>
                            @else
                                <i class="fas fa-times"></i>
                            @endif
                        </div>
                        <div class="card-body text-right">
                            <span class="p-r-2" style="padding-right: 10px;color: {{ env('MAIN_COLOR') }}">
                                {{ \Carbon\Carbon::parse($user_question->created_at)->diffForHumans() }}
                            </span>
                            <a href="{{ route('question.solution',['question'=>$user_question->question_id]) }}"
                               class="btn btn-info">
                                <span class="mb-1">عرض</span>
                                <i class="ml-1 fas fa-chevron-right"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="card-footer">
                <div class="text-center">
                    {{ $user_questions->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection


