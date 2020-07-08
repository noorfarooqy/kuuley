@extends('layouts.mainlayout')

@section('body-content')


<div class="mdk-drawer-layout__content page" style="transform: translate3d(0px, 0px, 0px);">



    <div class="container-fluid page__heading-container">
        <div
            class="page__heading d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-lg-between text-center text-lg-left">
            <div>
                @if (isset($viewLesson) && $viewLesson != null)
                <h1 class="m-lg-0"> {{$viewLesson->lessonTitle}} </h1>
                <div class="d-inline-flex align-items-center">
                    <i class="material-icons icon-16pt mr-1 text-muted">access_time</i> 2 <small
                        class="text-muted ml-1 mr-1">hours</small>: 26 <small class="text-muted ml-1">min</small>
                </div>
                @else
                <h1 class="m-lg-0"> {{$course->course_name}} </h1>
                <div class="d-inline-flex align-items-center">
                    <i class="material-icons icon-16pt mr-1 text-muted">access_time</i> 2 <small
                        class="text-muted ml-1 mr-1">hours</small>: 26 <small class="text-muted ml-1">min</small>
                </div>
                @endif

            </div>
            <div>
                {{-- <a href="#" class="btn btn-success">
                                    Purchase:
                                    <strong>$49</strong>
                                </a> --}}
            </div>
        </div>
    </div>





    <div class="container-fluid page__container">
        <div class="row">
            @if ($sections->count() > 0 && $sections[0]->lessons->count() > 0)
            <div class="col-md-8">

                @if (isset($viewLesson) && $viewLesson != null)
                <div class="card">

                    @if ($viewLesson->lesson_type == $viewLesson->lesson_document)
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="/storage/{{$viewLesson->lesson_url}}"
                            allowfullscreen=""></iframe>
                    </div>
                    @elseif($viewLesson->lesson_type == $viewLesson->lesson_assignment)
                    @php
                    $Questions = $viewLesson->Assignment->Questions;
                    @endphp


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
                                            <span class="mr-2"><i class="material-icons text-light-gray">menu</i></span>
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
                                            <span class="mr-2"><i class="material-icons text-light-gray">menu</i></span>
                                            <div>
                                                True
                                            </div>
                                            <div class="ml-auto">
                                                <input type="radio" :value="1" v-model="question.answer"
                                                    :checked="question.answer == 1"
                                                    :name="'answer'+question.id" id="" class="form-control-input">
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

                                                <input type="radio" v-model="question.answer" :checked="question.answer == question.id"
                                                    :name="'answer'+question.id" :id="question.id" class="form-control-input"
                                                    v-if="question.question_type == 2" :value="answer.id" >

                                                <input type="checkbox" :name="'answer'+question.id+'_'+akey"
                                                    :value="answer.id" class="form-control-input" v-else
                                                    v-model="question.answer" :checked="question.answer == question.id">
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
                        <div class="btn btn-primary" @click.prevent="submitQuiz({{$viewLesson->assignment_id}})">Submit Assignment</div>
                    </div>
                    

                    @else
                    <div class="embed-responsive embed-responsive-16by9">
                        <video controls src="/storage/{{$viewLesson->lesson_url}}"></video>
                    </div>

                    @endif

                </div>
                @else
                <div class="card">
                    <div class="embed-responsive embed-responsive-16by9">
                        @if ($sections[0]->lessons[0]->lesson_type == $sections[0]->lesson_document)
                        <iframe class="embed-responsive-item" src="/storage/{{$sections[0]->lessons[0]->lesson_url}}"
                            allowfullscreen=""></iframe>
                        @else
                        <video controls src="/storage/{{$sections[0]->lessons[0]->lesson_url}}"></video>
                        @endif

                    </div>
                </div>
                @endif

                @if (isset($viewLesson) && $viewLesson != null)
                <div class="card">
                    <div class="card-header card-header-large bg-light d-flex align-items-center">
                        <div class="flex">
                            <h4 class="card-header__title">lesson Description</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        {{$viewLesson->lessonDescription}}
                    </div>
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
                @else
                <div class="card">
                    <div class="card-header card-header-large bg-light d-flex align-items-center">
                        <div class="flex">
                            <h4 class="card-header__title">Course Description</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        {{$course->course_description}}
                    </div>
                </div>
                @endif


            </div>


            <div class="col-md-4">

                <!-- Lessons -->
                <div class="card">
                    <div class="card-header card-header-large bg-light d-flex align-items-center">
                        <div class="flex">
                            <h4 class="card-header__title">Course Lessons</h4>
                        </div>
                    </div>
                    @foreach ($sections as $section)
                    <ul class="list-group list-group-fit">
                        @php
                        $lessons = $section->lessons;
                        @endphp
                        <strong><span class="ml-2">{{$section->section_name}}</span></strong>
                        @foreach ($lessons as $key => $lesson)
                        <li class="list-group-item">
                            <div class="media">
                                <div class="media-left">
                                    <div class="text-muted">{{$key+1}}</div>
                                </div>
                                <div class="media-body">
                                    @if (Auth::user()->isAdmin)
                                    <a href="/admin/courses/{{$course->id}}/lessons/{{$lesson->id}}">
                                        {{ strlen($lesson->lessonTitle) > 30  ? substr($lesson->lessonTitle,0,30).' ...' : $lesson->lessonTitle}}
                                    </a>
                                    @else
                                    <a href="/student/courses/{{$course->id}}/lessons/{{$lesson->id}}">
                                        {{ strlen($lesson->lessonTitle) > 30  ? substr($lesson->lessonTitle,0,30).' ...' : $lesson->lessonTitle}}
                                    </a>
                                    @endif

                                </div>
                                <div class="media-right">
                                    <small class="text-muted">
                                        @if ($lesson->lesson_type == $lesson->lesson_video)
                                        Video
                                        @elseif($lesson->lesson_type == $lesson->lesson_document)
                                        Document
                                        @else
                                        Assignment
                                        @endif
                                    </small>
                                </div>
                            </div>
                        </li>
                        @endforeach

                    </ul>
                    @endforeach

                </div>


                <div class="card ">
                    <div class="card-header card-header-large bg-light d-flex align-items-center">
                        <div class="flex">
                            <h4 class="card-header__title">Related Courses</h4>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="card card__course clear-shadow border">
                            <div class=" d-flex justify-content-center">
                                <a class="" href="#">
                                    <img src="https://images.unsplash.com/photo-1562577309-4932fdd64cd1?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=clamp&amp;w=800&amp;h=250"
                                        style="width:100%" alt="...">
                                </a>
                            </div>
                            <div class="p-3">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <a class="text-body mb-1" href="#"><strong>Basics of Social
                                                Media</strong></a><br>
                                        <div class="d-flex align-items-center">
                                            <span class="text-blue mr-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 40 40"
                                                    width="16" height="16" style="position:relative; top:-2px">
                                                    <g
                                                        transform="matrix(1.6666666666666667,0,0,1.6666666666666667,0,0)">
                                                        <path
                                                            d="M2.5,16C2.224,16,2,15.776,2,15.5v-11C2,4.224,2.224,4,2.5,4h14.625c0.276,0,0.5,0.224,0.5,0.5V8c0,0.552,0.448,1,1,1 s1-0.448,1-1V4c0-1.105-0.895-2-2-2H2C0.895,2,0,2.895,0,4v12c0,1.105,0.895,2,2,2h5.375c0.138,0,0.25,0.112,0.25,0.25v1.5 c0,0.138-0.112,0.25-0.25,0.25H5c-0.552,0-1,0.448-1,1s0.448,1,1,1h7.625c0.552,0,1-0.448,1-1s-0.448-1-1-1h-2.75 c-0.138,0-0.25-0.112-0.25-0.25v-1.524c0-0.119,0.084-0.221,0.2-0.245c0.541-0.11,0.891-0.638,0.781-1.179 c-0.095-0.466-0.505-0.801-0.981-0.801L2.5,16z M3.47,9.971c-0.303,0.282-0.32,0.757-0.037,1.06c0.282,0.303,0.757,0.32,1.06,0.037 c0.013-0.012,0.025-0.025,0.037-0.037l2-2c0.293-0.292,0.293-0.767,0.001-1.059c0,0-0.001-0.001-0.001-0.001l-2-2 c-0.282-0.303-0.757-0.32-1.06-0.037s-0.32,0.757-0.037,1.06C3.445,7.006,3.457,7.019,3.47,7.031l1.293,1.293 c0.097,0.098,0.097,0.256,0,0.354L3.47,9.971z M7,11.751h2.125c0.414,0,0.75-0.336,0.75-0.75s-0.336-0.75-0.75-0.75H7 c-0.414,0-0.75,0.336-0.75,0.75S6.586,11.751,7,11.751z M18.25,16.5c0,0.276-0.224,0.5-0.5,0.5s-0.5-0.224-0.5-0.5v-5.226 c0-0.174-0.091-0.335-0.239-0.426c-1.282-0.702-2.716-1.08-4.177-1.1c-0.662-0.029-1.223,0.484-1.252,1.146 c-0.001,0.018-0.001,0.036-0.001,0.054v7.279c0,0.646,0.511,1.176,1.156,1.2c1.647-0.011,3.246,0.552,4.523,1.593 c0.14,0.14,0.33,0.219,0.528,0.218c0.198,0.001,0.388-0.076,0.529-0.215c1.277-1.044,2.878-1.61,4.527-1.6 c0.641-0.023,1.15-0.547,1.156-1.188v-7.279c-0.001-0.327-0.134-0.64-0.369-0.867c-0.236-0.231-0.557-0.353-0.886-0.337 c-1.496,0.016-2.963,0.411-4.265,1.148c-0.143,0.092-0.23,0.251-0.23,0.421V16.5z"
                                                            stroke="none" fill="currentColor" stroke-width="0"
                                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </g>
                                                </svg>
                                            </span>
                                            <a href="take-course.html" class="small">Social Media</a>
                                        </div>
                                    </div>
                                    <a href="#" class="btn btn-primary ml-auto">$99</a>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
            @else
            <div class="alert alert-warning">
                <i class="fa fa-info-circle"></i>
                There are no lessons for this course
            </div>
            @endif

        </div>
    </div>


</div>

@endsection


@section('scripts')
@if (isset($viewLesson) && $viewLesson != null)

<script>
    window.lesson_id = "{{$viewLesson->id}}";
    window.api_token = "{{Auth::user()->api_token}}";

</script>
@endif
<script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.2/MathJax.js?config=TeX-AMS_HTML"></script>

<script src="/js/quizes.js"></script>
{{-- <link id="themecss" rel="stylesheet" type="text/css" href="//www.shieldui.com/shared/compon            <div class="card-header">ents/latest/css/light/all.min.css" /> --}}
@endsection
