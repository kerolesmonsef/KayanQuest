@extends('layouts.master')
@section('title', "")

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <b>  {{ $question->content }}</b>
            </div>
            <div class="card-body ">
                @foreach($question->answers as $answer)
                    <div
                        style="{{ $answer->isTrue=='1'? 'border: 3px solid '.env('MAIN_COLOR').'; color:'.env('MAIN_COLOR').';':'border: 1px solid #426C90'}} ;background-color: rgba(255, 255, 255, 0.3)"
                        class="p-3 m-2 answerdiv">
                        <span
                            style="border: 1px solid #426C90; padding: 10px 15px; border-radius: 5px;margin-right: 19px">
                            <b>{{ $loop->iteration }}</b>
                        </span>
                        <span>
                            <b>{{ $answer->content }}</b>
                        </span>
                    </div>
                @endforeach
            </div>
            <div class="card-footer">
                <a class="btn btn-success" href="{{ route('question.index')."?type=today" }}">العودة الي الاسئلة
                    اليومية</a> <br>
                <a class="btn btn-primary mt-1" href="{{ route('question.index') }}"> اسئلة الموسم </a>
            </div>
        </div>
    </div>
@endsection


