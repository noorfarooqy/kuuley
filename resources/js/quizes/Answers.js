export default class {
    constructor(answer, is_correct, akey) {
        this.answer = answer;
        this.is_correct = is_correct;
        this.existing_keys = akey;
        this.answer_key = this.GenerateKey();
    }

    GenerateKey(){
        var key =  Date.now()+''+Math.round(Math.random(99,200)*100);
        if(this.existing_keys.indexOf(key) > 0)
            this.GenerateKey();
        return key;

    }
}