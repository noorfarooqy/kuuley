<template>
    <div class="maths-div">
        <div class="form-group mb-3 border-dark p-2 " style="border:thin solid gray">
            <img src="/assets/math_icons/plus.png" height="20" alt="" style="border: thin solid rgb(240, 218, 218)"
                class="p-1">
            <img src="/assets/math_icons/minus.png" height="20" alt="" style="border: thin solid rgb(240, 218, 218)"
                class="p-1">
            <img src="/assets/math_icons/divide.png" height="20" alt="" style="border: thin solid rgb(240, 218, 218)"
                class="p-1">
            <img src="/assets/math_icons/multiply.png" height="20" alt="" style="border: thin solid rgb(240, 218, 218)"
                class="p-1">
            <img src="/assets/math_icons/fraction.png" height="20" alt="" style="border: thin solid rgb(240, 218, 218)"
                class="p-1">
            <img src="/assets/math_icons/equal.png" height="20" alt="" style="border: thin solid rgb(240, 218, 218)"
                class="p-1">
            <img src="/assets/math_icons/division_2.png" height="20" alt=""
                style="border: thin solid rgb(240, 218, 218)" class="p-1">
            <img src="/assets/math_icons/lessthan.png" height="20" alt="" style="border: thin solid rgb(240, 218, 218)"
                class="p-1">
            <img src="/assets/math_icons/greaterthan.png" height="20" alt=""
                style="border: thin solid rgb(240, 218, 218)" class="p-1">
            <img src="/assets/math_icons/lessthan_equalto.png" height="20" alt=""
                style="border: thin solid rgb(240, 218, 218)" class="p-1">
            <img src="/assets/math_icons/lgreaterthan_equalto.png" height="20" alt=""
                style="border: thin solid rgb(240, 218, 218)" class="p-1">
            <img src="/assets/math_icons/notequal.png" height="20" alt="" style="border: thin solid rgb(240, 218, 218)"
                class="p-1">
            <img src="/assets/math_icons/power.png" height="20" alt="" style="border: thin solid rgb(240, 218, 218)"
                class="p-1">
            <img src="/assets/math_icons/times.png" height="20" alt="" style="border: thin solid rgb(240, 218, 218)"
                class="p-1">
            <img src="/assets/math_icons/plus_minus.png" height="20" alt=""
                style="border: thin solid rgb(240, 218, 218)" class="p-1">
        </div>
        <div class="form-group mb-3">
            <label class="control-label h6">New Question:</label>
            <textarea placeholder="Question text" v-model="formula" type="text" name="question[title]" class="form-control"></textarea>
        </div>
        <vue-mathjax :formula="formula"></vue-mathjax>
        
        <ul class="list-group" id="answer_container_1">
            <li class="list-group-item d-flex" data-position="1" data-answer-id="1" data-question-id="1">
                <span class="mr-2"><i class="material-icons text-light-gray">menu</i></span>
                <div>
                    True
                </div>
                <div class="ml-auto">
                    <input type="radio" name="question[correct_answer_id]" id="correct_answer_1">
                </div>
            </li>
            <li class="list-group-item d-flex" data-position="1" data-answer-id="1" data-question-id="1">
                <span class="mr-2"><i class="material-icons text-light-gray">menu</i></span>
                <div>
                    False
                </div>
                <div class="ml-auto">
                    <input type="radio" name="question[correct_answer_id]" id="correct_answer_1" checked="">
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
import {VueMathjax} from 'vue-mathjax';
export default {
    
    data() {
        return {
            name: 'maths-vue',
            version: '1.0',
            formula:'$$x = {-b \\pm \\sqrt{b^2-4ac} \\over 2a}.$$',
        }
    },
    mounted() {
        // alert('maths is ready');
        console.log('math is ready');
    },
    methods: {
        GetMathsPreview()
        {
            // MathJax.textReset();
            
            return this.math_text;
        }
    },
    components: {
        'vue-mathjax': VueMathjax
    }
}
</script>