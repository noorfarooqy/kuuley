<template>
    <div class="maths-div">
        <div class="form-group mb-3 border-dark p-2 " style="border:thin solid gray">
            <img src="/assets/math_icons/plus.png" height="20" alt="" style="border: thin solid rgb(240, 218, 218); "
                class="p-1 pointer" @click.prevent="addFormula(Signs.sign_plus)">
            <img src="/assets/math_icons/minus.png" height="20" alt="" style="border: thin solid rgb(240, 218, 218)"
                class="p-1"  @click.prevent="addFormula(Signs.sign_minus)">
            <img src="/assets/math_icons/divide.png" height="20" alt="" style="border: thin solid rgb(240, 218, 218)"
                class="p-1"  @click.prevent="addFormula(Signs.sign_divide)">
            <img src="/assets/math_icons/multiply.png" height="20" alt="" style="border: thin solid rgb(240, 218, 218)"
                class="p-1" @click.prevent="addFormula(Signs.sign_times)">
            <img src="/assets/math_icons/fraction.png" height="20" alt="" style="border: thin solid rgb(240, 218, 218)"
                class="p-1" @click.prevent="addFormula(Signs.sign_percentage)">
            <img src="/assets/math_icons/equal.png" height="20" alt="" style="border: thin solid rgb(240, 218, 218)"
                class="p-1" @click.prevent="addFormula(Signs.sign_equal)">
            <img src="/assets/math_icons/division_2.png" height="20" alt=""
                style="border: thin solid rgb(240, 218, 218)" class="p-1" @click.prevent="addFormula(Signs.sign_square_root)">
            <img src="/assets/math_icons/lessthan.png" height="20" alt="" style="border: thin solid rgb(240, 218, 218)"
                class="p-1" @click.prevent="addFormula(Signs.sign_lessthan)">
            <img src="/assets/math_icons/greaterthan.png" height="20" alt=""
                style="border: thin solid rgb(240, 218, 218)" class="p-1" @click.prevent="addFormula(Signs.sign_greaterthan)">
            <img src="/assets/math_icons/lessthan_equalto.png" height="20" alt=""
                style="border: thin solid rgb(240, 218, 218)" class="p-1" @click.prevent="addFormula(Signs.sign_lessthan_equalto)">
            <img src="/assets/math_icons/lgreaterthan_equalto.png" height="20" alt=""
                style="border: thin solid rgb(240, 218, 218)" class="p-1" @click.prevent="addFormula(Signs.sign_greaterthan_equalto)">
            <img src="/assets/math_icons/notequal.png" height="20" alt="" style="border: thin solid rgb(240, 218, 218)"
                class="p-1" @click.prevent="addFormula(Signs.sign_not_equal)">
            <img src="/assets/math_icons/power.png" height="20" alt="" style="border: thin solid rgb(240, 218, 218)"
                class="p-1" @click.prevent="addFormula(Signs.sign_power)">
            <img src="/assets/math_icons/times.png" height="20" alt="" style="border: thin solid rgb(240, 218, 218)"
                class="p-1" @click.prevent="addFormula(Signs.sign_ast)">
            <img src="/assets/math_icons/plus_minus.png" height="20" alt="" @click.prevent="addFormula(Signs.sign_pm)"
                style="border: thin solid rgb(240, 218, 218)" class="p-1">
        </div>
        <div class="form-group mb-3">
            <label class="control-label h6">New Question:</label>
            <textarea placeholder="Question text" ref="formula" v-model="formula" type="text" name="question[title]" class="form-control"></textarea>
        </div>
        <vue-mathjax :formula="GetMathsPreview()"></vue-mathjax>
        <div class="flex" v-if="type == 1">
            <label for="subscribe">Select if answer is true</label><br>
            <div class="custom-control custom-checkbox-toggle custom-control-inline mr-1">
                <input checked="" type="checkbox" id="subscribe" class="custom-control-input">
                <label class="custom-control-label" for="subscribe">True</label>
            </div>
            <label for="subscribe" class="mb-0">True</label>
        </div>
        <ul class="list-group" id="answer_container_1" v-if="type == 2">
            <li class="list-group-item d-flex" data-position="1" data-answer-id="1" data-question-id="1" 
            v-for="(answer, akey) in SingleChoiceQuiz.answers" :key="akey">
                <span class="mr-2"><i class="material-icons text-light-gray">menu</i></span>
                <div>
                    {{answer.answer}}
                </div>
                <div class="ml-auto">
                    <input :checked="answer.is_correct" type="radio" name="question[correct_answer_id]" id="correct_answer_6">
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
import {VueMathjax} from 'vue-mathjax';
import signs from './signs';
import single_choice_quiz  from "./single_choice_question";
import answer from './Answers';
export default {
    
    data() {
        return {
            name: 'maths-vue',
            version: '1.0',
            formula:'',
            Signs: new signs(),
            SingleChoiceQuiz : new single_choice_quiz(),
        }
    },
    mounted() {
        // alert('maths is ready');
        console.log('math is ready');
        this.SingleChoiceQuiz.question_text = 'This my question';
        this.SingleChoiceQuiz.answers.push(new answer('Answer 1', true));
    },
    methods: {
        GetMathsPreview()
        {
            // MathJax.textReset();
            
            return '$$ '+this.formula+ ' $$';
        },
        addFormula(sign)
        {
            console.log('acitve aelemtn ', this.$refs.formula);
            // pos = ;
            console.log('postion ',this.$refs.formula.selectionEnd);
            this.typeInTextarea(sign, this.$refs.formula);
        },
        typeInTextarea(newText, el = document.activeElement) {
            const [start, end] = [el.selectionStart, el.selectionEnd];
            console.log(' start ',start, ' end  ',end);
            el.setRangeText(newText+' ', start, end, 'select');
            el.focus();
            el.setSelectionRange(el.selectionEnd,el.selectionEnd+2,'forward');
        }
        
    },
    components: {
        'vue-mathjax': VueMathjax
    },
    props: ['type']
}
</script>