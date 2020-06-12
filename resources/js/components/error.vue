<template>
    <div class="alert alert-danger mt-2">
       <span class="fa fa-info-circle fa-1x"></span>  {{error_text}}
    </div>
</template>
<script>
export default {
    data() {
        return {
            name: 'error-component',
            version: 1
        }
    },
    mounted() {

    },
    props:['error_text']
}
</script>