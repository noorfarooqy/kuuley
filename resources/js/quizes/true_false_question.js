
import Answer from './Answers';
import Quiz from "./Quiz";
export default class extends Quiz {
    constructor(){
        super();
        this.answers = false;
    }
    UpdateAnswers(state){
        console.log('new answer state ---- ',state)
        this.answers = state.target.checked;
    }
}
