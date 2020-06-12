
import Answer from './Answers';
import Quiz from './Quiz';
export default class extends Quiz {
    constructor(){
        super();
        
    }
    UpdateAnswers(answer){
        console.log('new correct answer ',answer);
        if(answer.is_correct)
            return;
        for(var i=0; i<this.answers.length; i++)
        {
            if(this.answers[i].answer_key === answer.answer_key)
                this.answers[i].is_correct = true;
            else
                this.answers[i].is_correct =false;
        }
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
