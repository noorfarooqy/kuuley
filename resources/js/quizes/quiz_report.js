require('./../bootstrap');
import maths from '../components/maths.vue';
import VueMathjax from 'vue-mathjax'
import QuizInfo from "./../components/quiz_info.vue";
import Server from "./../server";
import Chart from 'chart.js'
// import ionRangeSlider from 'ion-rangeslider';
Vue.use(VueMathjax)
    // Vue.use('')
var app = new Vue({
    el: "#app",
    data: {
        p1: null,
        Server: new Server(),

    },
    methods: {
        somefunction() {
            console.log('hi');
        }
    },
    mounted() {

    },
    methods: {
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
        DeletedQuestion(question) {
            var ques = this.Questions.find(q => q.id == question.id);
            var index = this.Questions.indexOf(ques);
            if (index < 0) {
                alert('Question deleted successfully, could not remove from the list. Refresh the page');
            } else {
                console.log('index to remove ', index);
                this.Questions.splice(index, 1);
                alert('succesfully deleted the question');
            }

        },
        AddNewQuestion(question) {
            this.Questions.push(question);
        },
        DeleteQuestion(question_id, quiz_id) {
            this.Server.setRequest({
                api_token: window.api_token,
                question: question_id,
                quiz_id: quiz_id,
            });
            this.Server.serverRequest('/api/admin/quiz/questions/delete', this.DeletedQuestion, this.showErrors);

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
    },
    components: {
        'math-comp': maths,
        'quiz-info': QuizInfo
    },
})