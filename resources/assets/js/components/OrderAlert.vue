<template>
    <div>
        Order Alert Component
        </div>
</template>

<script>
    import { alert } from 'vue-strap'

    export default {
        components:{
            alert
        },

        props: ['order_id'],

        data(){
            return {
                
            }
        },

        mounted(){
            Echo.channel('pizza-tracker.' + this.order_id)
            .listen('OrderStatusChanged', (order) => {

            });
        }
    }
</script>