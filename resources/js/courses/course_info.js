require('../bootstrap');
import Server from "../server";
// Vue.use('')
var app = new Vue({
    el: "#app",
    data: {
        Server: new Server(),
        loader_visible: false,
        Course: null,
        Errors: [],
    },
    mounted() {
        this.ToggleLoader(true);
        this.Server.setRequest({
            'api_token': window.api_token,
            'course_id': window.course_id
        });
        this.Server.serverRequest('/api/student/courses/info', this.showCourses, this.showError);
    },
    methods: {
        showCourses(data) {
            this.Course = data;
            this.ToggleLoader();
        },
        OpenFileHandler() {
            this.$refs.lessonResourceFile.click();
        },
        showError(error) {
            // alert(error);
            console.log('error ', error);
            this.Errors.push(error);
            var alertor = document.querySelector('div.error-alert-toast');
            console.log('laertor ', $(alertor).children('div.toast-danger').children('div.toast-message'));
            $(alertor).css('display', 'block');
            $(alertor).children('div.toast-danger').children('div.toast-message').text(error);
            setTimeout(function() {
                $(alertor).css('display', 'none');
            }, 10000);
            this.ToggleLoader();
        },
        ToggleLoader(status) {
            var loader = document.querySelector('div#modal-success');
            var toggle;
            if (status == null || status == false)
                toggle = 'none';
            else
                toggle = 'block';
            $(loader).css('display', toggle);
        },
        EnrollCourse() {
            this.ToggleLoader(true);
            this.Server.setRequest({
                api_token: window.api_token,
                course_id: this.Course != null ? this.Course.id : null,
            });
            this.Server.serverRequest('/api/student/courses/enroll', this.EnrolledCourse, this.showError);
        },
        EnrolledCourse(data) {
            this.Course = data;
            this.showSuccess('Request to enroll the course has been sent. You will receive email for confirmation.');
            this.ToggleLoader();
        },
        getRndInteger(min, max) {
            return Math.floor(Math.random() * (max - min)) + min;
        },
        showSuccess(message) {
            // alert(error);
            console.log('error ', message);
            // this.Errors.push(error);
            var alertor = document.querySelector('div.success-alert-toast');
            console.log('laertor ', $(alertor).children('div.toast-danger').children('div.toast-message'));
            $(alertor).css('display', 'block');
            $(alertor).children('div.toast-success').children('div.toast-message').text(message);
            setTimeout(function() {
                $(alertor).css('display', 'none');
            }, 10000);
            this.ToggleLoader();
        },
    }
})