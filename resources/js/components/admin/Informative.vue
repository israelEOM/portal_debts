<template>
    <div class="col-md-7 mt-3 pr-5 pl-4 p-custom">

        <div class="col-md-10">
            <h2 class="mt-5 pb-0">Em caso de dúvidas, entre em contato conosco</h2>

            <h5 class="text-thin mt-4"><strong class="text-blue">WhatsApp:</strong> (11) 984552713</h5>
            <h5 class="text-thin mt-3"><strong class="text-blue">Telefone:</strong> 0800 601 3319</h5>
            <h5 class="text-thin">ou (11) 3526-3319</h5>
            <h5 class="text-thin mt-3"><strong class="text-blue">Email:</strong> cobranca.carrefour@creditcash.net.br</h5>
        </div>

    </div>
</template>

<style lang="scss" scoped>
   
</style>

<script>
export default {
    data() {
        return {
            
        }
    },

    watch: {
        'deals': function (val) {
            if (Object.keys(val).length > 0) {
                this.deal = val[0];
            }
        },
    },

    methods: {

    },
}
</script>