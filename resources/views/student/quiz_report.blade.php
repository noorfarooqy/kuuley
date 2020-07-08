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





    <div class="container-fluid page__container">

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <i class="fa fa-pen-alt mr-2"></i>Attempted
                        <h3>
                            30
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
                            30
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
                            A
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
                            30
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

                        <div class="chart">
                            <canvas id="devicesChart" class="chart-canvas"></canvas>
                        </div>
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
                                <label for="">Correct questions</label>
                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 25%;"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                                </div>

                            </div>
                            <div class=" card-form__body card-body border-left">
                                <label for="">Correct questions</label>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar"
                                        style="width: 25%; background-color:#e40808 !important" aria-valuenow="25"
                                        aria-valuemin="0" aria-valuemax="100">25%</div>
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
                        <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link  bg-soft-success rounded-circle" href="#" tabindex="-1">1</a>
                            </li>
                            <span class="mt-1 ml-3 w-75">
                                The question for this topic
                            </span>
                            <span class="mt-1">
                                <i class="fa fa-check-circle text-success fa-2x"></i>
                            </span>
                            
                        </ul>
                        <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link  bg-soft-danger rounded-circle" href="#" tabindex="-1">2</a>
                            </li>
                            <span class="mt-1 ml-3 w-75">
                                The question for this topic
                            </span>
                            <span class="mt-1">
                                <i class="fa fa-times-circle text-danger fa-2x"></i>
                            </span>
                            
                        </ul>
                        
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

@php
$hash = hash('md5', file_get_contents(public_path('js/quiz_report.js')));
@endphp
<script src="{{'/js/quiz_report.js?'.$hash}}"></script>

<script>
    var ctx = document.getElementById('devicesChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Correct Answers', 'Incorrect Answers', ],
            datasets: [{
                label: '# of Votes',
                data: [12, 19],
                backgroundColor: [
                    'rgb(4, 158, 94)',
                    'rgba(228, 0, 0, 0.97)',
                ],
                borderColor: [
                    'rgb(4, 158, 94)',
                    'rgba(228, 0, 0, 0.97)',
                ],
                borderWidth: 1
            }]
        },
        options: {}
    });

</script>
@endsection

@section('links')
<!-- ion Range Slider -->
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/css/ion.rangeSlider.min.css" />

@endsection
