
require('./../bootstrap');
const anime = require('animejs');
import maths from '../components/maths.vue';
import VueMathjax from 'vue-mathjax'
import QuizInfo from "./../components/quiz_info.vue";
import Server from "./../server";
Vue.use(VueMathjax)
// Vue.use('')
var app = new Vue({
    el: "#app",
    data: {
        p1:null,
        Quizerrors:[],
        Server: new Server(),
        Questions:[],

    },
    methods: {
        somefunction()
        {
            console.log('hi');
        }
    },
    mounted() {
        this.Server.setRequest({
            api_token: window.api_token,
            quiz_id: window.quiz_id
        });
        this.Server.serverRequest('/api/admin/quiz/questions',this.ShowQuizQuestions,this.ShowErrors);
    },
    methods:{

        ShowQuizQuestions(data){
            console.log(data);
            data.forEach(question => {
                this.AddNewQuestion(question);
            });
        },
        ShowErrors(error){
            console.log('Error ',error);
            this.Quizerrors.push(error);
            alert(error);
        },
        DeletedQuestion(question)
        {
            var ques = this.Questions.find(q => q.id == question.id);
            var index = this.Questions.indexOf(ques);
            if(index < 0)
            {
                alert('Question deleted successfully, could not remove from the list. Refresh the page');
            }
                
            else{
                console.log('index to remove ',index);
                this.Questions.splice(index,1);
                alert('succesfully deleted the question');
            }
            
        },
        AddNewQuestion(question)
        {
            this.Questions.push(question);
        },
        DeleteQuestion(question_id, quiz_id)
        {
            this.Server.setRequest({
                api_token: window.api_token,
                question: question_id,
                quiz_id : quiz_id,
            });
            this.Server.serverRequest('/api/admin/quiz/questions/delete',this.DeletedQuestion,this.ShowErrors);
            
        }
    },
    components: {'math-comp':maths, 'quiz-info':QuizInfo},
})