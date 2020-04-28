@extends('layouts.master')
@section('title', "")
@section('style')
    <style rel="stylesheet">
        .answerdiv:hover {
            background-color: rgba(225, 216, 216, 0.3) !important;
            cursor: pointer;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header text-white" style="background-color: {{ env('MAIN_COLOR') }}">
                {{ $question->content }}
            </div>
            <div class="card-body ">
                @foreach($question->answers as $answer)
                    @component('Components.sAnswer')
                        @slot('ansStyle')
                            border: 1px solid #426C90;background-color: rgba(255, 255, 255, 0.3)
                        @endslot
                        @slot('onclick')
                            onclick="location.href='{{ route('question.answer',['question'=>$question->id,'answer'=>$answer->id]) }}'"
                        @endslot
                        @slot('content',$answer->content)
                        @slot('number',$loop->iteration)
                        @slot('box_style')
                            border: 1px solid #426C90; padding: 10px 15px; border-radius: 5px; margin-right:10px;
                        @endslot
                    @endcomponent
                @endforeach
            </div>
        </div>
    </div>
@endsection


