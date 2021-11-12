<template>
    <div class="col-md-7 mt-3 pr-5 pl-4 p-custom">

        <h4 class="mt-5 pb-0">Meus Acordos</h4>
        <ul class="nav nav-tabs text-muted mt-3 mb-4 mr-0">
            <li v-for="(acordo, key) in deals" :key="key" :class="[{'contract-item ': true, 'active': key==0}]">
                Acordo - {{ acordo.contrato }}
            </li>
        </ul>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h5 v-if="deal"><b class="text-blue"></b> {{ deal.NomeFantasia + ' - ' + deal.contrato }}</h5>
                    <h5 v-else><b class="text-blue">Não há acordos registrados!</b></h5>
                </div>
            </div>

            <div v-if="deal">
                <div class="row debit-item mb-3">
                    <div class="col-6">
                        <p class="text-muted mb-0">Valor Original</p>
                    </div>
                    <div class="col-6 text-right">
                        <strong> {{ currency(deal.vlOriginal) }}</strong>
                    </div>
                </div>


                <div class="row debit-item mb-3">
                    <div class="col-6">
                        <p class="text-muted mb-0">Valor Atualizado</p>
                    </div>
                    <div class="col-6 text-right">
                        <strong> {{ currency(deal.vlCorrigido) }}</strong>
                    </div>
                </div>

                <div class="row debit-item mb-3">
                    <div class="col-6">
                        <p class="text-blue mb-0">Valor Desconto</p>
                    </div>
                    <div class="col-6 text-right">
                        <strong> - {{ currency(deal.vlDesconto) }}</strong>
                    </div>
                </div>

                <div class="row debit-item mb-3">
                    <div class="col-6">
                        <p class="text-blue mb-0">Valor Acordo</p>
                    </div>
                    <div class="col-6 text-right">
                        <strong> {{ currency(deal.vlAcordo) }}</strong>
                    </div>
                </div>

                <h5 class="mt-5 pb-0">Débitos negociados</h5>
                <div class="row debit-item" v-for="(divida, key) in deal.dividas" :key="key">
                    <div class="col-8">
                        <p>
                            <b class="text-blue">Produto:</b> {{ divida.descricao }} <br>
                            <!-- <b class="text-blue">Vencimento:</b> {{ new Date(divida.dtVencimento).toLocaleDateString() }} <br> -->
                            <b class="text-blue">Valor:</b> {{ currency(divida.vlCorrigido) }} <br>
                        </p>
                    </div>
                    <div class="col-4">
                        <button class="btn download-button" v-if="divida.stDownload" @click="handleDownload(divida)">
                            Baixar Boleto
                            <font-awesome-icon icon="download" class="icon" />
                        </button>
                        <h5 class="text-blue" v-else>Em análise</h5>
                    </div>
                </div>
            </div>

        </div>

    </div>
</template>

<style lang="scss" scoped>
    .download-button {
        background-color: #34b8dc;
        border-radius: 0 !important;
        font-size: .8rem;
        color: white;
        line-height: 2rem;
        padding: .3rem .6rem .8rem .6rem;
        width: 6.5rem;
        float: right;
    }

    .download-button .icon {
        font-size: 1.2rem;
    }

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

    .blue-line {
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

    @media only screen and (max-width: 600px) {
        .p-custom {
            padding: 0 2rem !important;
        }

        h2 {
            font-size: 1.7rem;
        }

        h2, .subtitle {
            text-align: center;
        }

        h4 {
            font-size: 1.2rem;
        }

        h5 {
            font-size: 1rem;
        }

        h6, .text-right strong, b {
            font-size: .8rem !important;
        }
        

        p.text-muted, p.text-blue, p {
            font-size: .8rem !important;
        }
    }
</style>

<script>
export default {
    data() {
        return {
            deal: '',
        }
    },

    props: ['deals'],

    watch: {
        'deals': function (val) {
            if (Object.keys(val).length > 0) {
                this.deal = val[0];
            }
        },
    },

    methods: {
        currency (val) {
            return this.$parent.currency(val);
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

        handleDownload (boleto) {
            let data = {
                idAcesso: this.$parent.data.acesso.id,
                idContrato: this.deal.idContrato,
                idServidor: this.deal.idServidor,
                idEmpresa: this.$parent.data.empresa.id,
                idCliente: this.$parent.data.cliente.id,
                tpNegociacao: 2,
                boleto: boleto
            }

            axios.post('/boleto', data)
            .then(res => {
                console.log(res.data);

                const linkSource = `data:application/pdf;base64,${res.data.boleto.pdf}`;
                const downloadLink = document.createElement("a");
                const fileName = "abc.pdf";
                downloadLink.href = linkSource;
                downloadLink.download = fileName;
                downloadLink.click();
                // window.open("data:application/pdf;base64," + res.data.boleto.pdf);
            })
            .catch(err => {
                console.error(err); 
            })
            
        }
    },
}
</script>