@extends('layouts.mainlayout')

@section('body-content')
<div class="mdk-drawer-layout__content page" style="transform: translate3d(0px, 0px, 0px);">



    <div class="container-fluid page__heading-container">
        <div
            class="page__heading d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-lg-between text-center text-lg-left">
            <h1 class="m-lg-0">Quizes</h1>
            <a href="" class="btn btn-success ml-lg-3">Back to Course <i class="material-icons">arrow_forward</i></a>
        </div>
    </div>





    <div class="container-fluid page__container">

        <div class="row">
            <div class="col-md-7 col-lg-7">
                <div class="z-0">
                    <div class="card">
                        <div class="card-header bg-light-gray">
                            Quiz information
                        </div>
                        <div class="card-body">
                            <form action="" method="POST">
                                @csrf
                                @if ($errors->any())
                                <div class="alert alert-danger">{{$errors->first()}}</div>
                                @endif
                                
                                <quiz-info></quiz-info>
                            </form>
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

@section('links')

{{-- <link id="themecss" rel="stylesheet" type="text/css" href="//www.shieldui.com/shared/components/latest/css/light/all.min.css" /> --}}
@endsection