@extends('layouts.master')
@section('title', "")
@section('style')

@endsection
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header text-white" style="background-color: {{ env('MAIN_COLOR') }}">
                انشاء سؤال جديد
            </div>
            <div class="card-body ">
                <form method="POST" action="{{ route('question.store') }}" onsubmit="return validateForm()">
                    @csrf
                    <div class="form-group">
                        <label>السوال</label>
                        <input type="text" name="question" value="{{ old('question') }}" class="form-control question"
                               aria-describedby="emailHelp"
                               placeholder="اكتب السوال هنا">
                        <small id="emailHelp" class="form-text text-muted">اكتب السول ثم اضف الاجابات االمحتملة لهذا
                            السوال</small>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <label>الاجابات</label>
                            <input type="text" class="form-control answer_text"
                                   placeholder="اكتب الاجابة ثم اضغط علي اضافة الاجابة">
                        </div>
                        <div class="col-sm-2">
                            <label class="col-md-12">&nbsp;</label>
                            <button type="button" class="add_new_answer_button btn btn-info">اضافة اجابة</button>
                        </div>
                    </div>
                    <hr>
                    <div class="card">
                        <div class="card-header">
                            الاجابات هي ....
                        </div>
                        <ul class="list-group list-group-flush answers">

                        </ul>
                    </div>
                    <button type="submit" class="btn btn-primary">اضافة هذا السوال</button>
                </form>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script>
        $('.add_new_answer_button').click(function () {

            let answerText = $('.answer_text').val();
            if (answerText == '') return;
            let repeat = false;
            $('.answer_i_h_value').each(function (index, element) {
                if ($(this).val() == answerText) {
                    repeat = true;
                    return;
                }
            })

            if (repeat) return;

            $('.answers').append(
                `
                  <li class="list-group-item answer_i">
                    <div class="row">
                        <div class="col-sm-10" style="border-bottom: 1px solid;">
                            <input style="margin: 7px;float: left;" type="radio" value="${answerText}" checked name="right">
                            <input type="hidden" class="answer_i_h_value" value="${answerText}" name="answers[]">
                            <div class="">${answerText}</div>
                        </div>
                        <div class="col-sm-2">
                            <button type="button" class="btn btn-danger delete_answer_i">مسح الاجابة</button>
                        </div>
                    </div>
                </li>
              `
            );
            $('.answer_text').val('')
        })

        $(document).on('click', '.delete_answer_i', function () {
            $(this).parents('.answer_i').remove();
        })

        function validateForm() {
            if ($('.question').val() == "") {
                alert("برجاء كتابة السوال");
                return false;
            }
            if (!$("input[name='right']:checked").val()) {
                alert("برجاء اختيار الاجابة الصحيحة");
                return false;
            }
            return true
        }

        $('.answer_text').keypress(function (e) {
            if (e.which == 13) {
                e.preventDefault();
            }
        })

    </script>
@endsection


