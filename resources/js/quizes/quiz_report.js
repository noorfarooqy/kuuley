require('./../bootstrap');
import maths from '../components/maths.vue';
import VueMathjax from 'vue-mathjax'
import QuizInfo from "./../components/quiz_info.vue";
import Server from "./../server";
import Chart from 'chart.js'
import ResultProjection from '../components/resultprojectchart.vue';
// import ionRangeSlider from 'ion-rangeslider';
Vue.use(VueMathjax)
    // Vue.use('')
var app = new Vue({
    el: "#app",
    data: {
        p1: null,
        Quizerrors: [],
        Server: new Server(),
        Questions: [],
        Trails: [],
        topic_results: [],
        Results: null,

    },
    methods: {
        somefunction() {
            console.log('hi');
        }
    },
    mounted() {

        if (window.quiz != null && window.quiz != undefined) {
            this.ToggleLoader(true);
            this.Server.setRequest({
                api_token: window.api_token,
                quiz: window.quiz,
                trail_count: window.trail,
            });
            this.Server.serverRequest(
                '/api/student/quiz/report',
                this.SetQuizReport,
                this.showErrors
            );
        }

    },
    methods: {
        SetQuizReport(data) {
            console.log('data ', data);
            this.Questions = data.questions;
            this.Trails = data.trail;
            this.Results = data.results.trail_result[0];
            this.topic_results = data.results.topic_result;
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
        GetEstimatedGrade() {
            var grade = ((this.Results['result'] / this.Results['total']) * 100).toFixed(1);
            if (grade >= 90) return 'A';
            else if (grade >= 80) return 'B';
            else if (grade >= 70) return 'C';
            else if (grade >= 60) return 'D';
            else return 'E';
        },
        HasGotQuestionCorrect(question) {
            var index = this.Trails.findIndex((trail) => trail.question_id == question.id);
            return this.Trails[index].is_correct_choice;
        },
        IsCorrectChoice(answer, question) {
            if (question.question_type === 1) {
                var index = this.Trails.findIndex((trail) => trail.question_id == question.id && trail.chosen_answer == answer);
                console.log('comparing ', answer, ' and ', this.Trails[0].chosen_answer);
            } else
                var index = this.Trails.findIndex((trail) => trail.question_id == question.id && trail.chosen_answer == answer.id);

            if (index >= 0) {

                return this.Trails[index].is_correct_choice;
            }
            return false;
        },
        IsChosenAnswer(answer, question) {
            if (question.question_type === 1) {
                var index = this.Trails.findIndex((trail) => trail.question_id == question.id && trail.chosen_answer == answer);
                console.log('comparing ', answer, ' and ', this.Trails[0].chosen_answer);
            } else
                var index = this.Trails.findIndex((trail) => trail.question_id == question.id && trail.chosen_answer == answer.id);
            if (index >= 0) {
                return true;
            }
            return false;
        },
        GetFeedBackType(score) {
            if (score >= 90)
                return 'Excelent';
            else if (score >= 80)
                return 'Very Good';
            else if (score >= 70)
                return 'Good';
            else if (score >= 60)
                return 'Average';
            else
                return 'Below Average';
        },
        GetBackGroundInfo(topic, n = 0) {
            var value = ((topic.topic_result / topic.topic_total) * 100).toFixed(0);
            if (n == 1) {
                if (value > 60) return 'bg-success';
                else return 'bg-danger';
            } else {
                if (value > 60) return 'bg-soft-success';
                else return 'bg-soft-danger';
            }

        }



    },
    components: {
        'math-comp': maths,
        'quiz-info': QuizInfo,
        'result-chart': ResultProjection
    },
})