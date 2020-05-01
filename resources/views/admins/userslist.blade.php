@extends('layouts.mainlayout')

@section('body-content')
    
<div class="mdk-drawer-layout__content page" style="transform: translate3d(0px, 0px, 0px);">



    <div class="container-fluid page__heading-container">
        <div class="page__heading d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-lg-between text-center text-lg-left">
            <h1 class="m-lg-0">Users lists</h1>
            <div>
                <a href="student-edit-account.html" class="btn btn-light ml-3"><i class="material-icons">edit</i> Edit</a>
                <a href="student-profile.html" class="btn btn-success ml-1">View Profile <i class="material-icons">account_circle</i></a>
            </div>
        </div>
    </div>





    <div class="container-fluid page__container">
        <div class="row">
            <div class="card col-lg-8 col-md-8" >
                @if (Session::has('successmessage'))
                <div class="alert alert-success">
                    {{ Session::get('successmessage') }}
                </div>
                @endif
                @error('user_id')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
                @enderror
                <div class="card-header bg-primary text-white">
                    Users who can be admins
                </div>
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
    
    
                                    <th style="width: 37px;">Status</th>
                                    <th style="width: 120px;">Email</th>
                                    <th style="width: 24px;"></th>
                                </tr>
                            </thead>
                            <tbody class="list" id="staff02">
                                @foreach ($users as $user)
                                @if ($user->isAdmin == null || $user->isAdmin->count() <= 0)
                                <tr>
    
                                    <td>
    
                                        <span class="js-lists-values-employee-name">
                                            {{$user->name}}
                                        </span>
    
                                    </td>
    
    
                                    <td><span class="badge badge-warning">Active</span></td>
                                    <td><small class="text-muted">{{$user->email}}</small></td>
                                    <td class="dropdown">
                                        <div href="#"  class="text-muted" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="material-icons">more_vert</i>
                                        </div>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="#" onclick="event.preventDefault();
                                            document.getElementById('make-admin-form').submit();""> Make admin </a>
                                            <a class="dropdown-item" href="/admin/accounts/inst/{{$user->id}}">Add teacher info</a>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                          </div>
                                        <form action="{{route('make-user-admin')}}" method="POST" id="make-admin-form">
                                            @csrf
                                            <input type="hidden" value="{{$user->id}}" name="user_id">
                                        </form>
                                    </td>
                                </tr>
                                @endif
                                
                                @endforeach
                                
    
    
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
            <div class="card col-md-4 col-lg-4">
                <div class="card-header bg-primary text-white">
                    Create admin/teacheer
                </div>
                <div class="card-body">
                    <form action="{{route('create-teacher-admin')}}" method="POST">
                        @csrf
                        <div class="hint toast-warning p-3">
                            The user password will be auto generated and a reset link will be sent to their email.
                        </div>
                        <div class="hint  toast-warning p-3">
                            If you are creating an admin, the admin permissions can be changed from the list of admins
                            <br>

                        </div>
                        @if (Session::has('successmessage'))
                        <div class="alert alert-success mt-2">
                            {{Session::get('successmessage')}}
                        </div>
                        @endif
                        <div class="form-group ">
                            <label for="name" class="label">User name</label>
                            <input type="text" placeholder="User name" name="name" class="form-control">
                            @error('name')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="name" class="label">Email</label>
                            <input type="email" placeholder="User email" name="email" class="form-control">
                            @error('email')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="name" class="label">Select user type</label>
                            <select name="usertype" class="form-control select">
                                <option value="-1">Select user type</option>
                                <option value="1">Teacher</option>
                                <option value="2">Admin</option>
                            </select>
                        </div>
                        @error('usertype')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                        @enderror
                        <div class="form-group">
                            <input type="submit" name="submit" value="Create user" class="form-control btn btn-primary">
                        </div>
                    </form>
                </div>
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