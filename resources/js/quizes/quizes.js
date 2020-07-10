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
        p1: null,
        Quizerrors: [],
        Server: new Server(),
        Questions: [],
        Answer: {
            question_id: null,
            answer: null,
        },
        SubmittedResults: [],
        Courses: [],
        Lessons: null,

    },
    methods: {
        somefunction() {
            console.log('hi');
        }
    },
    mounted() {
        if (window.quiz_id != undefined && window.quiz_id != null) {
            this.Server.setRequest({
                api_token: window.api_token,
                quiz_id: window.quiz_id
            });
            this.Server.serverRequest('/api/admin/quiz/questions', this.ShowQuizQuestions, this.showErrors);
        } else if (window.lesson_id != undefined && window.lesson_id != null) {
            this.ToggleLoader(true);
            this.Server.setRequest({
                api_token: window.api_token,
                lesson_id: window.lesson_id
            });

            this.Server.serverRequest('/api/student/quiz/questions', this.setQuizQuestions, this.showErrors);
        }

    },
    methods: {
        setQuizQuestions(data) {
            this.Questions = data[0];
            this.SubmittedResults = data[1];
            this.ToggleLoader();
        },

        ShowQuizQuestions(data) {
            console.log(data);
            data.forEach(question => {
                this.AddNewQuestion(question);
            });
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
        GetCourseList() {
            this.ToggleLoader(true);
            this.Server.setRequest({
                api_token: window.api_token
            });
            this.Server.serverRequest('/api/courses/list', this.SetCourseList, this.showErrors);
        },
        GetCourseLessons(course) {
            console.log('will get lesson fro ', course);
            if (course == -1 || course == null) {
                this.Lessons = null;
                return;
            }
            this.ToggleLoader(true);
            this.Server.setRequest({
                api_token: window.api_token,
                course_id: course
            });
            this.Server.serverRequest('/api/courses/lessons', this.SetCourseLessons, this.showErrors);
        },
        SetCourseLessons(data) {
            this.Lessons = data;
            this.ToggleLoader();
        },
        SetCourseList(data) {
            this.Courses = data;
            this.ToggleLoader();
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