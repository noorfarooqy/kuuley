@extends('layouts.mainlayout')

@section('body-content')

<div class="mdk-drawer-layout__content page" style="transform: translate3d(0px, 0px, 0px);">



    <div class="container-fluid page__heading-container">
        <div
            class="page__heading d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-lg-between text-center text-lg-left">
            <h1 class="m-lg-0">Quiz report</h1>
            <div>
                <a href="student-edit-account.html" class="btn btn-light ml-3"><i class="material-icons">edit</i>
                    Edit</a>
                <a href="student-profile.html" class="btn btn-success ml-1">View Profile <i
                        class="material-icons">account_circle</i></a>
            </div>
        </div>
    </div>





    <div class="container-fluid page__container" v-if="Results != null && Questions.length > 0 && Trails.length > 0">

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <i class="fa fa-pen-alt mr-2"></i>Attempted
                        <h3>
                            @{{Questions.length}}
                        </h3>
                        Questions
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <i class="fa fa-file-alt mr-2"></i>Test
                        <h3>
                            @{{((Results['result']/Results['total'])*100).toFixed(1) + '%'}}
                        </h3>
                        Score
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <i class="fa fa-graduation-cap mr-2"></i>Estimated
                        <h3>
                            @{{GetEstimatedGrade()}}
                        </h3>
                        Grade
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <i class="fa fa-clock mr-2"></i>Time
                        <h3>
                            @{{Results['time']}}
                        </h3>
                        Taken
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-mg6 col-lg-6">
                <div class="card">
                    <div class="card-header card-header-large bg-white">
                        <h4 class="card-header__title">Quiz Projection</h4>
                    </div>
                    <div class="card-body">
                        <p> </p>

                        <result-chart :results="Results"></result-chart>
                    </div>
                </div>
            </div>
            <div class="col-mg6 col-lg-6">
                <div class="card">
                    <div class="card-header card-header-large bg-white">
                        <h4 class="card-header__title">Quiz Projection</h4>
                    </div>
                    <div class="card-body">
                        <p> </p>

                        <div class="chart">

                            <div class=" card-form__body card-body border-left">
                                <label for="">Correct questions (@{{Results.result}})</label>
                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar"
                                        :style="'width: '+((Results.result/Results.total)*100).toFixed(0)+'%'"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                        @{{((Results['result']/Results['total'])*100).toFixed(0)}}%
                                    </div>
                                </div>

                            </div>
                            <div class=" card-form__body card-body border-left">
                                <label for="">Correct questions (@{{Results.total - Results.result}})</label>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar"
                                        :style="'width: '+(((Results.total - Results.result)/Results.total)*100).toFixed(0)+'%; background-color:#e40808 !important'"
                                        aria-valuemin="0" aria-valuemax="100">
                                        @{{(((Results.total - Results.result)/Results['total'])*100).toFixed(0)}}%
                                    </div>
                                </div>

                            </div>

                            <div class=" card-form__body card-body border-left">
                                <label for="">Estimated rank - </label>
                                <span class="hint ml-3" style="font-size: 13px">Top 97% </span>
                                <div>
                                    <i class="fa fa-star text-success"></i>
                                    <i class="fa fa-star-half-alt text-success"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>

                                </div>


                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead class="thead bg-teal">
                            <tr class="">
                                <th class="text-white">
                                    Topic
                                </th>
                                <th class="text-white">
                                    Level
                                </th>
                                <th class="text-white">
                                    Feedback
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-soft-warning">
                                <td class="text-dark">Fractions topic</td>
                                <td>

                                    <div class="progress">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 25%;"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                            25%
                                        </div>
                                    </div>
                                </td>
                                <td class="text-dark">
                                    Poor
                                </td>
                            </tr>
                            <tr class="bg-soft-success">
                                <td class="text-dark">Fractions topic</td>
                                <td>

                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 25%;"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                            65%
                                        </div>
                                    </div>
                                </td>
                                <td class="text-dark">
                                    Good
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header bg-teal text-white">
                        Questions review
                    </div>
                    <div class="card-body">
                        <div v-for="(question,qkey) in Questions">
                            <div class="card-header d-flex justify-content-between">
                                <div class="row w-100">
                                    <div class="col-md-8 col-lg-8 ">
                                        <div class="d-flex align-items-center">
                                            <ul class="pagination">
                                                <li class="page-item">
                                                    <a class="page-link bg-soft-success rounded-circle" href="#"
                                                        tabindex="-1" v-if="HasGotQuestionCorrect(question)">
                                                        @{{qkey+1}}
                                                    </a>

                                                    <a class="page-link bg-soft-danger rounded-circle" href="#"
                                                        tabindex="-1" v-else>
                                                        @{{qkey+1}}
                                                    </a>

                                                </li>

                                            </ul>
                                            <div class="h4 m-0 ml-4">
                                                <vue-mathjax :formula="'$$' + question.question_text + '$$'">
                                                </vue-mathjax>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-md-4 col-lg-4 mr-0">
                                        <i class="fa fa-check-circle text-success fa-2x" style="float: right"
                                         v-if="HasGotQuestionCorrect(question)"></i>
                                        <i class="fa fa-times-circle text-danger fa-2x" style="float: right" v-else></i>
                                    </div>
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
                                                
                                                <i class="fa fa-thumbs-up text-success" 
                                                v-if="IsChosenAnswer(0, question) && 
                                                IsCorrectChoice(0, question)"></i>
                                                <i class="fa fa-thumbs-down text-danger" 
                                                v-else-if="IsChosenAnswer(0, question)"></i>
                                                <i class="fa fa-check-circle text-success" 
                                                v-if="question.answers[0].answer_bool == 0"></i>

                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex" data-position="2" data-answer-id="2"
                                            data-question-id="2">
                                            <span class="mr-2"><i class="material-icons text-light-gray">menu</i></span>
                                            <div>
                                                True
                                            </div>
                                            <div class="ml-auto">
                                                <i class="fa fa-thumbs-up text-success" 
                                                v-if="IsChosenAnswer(1, question) && 
                                                IsCorrectChoice(1, question)"></i>
                                                <i class="fa fa-thumbs-down text-danger" 
                                                v-else-if="IsChosenAnswer(1, question)"></i>
                                                <i class="fa fa-check-circle text-success" 
                                                v-if="question.answers[0].answer_bool == 1"></i>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div id="answerWrapper_1" class="mb-4" v-else>

                                    <ul class="list-group" id="answer_container_1">
                                        <li class="list-group-item d-flex" data-position="1" data-answer-id="1"
                                            data-question-id="1" v-for="(answer, akey) in question.answers" :key="akey">
                                            <span class="mr-2"><i class="material-icons text-light-gray">menu</i></span>
                                            <div>
                                                <vue-mathjax :formula="'$$ '+answer.answer_text+' $$'"></vue-mathjax>
                                            </div>
                                            <div class="ml-auto">

                                                <i class="fa fa-thumbs-up text-success" 
                                                v-if="IsCorrectChoice(answer,question)"></i>
                                                <i class="fa fa-thumbs-down text-danger" 
                                                v-else-if="IsChosenAnswer(answer,question)"></i>
                                                <i class="fa fa-check-circle text-success" 
                                                v-if="answer.is_correct"></i>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection

@section('scripts')
{{-- 
<script src="/assets/vendor/list.min.js"></script>
<script src="/assets/js/list.js"></script> --}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.2/MathJax.js?config=TeX-AMS_HTML"></script>
@php
$hash = hash('md5', file_get_contents(public_path('js/quiz_report.js')));
@endphp

<script>
    window.api_token = "{{Auth::user()->api_token}}";
    window.quiz = "{{$quiz->id}}";
    window.trail = "{{$trail[0]->trail_count}}";

</script>

<script src="{{'/js/quiz_report.js?'.$hash}}"></script>


@endsection

@section('links')
<!-- ion Range Slider -->

@endsection
