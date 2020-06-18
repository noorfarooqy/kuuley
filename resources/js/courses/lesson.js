require('./../bootstrap');
import Server from "./../server";
// Vue.use('')
var app = new Vue({
    el: "#app",
    data: {
        p1: null,
        Quizerrors: [],
        Server: new Server(),
        ResourceFile: {
            file_url: null,
            file_type: null,
        },
        Errors: [],
        Questions: [],
        Assignments: [],
    },
    mounted() {

    },
    methods: {
        UpdateLessonFile(event) {
            console.log('event ', event);
            var input = event.target;
            this.ResourceFile.file_type = input.files[0].type;
            this.Server.previewFile(input, this.previewResourceFile, this.showError)
        },
        OpenFileHandler() {
            this.$refs.lessonResourceFile.click();
        },
        showError(error) {
            alert(error);
            console.log('error ', error);
            this.Errors.push(error);
        },
        previewResourceFile(filedata) {
            this.$refs.lessonFileUrl.src = filedata.currentTarget.result;
            console.log('file data ', filedata);
        },
        getAssignments(course_id) {
            this.Server.setRequest({
                api_token: window.api_token,
                course_id: course_id
            });
            this.Server.serverRequest('/api/admin/courses/quizes', this.setAssignments, this.showError);
        },
        setAssignments(data) {
            this.Assignments = data;
        },
        setSelectLesson(event, course) {
            var index = event.target.options.selectedIndex;
            if (index == 2) {
                this.getAssignments(course)
            }
        }
    }
})