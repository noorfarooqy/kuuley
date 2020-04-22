@extends('layouts.mainlayout')

@section('body-content')
<div class="mdk-drawer-layout__content page" style="transform: translate3d(0px, 0px, 0px);">



    <div class="container-fluid page__heading-container">
        <div class="page__heading d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-lg-between text-center text-lg-left">
            <h1 class="m-lg-0">Instructor Dashboard</h1>
            <a href="" class="btn btn-success ml-lg-3">Go to Courses <i class="material-icons">arrow_forward</i></a>
        </div>
    </div>





    <div class="container-fluid page__container">

        <div class="row card-group-row">
            <div class="col-lg-4 col-md-6 card-group-row__col">
                <div class="card card-group-row__card card-body card-body-x-lg flex-row align-items-center">
                    <div class="flex">
                        <div class="card-header__title text-muted mb-2">Hours This week</div>
                        <div class="text-amount">0 hrs</div>
                        <div class="text-stats text-success">0% <i class="material-icons">arrow_upward</i></div>
                    </div>

                    <div class="avatar">
                        <span class="bg-soft-success avatar-title rounded-circle text-center text-success">
                            <i class="material-icons icon-40pt">gps_fixed</i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 card-group-row__col">
                <div class="card card-group-row__card card-body card-body-x-lg flex-row align-items-center">
                    <div class="flex">
                        <div class="card-header__title text-muted mb-2">Total Lessons</div>
                        <div class="text-amount">0</div>
                        <div class="text-stats text-success">0% <i class="material-icons">arrow_upward</i></div>
                    </div>
                    <div class="avatar">
                        <span class="bg-soft-primary avatar-title rounded-circle text-center text-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 40 40" width="30" height="30">
                                <g transform="matrix(1.6666666666666667,0,0,1.6666666666666667,0,0)">
                                    <path d="M16,5.75c0.414,0,0.75-0.336,0.75-0.75V3.5c0-0.414-0.336-0.75-0.75-0.75s-0.75,0.336-0.75,0.75V5 C15.25,5.414,15.586,5.75,16,5.75z M21,3c0-1.657-1.343-3-3-3H6C4.343,0,3,1.343,3,3v18c0,1.657,1.343,3,3,3h12 c1.657,0,3-1.343,3-3V3z M12,14c0.552,0,1,0.448,1,1s-0.448,1-1,1s-1-0.448-1-1S11.448,14,12,14z M11,10.5c0-0.552,0.448-1,1-1 s1,0.448,1,1s-0.448,1-1,1S11,11.052,11,10.5z M16.5,18.75c0.414,0,0.75,0.336,0.75,0.75s-0.336,0.75-0.75,0.75H11 c-0.414,0-0.75-0.336-0.75-0.75s0.336-0.75,0.75-0.75H16.5z M16.5,16c-0.552,0-1-0.448-1-1s0.448-1,1-1c0.552,0,1,0.448,1,1 S17.052,16,16.5,16z M16.5,11.5c-0.552,0-1-0.448-1-1s0.448-1,1-1c0.552,0,1,0.448,1,1S17.052,11.5,16.5,11.5z M7.5,16 c-0.552,0-1-0.448-1-1s0.448-1,1-1s1,0.448,1,1S8.052,16,7.5,16z M8.5,19.5c0,0.552-0.448,1-1,1s-1-0.448-1-1s0.448-1,1-1 S8.5,18.948,8.5,19.5z M7.5,11.5c-0.552,0-1-0.448-1-1s0.448-1,1-1s1,0.448,1,1S8.052,11.5,7.5,11.5z M6,2h12c0.552,0,1,0.448,1,1 v3.25c0,0.138-0.112,0.25-0.25,0.25H5.25C5.112,6.5,5,6.388,5,6.25V3C5,2.448,5.448,2,6,2z" stroke="none" fill="currentColor" stroke-width="0" stroke-linecap="round" stroke-linejoin="round"></path>
                                </g>
                            </svg>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 card-group-row__col">
                <div class="card card-group-row__card card-body card-body-x-lg flex-row align-items-center">
                    <div class="flex">
                        <div class="card-header__title text-muted mb-2">Students this Month</div>
                        <div class="text-amount">0</div>
                        <div class="text-stats text-danger">0% <i class="material-icons">arrow_downward</i></div>
                    </div>
                    <div class="avatar">
                        <span class="bg-soft-warning avatar-title rounded-circle text-center text-warning">
                            <i class="material-icons text-warning icon-40pt">perm_identity</i>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- CHART -->
        <div class="row">
            <div class="col-md-8">

                <div class="card">
                    <div class="card-header bg-white d-flex align-items-center">
                        <h4 class="card-header__title mb-0">Reports</h4>
                    </div>
                    <div class="card-body">
                        
                    </div>
                </div>

            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header card-header-large bg-light d-flex align-items-center">

                        <h4 class="card-header__title">Top Courses</h4>

                    </div>




                    <ul class="list-group list-group-flush mb-0" style="z-index: initial;">

                        <li class="list-group-item" style="z-index: initial;">
                            <div class="d-flex align-items-center">
                                <a href="#" class="mr-3">
                                    <img src="https://images.unsplash.com/photo-1562577309-4932fdd64cd1?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=clamp&amp;w=35&amp;h=35" alt="course" class="">

                                </a>
                                <div class="flex">
                                    <a href="#" class="text-body"><strong>Basics of Social Media</strong></a>
                                    <div class="d-flex align-items-center">
                                        <small class="text-muted">60 sales</small>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    $23460
                                </div>
                            </div>
                        </li>

                        <li class="list-group-item" style="z-index: initial;">
                            <div class="d-flex align-items-center">
                                <a href="#" class="mr-3">
                                    <img src="assets/images/logos/vuejs.svg" alt="course" class="">

                                </a>
                                <div class="flex">
                                    <a href="#" class="text-body"><strong>Learn Vue.js Fundamentals</strong></a>
                                    <div class="d-flex align-items-center">
                                        <small class="text-muted">25 sales</small>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    $9775
                                </div>
                            </div>
                        </li>

                        <li class="list-group-item" style="z-index: initial;">
                            <div class="d-flex align-items-center">
                                <a href="#" class="mr-3">
                                    <img src="assets/images/logos/angular.svg" alt="course" class="">

                                </a>
                                <div class="flex">
                                    <a href="#" class="text-body"><strong>Angular in Steps</strong></a>
                                    <div class="d-flex align-items-center">
                                        <small class="text-muted">100 sales</small>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    $39100
                                </div>
                            </div>
                        </li>

                        <li class="list-group-item" style="z-index: initial;">
                            <div class="d-flex align-items-center">
                                <a href="#" class="mr-3">
                                    <img src="assets/images/logos/javascript.svg" alt="course" class="">

                                </a>
                                <div class="flex">
                                    <a href="#" class="text-body"><strong>ES6 Foundations</strong></a>
                                    <div class="d-flex align-items-center">
                                        <small class="text-muted">80 sales</small>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    $31280
                                </div>
                            </div>
                        </li>

                    </ul>
                </div>

            </div>
        </div>
    </div>


</div>
@endsection