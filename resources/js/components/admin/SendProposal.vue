<template>
    <div class="col-md-7 mt-3 pr-5 pl-4 p-custom-proposal">

        <div v-if="success">
            <div class="col-md-10">
                <h2 class="mt-5 pb-0">Acordo formalizado com sucesso!</h2>

                <h5 class="text-blue mt-4 text-thin">Acesse o menu Meus Acordos para baixar seu boleto.</h5>

                <h5 class="text-thin mt-4"><strong class="text-blue">WhatsApp:</strong> (11) 984552713</h5>
            <h5 class="text-thin mt-3"><strong class="text-blue">Telefone:</strong> 0800 601 3319</h5>
            <h5 class="text-thin">ou (11) 3526-3319</h5>
            <h5 class="text-thin mt-3"><strong class="text-blue">Email:</strong> cobranca.carrefour@creditcash.net.br</h5>
            </div>
        </div>

        <div v-else>
            <div class="col-md-9" v-if="!contract">
                <h4 class="mt-5 pb-0">Nenhum débito disponível para negociação!</h4>

                <h5 class="text-blue mt-4 text-thin">
                    <strong>Dúvidas:</strong>
                </h5>
                <h5 class="text-thin mt-4"><strong class="text-blue">WhatsApp:</strong> (11) 984552713</h5>
            <h5 class="text-thin mt-3"><strong class="text-blue">Telefone:</strong> 0800 601 3319</h5>
            <h5 class="text-thin">ou (11) 3526-3319</h5>
            <h5 class="text-thin mt-3"><strong class="text-blue">Email:</strong> cobranca.carrefour@creditcash.net.br</h5>
            </div>
            <div v-else>
                <h2 class="mt-5 pb-0 mb-0">{{ currency(installment.vlAcordo) }}</h2>
                <p class="text-muted subtitle" v-if="installment.vlDemais == 0">À vista com desconto</p>
                <p class="text-muted subtitle" v-else>Parcelado</p>

                <h4 class="mt-5 pb-0">Detalhes do pagamento</h4>
                <ul class="nav nav-tabs text-muted mt-3 mb-4 mr-0">
                    <li :class="[{'contract-item ': true, 'active': inCash}]" @click="togglePaymentForm(1)">Quantidade de Parcelas</li>
                    <!-- <li :class="[{'contract-item ': true, 'active': installments}]" @click="togglePaymentForm(0)">Parcelado</li> -->
                </ul>

                <div v-if="contract">
                    <div class="container" v-if="inCash">
                        <div class="row mb-3">
                            <button 
                                :class="{'btn btn-installment ': true, 'active': data.installments == 1}"
                                @click="data.installments = 1" 
                            >À vista</button>
                            <button v-for="(parcela, key) in contract.negociacao.parcelas" 
                                :key="key" :value="key" :class="{'btn btn-installment': true, 'active': data.installments == key}"
                                @click="data.installments = key" 
                            >
                                {{ key + 'x' }}
                            </button>
                        </div>
                        <div class="row debit-item">
                            <div class="col-md-9">
                                <h5 class="mb-0">Detalhes do pagamento</h5>
                            </div>
                        </div>

                        <div class="row debit-item">
                            <div class="col-6">
                                <p class="text-muted mb-0">Data de vencimento:</p>
                            </div>
                            <div class="col-6">
                                <datepicker input-class="form-control f-sm" format="dd/MM/yyyy"
                                    :disabled-dates="getRangeDate(contract.negociacao.aVista.dtVencimento.slice(0,10))"
                                    @input="updateDate"
                                ></datepicker>
                            </div>
                        </div>
                        <div class="row debit-item mb-3">
                            <div class="col-6">
                                <p class="text-muted mb-0">Subtotal</p>
                            </div>
                            <div class="col-6 text-right">
                                <strong>
                                    {{ currency(this.installment.vlCorrigido) }}
                                </strong>
                            </div>
                        </div>
                        <div class="row debit-item mb-3">
                            <div class="col-6">
                                <p class="text-muted mb-0">Desconto</p>
                            </div>
                            <div class="col-6 text-right">
                                <strong class="text-blue">
                                    - {{ currency(installment.vlDesconto) }}
                                </strong>
                            </div>
                        </div>
                        <!-- <div class="row debit-item mb-3">
                            <div class="col-md-6">
                                <p class="text-muted mb-0">Débitos selecionados:</p>
                            </div>
                            <div class="col-md-6 text-right">
                                <strong v-for="(divida, key) in contract.dividas" :key="key">
                                    {{ capitalize(new Date(divida.dtVencimento).toLocaleDateString('pt-BR', dateOption)) }}
                                    {{ contract.dividas.length > key+1 ? ',' : ''}}
                                </strong>
                            </div>
                        </div> -->
                        <hr>
                        <div class="row total">
                            <div class="col-4">
                                <h6>Valor total</h6>
                            </div>
                            <div class="col-8 text-right">
                                <h6>{{ currency(installment.vlAcordo) }}</h6>
                            </div>
                        </div>
                        <div class="row pt-0">
                            <div class="col-4">
                                <h6 class="text-dark">Pagamento</h6>
                            </div>
                            <div class="col-8 text-right">
                                <h6 v-if="installment.qtParcela == 1">{{ currency(installment.valor) }} + Resíduo de {{ currency(installment.vlResiduo) }}</h6>
                                <h6 v-else>
                                    {{
                                    installment.vlEntrada !== installment.vlDemais
                                    ? currency(installment.vlEntrada) + ' + ' +  (data.installments-1) + 'x de ' + currency(installment.vlDemais)
                                    : data.installments + ' x de ' + currency(installment.vlDemais)
                                }}</h6>
                            </div>
                        </div>
                    </div>
                </div>

                <h4 class="mt-5 pb-0">Débitos pendentes</h4>
                <ul class="nav nav-tabs text-muted mt-3 mb-4">
                    <li v-for="(contrato, key) in contracts" :key="contrato.contrato" :class="[{'contract-item ': true, 'active': key==0}]">
                        Contrato {{ contrato.contrato }}
                    </li>
                </ul>

                <div class="container" v-if="contract">
                    <div class="row debit-item" v-for="(divida, key) in contract.dividas" :key="key">
                        <div class="col-7">
                            <h5 class="mb-0">
                                <!-- {{ capitalize(new Date(divida.dtVencimento).toLocaleDateString('pt-BR', dateOption)) }} - -->
                                <small><strong>{{ divida.descricao }}</strong></small>
                            </h5>
                            <p class="text-muted mb-0">Vencido em {{ new Date(divida.dtVencimento).toLocaleDateString() }}</p>
                        </div>
                        <div class="col-5">
                            <h6 class="mb-0 text-right">{{ currency(divida.vlAtualizado) }}</h6>
                        </div>
                    </div>
                    <!-- <div class="row my-3">
                         <div class="col-sm-1 col-1 d-flex align-items-center">
                             <font-awesome-icon icon="exclamation-circle" class="icon-exclamation" />
                         </div>
                         <div class="col-sm-6 col-10">
                            <b> <span class="text-blue">Pague à vista ou em 2x</span> e receba até <span class="text-blue">70% de desconto</span> no valor principal </b>
                         </div>
                    </div> -->

                    <!-- <div class="row total">
                        <div class="col-md-12">
                            <h5 class="mb-0 text-right">Total: {{ total }}</h5>
                        </div>
                    </div> -->
                </div>

                <div class="d-flex justify-content-center my-5">
                    <button class="btn btn-md btn-blue m-auto" @click="handleSaveNegotiation">Enviar Proposta</button>
                </div>
            </div>
        </div>
    </div>
</template>

<style lang="scss" scoped>
    .nav-tabs {
        border-bottom: 2px solid #dee2e6;
        margin-right: .8rem;
    }

    .contract-item {
        padding: .7rem .9rem;
        cursor: pointer;
    }

    .contract-item.active {
        color: #34b8dc;
        font-weight: 700;
        border-bottom: 3px solid #34b8dc;
        margin-bottom: -2px;
    }

    .total {
        color:  #34b8dc;
        margin-top: 1.5rem;
    }

    .debit-item {
        display: flex;
        align-items: center;
    }

    .debit-item + .debit-item {
        margin-top: 1rem;
    }

    .green-line {
        height: 3px;
        width: 2.5rem;
        background-color: #34b8dc;
    }

    .date {
        background-color: #f7f7f7;
        padding: .3rem .5rem;
        border-radius: .5rem;
        border: 2px solid #c9cacd;
        font-weight: 500;
        text-align: end;
        float: right;
    }

    .btn-installment {
        background: white;
        color: #34b8dc;
        border: solid .1rem  #34b8dc;
        padding: .1rem .5rem;
        border-radius: .6rem;
        margin: .2rem .4rem
    }

    .btn-installment.active {
        background: #34b8dc;
        color: white;
    }

    .btn-installment:hover {
        background: #34b8dc;
        color: white;
    }

    .icon-exclamation {
        font-size: 2rem;
        color: #34b8dc;
    }

    .form-control-date {
        font-size: .8rem !important;
        display: block;
        width: 100%;
        height: calc(1.5em + .75rem + 2px);
        padding: .375rem .75rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: .25rem;
        transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    }

    @media only screen and (max-width: 600px) {
        h2 {
            font-size: 1.7rem;
        }

        h2, .subtitle {
            text-align: center;
        }

        h4 {
            font-size: 1.2rem;
        }

        h4.mt-5 {
            margin-top: 1.3rem !important;
        }

        h5 {
            font-size: 1rem;
        }

        h6, .text-right strong, b {
            font-size: .8rem !important;
        }
        

        p.text-muted {
            font-size: .8rem !important;
        }

        .form-control-date {
            font-size: .8rem !important;
            display: block;
            width: 100%;
            height: calc(1.5em + .75rem + 2px);
            padding: .375rem .75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: .25rem;
            transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }

        .btn-installment {
            font-size: .7rem;
            padding: 0.1rem 0.3rem;
            border-radius: .4rem;
            margin: 0;
        }

        .btn-installment + .btn-installment {
            margin-left: .8rem;
        }

        .nav-tabs {
            margin-bottom: 1.3rem !important;
        }

        .form-control {
            height: 5rem;
        }

        .icon-exclamation {
            font-size: 1.5rem;
        }

        .p-custom-proposal {
            padding: 0 2rem !important;
            margin-top: -2rem !important;
            border-radius: 1.6rem;
        }
    }
</style>

<script>
import Datepicker from 'vuejs-datepicker';

export default {
    components: {Datepicker},

    data() {
        return {
            contract: '',
            total: '',
            inCash: true,
            installments: false,
            installment: false,
            dueDate: '',
            dateOption: { month: 'short', year: 'numeric' },
            data: {
                installments: 1
            },
            success: false,
            disabledDates: {
                to: '',
                from: '',
                days: [6, 0]
            },
            expirationDate: '',
        }
    },

    props: ['contracts', 'vlTotal'],

    watch: {
        'contracts': function (val) {
            if (Object.keys(val).length > 0) {
                this.contract = val[0];
                this.installment = this.contract.negociacao.aVista;
            }
        },

        'vlTotal': function (val) {
            if (val > 0) {
                this.total = this.currency(val);
            }
        },

        'data.installments': function (val) {
            if (val == 1) {
                this.installment = this.contract.negociacao.aVista;
            }

            if (val > 1) {
                this.installment = this.contract.negociacao.parcelas[val];
            }
        }
    },

    methods: {
        capitalize (s) {
            s = s.replace('. de ', '/');
            if (typeof s !== 'string') return '';
            return s.charAt(0).toUpperCase() + s.slice(1);
        },

        getMaxDate (date) {
            let d = new Date(date);
            d.setDate(d.getDate() + 9);

            return d.toISOString().slice(0,10);
        },

        getNextDate () {

        },

        getRangeDate (date) {
            let d = new Date(date);
            d.setDate(d.getDate() + 9);

            this.disabledDates.to = new Date(date);
            this.disabledDates.from = d;

            return this.disabledDates;
        },

        togglePaymentForm (type) {
            if (type == 1) {
                this.inCash = true;
                this.installments = false;
            } else {
                this.inCash = false;
                this.installments = true;
            }
        },

        getTotalInstallments () {
            let total = "0.00";
            if (this.data.installments !== '') {
                total = this.contract.negociacao.parcelas[this.data.installments].vlAcordo;
            }   

            return this.currency(total);
        },

        updateDate (date) {
            let d = new Date(date.toISOString());

            this.dtVencimento = d.toISOString().slice(0,10);
            d.setDate(d.getDate() - 1);

            this.expirationDate = d.toISOString().slice(0,10);

            // this.contract.negociacao.parcelas[this.data.installments].dtVencimento = d.toISOString().slice(0,10);
            // this.contract.negociacao.aVista.dtVencimento = d.toISOString().slice(0,10);
        },

        currency (val) {
            return this.$parent.currency(val);
        },

        handleSaveNegotiation () {
            let contrato = {
                idServidor: this.contract.idServidor,
                idContrato: this.contract.idContrato,
                dividas: this.contract.dividas,
                dtVencimento: this.dtVencimento ? this.dtVencimento : this.contract.dtVencimento,
                tpNegociacao: this.contract.tpNegociacao,
                empresa: this.$parent.data.empresa
            };

            // let parcela = this.inCash ? this.contract.negociacao.aVista : this.contract.negociacao.parcelas[this.data.installments];

            axios.post('/negociacao',
            {
                contrato,
                acesso: this.$parent.data.acesso,
                parcela: this.installment,
                cliente: this.$parent.data.cliente,
            })
            .then(res => {
                console.log("successs", this.$parent.data, res.data)
                this.success = res.data.status;

                if(this.success){
                    this.$parent.data = res.data;
                }
            })
            .catch(err => {
                console.error("error", this.$parent.data, err);
            })
        }
    },
}
</script>