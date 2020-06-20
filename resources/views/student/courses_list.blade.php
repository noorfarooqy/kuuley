@extends('layouts.mainlayout')

@section('body-content')

<div class="mdk-drawer-layout__content page" style="transform: translate3d(0px, 0px, 0px);">





                    <div class="container-fluid page__heading-container">
                        <div class="page__heading d-flex align-items-center justify-content-between">
                            <h1 class="m-0">Courses</h1>
                            <a href="" class="btn btn-success ml-3">Go to Courses <i class="material-icons">arrow_forward</i></a>
                        </div>
                    </div>





                    <div class="container-fluid page__container">
                        <form action="#" class="">
                            <div class="d-lg-flex">
                                <div class="search-form mb-3 mr-3-lg search-form--light">
                                    <input type="text" class="form-control" placeholder="Search courses" id="searchSample02">
                                    <button class="btn" type="button"><i class="material-icons">search</i></button>
                                </div>

                                <div class="form-inline  mb-3 ml-auto">
                                    <div class="form-group mr-3">
                                        <label for="custom-select" class="form-label mr-1">Category</label>
                                        <select id="custom-select" class="form-control custom-select" style="width: 200px;">

                                            <option selected="">All categories</option>
                                            <option value="category->id" v-for="(category,ckey) in course_categories">
                                                @{{category.category_name}}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="published01" class="form-label mr-1">Status</label>
                                        <select id="published01" class="form-control custom-select" style="width: 200px;">
                                            <option selected="">All</option>
                                            <option value="1">In Progress</option>
                                            <option value="3">New Releases</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="row" v-for="(category,ckey) in course_categories" :key="ckey">

                            <div class="col-md-3" v-for="(course, cokey) in category.courses" :key="cokey">
                                <div class="card card__course">
                                    <div class="card-header card-header-large card-header-dark bg-dark d-flex justify-content-center">
                                        <a class="card-header__title  justify-content-center align-self-center d-flex flex-column" :href="'/student/courses/'+course.id">
                                            <span><img :src="course.course_preview_image" class="mb-1" style="width:34px;" alt="logo"></span>
                                            <span class="course__title">@{{course.course_name}}</span>
                                            <span class="course__subtitle">@{{course.course_description.substr(0,20)}}</span>
                                        </a>
                                    </div>
                                    <div class="p-3">
                                        <div class="mb-2">
                                            <span class="mr-2">
                                                <a href="#" class="rating-link active"><i class="material-icons icon-16pt">star</i></a>
                                                <a href="#" class="rating-link active"><i class="material-icons icon-16pt">star</i></a>
                                                <a href="#" class="rating-link active"><i class="material-icons icon-16pt">star</i></a>
                                                <a href="#" class="rating-link active"><i class="material-icons icon-16pt">star</i></a>
                                                <a href="#" class="rating-link active"><i class="material-icons icon-16pt">star_half</i></a>
                                            </span>
                                            <strong>@{{getRndInteger(3,5)+0.3}}</strong><br>
                                            <small class="text-muted">(391 ratings)</small>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            {{-- <strong class="h4 m-0">$49</strong> --}}
                                            <a href="#" class="btn btn-primary ml-auto"><i class="material-icons">add_shopping_cart</i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <hr>
                        <div class="d-flex flex-row align-items-center mb-3">
                            <div class="form-inline">
                                View
                                <select class="custom-select ml-2">
                                    <option value="20" selected="">20</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                    <option value="200">200</option>
                                </select>
                            </div>
                            <div class="ml-auto">
                                20 <span class="text-muted">of 100</span> <a href="#" class="icon-muted"><i class="material-icons float-right">arrow_forward</i></a>
                            </div>
                        </div>

                    </div>


                </div>

@endsection


@section('scripts')
<script>
    window.api_token = "{{$student->api_token}}";
</script>
@php
    $hash = hash('md5', file_get_contents(public_path('/js/courses_list.js')));
@endphp
<script src={{"/js/courses_list.js?$hash"}}></script>
@endsection