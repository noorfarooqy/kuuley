require('./../bootstrap');
import maths from '../components/maths.vue';
import VueMathjax from 'vue-mathjax'
import QuizInfo from "./../components/quiz_info.vue";
import Server from "./../server";
Vue.use(VueMathjax)
    // Vue.use('')
var app = new Vue({
    el: "#app",
    data: {
        Quizerrors: [],
        Server: new Server(),
        Questions: [],
        Answer: {
            question_id: null,
            answer: null,
        },
        SubmittedResults: [],
        QuizData: {
            title: '',
            desc: ''
        },
        courseLessons: null

    },
    methods: {
        somefunction() {
            console.log('hi');
        }
    },
    mounted() {


    },
    methods: {
        GetDiagnostic(quiz) {
            console.log('quiz ', quiz);
            this.ToggleLoader(true);
            this.Server.setRequest({
                api_token: window.api_token,
                quiz: quiz.id
            })
            this.QuizData.title = quiz.quiz_title;
            this.QuizData.desc = quiz.quiz_instructions;

            this.Server.serverRequest('/api/student/quiz/diag', this.setQuizQuestions, this.showErrors);
        },
        setQuizQuestions(data) {
            this.Questions = data[0];
            this.SubmittedResults = data[1];
            this.ToggleLoader();
        },
        showErrors(error) {
            // alert(error);
            console.log('error ', error);
            this.Quizerrors.push(error);
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
        GetLessons(event) {
            this.ToggleLoader(true);
            console.log('evenet ', event);
            var index = event.target.options.selectedIndex;
            var course_id = event.target.options[index].value;
            if (course_id <= 0) {
                this.ToggleLoader();
                this.courseLessons = null;
                return;
            }
            this.Server.setRequest({
                api_token: window.api_token,
                course_id: course_id
            });
            this.Server.serverRequest('/api/courses/lessons', this.setCourseLessons, this.showErrors);
        },
        setCourseLessons(data) {
            this.courseLessons = data;
            this.ToggleLoader();
        },
        submitAnswer(question) {

            if (question.answer == null) {
                this.showErrors('Please ensure you have selected an answer before saving');
                return;
            }
            this.ToggleLoader(true);
            this.Server.setRequest({
                api_token: window.api_token,
                question_id: question.id,
                answer: question.answer
            });
            this.Server.serverRequest('/api/student/quiz/answer', this.answerSaved, this.showErrors);

        },
        submitQuiz(quiz_id) {
            this.ToggleLoader(true);
            this.Server.setRequest({
                assignment_id: quiz_id,
                api_token: window.api_token
            });
            this.Server.serverRequest('/api/student/quiz/submit', this.quizSubmitted, this.showErrors);
        },
        quizSubmitted(data) {
            this.showSuccess('Assignment successfully submitted');
        },
        answerSaved(data) {
            this.showSuccess('successfully saved the answer');
        },
    },
    components: {
        'math-comp': maths,
        'quiz-info': QuizInfo
    },
})