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
            <div class="col-md-3">
                <div class="card">
                    <div class="border-bottom">
                        @php
                            $hasinfo = $user->HasInstructorInfo();
                        @endphp
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <img src="{{$user->profile_photo}}" alt="About Adrian" width="100" class="rounded-circle">
                            </div>


                            <p> {{$hasinfo ? $user->inst_biography : "No biography for this instructor"}} </p>

                            @if ($hasinfo)
                            <a href="{{$user->InstructorInfo->inst_fb}}" class="btn btn-facebook btn-sm"><i class="fab fa-facebook"></i></a>
                            <a href="{{$user->InstructorInfo->inst_twitter}}" class="btn btn-twitter btn-sm"><i class="fab fa-twitter"></i></a>
                            <a href="{{$user->InstructorInfo->inst_github}}" class="btn btn-light btn-sm"><i class="fab fa-github"></i></a>
                            <a href="{{$user->InstructorInfo->inst_youtube}}" class="btn btn-light btn-sm"><i class="fab fa-youtube"></i></a>
                            <a href="{{$user->InstructorInfo->inst_linkedin}}" class="btn btn-light btn-sm"><i class="fab fa-linkedin"></i></a>
                            @else
                            <a href="https://facebook.com" class="btn btn-facebook btn-sm"><i class="fab fa-facebook"></i></a>
                            <a href="https://twitter.com/drongotech" class="btn btn-twitter btn-sm"><i class="fab fa-twitter"></i></a>
                            <a href="https://github.com" class="btn btn-light btn-sm"><i class="fab fa-github"></i></a>
                            <a href="https://github.com" class="btn btn-light btn-sm"><i class="fab fa-youtube"></i></a>
                            <a href="https://github.com" class="btn btn-light btn-sm"><i class="fab fa-linkedin"></i></a>
                            @endif
                            

                        </div>
                    </div>



                    <div class="border-bottom">
                        <div class="card-header bg-light">
                            <h4 class="card-header__title text-center">Achievements</h4>
                        </div>
                        <div class="card-body text-center">
                            <div class="avatar avatar-xs mr-1" data-toggle="tooltip" data-placement="top" title="Senior Developer">
                                <span class="avatar-title rounded-circle bg-primary">
                                    <i class="fas fa-trophy fa-2x"></i>
                                </span>
                            </div>
                            <div class="avatar avatar-xs mr-1" data-toggle="tooltip" data-placement="top" title="100 Lessons Learned">
                                <span class="avatar-title rounded-circle bg-warning">
                                    
                                    <i class="fas fa-medal fa-2x"></i>
                                </span>
                            </div>
                            <div class="avatar avatar-xs mr-1" data-toggle="tooltip" data-placement="top" title="First Course Completed">
                                <span class="avatar-title rounded-circle bg-success">
                                    
                                    <i class="fas fa-award fa-2x"></i>
                                </span>
                            </div>
                            <div class="avatar avatar-xs mr-1" data-toggle="tooltip" data-placement="top" title="1 Series Completed">
                                <span class="avatar-title rounded-circle bg-danger">
                                    <i class="fas fa-certificate fa-2x"></i>
                                </span>
                            </div>
                            <div class="avatar avatar-xs" data-toggle="tooltip" data-placement="top" title="VIP Pass">
                                <span class="avatar-title rounded-circle bg-purple">
                                    <i class="fas fa-ribbon fa-2x"></i>
                                </span>
                            </div>
                        </div>
                    </div>





                    <!-- START SKILLS -->

                    <div class="">
                        <div class="card-header">
                            <h4 class="card-header__title text-center">Skill</h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled list-skills">
                                <li>
                                    <div>HTML</div>
                                    <div class="flex">
                                        <div class="progress" style="height: 4px;">
                                            <div class="progress-bar" role="progressbar" style="width: 61%;" aria-valuenow="61" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="text-dark-gray"><strong>61%</strong></div>
                                </li>
                                <li>
                                    <div>CSS/SCSS</div>
                                    <div class="flex">
                                        <div class="progress" style="height: 4px;">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 39%;" aria-valuenow="39" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="text-dark-gray"><strong>39%</strong></div>
                                </li>
                                <li>
                                    <div>JAVASCRIPT</div>
                                    <div class="flex">
                                        <div class="progress" style="height: 4px;">
                                            <div class="progress-bar bg-warning" role="progressbar" style="width: 76%;" aria-valuenow="76" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="text-dark-gray"><strong>76%</strong></div>
                                </li>
                                <li>
                                    <div>RUBY ON RAILS</div>
                                    <div class="flex">
                                        <div class="progress" style="height: 4px;">
                                            <div class="progress-bar bg-danger" role="progressbar" style="width: 28%;" aria-valuenow="28" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="text-dark-gray"><strong>28%</strong></div>
                                </li>
                                <li>
                                    <div>VUEJS</div>
                                    <div class="flex">
                                        <div class="progress" style="height: 4px;">
                                            <div class="progress-bar bg-vuejs" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="text-dark-gray"><strong>50%</strong></div>
                                </li>
                            </ul>
                        </div>

                    </div>
                    <!-- END SKILLS -->


                </div>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-body">
                            <div class="d-flex align-items-center">

                                <div class="avatar avatar-lg mr-3">
                                    <span class="bg-soft-primary avatar-title rounded-circle text-center text-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 40 40" width="30" height="30">
                                            <g transform="matrix(1.6666666666666667,0,0,1.6666666666666667,0,0)">
                                                <path d="M6.354,8.984C5.64,8.853,4.854,8.75,3.909,8.659C3.497,8.619,3.195,8.252,3.235,7.84c0.04-0.412,0.407-0.714,0.819-0.674 C5.362,7.274,6.66,7.486,7.935,7.8c0.161,0.042,0.332,0.001,0.456-0.109c0.813-0.716,1.755-1.27,2.776-1.633 c0.2-0.071,0.333-0.26,0.333-0.472V2.517c0-0.171-0.088-0.33-0.232-0.422C9.235,0.8,5.417,0.11,1.789,0 C1.32-0.018,0.866,0.16,0.534,0.492C0.193,0.823,0.001,1.278,0,1.753v12.833c0,0.952,0.761,1.729,1.713,1.748 c1.156,0.031,2.309,0.124,3.454,0.279c0.273,0.039,0.526-0.152,0.565-0.425C5.741,16.125,5.738,16.062,5.723,16 C5.575,15.367,5.5,14.72,5.5,14.07c0-0.349,0.021-0.698,0.064-1.045c0.034-0.273-0.159-0.522-0.432-0.557 c-0.379-0.049-0.784-0.094-1.223-0.137c-0.412-0.04-0.714-0.407-0.674-0.819c0.04-0.412,0.407-0.714,0.819-0.674 c0.58,0.056,1.109,0.118,1.6,0.188c0.224,0.031,0.441-0.092,0.529-0.3c0.147-0.344,0.317-0.678,0.508-1 C6.833,9.489,6.755,9.182,6.518,9.04C6.467,9.01,6.411,8.989,6.352,8.978L6.354,8.984z M4.054,3.493 c1.763,0.129,3.504,0.471,5.185,1.02c0.393,0.132,0.604,0.557,0.472,0.95s-0.557,0.604-0.95,0.472 C7.189,5.422,5.559,5.103,3.909,4.986c-0.412-0.04-0.714-0.407-0.674-0.819S3.642,3.453,4.054,3.493z M23.466,0.492 C23.132,0.164,22.679-0.013,22.211,0c-3.628,0.11-7.446,0.8-9.479,2.1C12.588,2.192,12.5,2.351,12.5,2.522v2.603 c-0.002,0.276,0.221,0.501,0.497,0.503c0.019,0,0.039-0.001,0.058-0.003C13.369,5.59,13.684,5.571,14,5.57 c0.165,0,0.329,0,0.492,0.014c0.073,0.004,0.145-0.024,0.195-0.078c0.051-0.053,0.076-0.127,0.067-0.2 c-0.039-0.351,0.173-0.682,0.508-0.794c1.677-0.593,3.416-0.992,5.184-1.19c0.412-0.04,0.779,0.262,0.819,0.674 s-0.262,0.779-0.674,0.819c-1.269,0.135-2.523,0.391-3.743,0.766c-0.132,0.04-0.207,0.179-0.168,0.311 c0.023,0.076,0.081,0.137,0.156,0.164c0.707,0.252,1.378,0.596,1.994,1.024c0.107,0.074,0.239,0.103,0.367,0.082 C19.599,7.094,20.015,7.04,20.446,7c0.411-0.036,0.775,0.264,0.819,0.674c0.046,0.336-0.159,0.655-0.483,0.754 c-0.129,0.049-0.194,0.194-0.145,0.323c0.009,0.024,0.022,0.046,0.038,0.066c1.598,2.025,2.188,4.667,1.605,7.18 c-0.03,0.135,0.054,0.268,0.189,0.299c0.034,0.008,0.07,0.008,0.104,0.001c0.83-0.144,1.434-0.868,1.427-1.711V1.753 C23.999,1.278,23.807,0.823,23.466,0.492z M16,10.751h-4c-0.69,0.001-1.248,0.559-1.25,1.249v0.445 c-0.011,0.414,0.315,0.759,0.729,0.771s0.759-0.315,0.771-0.729c0.007-0.132,0.117-0.236,0.249-0.236H13 c0.138,0,0.25,0.112,0.25,0.25V16c0.001,0.138-0.11,0.249-0.248,0.25c-0.001,0-0.001,0-0.002,0c-0.414,0-0.75,0.336-0.75,0.75 s0.336,0.75,0.75,0.75h2c0.414,0,0.75-0.336,0.75-0.75s-0.336-0.75-0.75-0.75c-0.138,0.001-0.249-0.11-0.25-0.248 c0-0.001,0-0.001,0-0.002v-3.5c0-0.138,0.112-0.25,0.25-0.25h0.5c0.132,0,0.241,0.103,0.249,0.234 c0.011,0.414,0.355,0.741,0.769,0.731c0.414-0.011,0.741-0.355,0.731-0.769V12C17.247,11.311,16.689,10.753,16,10.751z M19.9,18.489c-0.168-0.168-0.195-0.431-0.064-0.629c2.132-3.225,1.245-7.568-1.98-9.699s-7.568-1.245-9.699,1.98 s-1.245,7.568,1.98,9.699c2.341,1.547,5.379,1.547,7.719,0c0.198-0.131,0.461-0.105,0.629,0.063l3.806,3.806 c0.391,0.39,1.024,0.39,1.415,0c0.39-0.391,0.39-1.024-0.001-1.415l0,0L19.9,18.489z M14,19c-2.761,0-5-2.239-5-5s2.239-5,5-5 s5,2.239,5,5C18.997,16.76,16.76,18.997,14,19z" stroke="none" fill="currentColor" stroke-width="0" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </g>
                                        </svg>
                                    </span>
                                </div>
                                <div>
                                    <a href="#" class="text-muted mb-2">Courses Taken</a>
                                    <h4 class="m-0 bold">0</h4>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-body">
                            <div class="d-flex align-items-center">

                                <div class="avatar avatar-lg mr-3">
                                    <span class="bg-soft-warning avatar-title rounded-circle text-center text-warning">
                                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 40 40" width="30" height="30">
                                            <g transform="matrix(1.6666666666666667,0,0,1.6666666666666667,0,0)">
                                                <path d="M11.75,4.5C11.888,4.5,12,4.612,12,4.75V5c0,0.552,0.448,1,1,1s1-0.448,1-1V4.75c0-0.138,0.112-0.25,0.25-0.25h1 c0.138,0,0.25,0.112,0.25,0.25v4.7c0,0.135,0.11,0.245,0.246,0.244c0.018,0,0.036-0.002,0.054-0.006 c0.48-0.108,0.969-0.171,1.46-0.188c0.133-0.002,0.239-0.11,0.24-0.243V4.5c0-1.105-0.895-2-2-2h-1.25C14.112,2.5,14,2.388,14,2.25 V1c0-0.552-0.448-1-1-1s-1,0.448-1,1v1.25c0,0.138-0.112,0.25-0.25,0.25h-1.5C10.112,2.5,10,2.388,10,2.25V1c0-0.552-0.448-1-1-1 S8,0.448,8,1v1.25C8,2.388,7.888,2.5,7.75,2.5h-1.5C6.112,2.5,6,2.388,6,2.25V1c0-0.552-0.448-1-1-1S4,0.448,4,1v1.25 C4,2.388,3.888,2.5,3.75,2.5H2c-1.105,0-2,0.895-2,2v13c0,1.105,0.895,2,2,2h7.453c0.135,0,0.244-0.109,0.245-0.243 c0-0.019-0.002-0.038-0.007-0.057c-0.109-0.48-0.173-0.968-0.191-1.46c-0.002-0.133-0.11-0.239-0.243-0.24H2.25 C2.112,17.5,2,17.388,2,17.25V4.75C2,4.612,2.112,4.5,2.25,4.5h1.5C3.888,4.5,4,4.612,4,4.75V5c0,0.552,0.448,1,1,1s1-0.448,1-1 V4.75C6,4.612,6.112,4.5,6.25,4.5h1.5C7.888,4.5,8,4.612,8,4.75V5c0,0.552,0.448,1,1,1s1-0.448,1-1V4.75 c0-0.138,0.112-0.25,0.25-0.25H11.75z M17.5,11c-3.59,0-6.5,2.91-6.5,6.5s2.91,6.5,6.5,6.5s6.5-2.91,6.5-6.5 C23.996,13.912,21.088,11.004,17.5,11z M17.5,22.5c-0.552,0-1-0.448-1-1s0.448-1,1-1s1,0.448,1,1S18.052,22.5,17.5,22.5z M18.439,18.327c-0.118,0.037-0.196,0.15-0.189,0.273v0.15c0,0.414-0.336,0.75-0.75,0.75s-0.75-0.336-0.75-0.75V18.2 c0.003-0.588,0.413-1.096,0.988-1.222c0.607-0.131,0.993-0.73,0.862-1.338c-0.131-0.607-0.73-0.993-1.338-0.862 c-0.517,0.112-0.887,0.57-0.887,1.099c0,0.414-0.336,0.75-0.75,0.75s-0.75-0.336-0.75-0.75c0-1.45,1.176-2.625,2.626-2.624 c1.45,0,2.625,1.176,2.624,2.626c0,1.087-0.671,2.062-1.686,2.451V18.327z" stroke="none" fill="currentColor" stroke-width="0" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </g>
                                        </svg>
                                    </span>
                                </div>
                                <div>
                                    <a href="#" class="text-muted mb-2">Hours learned</a>
                                    <h4 class="m-0 bold">0</h4>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-body">
                            <div class="d-flex align-items-center">

                                <div class="avatar avatar-lg mr-3">
                                    <span class="bg-soft-success avatar-title rounded-circle text-center text-success">
                                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 40 40" width="30" height="30">
                                            <g transform="matrix(1.6666666666666667,0,0,1.6666666666666667,0,0)">
                                                <path d="M11.75,4.5C11.888,4.5,12,4.612,12,4.75V5c0,0.552,0.448,1,1,1s1-0.448,1-1V4.75c0-0.138,0.112-0.25,0.25-0.25h1 c0.138,0,0.25,0.112,0.25,0.25v4.7c0,0.135,0.11,0.245,0.246,0.244c0.018,0,0.036-0.002,0.054-0.006 c0.48-0.108,0.969-0.171,1.46-0.188c0.133-0.002,0.239-0.11,0.24-0.243V4.5c0-1.105-0.895-2-2-2h-1.25C14.112,2.5,14,2.388,14,2.25 V1c0-0.552-0.448-1-1-1s-1,0.448-1,1v1.25c0,0.138-0.112,0.25-0.25,0.25h-1.5C10.112,2.5,10,2.388,10,2.25V1c0-0.552-0.448-1-1-1 S8,0.448,8,1v1.25C8,2.388,7.888,2.5,7.75,2.5h-1.5C6.112,2.5,6,2.388,6,2.25V1c0-0.552-0.448-1-1-1S4,0.448,4,1v1.25 C4,2.388,3.888,2.5,3.75,2.5H2c-1.105,0-2,0.895-2,2v13c0,1.105,0.895,2,2,2h7.453c0.135,0,0.244-0.109,0.245-0.243 c0-0.019-0.002-0.038-0.007-0.057c-0.109-0.48-0.173-0.968-0.191-1.46c-0.002-0.133-0.11-0.239-0.243-0.24H2.25 C2.112,17.5,2,17.388,2,17.25V4.75C2,4.612,2.112,4.5,2.25,4.5h1.5C3.888,4.5,4,4.612,4,4.75V5c0,0.552,0.448,1,1,1s1-0.448,1-1 V4.75C6,4.612,6.112,4.5,6.25,4.5h1.5C7.888,4.5,8,4.612,8,4.75V5c0,0.552,0.448,1,1,1s1-0.448,1-1V4.75 c0-0.138,0.112-0.25,0.25-0.25H11.75z M17.5,11c-3.59,0-6.5,2.91-6.5,6.5s2.91,6.5,6.5,6.5s6.5-2.91,6.5-6.5 C23.996,13.912,21.088,11.004,17.5,11z M17.5,22.5c-0.552,0-1-0.448-1-1s0.448-1,1-1s1,0.448,1,1S18.052,22.5,17.5,22.5z M18.439,18.327c-0.118,0.037-0.196,0.15-0.189,0.273v0.15c0,0.414-0.336,0.75-0.75,0.75s-0.75-0.336-0.75-0.75V18.2 c0.003-0.588,0.413-1.096,0.988-1.222c0.607-0.131,0.993-0.73,0.862-1.338c-0.131-0.607-0.73-0.993-1.338-0.862 c-0.517,0.112-0.887,0.57-0.887,1.099c0,0.414-0.336,0.75-0.75,0.75s-0.75-0.336-0.75-0.75c0-1.45,1.176-2.625,2.626-2.624 c1.45,0,2.625,1.176,2.624,2.626c0,1.087-0.671,2.062-1.686,2.451V18.327z" stroke="none" fill="currentColor" stroke-width="0" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </g>
                                        </svg>
                                    </span>
                                </div>
                                <div>
                                    <a href="#" class="text-muted mb-2">Quizzes Taken</a>
                                    <h4 class="m-0 bold">0</h4>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- ACTIVITY -->

                <div class="card card-form">
                    <div class="row no-gutters">
                        <div class="col-lg-4 card-body">
                            <p><strong class="headings-color">Basic Information</strong></p>
                            <p class="text-muted mb-0">Edit basic account details</p>
                        </div>
                        <div class="col-lg-8 card-form__body card-body">
                            <form action="{{url('/admin/accounts/update/'.$user->id)}}" method="post">
                                @csrf
                                @if(Session::has('success'))
                                <div class="row">
                                    <div class="col">
                                        <div class="alert alert-success">
                                            {{Session::get('success')}}
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @error('first_name')
                                <div class="row">
                                    <div class="col">
                                        <div class="alert alert-danger">
                                            {{$message}}
                                        </div>
                                    </div>
                                </div>
                                @enderror
                                @error('second_name')
                                <div class="row">
                                    <div class="col">
                                        <div class="alert alert-danger">
                                            {{$message}}
                                        </div>
                                    </div>
                                </div>
                                @enderror
                                @error('last_name')
                                <div class="row">
                                    <div class="col">
                                        <div class="alert alert-danger">
                                            {{$message}}
                                        </div>
                                    </div>
                                </div>
                                @enderror
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="first_name">First name</label>
                                            <input name="first_name" type="text" class="form-control" placeholder="First name"
                                             value="{{old('first_name') != null ? old('first_name') : $hasinfo ? $user->InstructorInfo->inst_firstname : ''}}">
                                        </div>
                                        
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="second_name">second name</label>
                                            <input name="second_name" type="text" class="form-control" placeholder="Second name" 
                                            value="{{old('second_name') != null ? old('second_name') : $hasinfo ? $user->InstructorInfo->inst_secondname : ''}}">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="last_name">Last name</label>
                                            <input name="last_name" type="text" class="form-control" placeholder="Last name" 
                                            value="{{old('last_name')  != null ? old('last_name') : $hasinfo ? $user->InstructorInfo->inst_lastname : ''}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="biography">Bio / Description</label>
                                    <textarea name="biography" rows="4" class="form-control" placeholder="Bio / description ...">{{old('biography')  != null ? old('second_name') : $hasinfo ? $user->InstructorInfo->inst_biography : ''}}</textarea>
                                </div>
                                @error('biography')
                                    <div class="alert alert-danger">
                                        {{$message}}
                                    </div>
                                @enderror
    
                                <div class="form-group">
                                    <label for="profession">Profession</label>
                                    <input name="profession" type="text" class="form-control" placeholder="Software engineer" 
                                    value="{{old('profession')  != null ? old('profession') : $hasinfo ? $user->InstructorInfo->inst_specialization : ''}}">
                                </div>

                                @error('profession')
                                    <div class="alert alert-danger">
                                        {{$message}}
                                    </div>
                                @enderror
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="nationality">Nationality</label><br>
                                            <select name="nationality" class="custom-select w-auto">
                                                
                                                @foreach ($countries as $country)
                                                @if (old('nationality') == $country->id)
                                                <option selected value="{{$country->id}}">{{$country->country_name}}</option>
                                                @elseif($hasinfo && $country->id == $user->InstructorInfo->inst_nationality)
                                                <option selected value="{{$country->id}}">{{$country->country_name}}</option>
                                                @else
                                                <option value="{{$country->id}}">{{$country->country_name}}</option>
                                                @endif
                                                
                                                @endforeach
                                            </select>
                                            <small class="form-text text-muted">Your Nationality is not visible to other users.</small>
                                        </div>

                                        @error('nationality')
                                        <div class="alert alert-danger">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="gender">Gender</label><br>
                                            <select name="gender" class="custom-select w-auto">
                                                @if (old('gender') == 1)
                                                <option  value="0">Male</option>
                                                <option selected value="1">Female</option>
                                                @elseif($hasinfo && $user->InstructorInfo->inst_is_female == 1)
                                                <option  value="0">Male</option>
                                                <option selected value="1">Female</option>
                                                @elseif($hasinfo && $user->InstructorInfo->inst_is_female == 0)
                                                <option selected value="0">Male</option>
                                                <option  value="1">Female</option>
                                                @else
                                                <option selected value="0">Male</option>
                                                <option value="1">Female</option>
                                                @endif
                                                
                                            </select>
                                        </div>

                                        @error('gender')
                                        <div class="alert alert-danger">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
    
                                </div>
                                <div class="form-group">
                                    <input id="lname" type="submit" class="form-control btn btn-success"  value="Save">
                                </div>
                            </form>
                            
                            
                        </div>
                    </div>
                </div>

                <div class="card card-form">
                    <div class="row no-gutters">
                        <div class="col-lg-4 card-body">
                            <p><strong class="headings-color">Address Information</strong></p>
                            <p class="text-muted mb-0">Edit address details</p>
                        </div>
                        <div class="col-lg-8 card-form__body card-body">
                            <form action="{{url('/admin/accounts/inst/update/address/'.$user->id)}}" method="post">
                                @csrf
                                @error('living_country')
                                <div class="alert alert-danger">
                                    {{$message}}
                                </div>
                                @enderror
                                @error('living_city')
                                <div class="alert alert-danger">
                                    {{$message}}
                                </div>
                                @enderror
                                @error('living_address')
                                <div class="alert alert-danger">
                                    {{$message}}
                                </div>
                                @enderror
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="fname">Living country</label>
                                            <select name="living_country" class="custom-select w-auto">
                                                
                                                @foreach ($countries as $country)
                                                @if (old('living_country') == $country->id)
                                                <option selected value="{{$country->id}}">{{$country->country_name}}</option>
                                                @elseif($hasinfo && $country->id == $user->InstructorInfo->inst_living_country)
                                                <option selected value="{{$country->id}}">{{$country->country_name}}</option>
                                                @else
                                                <option value="{{$country->id}}">{{$country->country_name}}</option>
                                                @endif
                                                
                                                @endforeach
                                            </select>
                                        </div>
                                        
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="living_city">City</label>
                                            <input name="living_city" type="text" class="form-control" placeholder="Last name" 
                                            value="{{old('living_city')  == null ?  $hasinfo ? $user->InstructorInfo->inst_living_city : '' : old('living_city') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="living_address">Address</label>
                                    <input name="living_address" type="text" class="form-control" placeholder="Address" 
                                    value="{{old('living_address') == null ?  $hasinfo ? $user->InstructorInfo->inst_living_address : '' : old('living_address')}}">
                                </div>
    
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="telephone">Telephone</label><br>
                                            <input name="telephone" type="text" class="form-control" placeholder="Telepone " 
                                            value="{{old('telephone')  == null ?   $hasinfo ? $user->InstructorInfo->inst_telephone : '' : old('telephone')}}">
                                        </div>
                                        @error('telephone')
                                        <div class="alert alert-danger">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>

                                    
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="telephone_two">Telephone two</label><br>
                                            <input name="telephone_two" type="text" class="form-control" placeholder="Telephone two" 
                                            value="{{old('telephone_two')  == null ?  $hasinfo ? $user->InstructorInfo->inst_telephone_two : '' : old('telephone_two') }}">
                                        </div>
                                        @error('telephone_two')
                                        <div class="alert alert-danger">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                    
                                    
    
                                </div>

                                <div class="form-group">
                                    <input id="lname" type="submit" class="form-control btn btn-success"  value="Save">
                                </div>
                            </form>
                            
                            
                        </div>
                    </div>
                </div>

                <div class="card card-form">
                    <div class="row no-gutters">
                        <div class="col-lg-4 card-body">
                            <p><strong class="headings-color">Social Media</strong></p>
                            <p class="text-muted mb-0">Update your public profile and social media.</p>
                        </div>
                        <div class="col-lg-8 card-form__body card-body">
                            <div class="row">
                                <div class="col-2">
                                    <div class="form-group">
                                        <label>Profile</label>
                                        <div class="dz-clickable media align-items-center" data-toggle="dropzone" data-dropzone-url="http://" data-dropzone-clickable=".dz-clickable" data-dropzone-files="[&quot;assets/images/account-add-photo.svg&quot;]">
                                            <div class="dz-preview dz-file-preview dz-clickable mr-3">
                                                <div class="avatar avatar-lg">
                                                    <img src="/assets/images/account-add-photo.svg" class="avatar-img rounded" alt="..." data-dz-thumbnail="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <form action="{{url('/admin/accounts/inst/update/social/'.$user->id)}}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="social1">Social links</label>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    
                                                    <div class="input-group input-group-merge mb-2">
                                                        <input name="facebook" type="text" class="form-control form-control-prepended" placeholder="Facebook"
                                                        value="{{old('facebook')  == null ?  $hasinfo ? $user->InstructorInfo->inst_fb : '' : old('facebook') }}">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <span class="fab fa-facebook text-facebook"></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    @error('facebook')
                                                    <div class="alert alert-danger">
                                                        {{$message}}
                                                    </div>
                                                    @enderror
                                                    <div class="input-group input-group-merge mb-2">
                                                        <input name="twitter" type="text" class="form-control form-control-prepended" placeholder="Twitter"
                                                        value="{{old('twitter')  == null ?  $hasinfo ? $user->InstructorInfo->inst_twitter : '' : old('twitter') }}">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <span class="fab fa-twitter text-twitter"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @error('twitter')
                                                    <div class="alert alert-danger">
                                                        {{$message}}
                                                    </div>
                                                    @enderror
                                                    <div class="input-group input-group-merge mb-2">
                                                        <input name="youtube" type="text" class="form-control form-control-prepended" placeholder="Youtube"
                                                        value="{{old('youtube')  == null ?  $hasinfo ? $user->InstructorInfo->inst_youtube : '' : old('youtube') }}">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <span class="fab fa-youtube text-youtube"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @error('youtube')
                                                    <div class="alert alert-danger">
                                                        {{$message}}
                                                    </div>
                                                    @enderror
                                                    <div class="input-group input-group-merge mb-2">
                                                        <input name="github" type="text" class="form-control form-control-prepended" placeholder="Github"
                                                        value="{{old('github')  == null ?  $hasinfo ? $user->InstructorInfo->inst_github : '' : old('github') }}">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <span class="fab fa-github text-github"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @error('github')
                                                    <div class="alert alert-danger">
                                                        {{$message}}
                                                    </div>
                                                    @enderror
                                                    <div class="input-group input-group-merge mb-2">
                                                        <input name="linkedin" type="text" class="form-control form-control-prepended" placeholder="Linkedin"
                                                        value="{{old('linkedin')  == null ?  $hasinfo ? $user->InstructorInfo->inst_linkedin : '' : old('linkedin') }}">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <span class="fab fa-linkedin text-linkedin"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @error('linkedin')
                                                    <div class="alert alert-danger">
                                                        {{$message}}
                                                    </div>
                                                    @enderror
            
                                                </div>
                                            </div>
                                        </div>
    
                                        <div class="form-group">
                                            <input id="lname" type="submit" class="form-control btn btn-success"  value="Save">
                                        </div>
                                    </form>
                                    
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