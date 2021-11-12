<template>
    <div class="bg-light">
        <div class="container py-5">
            <h1 class="text-center text-blue">Como funciona?</h1>

            <p class="text-center mt-4">É simples e rápido! Você consulta seu CPF e verifica na hora as melhores oportunidades.</p>

            <div class="row">
                <div class="col-md-4">
                    <WhiteCard :icon="icon1">
                        1. Consulte o seu CPF e veja se possui dívidas.
                    </WhiteCard>
                </div>
                <div class="col-md-4">
                    <WhiteCard :icon="icon2">
                        2. Veja as opções de negociação e faça um acordo.
                    </WhiteCard>
                </div>
                <div class="col-md-4">
                    <WhiteCard :icon="icon3">
                        3. Pronto! Agora é só efetuar o pagamento.
                    </WhiteCard>
                </div>
            </div>

            <p class="text-center mt-5">Ficou com alguma dúvida? <strong>Clique aqui e fale conosco pelo WhatsApp!</strong></p>
            
        </div>
        
    </div>
</template>

<style lang="scss" scoped>
    @media only screen and (max-width: 600px) {
        .container {
            padding: 2rem !important;
        }

        .col-md-4 {
            padding: 0 3rem;
        }

        .col-md-4 + .col-md-4 {
            margin-top: 1rem;
        }
    }
</style>

<script>
import icon1 from '../assets/images/icon1.png';
import icon2 from '../assets/images/icon2.png';
import icon3 from '../assets/images/icon3.png';
import WhiteCard from './WhiteCard.vue';

export default {
    components: { WhiteCard },

    data() {
        return {
            icon1: icon1,
            icon2: icon2,
            icon3: icon3,
        }
    },
}
</script>