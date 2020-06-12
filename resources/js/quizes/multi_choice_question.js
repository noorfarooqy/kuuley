
import Answer from './Answers';
export default class {
    constructor(){
        this.question_text = '';
        this.answers = [];
        this.existing_keys = [];
    }
    UpdateAnswers(answer){
        var index = this.answers.indexOf(answer);
        this.answers[index].is_correct = !this.answers[index].is_correct;
    }
    NewAnswer(answer_text){
        var newAnswer = new Answer(answer_text,false,this.existing_keys);
        var AnswerKey = this.answers.push(newAnswer);
        this.existing_keys.push(newAnswer.answer_key);
    }
    DeleteAnswer(answer){
        var index = this.answers.indexOf(answer);
        this.answers.splice(index,1);
    }
}
