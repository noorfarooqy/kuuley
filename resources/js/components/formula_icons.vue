<template>
    <div class="form-group mb-3 border-dark p-2 " style="border:thin solid gray">
        <img src="/assets/math_icons/plus.png" height="20" alt="" style="border: thin solid rgb(240, 218, 218); "
            class="p-1 pointer" @click.prevent="addFormula(Signs.sign_plus, element)">
        <img src="/assets/math_icons/minus.png" height="20" alt="" style="border: thin solid rgb(240, 218, 218)"
            class="p-1" @click.prevent="addFormula(Signs.sign_minus, element)">
        <img src="/assets/math_icons/divide.png" height="20" alt="" style="border: thin solid rgb(240, 218, 218)"
            class="p-1" @click.prevent="addFormula(Signs.sign_divide, element)">
        <img src="/assets/math_icons/multiply.png" height="20" alt="" style="border: thin solid rgb(240, 218, 218)"
            class="p-1" @click.prevent="addFormula(Signs.sign_times, element)">
        <img src="/assets/math_icons/fraction.png" height="20" alt="" style="border: thin solid rgb(240, 218, 218)"
            class="p-1" @click.prevent="addFormula(Signs.sign_percentage, element)">
        <img src="/assets/math_icons/equal.png" height="20" alt="" style="border: thin solid rgb(240, 218, 218)"
            class="p-1" @click.prevent="addFormula(Signs.sign_equal, element)">
        <img src="/assets/math_icons/division_2.png" height="20" alt="" style="border: thin solid rgb(240, 218, 218)"
            class="p-1" @click.prevent="addFormula(Signs.sign_square_root, element)">
        <img src="/assets/math_icons/lessthan.png" height="20" alt="" style="border: thin solid rgb(240, 218, 218)"
            class="p-1" @click.prevent="addFormula(Signs.sign_lessthan, element)">
        <img src="/assets/math_icons/greaterthan.png" height="20" alt="" style="border: thin solid rgb(240, 218, 218)"
            class="p-1" @click.prevent="addFormula(Signs.sign_greaterthan, element)">
        <img src="/assets/math_icons/lessthan_equalto.png" height="20" alt=""
            style="border: thin solid rgb(240, 218, 218)" class="p-1"
            @click.prevent="addFormula(Signs.sign_lessthan_equalto, element)">
        <img src="/assets/math_icons/lgreaterthan_equalto.png" height="20" alt=""
            style="border: thin solid rgb(240, 218, 218)" class="p-1"
            @click.prevent="addFormula(Signs.sign_greaterthan_equalto, element)">
        <img src="/assets/math_icons/notequal.png" height="20" alt="" style="border: thin solid rgb(240, 218, 218)"
            class="p-1" @click.prevent="addFormula(Signs.sign_not_equal, element)">
        <img src="/assets/math_icons/power.png" height="20" alt="" style="border: thin solid rgb(240, 218, 218)"
            class="p-1" @click.prevent="addFormula(Signs.sign_power, element)">
        <img src="/assets/math_icons/times.png" height="20" alt="" style="border: thin solid rgb(240, 218, 218)"
            class="p-1" @click.prevent="addFormula(Signs.sign_ast, element)">
        <img src="/assets/math_icons/plus_minus.png" height="20" alt="" @click.prevent="addFormula(Signs.sign_pm, element)"
            style="border: thin solid rgb(240, 218, 218)" class="p-1">
    </div>
</template>
<script>
export default {
    data() {
        return {
            name: 'formula icons',
            version: 1
        }
    },
    methods: {
        addFormulas(sign){
            console.log('calling for sign ',sign);
        },

        addFormula(sign,el) {
            console.log('editor --------- ',el);
            this.typeInTextarea(sign, el);
        },
        typeInTextarea(newText, el = document.activeElement) {
            const [start, end] = [el.selectionStart, el.selectionEnd];
            console.log(' start ', start, ' end  ', end);
            el.setRangeText(newText + ' ', start, end, 'select');
            el.focus();
            el.setSelectionRange(el.selectionEnd, el.selectionEnd + 2, 'forward');
        },
    },
    props: [ 'Signs', 'answer', 'element']
}
</script>