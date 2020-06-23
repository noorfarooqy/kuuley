@extends('layouts.mainlayout')

@section('body-content')


<div class="container-fluid page__container mt-4 mb-4" v-if="Course != null">
    <div class="row" style="height: 400px;">
        <div class="col-md-4 ps" data-perfect-scrollbar="">
            <div class="card clear-shadow border">
                <div class="card-body ">
                    <div class="d-flex justify-content-between align-items-center">
                        <strong>@{{Course.course_name}}</strong>
                        <small class="text-muted">3h 50min</small>
                    </div>
                    <div>
                        <span class="mr-2">
                            <a href="#" class="rating-link active"><i class="material-icons icon-16pt">star</i></a>
                            <a href="#" class="rating-link active"><i class="material-icons icon-16pt">star</i></a>
                            <a href="#" class="rating-link active"><i class="material-icons icon-16pt">star</i></a>
                            <a href="#" class="rating-link active"><i class="material-icons icon-16pt">star</i></a>
                            <a href="#" class="rating-link active"><i class="material-icons icon-16pt">star_half</i></a>
                        </span>
                        <small class="text-muted">(391 ratings)</small>
                    </div>
                </div>
            </div>
            <div class="lessons-list" style="overflow-y: scroll;max-height: 300px;">
                <ul class="list-group list-group-fit" v-for="(section , skey) in Course.lesson_sections" :key="skey">
                    <strong class="ml-3">@{{section.section_name}}</strong>
                    <li class="list-group-item" v-for="(lesson, lkey) in section.lessons" :key="lkey">
                        <div class="media">
                            <div class="media-left mr-1">
                                <div class="text-muted">1.</div>
                            </div>
                            <div class="media-body">
                                <a :href="'/student/course/'+Course.id+'/lessons/'+lesson.id">@{{lesson.lessonTitle}}</a>
                                <span v-if="!Course.is_enrolled" class="ml-2">
                                    <i class="fa fa-1x fa-lock"></i>
                                </span>
                            </div>
                            <div class="media-right">
                                <small class="text-muted" v-if="lesson.lesson_type == 10">Video</small>
                                <small class="text-muted" v-else-if="lesson.lesson_type == 20">Document</small>
                                <small class="text-muted" v-else>Assignment</small>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>


            <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
            </div>
            <div class="ps__rail-y" style="top: 0px; right: 0px;">
                <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
            </div>
        </div>
        <div class="col-md-8">

            <div class="embed-responsive embed-responsive-16by9 mb-4" style="max-height:400px; background: #000;">
                <video class="embed-responsive-item" controls v-if="Course.lesson_sections[0].lessons[0].lesson_type == 10"
                    :src="'/storage/'+Course.lesson_sections[0].lessons[0].lesson_url"></video>
                <iframe v-else :src="'/storage/'+Course.lesson_sections[0].lessons[0].lesson_url"></iframe>
            </div>

        </div>
    </div>
</div>

<div class="container-fluid page__container">
    <div class="row">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header card-header-tabs-basic nav border-top" role="tablist">
                    <a href="#overview" class="active" data-toggle="tab" role="tab" aria-controls="overview"
                        aria-selected="true">Overview</a>
                    <a href="#comments" data-toggle="tab" role="tab" aria-selected="false" class="">Comments</a>
                    <a href="#assets" data-toggle="tab" role="tab" aria-selected="false" class="">Assets</a>
                </div>
                <div class="tab-content">
                    <div class="tab-pane active" id="overview">
                        <div class="card-body" id="course_content">
                            <p>
                                @{{Course == null ? '' : Course.course_description}}
                            </p>

                            {{-- <h4>What you will learn</h4>
                            <ul>
                                <li class="chevron">How to design a new Website</li>
                                <li class="chevron">Keep track of your time</li>
                                <li class="chevron">Skills you need</li>
                                <li class="chevron">Sketch /Figma Interface</li>
                                <li class="chevron">Spec a list of Requirements</li>
                            </ul>

                            <h4>Features</h4>
                            <ul>
                                <li class="confirm">How to design a new Website</li>
                                <li class="confirm">Keep track of your time</li>
                                <li class="confirm">Skills you need</li>
                                <li class="confirm">Sketch /Figma Interface</li>
                                <li class="confirm">Spec a list of Requirements</li>
                            </ul> --}}
                        </div>
                    </div>

                    <div class="tab-pane" id="comments">
                        //comments
                    </div>
                    <div class="tab-pane" id="assets">
                        //assets
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card" v-if="Course != null && Course.course_progress != null">
                <div class="card-header card-header-large bg-light d-flex align-items-center">
                    <div class="flex">
                        <h4 class="card-header__title">My Progress</h4>
                        <div class="card-subtitle text-muted">Current lesson progress</div>
                    </div>
                    <div class="ml-auto">

                        <a href="#"  @click.prevent="" class="btn btn-light text-muted" v-if="Course.is_enrolled"><i
                                class="material-icons icon-16pt">check_circle</i> Complete</a>

                        <a href="#" @click.prevent="EnrollCourse()" class="btn btn-light text-active" v-else><i
                                class="material-icons icon-16pt">check_circle</i> Enroll</a>

                    </div>
                </div>
                <div class="p-2 px-4 d-flex align-items-center">
                    <div class="progress" style="width:100%;height:6px;">
                        <div class="progress-bar bg-primary" role="progressbar" :style="'width:' +Course.course_progress +'%;'" aria-valuenow="60"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="ml-2 text-primary">
                        @{{Course.course_progress }}%
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header bg-light">
                    <h4 class="card-header__title">Achievements</h4>
                </div>
                <div class="card-body">
                    <div class="avatar avatar-xs mr-3" data-toggle="tooltip" data-placement="top" title=""
                        data-original-title="Senior Developer">
                        <span class="avatar-title rounded-circle bg-primary">
                            
                        </span>
                    </div>
                </div>
            </div>

            <div class="card" v-if="Course != null && Course.instructor">
                <div class="card-header">
                    <div class="media align-items-center">
                        <div class="media-left">
                            <img src="/assets/images/256_luke-porter-261779-unsplash.jpg" alt="About Adrian" width="40"
                                class="rounded-circle">
                        </div>
                        <div class="media-body">
                            <div class="card-title mb-0"><a href="student-profile.html" class="text-body"><strong>Adrian
                                        Demian</strong></a></div>
                            <p class="text-muted mb-0">Author</p>
                        </div>
                        <div class="media-right">
                            <a href="" class="btn btn-facebook btn-sm"><i class="fab fa-facebook"></i></a>
                            <a href="" class="btn btn-twitter btn-sm"><i class="fab fa-twitter"></i></a>
                            <a href="" class="btn btn-light btn-sm"><i class="fab fa-github"></i></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    Having over 12 years exp. Adrian is one of the lead UI designers in our team.
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


@section('scripts')
<script>
    window.api_token = "{{$student->api_token}}";
    window.course_id = "{{$courseInfo->id}}"

</script>
@php
$hash = hash('md5', file_get_contents(public_path('/js/course_info.js')));
@endphp
<script src={{"/js/course_info.js?$hash"}}></script>
@endsection
