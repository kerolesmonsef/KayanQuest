@extends('layouts.master')
@section('title', $title)


@section('content')
    <div class="container-fluid">
        <div class="card">

            <div class="card-body">
                @foreach($questions as $question)
                    <div class="card">
                        <div class="card-header text-right text-white "
                             style="background-color: {{ env('MAIN_COLOR') }}">
                            <a style="color: white"
                               href="{{ route('question.show',['question'=>$question->id]) }}">{{ $question->content }} {{ $question->id }}</a>
                        </div>
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-sm-3">
                                    @if(auth()->user()->isAdmin())
                                        <button data-toggle="modal"
                                                data-target=".remove_the_question"
                                                class="btn-danger btn delete_the_question_button"
                                                data-delete-url="{{ route('question.destroy',['question'=>$question->id]) }}">
                                            مسح السؤال
                                        </button>
                                    @endif
                                </div>
                                <div class="col-sm-9 text-right">
                                <span class="p-r-2" style="padding-right: 10px;color: {{ env('MAIN_COLOR') }}">
                                    {{ \Carbon\Carbon::parse($question->created_at)->diffForHumans() }}
                                </span>
                                    @if($question->isFresh == "1")
                                        <a href="{{ route('question.show',['question'=>$question->id]) }}"
                                           class="btn btn-info">
                                            <span class="mb-1">اجابة</span>
                                            <i class="ml-1 fas fa-chevron-right"></i>
                                        </a>
                                    @else
                                        <a href="{{ route('question.solution',['question'=>$question->id]) }}"
                                           class="btn btn-info">
                                            <span class="mb-1">عرض</span>
                                            <i class="ml-1 fas fa-chevron-right"></i>
                                        </a>
                                    @endif
                                </div>

                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
            <div class="card-footer">
                <div class="text-center">
                    {{ $questions->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
    </div>
    @component('Components.ask_before_action')
        @slot('fire_button_class','delete_the_question_button')
        @slot("modal_class","remove_the_question")
        @slot('crsf',csrf_field())
        @slot('method_in_form',method_field("delete"))
    @endcomponent
@endsection


