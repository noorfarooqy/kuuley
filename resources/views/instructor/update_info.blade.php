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
                                        
                                        <i class="fas fa-book-reader"></i>
                                    </span>
                                </div>
                                <div>
                                    <a href="#" class="text-muted mb-2">Courses Instructed</a>
                                    <h4 class="m-0 bold"> 0 </h4>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-body">
                            <div class="d-flex align-items-center">

                                <div class="avatar avatar-lg mr-3">
                                    <span class="bg-soft-warning avatar-title rounded-circle text-center text-warning">
                                        <i class="fas fa-stopwatch"></i>
                                    </span>
                                </div>
                                <div>
                                    <a href="#" class="text-muted mb-2"> Hours instructed </a>
                                    <h4 class="m-0 bold"> 0 </h4>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-body">
                            <div class="d-flex align-items-center">

                                <div class="avatar avatar-lg mr-3">
                                    <span class="bg-soft-success avatar-title rounded-circle text-center text-success">
                                        <i class="fas fa-user-graduate"></i>
                                    </span>
                                </div>
                                <div>
                                    <a href="#" class="text-muted mb-2">Students</a>
                                    <h4 class="m-0 bold"> 0 </h4>
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
                            <form action="{{url('/admin/accounts/inst/update/'.$user->id)}}" method="post">
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