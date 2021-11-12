<template>
    <div class="col-md-5 bg-light p-0 m-0">
        <div class="header d-flex align-items-center justify-content-center">
            <img :src="smile" class="smile">
            <h3>Olá, <strong>{{ firstName }}</strong></h3>
        </div>

        <div class="container pt-5 pl-5">
            <div class="row px-3 mt-5 mb-3">
                <h4 class="p-0">Meus dados</h4>
            </div>
            
            <div class="row d-flex justify-content-between px-3">
                <p class="text-muted col-5 p-0">Nome completo</p>
                <p class="col-7 p-0 text-right">{{ data.nome }}</p>
            </div>
            <div class="row d-flex justify-content-between px-3">
                <p class="text-muted col-5 p-0">CPF</p>
                <p class="col-7 p-0 text-right">{{ data.cgcpf }}</p>
            </div>
            <!-- <div class="row d-flex justify-content-between px-3">
                <p class="text-muted">Data de aniversário</p>
                <p>12/07/1999</p>
            </div> -->

            <div class="row px-3 mt-4 mb-3">
                <h4 class="p-0">Atualizar Contato</h4>
            </div>
            
            <div class="row d-flex justify-content-between px-3">
                <p class="text-muted">Celular</p>
                <the-mask :mask="['(##) ####-####', '(##) #####-####']" class="form-control w-75 custom-input" v-model="contact.phone" />
            </div>
            <div class="row d-flex justify-content-between px-3">
                <p class="text-muted">E-mail</p>
                <input type="email" class="form-control w-75 custom-input" v-model="contact.email">
            </div>

            <div v-if="Object.keys(errors).length" class="alert alert-danger">
            <b>Por favor, corrija o(s) seguinte(s) erro(s):</b>
            <ul>
                <li v-for="(error, key) in errors" :key="key">{{ error[0] }}</li>
            </ul>
        </div>

        <div v-if="success" class="alert alert-success">
            <b>Sucesso!</b> {{ success.message }}
        </div>

            <div class="d-flex justify-content-center mb-5 mt-3">
                <button class="btn btn-md btn-blue m-auto" @click="handleUpdateContact">Atualizar</button>
            </div>
        </div>
    </div>
</template>

<style lang="scss" scoped>
    .smile {
        max-width: 5rem;
        margin-right: 1rem;
    }

    .header {
        background-color: #34b8dc;
        padding: 2.5rem 0 !important;
        color: white;
    }

    .custom-input {
        height: 2rem !important;
        font-size: .8rem;
    }

    @media only screen and (max-width: 600px) {
        .header {
            display: none !important;
        }

        .container {
            padding: 0 2rem !important;
        }
    }
</style>

<script>
import smile from '../../assets/images/usuario.png';

export default {
    data() {
        return {
            smile: smile,
            firstName: '',
            data: '',
            contact: {
                email: '',
                phone: ''
            },
            errors: {},
            success: false
        }
    },

    props: ['email', 'client', 'phone'],

    watch: {
        'client': function (val) {
            if (Object.keys(val).length > 0) {
                this.data = val;
                this.firstName = val.nome.split(' ')[0];
            }
        },

        'email': function (val) {
            if (val !== null) {
                this.contact.email = val;
            }
        },

        'phone': function (val) {
            if (val !== null) {
                this.contact.phone = val;
            }
        },
    },

    methods: {
        handleUpdateContact () {
            axios.post('/contato',{
                cliente: this.client,
                telefone: this.contact.phone,
                email: this.contact.email
            })
            .then(res => {
                console.log(res.data)
            })
            .catch(err => {
                this.errors = err.response.data.errors;
            })
        },
    },
}
</script>