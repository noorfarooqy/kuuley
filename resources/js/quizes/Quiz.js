class Quiz {

    constructor(){
        this.question_text = '';
        this.answers = [];
        this.existing_keys = [];
        this.error_message = null;
    }

    QuestionIsValid(Errors){
        if(this.question_text == null || this.question_text.length <= 0){
            this.error_message = Errors.formula_incomplete;
            return false;
        }
        else if(this.answers == null || this.answers.length <= 0){
            this.error_message = Errors.answer_missing;
            return false;
        }
        return true;

    }

    GetErrorMessage(){
        return this.error_message;
    }
}
module.exports = Quiz;