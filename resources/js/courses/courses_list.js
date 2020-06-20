require('../bootstrap');
import Server from "../server";
// Vue.use('')
var app = new Vue({
    el: "#app",
    data: {
        Server: new Server(),
        loader_visible: false,
        course_categories: [],
        Errors: [],
    },
    mounted() {
        this.ToggleLoader(true);
        this.Server.setRequest({
            'api_token': window.api_token,
        });
        this.Server.serverRequest('/api/student/courses', this.showCourses, this.showError);
    },
    methods: {
        showCourses(data) {
            this.course_categories = data;
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
        getRndInteger(min, max) {
            return Math.floor(Math.random() * (max - min)) + min;
        }
    }
})