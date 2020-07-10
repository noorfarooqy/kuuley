@extends('layouts.mainlayout')

@section('body-content')
<div class="mdk-drawer-layout__content page" style="transform: translate3d(0px, 0px, 0px);">



    <div class="container-fluid page__heading-container">
        <div
            class="page__heading d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-lg-between text-center text-lg-left">
            <h1 class="m-lg-0">Quizes</h1>
            <a href="" class="btn btn-success ml-lg-3">Back to Course <i class="material-icons">arrow_forward</i></a>
        </div>
    </div>
    {{-- <div id="toast-container" class="toast-top-right"><div class="toast toast-success" aria-live="polite" style="opacity: 0.721;"><div class="toast-progress" style="width: 0%;"></div><div class="toast-title">Well Done!</div><div class="toast-message">You successfully read this important alert message.</div></div></div> --}}





    <div class="container-fluid page__container">

        <div class="row">
            <div class="col-md-7 col-lg-7">
                <div class="alert alert-danger" v-if="Quizerrors.length > 0" v-for="(error,ekey) in Quizerrors"
                    :key="ekey" v-text="error"></div>
                <div class="z-0">


                    <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
                        <li class="nav-item">
                            <a href="#tab-21" class="nav-link" data-toggle="tab" role="tab" aria-controls="tab-21"
                                aria-selected="false">
                                <span class="nav-link__count">
                                    <img src="/assets/images/quiz_icon3.png" height="50" alt="">
                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#tab-22" class="nav-link" data-toggle="tab" role="tab" aria-selected="false">
                                <img src="/assets/images/quiz_icon2.png" height="50" alt="">
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#tab-23" class="nav-link" data-toggle="tab" role="tab" aria-selected="false">
                                <img src="/assets/images/quiz_icon1.png" height="50" alt="">
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#tab-24" class="nav-link" data-toggle="tab" role="tab" aria-selected="false">
                                <img src="/assets/images/quiz_icon1.png" height="50" alt="">
                            </a>
                        </li>
                    </ul>
                    <div class="card card-tab">
                        <div class="card-body tab-content">
                            <div class="tab-pane fade" id="tab-21">
                                <div class="card">
                                    <div class="card-header bg-primary text-white">
                                        True / False questions
                                    </div>
                                    <div class="card-body card-form__body">
                                        <form action="#">



                                            <math-comp  v-on:get-course-list="GetCourseList()"
                                            v-on:get-course-lessons="GetCourseLessons"
                                            v-on:new-quiz-added="AddNewQuestion"
                                            v-bind="{type:1, courses:Courses , lessons:Lessons}" >
                                            </math-comp>


                                        </form>
                                    </div>
                                </div>


                            </div>
                            <div class="tab-pane fade" id="tab-22">

                                <div class="card">
                                    <div class="card-header bg-primary text-white">
                                        Single choice questions
                                    </div>
                                    <div class="card-body card-form__body">
                                        <form action="#">



                                            <math-comp  v-on:get-course-list="GetCourseList()"
                                            v-on:get-course-lessons="GetCourseLessons"
                                            v-on:new-quiz-added="AddNewQuestion"
                                            v-bind="{type:2, courses:Courses , lessons:Lessons}" >
                                            </math-comp>

                                        </form>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane fade" id="tab-23">
                                <div class="card">
                                    <div class="card-header bg-primary text-white">
                                        Multi choice questions
                                    </div>
                                    <div class="card-body card-form__body">
                                        <form action="#">

                                            

                                            <math-comp  v-on:get-course-list="GetCourseList()"
                                            v-on:get-course-lessons="GetCourseLessons"
                                            v-on:new-quiz-added="AddNewQuestion"
                                            v-bind="{type:3, courses:Courses , lessons:Lessons}" >
                                            </math-comp>

                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab-24">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="alert alert-info">
                                            <i class="fa fa-info-circle"></i>
                                            Sorry!
                                        </div>

                                    </div>
                                    <div class="card-body card-form__body">
                                        We are still working on this question type.

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4" data-position="1" data-question-id="1" v-for="(question,qkey) in Questions">
                        <div class="card-header d-flex justify-content-between">
                            <div class="d-flex align-items-center ">

                                <span class="question_handle btn btn-sm btn-secondary">
                                    <i class="material-icons">menu</i>
                                </span>
                                <div class="h4 m-0 ml-4">
                                    <vue-mathjax :formula="'$$' + question.question_text + '$$'"></vue-mathjax>
                                </div>
                            </div>
                            <div>
                                <a href="#" class="btn btn-danger btn-sm"
                                    @click.prevent="DeleteQuestion(question.id, question.quiz_id)">Delete</a>
                            </div>
                        </div>
                        <div class="card-body">

                            <div id="answerWrapper_1" class="mb-4" v-if="question.question_type == 1">

                                <ul class="list-group" id="answer_container_1">
                                    <li class="list-group-item d-flex" data-position="1" data-answer-id="1"
                                        data-question-id="1">
                                        <span class="mr-2"><i class="material-icons text-light-gray">menu</i></span>
                                        <div>
                                            False
                                        </div>
                                        <div class="ml-auto">
                                            <i class="fa fa-check-circle" style="color: green"
                                                v-if="question.answers[0].answer_bool == false"></i>
                                            <i class="fa fa-times-circle" style="color: red" v-else></i>
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex" data-position="2" data-answer-id="2"
                                        data-question-id="2">
                                        <span class="mr-2"><i class="material-icons text-light-gray">menu</i></span>
                                        <div>
                                            True
                                        </div>
                                        <div class="ml-auto">
                                            <i class="fa fa-check-circle" style="color: green"
                                                v-if="question.answers[0].answer_bool == true"></i>
                                            <i class="fa fa-times-circle" style="color: red" v-else></i>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div id="answerWrapper_1" class="mb-4" v-else>

                                <ul class="list-group" id="answer_container_1">
                                    <li class="list-group-item d-flex" data-position="1" data-answer-id="1"
                                        data-question-id="1" v-for="(answer, akey) in question.answers" :key="akey">
                                        <span class="mr-2"><i class="material-icons text-light-gray">menu</i></span>
                                        <div >
                                            <vue-mathjax :formula="'$$ '+answer.answer_text+' $$'"></vue-mathjax>
                                        </div>
                                        <div class="ml-auto">
                                            <i class="fa fa-check-circle" style="color: green"
                                                v-if="answer.is_correct"></i>
                                            <i class="fa fa-times-circle" style="color: red" v-else></i>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5 col-lg-5">
                <div class="card">
                    <div class="card-header bg-light-gray">
                        Quiz information
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="questionType">Question type</label>
                            <input type="text" value="{{$quiz->GetQuizTypeName()}}" disabled class="form-control">
                        </div>
                        @if ($quiz->has_course)
                        <div class="form-group">
                            <label for="questionType">Course</label>

                            <input type="text" value="{{$quiz->GetCourseName()}}" disabled class="form-control">
                        </div>
                        @endif

                        <div class="form-group">
                            <label for="questionType">Quiz title</label>
                            <input type="text" class="form-control" value="{{$quiz->quiz_title}}">
                        </div>
                        <div class="form-group">
                            <label for="questionType">Quiz instructions</label>
                            <textarea class="form-control" placeholder="Enter instructions" name=""
                                id="">{{$quiz->quiz_instructions}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

@endsection

@section('toaster')

@endsection

@section('scripts')
<script>
    window.quiz_id = "{{$quiz->id}}";

</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.2/MathJax.js?config=TeX-AMS_HTML"></script>

<script src="/js/quizes.js"></script>
{{-- <link id="themecss" rel="stylesheet" type="text/css" href="//www.shieldui.com/shared/compon            <div class="card-header">ents/latest/css/light/all.min.css" /> --}}
@endsection
@section('links')

{{-- <link id="themecss" rel="stylesheet" type="text/css" href="//www.shieldui.com/shared/components/latest/css/light/all.min.css" /> --}}
@endsection
