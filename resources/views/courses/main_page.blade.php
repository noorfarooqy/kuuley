@extends('layouts.mainlayout')

@section('body-content')
<div class="mdk-drawer-layout__content page" style="transform: translate3d(0px, 0px, 0px);">



    <div class="container-fluid page__heading-container">
        <div class="page__heading d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-lg-between text-center text-lg-left">
            <h1 class="m-lg-0">Update Profile</h1>
            <div>
                <a href="student-edit-account.html" class="btn btn-light ml-3"><i class="material-icons">edit</i> Edit</a>
                <a href="student-profile.html" class="btn btn-success ml-1">View Profile <i class="material-icons">account_circle</i></a>
            </div>
        </div>
    </div>





    <div class="container-fluid page__container">
        <div class="row">
            <div class="col-3">

                <div class="card card__course">
                    <div class="card-header card-header-large card-header-dark bg-dark d-flex justify-content-center">
                        <a class="card-header__title  justify-content-center align-self-center d-flex flex-column" href="/admin/courses/new">
                            <span><img src="/assets/images/courses1.png" class="mb-1" style="width:73px;" alt="logo"></span>
                            <span class="course__title">Courses</span>
                        </a>
                    </div>
                    <div class="p-3">
                        <div class="d-flex align-items-center">
                            <a href="/admin/courses/new" class="btn btn-primary">
                                <i class="fa fa-eye mr-1"></i> Add New Course
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">

                <div class="card card__course">
                    <div class="card-header card-header-large card-header-dark bg-dark d-flex justify-content-center">
                        <a class="card-header__title  justify-content-center align-self-center d-flex flex-column" href="/admin/courses/new">
                            <span><img src="/assets/images/courses2.png" class="mb-1" style="width:73px;" alt="logo"></span>
                            <span class="course__title">Courses</span>
                        </a>
                    </div>
                    <div class="p-3">
                        <div class="d-flex align-items-center">
                            <a href="/admin/courses/list" class="btn btn-primary">
                                <i class="fa fa-eye mr-1"></i> Active Courses
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">

                <div class="card card__course">
                    <div class="card-header card-header-large card-header-dark bg-dark d-flex justify-content-center">
                        <a class="card-header__title  justify-content-center align-self-center d-flex flex-column" href="/admin/courses/new">
                            <span><img src="/assets/images/courses3.png" class="mb-1" style="width:73px;" alt="logo"></span>
                            <span class="course__title">Courses</span>
                        </a>
                    </div>
                    <div class="p-3">
                        <div class="d-flex align-items-center">
                            <a href="/admin/courses/list/inactive" class="btn btn-primary">
                                <i class="fa fa-eye mr-1"></i> Inactive Courses
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">

                <div class="card card__course">
                    <div class="card-header card-header-large card-header-dark bg-dark d-flex justify-content-center">
                        <a class="card-header__title  justify-content-center align-self-center d-flex flex-column" href="/admin/courses/new">
                            <span><img src="/assets/images/courses4.png" class="mb-1" style="width:73px;" alt="logo"></span>
                            <span class="course__title">Courses</span>
                        </a>
                    </div>
                    <div class="p-3">
                        <div class="d-flex align-items-center">
                            <a href="/admin/courses/new" class="btn btn-primary">
                                <i class="fa fa-eye mr-1"></i> Courses Report
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection