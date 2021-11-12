<template>
    <div class="home">
        <Navbar />

        <loading :active.sync="isLoading" 
            :can-cancel="true" 
            :on-cancel="onCancel"
            :is-full-page="fullPage">
        </loading>

        <div class="bg pt-5">
            <div class="container py-5 mt-5">
                <div class="col-md-7">
                    

                    <div class="col-md-7 px-0 mt-5 mb-5">   
                        <h1 class="mt-5">Regularize</h1>

                        <p class="subtitle">O Cartão Carrefour tem <br> condições especiais para <br> você regularizar seu débito.</p>

                        <the-mask :mask="['###.###.###-##']" :class="{'form-control home-form-component cpf-input ': true, 'is-invalid' : error}" placeholder="CPF" v-model="cpf"/>
                        <div v-if="error" class="alert alert-danger p-2">
                            <b>CPF não encontrado</b>
                        </div>
                        <button class="btn btn-md btn-success btn-block home-form-component" @click.prevent="handleLogin">Entrar</button>
                    </div>
                </div>
            </div>
        </div>

        <HowItWorks />

        <!-- <Reports /> -->

        <About />

        <Footer />
    </div>
</template>

<style lang="scss">
    body {
        color: #002651;
    }
    h1 {
        font-size: 3.2rem;
    }

    .home p {
        font-size: 1.2rem;
        font-weight: 300;
        line-height: 1.5rem;
    }

    .btn-success {
        background-color: #9dd143;
        border-color: #9dd143;
    }

    .btn-success:hover {
        background-color: #85b13a;
        border-color: #85b13a;
    }

    strong {
        font-weight: bold;
    }

    .text-blue {
        color: #34b8dc;
    }

    .home .subtitle {
        font-size: 1.4rem !important;
        color: #002651;
        margin: 3rem 0;
        line-height: 1.6rem;
    }

    .cpf-input::-webkit-input-placeholder {
        color: #9dd143;
        text-align: center;
    }

    .home-form-component + .home-form-component {
        margin-top: 0.6rem;
    }

    .cpf-input {
        background-color:rgba(0,0,0,0) !important;
        border:solid 0.08rem #9dd143 !important;
    }

    .bg {
        background-image: url("../assets/images/banner.png");
        max-height: 100rem;
        background-position:top;
        background-repeat: no-repeat;
        background-size: cover;
    }

    @media only screen and (max-width: 600px) {
        h1 {
            font-size: 2rem;
            text-align: center;
        }
        .bg {
            height: 29rem;
        }
    }
</style>

<script>
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';
import Navbar from './Navbar.vue';
import HowItWorks from './HowItWorks.vue';
import Reports from './Reports.vue';
import About from './About.vue';
import Footer from './Footer.vue';
import Bus from '../bus';

export default {
    components: { Navbar, HowItWorks, Reports, About, Footer, Loading },

    data() {
        return {
            cpf: '',
            error: false,
            params: {
                client_id: "813047555100-8dljt4jvfibno55caa4kqpi1comrhga1.apps.googleusercontent.com"
            },
            isLoading: false,
            fullPage: true,
            data: ''
        }
    },

    mounted () {
        this.$cookies.remove('cpf');
        this.$cookies.config('30min');
    },

    methods: {

        onCancel() {
            console.log('User cancelled the loader.')
        },

        async handleLogin () {
            this.isLoading = true;

            await axios.post('/divida', { cpf: this.cpf })
            .then(res => {
                this.$cookies.set("cpf", res.data.cliente.cgcpf);
                this.$router.push({name: 'Admin'});
            })
            .catch(err => {
                console.error(err);
                this.isLoading = false;
                this.error = err.response.data.error;
                return;
            });
        },

        AuthProvider(provider) {
            var self = this;

            this.$auth.authenticate(provider).then(response => {
                self.SocialLogin(provider,response)
            }).catch(err => {
                console.log({err:err})
            })
        },

        SocialLogin(provider,response){
            this.$http.post('/sociallogin/'+ provider, response).then(response => {
                console.log('chegueeei2', response.data)
            }).catch(err => {
                console.log({err:err})
            })
        },
    }
}
</script>