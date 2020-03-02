<template>
</template>
<script>
    export default {
        data(){
            return {
                email : "",
                genealogyCount: 0,
            }
        },
        computed: {
            btnsize () {
                switch (this.$vuetify.breakpoint.name) {
                case 'xs': return '150px'
                case 'sm': return '150px'
                case 'md': return '200px'
                case 'lg': return '200px'
                case 'xl': return '200px'
                }
            },
        },
        methods : {
            handleSubmit(){
                
            },
            getCount(){
                axios.get('api/genealogy-count')
                .then( response => {
                    this.genealogyCount = response.data
                })
                .catch( error => {})
                .finally( x => {
                })
            },
        },
        created() {
            this.getCount();
            const that = this;
            setInterval(function() {
                that.genealogyCount += 1;
            }, 3000);
        }
    }
</script>

