@extends('layouts.mainlayout')

@section('body-content')
<div class="mdk-drawer-layout__content page" style="transform: translate3d(0px, 0px, 0px);">



    <div class="container-fluid page__heading-container">
        <div class="page__heading d-flex align-items-center justify-content-between">
            <h1 class="m-0">Edit Course</h1>
        </div>
    </div>





    <div class="container-fluid page__container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <form action="/admin/courses/{{$course->id}}/update" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-form__body card-body">
                        
                            @if (Session::has('success'))
                            <div class="alert alert-success">
                                <i class="fa fa-check-circle"></i>
                                {{Session::get('success')}}
                            </div>             
                            @endif
                            <div class="form-group">
                                <label for="courseName">Course name</label>
                                <input name="courseName" type="text" class="form-control" placeholder="Title goes here" 
                                value="{{old('courseName') == null ? $course->course_name : old('courseName')}}">
                            </div>
                            @error('courseName')
                            <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                            
    
                            <div class="form-group">
                                <label for="courseDescription">Description</label>
                                <textarea name="courseDescription" rows="4" class="form-control" 
                                placeholder="Please enter a description">{{old('courseDescription') == null ? $course->course_description : old('courseDescription')}}</textarea>
                            </div>
                            @error('courseDescription')
                            <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                            <div class="form-group">
                                <label for="courseCategory">Category</label><br>
                                <select id="courseCategory" class="custom-select w-auto" name="courseCategory">
                                    <option value="-1">Choose category</option>
                                    @foreach ($categories as $category)
                                    @if (old('category') == $category->id || $course->course_category == $category->id)
                                    <option selected value="{{$category->id}}">{{$category->category_name}}</option>
                                    @else
                                    <option value="{{$category->id}}">{{$category->category_name}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>

                            @error('courseCategory')
                            <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                            <div class="form-group">
                                <label for="subscribe">Published</label><br>
                                <div class="custom-control custom-checkbox-toggle custom-control-inline mr-1">
                                    @if ($course->course_is_active)
                                    <input checked="" name="published" type="checkbox" id="subscribe" class="custom-control-input">
                                    @else
                                    <input name="published" type="checkbox" id="subscribe" class="custom-control-input">
                                    @endif
                                    
                                    <label class="custom-control-label" for="subscribe">Yes</label>
                                </div>
                                <label for="subscribe" class="mb-0">Yes</label>
                            </div>

                            @error('published')
                            <div class="alert alert-danger">{{$message}}</div>
                            @enderror
    
                            <div class="form-group">
                                <label>Course Preview</label>
                                <div class="dz-clickable media align-items-center" data-toggle="dropzone" data-dropzone-url="http://" data-dropzone-clickable=".dz-clickable" data-dropzone-files="[&quot;/assets/images/account-add-photo.svg&quot;]">
                                    <div class="dz-preview dz-file-preview dz-clickable mr-3">
                                        <div class="avatar avatar-lg dz-error dz-complete">
                                            <img src="{{$course->course_preview_image}}" id="coursePreview" class="avatar-img rounded" alt="..." data-dz-thumbnail="">
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        <button class="btn btn-sm btn-light dz-clickable" 
                                        onclick="event.preventDefault();document.querySelector('input.files').click()">Choose photo</button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group " style="visibility:hidden">
                                <label for="coursePreview">Upload course preview</label>
                                <input class="files" onchange="PreviewFile(event)" type="file" name="coursePreview" />
                            </div>
                            
                            @error('coursePreview')
                            <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="card-body text-center">
    
                            <button type="submit" class="btn btn-success">Save Changes</button>
                        </div>
                    </form>
                    

                </div>
            </div>
            <div class="col-md-4">

                <!-- Lessons -->
                <div class="card">
                    <div class="card-header card-header-large bg-light d-flex align-items-center">
                        <div class="flex">
                            <h4 class="card-header__title">Categories</h4>
                            <div class="card-subtitle text-muted">Manage Categories</div>
                        </div>
                    </div>


                    <ul class="list-group list-group-fit">
                        @foreach ($categories as $category)
                        <li class="list-group-item">
                            <div class="media">
                                <div class="media-left">
                                    <a href="#">
                                        <i class="material-icons text-light-gray">list</i>
                                    </a>
                                </div>
                                <div class="media-body">
                                    <a href="/admin/cat/{{$category->id}}">{{$category->category_name}}</a>
                                </div>
                                <div class="media-right">
                                    <small class="text-muted">0 courses</small>
                                </div>
                            </div>
                        </li>
                        @endforeach
                        
                    </ul>
                </div>
                <div class="card">
                    <div class="card-header card-header-large bg-light d-flex align-items-center">
                        <div class="flex">
                            <h4 class="card-header__title">Add Category</h4>
                            <div class="card-subtitle text-muted">New category</div>
                        </div>
                    </div>
                    <div class="card-form__body card-body">
                        @error('categoryName')
                        <div class="alert alert-danger">
                            <i class="fa fa-info-circle"></i>
                            {{$message}}
                        </div>
                        @enderror
                        
                        <form action="/admin/cat/new" class="form" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="categoryName">Category</label>
                                <input name="categoryName" type="text" class="form-control" placeholder="Category" >
                            </div>
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-plus-circle mr-3"></i>Add category
                            </button>
                        </form>
                    </div>

                    
                </div>
            </div>
        </div>
    </div>


</div>
@endsection

@section('scripts')
    

    <!-- Dropzone -->
    {{-- <script src="/assets/vendor/dropzone.min.js"></script>
    <script src="/assets/js/dropzone.js"></script> --}}

    <script type="text/javascript" src="//www.shieldui.com/shared/components/latest/js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="//www.shieldui.com/shared/components/latest/js/shieldui-all.min.js"></script>

    <script type="text/javascript">
        function PreviewFile(event)
        {
            var file = event.target.files[0];
            if(file.size > 10000000)
                alert('File size exceeds the limit');
            else
            {
                var reader = new FileReader();
                var preview = document.querySelector('img#coursePreview');
                console.log('preview is ',preview );
                reader.onload = (function (e) {
                    console.log('target ',e.target)
                    preview.src = e.target.result;
                    return  e.target.result;
                });
                reader.readAsDataURL(file);
            }
            console.log(file);
        }
        function formatSize(bytes) {
            if (bytes === undefined) {
                return "N/A";
            }
            else if (bytes == 0) {
                return '0 Bytes';
            }
            else {
                var k = 1000,
                    sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'],
                    i = Math.floor(Math.log(bytes) / Math.log(k));
                return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
            }
        }
        jQuery(function ($) {
            $("#files").shieldUpload({
                async: {
                    enabled: true,
                    save: {
                        url: "/upload/save"
                    },
                    remove: {
                        url: "/upload/remove"
                    },
                    data: {'_token': "{{csrf_token()}}"}
                },
                files: {
                    template: function (fileInfo) {
                        var content = $('<span/>');
                        content.append(
                            '<div>' + fileInfo.name + " " + formatSize(fileInfo.size) + '</div>'
                        );
                        // if image and the FileReader API is supported, show a thumbnail of the file
                        if (/^image\//.test(fileInfo.type) && window.FileReader) {
                            var img = $('<img width="100px" height="75px" style="display:block;" />').appendTo(content);
                            var reader = new FileReader();
                            reader.onload = (function (aImg) {
                                return function (e) { aImg.src = e.target.result; };
                            })(img.get(0));
                            reader.readAsDataURL(fileInfo);
                        }
                        return content;
                    }
                }
            });
        });
    </script>
@endsection

@section('links')
    
{{-- <link id="themecss" rel="stylesheet" type="text/css" href="//www.shieldui.com/shared/components/latest/css/light/all.min.css" /> --}}
@endsection