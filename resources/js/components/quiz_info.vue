<template>
    <div>
        
            
            <div class="alert alert-danger" v-for="(error,ekey) in errors" :key="ekey">{{error}}</div>
            <div class="form-group">
                <label for="questionType">Question type*</label>
                <select name="quiz_type" id="" class="form-control" @change="CheckQuizType($event)">
                    
                    <option value="-1">Select question type</option>
                    <option value="1">Diagnostic Question</option>
                    <option value="2">Course Assignment</option>
                </select>
            </div>
            <div class="form-group" v-if="courses.length > 0">
                <label for="questionType">Choose the course*</label>
                <select name="quiz_course" id="" class="form-control">
                    <option value="">Select Course</option>
                    <option :value="course.id" v-for="(course , ckey) in courses" :key="ckey">
                        {{course.course_name}}
                    </option>
                </select>
            </div>
            <div class="form-group">
                <label for="questionType">Quiz title*</label>
                <input type="text" class="form-control" placeholder="Enter title" name="quiz_title" id="">
            </div>
            <div class="form-group">
                <label for="questionType">Quiz instructions*</label>
                <textarea class="form-control" placeholder="Enter instructions" name="quiz_instructions" id=""></textarea>
            </div>
            <button class="btn btn-primary">Create quiz</button>

    </div>
</template>
<script>
    import Server from "./../server";
    export default {
        data() {
            return {
                name: 'quiz-info',
                version: 1,
                Http: new Server(),
                errors: [],
                courses: [],
            }
        },
        methods: {
            CheckQuizType(event) {
                console.log('quiz is ', event);
                var index = event.target.options.selectedIndex;
                if (index == 2) {
                    this.errors = [];
                    this.Http.setRequest({
                        api_token: window.api_token,
                    });
                    this.Http.serverRequest('/api/admin/courses/list/instructor', this.showCourseList, this.HttpError);
                } else
                    this.courses = [];
            },
            showCourseList(data) {
                this.courses = data[0];
            },
            HttpError(error) {
                console.error(error);
                this.errors.push(error);
            }
        }
    }

</script>
