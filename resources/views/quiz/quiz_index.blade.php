@extends('layouts.mainlayout')

@section('body-content')
<div class="mdk-drawer-layout__content page" style="transform: translate3d(0px, 0px, 0px);">



    <div class="container-fluid page__heading-container">
        <div class="page__heading d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-lg-between text-center text-lg-left">
            <h1 class="m-lg-0">Quizes</h1>
            <a href="" class="btn btn-success ml-lg-3">Back to Course <i class="material-icons">arrow_forward</i></a>
        </div>
    </div>





    <div class="container-fluid page__container">

        <div class="row">
            <div class="col-md-7 col-lg-7">
                <div class="z-0">
                    <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
                        <li class="nav-item">
                            <a href="#tab-21" class="nav-link" data-toggle="tab" role="tab" aria-controls="tab-21" aria-selected="false">
                                <span class="nav-link__count">True/False</span>
                                Quiz
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#tab-22" class="nav-link" data-toggle="tab" role="tab" aria-selected="false">
                                <span class="nav-link__count">Single</span>
                                Choice
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#tab-23" class="nav-link" data-toggle="tab" role="tab" aria-selected="false">
                                <span class="nav-link__count">Multiple</span>
                                Choice
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#tab-24" class="nav-link" data-toggle="tab" role="tab" aria-selected="false">
                                <span class="nav-link__count">Graphic</span>
                                Quiz
                            </a>
                        </li>
                    </ul>
                    <div class="card card-tab">
                        <div class="card-body tab-content">
                            <div class="tab-pane fade" id="tab-21">
                                <div class="card">
                                    <div class="card-body card-form__body">
                                        <form action="#">
                                            
                                                
                                            <math-comp></math-comp>
                                            <button class="btn btn-primary mt-3"><i class="material-icons">add</i> Create Question</button>
                                        </form>
                                    </div>
                                </div>
                                
                                
                            </div>
                            <div class="tab-pane fade" id="tab-22">
                                
                                
                            </div>
                            <div class="tab-pane fade" id="tab-23">
                                
                            </div>
                            <div class="tab-pane fade" id="tab-24">
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body card-form__body">
                        <form action="#">
                            <div class="form-group mb-3">
                                <label class="control-label h6">New Question:</label>
                                <input type="text" name="question[title]" class="form-control">
                            </div>
                            <button class="btn btn-primary"><i class="material-icons">add</i> Create Question</button>
                        </form>
                    </div>
                </div>
        
                <div id="questions_wrapper">
        
        
        
                    <div class="card mb-4" data-position="1" data-question-id="1">
                        <div class="card-header d-flex justify-content-between">
                            <div class="d-flex align-items-center ">
        
                                <span class="question_handle btn btn-sm btn-secondary">
                                    <i class="material-icons">menu</i>
                                </span>
                                <div class="h4 m-0 ml-4">Q: What is a prop in Angular?</div>
                            </div>
                            <div>
                                <a href="#" class="btn btn-danger btn-sm">Delete</a>
                            </div>
                        </div>
                        <div class="card-body">
        
                            <div id="answerWrapper_1" class="mb-4">
                                <div class="row mb-1">
                                    <div class="col"><strong></strong></div>
                                    <div class="col text-right"><strong>Correct</strong></div>
                                </div>
        
                                <form action="#">
                                    <ul class="list-group" id="answer_container_1">
                                        <li class="list-group-item d-flex" data-position="1" data-answer-id="1" data-question-id="1">
                                            <span class="mr-2"><i class="material-icons text-light-gray">menu</i></span>
                                            <div>
                                                First Answer Title
                                            </div>
                                            <div class="ml-auto">
                                                <input type="radio" name="question[correct_answer_id]" id="correct_answer_1" checked="">
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex" data-position="2" data-answer-id="2" data-question-id="1">
                                            <span class="mr-2"><i class="material-icons text-light-gray">menu</i></span>
                                            <div>
                                                Second Answer
                                            </div>
                                            <div class="ml-auto">
                                                <input type="radio" name="question[correct_answer_id]" id="correct_answer_2">
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex" data-position="3" data-answer-id="3" data-question-id="1">
                                            <span class="mr-2"><i class="material-icons text-light-gray">menu</i></span>
                                            <div>
                                                Third Answer
                                            </div>
                                            <div class="ml-auto">
                                                <input type="radio" name="question[correct_answer_id]" id="correct_answer_3">
                                            </div>
                                        </li>
                                    </ul>
                                </form>
                            </div>
        
        
        
        
                            <div class="">
                                <form action="#">
                                    <div class="form-group mb-0">
                                        <button class="btn btn-success">New Answer</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
        
        
                    <div class="card mb-4" data-position="1" data-question-id="1">
                        <div class="card-header d-flex justify-content-between">
                            <div class="d-flex align-items-center ">
        
                                <span class="question_handle btn btn-sm btn-secondary">
                                    <i class="material-icons">menu</i>
                                </span>
                                <div class="h4 m-0 ml-4">Q: How you define something?</div>
                            </div>
                            <div>
                                <a href="#" class="btn btn-danger btn-sm">Delete</a>
                            </div>
                        </div>
                        <div class="card-body">
        
        
                            <div id="answerWrapper_2" class="mb-4">
                                <div class="row mb-1">
                                    <div class="col"><strong></strong></div>
                                    <div class="col text-right"><strong>Correct</strong></div>
                                </div>
        
                                <form action="#">
                                    <ul class="list-group" id="answer_container_2">
                                        <li class="list-group-item d-flex" data-position="1" data-answer-id="4" data-question-id="2">
                                            <span class="mr-2"><i class="material-icons text-light-gray">menu</i></span>
                                            <div>
                                                First Answer Title
                                            </div>
                                            <div class="ml-auto">
                                                <input type="radio" name="question[correct_answer_id]" id="correct_answer_4" checked="">
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex" data-position="2" data-answer-id="5" data-question-id="2">
                                            <span class="mr-2"><i class="material-icons text-light-gray">menu</i></span>
                                            <div>
                                                Second Answer
                                            </div>
                                            <div class="ml-auto">
                                                <input type="radio" name="question[correct_answer_id]" id="correct_answer_5">
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex" data-position="3" data-answer-id="6" data-question-id="2">
                                            <span class="mr-2"><i class="material-icons text-light-gray">menu</i></span>
                                            <div>
                                                Third Answer
                                            </div>
                                            <div class="ml-auto">
                                                <input type="radio" name="question[correct_answer_id]" id="correct_answer_6">
                                            </div>
                                        </li>
                                    </ul>
                                </form>
                            </div>
        
        
        
                            <div class="">
                                <form action="#">
                                    <div class="form-group mb-0">
                                        <button class="btn btn-success">New Answer</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
        
        
                    <div class="card mb-4" data-position="1" data-question-id="1">
                        <div class="card-header d-flex justify-content-between">
                            <div class="d-flex align-items-center ">
        
                                <span class="question_handle btn btn-sm btn-secondary">
                                    <i class="material-icons">menu</i>
                                </span>
                                <div class="h4 m-0 ml-4">Q: Can you deploy to production?</div>
                            </div>
                            <div>
                                <a href="#" class="btn btn-danger btn-sm">Delete</a>
                            </div>
                        </div>
                        <div class="card-body">
        
        
        
                            <div id="answerWrapper_3" class="mb-4">
                                <div class="row mb-1">
                                    <div class="col"><strong></strong></div>
                                    <div class="col text-right"><strong>Correct</strong></div>
                                </div>
        
                                <form action="#">
                                    <ul class="list-group" id="answer_container_3">
                                        <li class="list-group-item d-flex" data-position="1" data-answer-id="7" data-question-id="3">
                                            <span class="mr-2"><i class="material-icons text-light-gray">menu</i></span>
                                            <div>
                                                First Answer Title
                                            </div>
                                            <div class="ml-auto">
                                                <input type="radio" name="question[correct_answer_id]" id="correct_answer_7" checked="">
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex" data-position="2" data-answer-id="8" data-question-id="3">
                                            <span class="mr-2"><i class="material-icons text-light-gray">menu</i></span>
                                            <div>
                                                Second Answer
                                            </div>
                                            <div class="ml-auto">
                                                <input type="radio" name="question[correct_answer_id]" id="correct_answer_8">
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex" data-position="3" data-answer-id="9" data-question-id="3">
                                            <span class="mr-2"><i class="material-icons text-light-gray">menu</i></span>
                                            <div>
                                                Third Answer
                                            </div>
                                            <div class="ml-auto">
                                                <input type="radio" name="question[correct_answer_id]" id="correct_answer_9">
                                            </div>
                                        </li>
                                    </ul>
                                </form>
                            </div>
        
        
                            <div class="">
                                <form action="#">
                                    <div class="form-group mb-0">
                                        <button class="btn btn-success">New Answer</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
        
        
                </div>
            </div>
            <div class="col-md-5 col-lg-5">
                <div class="card">
                    <div class="card-header">
                        Add question category
                    </div>
                    <div class="card-body">

                    </div>
                </div>
            </div>
        </div>
        
    </div>


</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.2/MathJax.js?config=TeX-AMS_HTML"></script>

    <script src="/js/quizes.js"></script>
{{-- <link id="themecss" rel="stylesheet" type="text/css" href="//www.shieldui.com/shared/components/latest/css/light/all.min.css" /> --}}
@endsection
@section('links')
    
{{-- <link id="themecss" rel="stylesheet" type="text/css" href="//www.shieldui.com/shared/components/latest/css/light/all.min.css" /> --}}
@endsection