@extends('layouts.mainlayout')

@section('body-content')
<div class="mdk-drawer-layout__content page" style="transform: translate3d(0px, 0px, 0px);">



    <div class="container-fluid page__heading-container">
        <div class="page__heading d-flex align-items-center justify-content-between">
            <h1 class="m-0">Student Diagnostics - </h1>
        </div>
    </div>





    <div class="container-fluid page__container">
        @if ($errors->any())
        <div class="alert alert-danger" :error='showErrors("{{$errors->first()}}")'>
            {{$errors->first()}}
        </div>

        @endif
        @if (Session::has('success'))
        <div class="alert alert-success" :success='showSuccess("{{Session::get('success')}}")'>
            {{Session::get('success')}}
        </div>
        @endif
        <div class="row">
            <div class="col-md-7">
                <div class="card" v-if="Questions != null && Questions.length > 0">
                    <div class="card-header">
                        
                    </div>
                    <div class="card-body">
                        <div class="card mb-4" data-position="1" data-question-id="1">
                            <div v-for="(question,qkey) in Questions">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="d-flex align-items-center ">

                                        <span class="question_handle btn btn-sm btn-secondary">
                                            <i class="material-icons">menu</i>
                                        </span>
                                        <div class="h4 m-0 ml-4">
                                            <vue-mathjax :formula="'$$' + question.question_text + '$$'"></vue-mathjax>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">

                                    <div id="answerWrapper_1" class="mb-4" v-if="question.question_type == 1">

                                        <ul class="list-group" id="answer_container_1">
                                            <li class="list-group-item d-flex" data-position="1" data-answer-id="1"
                                                data-question-id="1">
                                                <span class="mr-2"><i
                                                        class="material-icons text-light-gray">menu</i></span>
                                                <div>
                                                    False
                                                </div>
                                                <div class="ml-auto">
                                                    <input type="radio" v-model="question.answer"
                                                        :name="'answer'+question.id" id="" class="form-control-input"
                                                        :value="0" :checked="question.answer == 0">
                                                </div>
                                            </li>
                                            <li class="list-group-item d-flex" data-position="2" data-answer-id="2"
                                                data-question-id="2">
                                                <span class="mr-2"><i
                                                        class="material-icons text-light-gray">menu</i></span>
                                                <div>
                                                    True
                                                </div>
                                                <div class="ml-auto">
                                                    <input type="radio" :value="1" v-model="question.answer"
                                                        :checked="question.answer == 1" :name="'answer'+question.id"
                                                        id="" class="form-control-input">
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div id="answerWrapper_1" class="mb-4" v-else>

                                        <ul class="list-group" id="answer_container_1">
                                            <li class="list-group-item d-flex" data-position="1" data-answer-id="1"
                                                data-question-id="1" v-for="(answer, akey) in question.answers"
                                                :key="akey">
                                                <span class="mr-2"><i
                                                        class="material-icons text-light-gray">menu</i></span>
                                                <div>
                                                    <vue-mathjax :formula="'$$ '+answer.answer_text+' $$'">
                                                    </vue-mathjax>
                                                </div>
                                                <div class="ml-auto">

                                                    <input type="radio" v-model="question.answer"
                                                        :checked="question.answer == question.id"
                                                        :name="'answer'+question.id" :id="question.id"
                                                        class="form-control-input" v-if="question.question_type == 2"
                                                        :value="answer.id">

                                                    <input type="checkbox" :name="'answer'+question.id+'_'+akey"
                                                        :value="answer.id" class="form-control-input" v-else
                                                        v-model="question.answer"
                                                        :checked="question.answer == question.id">
                                                </div>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="mt-3 mb-3 center">
                                        <input type="submit" value="Save" class="btn btn-primary"
                                            @click.prevent="submitAnswer(question)">
                                    </div>
                                    <div class="mb-3 center">
                                        <span class="text-light-gray" v-if="question.answer != null">Saved</span>
                                    </div>

                                </div>
                            </div>
                            <div class="btn btn-primary" @click.prevent="submitQuiz(Questions[0].quiz_id)">
                                Submit Assignment</div>
                        </div>
                    </div>
                </div>

                <div class="card" v-else>
                    <div class="card-header">
                        No quiz selected
                    </div>
                    <div class="card-body">
                        select Diagnostics to view questions
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-header"></div>
                    <div class="card-body">
                        <table class="table">
                            <thead class="thead">
                                <tr>
                                    <th>#</th>
                                    <th>Trial date</th>
                                    <th>Result</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(result, rkey) in SubmittedResults">
                                    <td v-text="rkey+1"></td>
                                    <td >
                                        <a :href="'/student/trail/'+result['quiz']+'/'+result['trail']" v-text="result['date']"></a>
                                    </td>
                                    <td v-text="((result['result']/result['total'])*100).toFixed(2) + '%'"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <div class="col-md-5">

                <div class="card">

                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Diagostic</th>
                                <th>Status</th>
                                <td>Date</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Diagnostics as $quiz)
                            <tr>
                                <td></td>
                                <td>
                                    <a href="#" @click.prevent="GetDiagnostic({{$quiz->QuizInfo}})">
                                        {{$quiz->QuizInfo->quiz_title}}
                                    </a>
                                </td>
                                <td>{{$quiz->QuizInfo->Trials->count()}}</td>
                                <td>{{$quiz->updated_at->format('Y-m-d')}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </div>


</div>
@endsection

@section('scripts')
@php
    $api_token = Auth::user()->api_token;
@endphp

<script>
    window.api_token = "{{$api_token}}"
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.2/MathJax.js?config=TeX-AMS_HTML"></script>
@php
    $hash = hash('md5', file_get_contents(public_path('js/student_diag.js')));

@endphp
<script src="{{'/js/student_diag.js?'.$hash}}"></script>

@endsection

@section('links')

@endsection
