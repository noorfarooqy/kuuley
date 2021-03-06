@extends('layouts.mainlayout')

@section('body-content')
    
<div class="mdk-drawer-layout__content page" style="transform: translate3d(0px, 0px, 0px);">



    <div class="container-fluid page__heading-container">
        <div class="page__heading d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-lg-between text-center text-lg-left">
            <h1 class="m-lg-0">Student enrolls</h1>
            <div>
                <a href="student-edit-account.html" class="btn btn-light ml-3"><i class="material-icons">edit</i> Edit</a>
                <a href="student-profile.html" class="btn btn-success ml-1">View Profile <i class="material-icons">account_circle</i></a>
            </div>
        </div>
    </div>





    <div class="container-fluid page__container">
        <div class="row">
            <div class="card col-lg-10 col-md-10" >
                @if (Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
                @endif
                @if($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
                @endif
                <div class="card-header bg-primary text-white">
                    {{$student->name}}
                </div>
                @if ($Enrollments->count() <= 0)
                @else
                <div class="card-body">
                    <div class="table-responsive border-bottom" data-toggle="lists" data-lists-values='["js-lists-values-employee-name"]'>

                        <div class="search-form search-form--light m-3">
                            <input type="text" class="form-control search" placeholder="Search">
                            <button class="btn" type="button" role="button"><i class="material-icons">search</i></button>
                        </div>
    
                        <table class="table mb-0 thead-border-top-0">
                            <thead>
                                <tr>
    
                                    <th>Name</th>
    
                                    <th>Status</th>
                                    <th style="width: 120px;">Email</th>
                                    <th style="width: 24px;"></th>
                                </tr>
                            </thead>
                            <tbody class="list" id="staff02">
                                @foreach ($Enrollments as $enrolls)
                                <tr>
    
                                    <td>
    
                                        <span class="js-lists-values-employee-name">
                                            <img src="{{$student->profile_photo}}" height="30" alt="">
                                            {{$student->name}}
                                        </span>
    
                                    </td>
                                    <td>
                                        {{$enrolls->courseInfo->course_name}}
                                        
                                            @if ($enrolls->enroll_status == 10)
                                            <span class="badge badge-warning mr-2">
                                                Review
                                            </span>
                                            @elseif($enrolls->enroll_status == 20)
                                            <span class="badge badge-danger mr-2">
                                                Rejected
                                            </span>
                                            @else  
                                            <span class="badge badge-success mr-2">
                                                Approved
                                            </span>
                                            @endif
                                        
                                    </td>
    
    
                                    <td><small class="text-muted">{{$student->email}}</small></td>
                                    {{-- <td class="dropdown">
                                        <div href="#"  class="text-muted" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="material-icons">more_vert</i>
                                        </div>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="/admin/student/{{$student->id}}" target="_blank">View profile</a>
                                            <a class="dropdown-item" href="/admin/student/{{$student->id}}/enrolls" target="_blank">Enrollments</a>
                                            @if ($enrolls->enroll_status == 10)
                                            <a class="dropdown-item" href="/admin/student/{{$student->id}}/enrolls/{{$enrolls->id}}/approve" >Approve</a>
                                            <a class="dropdown-item" href="/admin/student/{{$student->id}}/enrolls/{{$enrolls->id}}/reject" >Reject</a>
                                                                   
                                            @endif
                                          </div>
                                        <form action="{{route('make-user-admin')}}" method="POST" id="make-admin-form">
                                            @csrf
                                            <input type="hidden" value="{{$student->id}}" name="user_id">
                                        </form>
                                    </td> --}}
                                </tr>
                                
                                @endforeach
                                
    
    
                            </tbody>
                        </table>
                    </div>
                </div>  
                @endif
                
                
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    

    <!-- List.js -->
    <script src="/assets/vendor/list.min.js"></script>
    <script src="/assets/js/list.js"></script>

@endsection