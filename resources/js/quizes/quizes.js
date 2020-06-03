
require('./../bootstrap');
const anime = require('animejs');
import maths from './maths.vue';
import VueMathjax from 'vue-mathjax'
Vue.use(VueMathjax)
// Vue.use('')
var app = new Vue({
    el: "#app",
    data: {
        p1:null,
    },
    methods: {
        somefunction()
        {
            console.log('hi');
        }
    },
    components: {'math-comp':maths},
})