@extends('layouts.mainlayout')

@section('body-content')

<div class="mdk-drawer-layout__content page" style="transform: translate3d(0px, 0px, 0px);">



    <div class="container-fluid page__heading-container">
        <div class="page__heading d-flex align-items-center justify-content-between">
            <h1 class="m-0">Edit Lesson</h1>
        </div>
    </div>

    <div class="container-fluid page__container">
        <div class="row">
            <div class="col-md-8">

                @if ($errors->any())
                <div class="alert alert-danger">
                    <i  class="fa fa-1x fa-info-circle"></i> {{$errors->first()}}
                </div>
                @elseif(Session::has('success'))
                <div class="alert alert-success">
                    {{Session::get('success')}}
                </div>
                @endif
                <div class="alert alert-danger" v-for="(error, ekey) in Errors" :key="ekey">
                    <i class="fa fa-info-circle fa-1x"></i><span v-text="error"></span>
                </div>

                <form action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-form__body card-body">
                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <label for="category">Course:</label><br>
                                    <input type="text" name="courseName" class="form-control" disabled id=""
                                        value="{{$course->course_name}}s">

                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <label for="category">Lesson Section:</label><br>

                                    <select class="form-control" id="" name="lessonSection">
                                        <option value="-1">Select section</option>
                                        @foreach ($sections as $section)
                                        @if (old('lessonSection') == $section->id)
                                        <option selected value="{{$section->id}}">{{$section->section_name}}</option>
                                        @else 
                                        <option value="{{$section->id}}">{{$section->section_name}}</option>
                                        @endif

                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8 col-lg-8">
                                    <div class="form-group">
                                        <label for="fname">Title</label>
                                        <input name="lessonTitle" type="text" class="form-control" placeholder="Title goes here"
                                            value="{{old('lessonTitle')}}">
                                    </div>
                                </div>
                                <div class="col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label for="lessonTpype">Lesson type</label>
                                        <select name="lessonType" id="" class="form-control">
                                            <option value="-1">Select lesson type</option>
                                            @if (old('lessonType') == 1)
                                                <option selected value="2">Normal lesson</option>
                                                <option  value="1">Assignment</option>
                                            @elseif (old('lessonType') == 2)
                                                <option value="2">Normal lesson</option>
                                                <option selected value="1">Assignment</option>
                                            @else
                                                <option value="2">Normal lesson</option>
                                                <option value="1">Assignment</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            

                            <div class="form-group">
                                <label for="desc">Description</label>
                                <textarea name="lessonDescription" rows="4" class="form-control"
                                    placeholder="Please enter a description">{{old('lessonDescription')}}</textarea>
                            </div>

                            <div class="form-group mb-0">
                                <label for="subscribe">Published</label><br>
                                <div class="custom-control custom-checkbox-toggle custom-control-inline mr-1">
                                    <input name="lessonIsPublished" checked="" type="checkbox" id="subscribe" class="custom-control-input">
                                    <label  class="custom-control-label" for="subscribe">Yes</label>
                                </div>
                                <label for="subscribe" class="mb-0">Yes</label>
                            </div>

                        </div>


                    </div>
                    <div class="card">
                        <!-- Lessons -->

                        <div class="card-header card-header-large bg-light d-flex align-items-center">

                            <h4 class="card-header__title">Lesson Video</h4>
                        </div>

                        <div class="card-body">

                            <div class="embed-responsive embed-responsive-16by9 mb-3">
                                <iframe class="embed-responsive-item" ref="lessonFileUrl" 
                                v-if="ResourceFile.file_type != 'video/mp4'" 
                                    src="https://player.vimeo.com/video/97243285?title=0&amp;byline=0&amp;portrait=0"
                                    allowfullscreen=""></iframe>
                                <video src="https://player.vimeo.com/video/97243285?title=0&amp;byline=0&amp;portrait=0"
                                v-else ref="lessonFileUrl" controls></video>
                                <input type="file" name="lessonResourceFile" style="display: none"
                                @change="UpdateLessonFile" ref="lessonResourceFile" id="">
                            </div>
                            <!-- Lessons -->
                            <div class="form-group mb-3">
                                    <div class="avatar avatar-lg">
                                        <img src="/assets/images/account-add-photo.svg" class="avatar-img rounded"
                                            alt="..." data-dz-thumbnail="" @click="OpenFileHandler">
                                    </div>
                            </div>
                            <div class="card-body text-center">

                                <button type="submit" class="btn btn-success">Save Changes</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Add New Section
                    </div>
                    <div class="card-body">
                        <form action="/admin/courses/{{$course->id}}/lessons/section" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="">Section name</label>
                                <input type="text" name="sectionName" class="form-control" id=""
                                    placeholder="Section name">
                            </div>
                            <input type="submit" value="Add Section" class="btn btn-primary">
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>


</div>

@endsection

@section('toaster')

@endsection

@section('scripts')
<script>

</script>
<script src="/js/lesson.js"></script>
@endsection
@section('links')

@endsection
