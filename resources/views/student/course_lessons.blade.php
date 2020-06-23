@extends('layouts.mainlayout')

@section('body-content')

<div class="mdk-drawer-layout__content page" style="transform: translate3d(0px, 0px, 0px);">



    <div class="container-fluid page__heading-container">
        <div
            class="page__heading d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-lg-between text-center text-lg-left">
            <h1 class="m-lg-0"> Courses</h1>
            <a href="/admin/courses/new" class="btn btn-success ml-lg-3">New Course <i
                    class="material-icons">add</i></a>
        </div>
    </div>





    <div class="container-fluid page__container">


        <form action="#" class="mb-2">
            <div class="d-flex">
                <div class="search-form mr-3 search-form--light">
                    <input type="text" class="form-control" placeholder="Filter by name" id="searchSample02">
                    <button class="btn" type="button"><i class="material-icons">search</i></button>
                </div>

                <div class="form-inline ml-auto">
                    <div class="form-group mr-3">
                        <label for="custom-select" class="form-label mr-1">Sort</label>
                        <select id="custom-select" class="form-control custom-select" style="width: 200px;">
                            <option selected="">Name</option>
                            <option value="2">Created Date</option>
                            <option value="1">Earnings</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="published01" class="form-label mr-1">Status</label>
                        <select id="published01" class="form-control custom-select" style="width: 200px;">
                            <option selected="">Published</option>
                            <option value="1">Draft</option>
                            <option value="3">All</option>
                        </select>
                    </div>
                </div>
            </div>
        </form>



        <div class="row">
            @foreach ($EnrolledCourses as $course)
            @php
            $course = $course->courseInfo;
            @endphp
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">

                        <div class="d-flex flex-column flex-sm-row">
                            <a href="#" class="avatar mb-3 w-xs-plus-down-100 mr-sm-3">
                                <img src="{{$course->course_preview_image}}" alt="Card image cap" class="avatar-course-img">
                            </a>
                            <div class="flex" style="min-width: 200px;">
                                <div class="d-flex">
                                    <div>
                                        <h4 class="card-title mb-1"><a href="/admin/courses/{{$course->id}}">
                                            {{$course->course_name}}</a></h4>
                                        <p class="text-muted">{{$course->course_description}}</p>
                                    </div>
                                    <div class="dropdown ml-auto">
                                        <a href="#" class="dropdown-toggle text-muted" data-caret="false"
                                            data-toggle="dropdown">
                                            <i class="material-icons">more_vert</i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="/student/courses/{{$course->id}}/lessons/list">View Lessons</a>
                                            <a class="dropdown-item text-danger" href="#">Archive</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end">
                                    <div class="d-flex flex flex-column mr-3">
                                        <div class="d-flex align-items-center py-2 border-bottom">
                                            {{-- <span class="mr-2">$1,230/mo</span> --}}
                                            <small class="text-muted ml-auto">0% complete</small>
                                        </div>
                                        <div class="d-flex align-items-center py-2">
                                            <span class="badge badge-vuejs mr-2">{{$course->Category->category_name}}</span>
                                            {{-- <span class="badge badge-soft-secondary">INTERMEDIATE</span> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            @endforeach
            
            


        </div>
        @if ($EnrolledCourses->count() <=0 )
        <div class="alert alert-warning">
            <i class="fa fa-info-circle fa-2x mr-2"></i>There are courses in this category
        </div>
        @endif

    </div>


</div>

@endsection
