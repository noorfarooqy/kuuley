@extends('layouts.mainlayout')

@section('body-content')
<div class="mdk-drawer-layout__content page" style="transform: translate3d(0px, 0px, 0px);">



    <div class="container-fluid page__heading-container">
        <div class="page__heading d-flex align-items-center justify-content-between">
            <h1 class="m-0">Student Diagnostics</h1>
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
            <div class="col-md-8">
                <div class="card">
                  
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Diagostic</th>
                                <th>Testing for</th>
                                <th>Status</th>
                                <td>Date</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($quizes as $quiz)
                                <tr>
                                    <td></td>
                                    <td>{{$quiz->QuizInfo->quiz_title}}</td>
                                    <td>{{$quiz->courseInfo->course_name}}</td>
                                    <td>{{$quiz->QuizInfo->Trials->count()}}</td>
                                    <td>{{$quiz->updated_at->format('Y-m-d')}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
            <div class="col-md-4">

                <!-- Lessons -->
                <div class="card">
                    <div class="card-header card-header-large bg-light d-flex align-items-center">
                        <div class="flex">
                            <h4 class="card-header__title">Categories</h4>
                            <div class="card-subtitle text-muted">Manage Categories</div>
                        </div>
                    </div>


                    <ul class="list-group list-group-fit">
                        {{-- @foreach ($categories as $category)
                        <li class="list-group-item">
                            <div class="media">
                                <div class="media-left">
                                    <a href="#">
                                        <i class="material-icons text-light-gray">list</i>
                                    </a>
                                </div>
                                <div class="media-body">
                                    <a href="/admin/cat/{{$category->id}}">{{$category->category_name}}</a>
                                </div>
                                <div class="media-right">
                                    <small class="text-muted">0 courses</small>
                                </div>
                            </div>
                        </li>
                        @endforeach --}}
                        
                    </ul>
                </div>
                <div class="card">
                    <div class="card-header card-header-large bg-light d-flex align-items-center">
                        <div class="flex">
                            <h4 class="card-header__title">Assign Diagnostics</h4>
                        </div>
                    </div>
                    <div class="card-form__body card-body">
                        @error('categoryName')
                        <div class="alert alert-danger">
                            <i class="fa fa-info-circle"></i>
                            {{-- {{$message}} --}}
                        </div>
                        @enderror
                        
                        <form action="" class="form" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="categoryName">Diagnostic</label>
                                <select name="diagnostic" class="form-control" id="">
                                    <option value="-1">Select Diagnostics</option>
                                    @foreach ($Diagnostics as $diag)
                                        <option value="{{$diag->id}}">{{$diag->quiz_title}}</option>
                                    @endforeach
                                </select>

                            </div>

                            <div class="form-group" >
                                <label for="categoryName">Corresponding Course</label>
                                <select name="course" class="form-control" id="" @change.prevent="GetLessons">
                                    <option value="-1">Select Course</option>
                                    @foreach ($Courses as $course)
                                    <option value="{{$course->id}}"  >{{$course->course_name}}</option>
                                    @endforeach
                                </select>
                                
                            </div>
                            <div class="form-group" v-if="courseLessons != null">
                                <label for="categoryName">Course lessons</label>
                                <select name="lesson" class="form-control" id="">
                                    <option value="-1">Select lesson</option>
                                    
                                    <option :value="lesson.id" v-for="(lesson, lkey) in courseLessons" >
                                        @{{lesson.lessonTitle}}
                                    </option>
                                </select>
                                
                            </div>
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-plus-circle mr-3"></i>Assign Diagnostic
                            </button>
                        </form>
                    </div>

                    
                </div>
            </div>
        </div>
    </div>


</div>
@endsection

@section('scripts')
<script>
    window.api_token = "{{Auth::user()->api_token}}";
</script>    
<script src="/js/student_diag.js"></script>

@endsection

@section('links')
    
@endsection