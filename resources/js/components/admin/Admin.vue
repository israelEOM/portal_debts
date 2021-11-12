<template>
   <div class="wrapper">
        <loading :active.sync="isLoading"
            :can-cancel="true" 
            :on-cancel="onCancel"
            :is-full-page="fullPage">
        </loading>

        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <img :src="logo" alt="">
            </div>

            <ul class="list-unstyled components">
                <li :class="['nav-item p-2 ', { 'active' : menu[0]}]" @click="setActiveMenu(1)">
                    <a class="nav-link active" href="#">
                        <div class="row">
                            <div class="col-4">
                                <img :src="menu1" alt="" srcset="" class="menu-icon">
                            </div>
                            <div class="col-8 pl-0 d-flex align-items-center">
                                <p class="m-0">Enviar Proposta </p>
                            </div>
                        </div>
                    </a>
                </li>
                <li :class="['nav-item p-2 ', { 'active' : menu[1]}]" @click="setActiveMenu(2)">
                    <a class="nav-link" href="#">
                        <div class="row">
                            <div class="col-4">
                                <img :src="menu2" alt="" srcset="" class="menu-icon">
                            </div>
                            <div class="col-8 pl-0 d-flex align-items-center">
                                <p class="m-0">Meus Acordos</p>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="nav-item p-2">
                    <a class="nav-link" href="https://api.whatsapp.com/send?phone=5511987560198&text=Olá,%20Gostaria%20de%20iniciar%20um%20contato!">
                        <div class="row">
                            <div class="col-4">
                                <img :src="menu3" alt="" srcset="" class="menu-icon">
                            </div>
                            <div class="col-8 pl-0 d-flex align-items-center">
                                <p class="m-0">Atendimento WhatsApp </p>
                            </div>
                        </div>
                    </a>
                </li>
                <li :class="['nav-item p-2 ', { 'active' : menu[3]}]" @click="setActiveMenu(4)">
                    <a class="nav-link" href="#">
                        <div class="row">
                            <div class="col-4">
                                <img :src="menu4" alt="" srcset="" class="menu-icon">
                            </div>
                            <div class="col-8 pl-0 d-flex align-items-center">
                                <p class="m-0">Informativo</p>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="nav-item p-2" @click="handleLogout">
                    <a class="nav-link" href="#">
                        <div class="row">
                            <div class="col-4">
                                <img :src="menu5" alt="" srcset="" class="menu-icon">
                            </div>
                            <div class="col-8 pl-0 d-flex align-items-center">
                                <p class="m-0">Sair</p>
                            </div>
                        </div>
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Mobile Navbar -->
        <nav id="mobile-nav">
            <div class="header-icon row mx-0">
                <img :src="logoWhite" alt="">
            </div>

            <ul class="mobile-links">
                <li :class="['nav-item ', { 'active' : menu[0]}]">
                    <a class="nav-link active" @click="setActiveMenu(1)">
                        <img :src="menuIcon1" class="menu-card-icon">
                        <p class="m-0">Enviar Proposta </p>
                    </a>
                </li>
                <li :class="['nav-item ', { 'active' : menu[1]}]">
                    <a class="nav-link" @click="setActiveMenu(2)">
                        <img :src="menuIcon2" class="menu-card-icon">
                        <p class="m-0">Meus Acordos</p>
                    </a>
                </li>
                <li :class="['nav-item ', { 'active' : menu[2]}]">
                    <a class="nav-link" href="https://api.whatsapp.com/send?phone=5511987560198&text=Olá,%20Gostaria%20de%20iniciar%20um%20contato!" @click="setActiveMenu(3)">
                        <img :src="menuIcon3" class="menu-card-icon">
                        <p class="m-0">Atendimento WhatsApp </p>
                    </a>
                </li>
                <li :class="['nav-item ', { 'active' : menu[3]}]">
                    <a class="nav-link" href="#" @click="setActiveMenu(4)">
                        <img :src="menuIcon4" class="menu-card-icon">
                        <p class="m-0">Meus dados</p>
                    </a>
                </li>
                <li :class="['nav-item ', { 'active' : menu[4]}]" @click="handleLogout">
                    <a class="nav-link" href="#">
                        <img :src="menuIcon5" class="menu-card-icon">
                        <p class="m-0">Sair</p>
                    </a>
                </li>
            </ul>
            <!-- <div class="mobile-bottom"></div> -->
        </nav>

        <!-- Page Content  -->
        <div id="content">

            <!-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-success">
                        <i class="fas fa-align-left"></i>
                    </button>
                    <small class="text-muted" v-if="data.cliente">{{ data.cliente.nome }}</small>
                </div>
            </nav> -->

            <div class="row h-100 w-100 m-0">
                <SendProposal
                    :class="['bg-white custom-radius ']"
                    v-show="menu[0]"
                    :contracts="data.pendentes"
                    :vlTotal="data.vlTotal"
                />

                <MyDeals
                    :class="['bg-white custom-radius ']"
                    v-show="menu[1]"
                    :deals="data.negociados"
                />

                <Informative
                    v-show="menu[3]"
                />

                <Profile
                    :class="['custom-radius ', 'profile ', { 'm-active' : menu[3]}]"
                    :email="data.email"
                    :client="data.cliente"
                    :phone="data.telefone"
                />
            </div>
            
        </div>

    </div>
</template>

<style lang="scss">
    p {
        font-weight: 400;
        font-size: .9rem;
    }

    h3 {
        font-weight: 100;
    }

    .text-muted {
        color: #c9cacd !important;
    }

    .text-orange {
        color: #f66a28;
    }

    .text-thin {
        font-weight: 300;
    }

    .btn-blue {
        background: #34b8dc;
        color: white;
    }

    .btn-blue:hover {
        background: #2a93b1;
        color: white;
    }

    .sidebar {
        height: inherit;
        min-height: 100%;
        position: absolute;
        top: 0;
    }

    .menu-icon {
        height: 1.8rem !important;
    }

    .nav-item {
        transition: background-color 0.5s ease;
        border-radius: .6rem;
    }

    .nav-item:hover {
        background-color: rgba($color:#34b8dc , $alpha: 0.2);
    }

    .nav-item + .nav-item {
        margin-top: .4rem;
    }

    .nav-link  {
        color: #444 !important;
        padding: .5rem !important;
    }

    .nav-link > .row > * {
        display: flex;
        align-items: center;
    }

    .nav-link:hover  {
        text-decoration: none !important;
    }

    .nav-item.active {
        background-color: #34b8dc;
    }

    .nav-item.active .nav-link {
        color:white !important;
    }

    .navbar {
        padding: 15px 10px;
        background: #fff;
        border: none;
        border-radius: 0;
        box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
    }

    .navbar-btn {
        box-shadow: none;
        outline: none !important;
        border: none;
    }

    .line {
        width: 100%;
        height: 1px;
        border-bottom: 1px dashed #ddd;
        margin: 40px 0;
    }

    /* ---------------------------------------------------
        SIDEBAR STYLE
    ----------------------------------------------------- */

    .wrapper {
        display: flex;
        width: 100%;
    }

    #sidebar {
        width: 250px;
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        z-index: 999;
        background: #f8f9fa!important;
        color: #000 !important;
        transition: all 0.3s;
    }

    #sidebar.active {
        margin-left: -250px;
    }

    #sidebar .sidebar-header {
        padding: 2.5rem;
        background: #f8f9faf1;
    }

    #sidebar ul.components {
        padding: 0 1rem;
    }

    a[data-toggle="collapse"] {
        position: relative;
    }

    .dropdown-toggle::after {
        display: block;
        position: absolute;
        top: 50%;
        right: 20px;
        transform: translateY(-50%);
    }

    ul ul a {
        font-size: 0.9em !important;
        padding-left: 30px !important;
        background: #6d7fcc;
    }

    ul.CTAs {
        padding: 20px;
    }

    ul.CTAs a {
        text-align: center;
        font-size: 0.9em !important;
        display: block;
        border-radius: 5px;
        margin-bottom: 5px;
    }

    a.download {
        background: #fff;
        color: #7386D5;
    }

    a.article,
    a.article:hover {
        background: #6d7fcc !important;
        color: #fff !important;
    }

    /* ---------------------------------------------------
        CONTENT STYLE
    ----------------------------------------------------- */

    #content {
        width: calc(100% - 250px);
        padding: 0;
        min-height: 100vh;
        transition: all 0.3s;
        position: absolute;
        top: 0;
        right: 0;
    }

    #content.active {
        width: 100%;
    }

    #mobile-nav {
        display: none;
    }

    /* ---------------------------------------------------
        MEDIAQUERIES
    ----------------------------------------------------- */

    @media (max-width: 768px) {
        #sidebar {
            margin-left: -250px;
        }
        #sidebar.active {
            margin-left: 0;
        }
        #content {
            width: 100%;
        }
        #content.active {
            width: calc(100% - 250px);
        }
        #sidebarCollapse span {
            display: none;
        }
    }

    @media only screen and (max-width: 600px) {
        .wrapper {
            display: grid;
        }

        .navbar {
            display: none;
        }

        #sidebar {
            display: none;
        }

        #content {
            // padding-top: 7rem;
            position: relative;
        }

        .custom-radius {
            margin-top: -2rem !important;
            border-radius: 1.6rem;
            // display: block;
        }

        #mobile-nav {
            height: 11rem;
            padding: 0;
            background-color: #03aa52;
            width: 100%;
            position: relative;
            // top: 0;
            display: block;
            // display: flex;
            // justify-content: center;
        }

        #mobile-nav .header-icon {
            display: flex;
            justify-content: center;
            margin-top: .5rem;
        }

        #mobile-nav .header-icon img {
            height: 1.7rem;
        }

        #mobile-nav .mobile-links {
            display: table;
            padding: 0;
            text-align:center;
            align-items: center;
            margin-top: 1rem;
            margin-bottom: 1rem;
        }

        #mobile-nav .mobile-links .nav-item {
            width: 18% !important;
            display: inline-block;
            vertical-align: top;
            list-style: none !important;
            padding: 0 !important;
        }

        #mobile-nav .mobile-links .nav-item .nav-link p {
            font-size: .55rem !important;
            text-align: center;
            line-height: .8rem;
            color: white;
        }

        .nav-item + .nav-item {
            margin-top: 0;
        }

        .menu-card-icon {
            width: 2.5rem;
            margin-bottom: .3rem;
        }

        .menu-card-icon:hover {
            // box-shadow: .1rem .1rem .5rem #000;
            filter: drop-shadow(.1rem .1rem .2rem rgba(0,0,0,0.5));
        }

        .mobile-bottom {
            width: 100%;
            height: 3rem;
            border-radius: 3rem;
            background-color: white;
        }

        .f-sm {
            font-size: .8rem !important;
            padding: .2rem .4rem;
            height: 1.5rem;
        }

        .profile {
            display: none;
        }

        .profile.m-active {
            display: block;
        }
    }
</style>

<!-- jQuery Custom Scroller CDN -->



<script>
import logo from '../../assets/images/carrefour.png';
import logoWhite from '../../assets/images/banco-original-logo-white.png';
import menu1 from '../../assets/images/menu1.png';
import menu2 from '../../assets/images/menu2.png';
import menu3 from '../../assets/images/menu3.png';
import menu4 from '../../assets/images/menu4.png';
import menu5 from '../../assets/images/menu5.png';
import menuIcon1 from '../../assets/images/menu-icon-1.png';
import menuIcon2 from '../../assets/images/menu-icon-2.png';
import menuIcon3 from '../../assets/images/menu-icon-3.png';
import menuIcon4 from '../../assets/images/menu-icon-4.png';
import menuIcon5 from '../../assets/images/menu-icon-5.png';
import menuWhite1 from '../../assets/images/menu-white1.png';
import menuWhite2 from '../../assets/images/menu-white2.png';
import menuWhite4 from '../../assets/images/menu-white4.png';
import Loading from 'vue-loading-overlay';
import Profile from './Profile.vue';
import SendProposal from './SendProposal.vue';
import MyDeals from './MyDeals.vue';
import Informative from './Informative.vue';
// import Bus from '../../bus';

export default {
    components: { Profile, SendProposal, Loading, MyDeals, Informative },
    data() {
        return {
            logo: logo,
            menu1: menuWhite1, 
            menu2: menu2, 
            menu3: menu3, 
            menu4: menu4,
            menu5: menu5,
            menuIcon1, menuIcon2, menuIcon3, menuIcon4, menuIcon5,
            logoWhite,
            menu: [true, false, false, false, false],
            menuProposal: true,
            menuAgreement: false,
            menuInformative: false,
            profile: false,
            cpf: '',
            data: '',
            isLoading: false,
            fullPage: true,
            teste: false
        }
    },

    updated(){
        // $("#sidebar").mCustomScrollbar({
        //     theme: "minimal"
        // });

        // $('#sidebarCollapse').on('click', function () {
        //     $('#sidebar, #content').toggleClass('active');
        //     $('.collapse.in').toggleClass('in');
        //     $('a[aria-expanded=true]').attr('aria-expanded', 'false');
        // });
    },

    mounted() {
        this.cpf = this.$cookies.get('cpf');
        this.handleGetData();

        
    },

    methods: {
        setActiveMenu (menu) {
            this.menu.fill(false);

            console.log(this.menu)

            if (menu == 1) {
                this.menu[0] = true;
                this.menu1 = menuWhite1;
                this.menu2 = menu2;
                this.menu4 = menu4;
            }
            if (menu == 2) {
                this.menu[1] = true;
                this.menu2 = menuWhite2;
                this.menu1 = menu1;
                this.menu4 = menu4;
            }
            if (menu == 3) {
                this.menu[2] = true;
                this.teste = !this.teste;
            }
            if (menu == 4) {
                this.menu[3] = true;
                this.menu4 = menuWhite4;
                this.menu1 = menu1;
                this.menu2 = menu2;
            }
        },

        onCancel() {
            console.log('User cancelled the loader.')
        },

        currency (val) {
            if (val == undefined)
                return;

            if (typeof val == 'string')
                val = parseFloat(val)

            let formato = { minimumFractionDigits: 2 , style: 'currency', currency: 'BRL' };
            return val.toLocaleString('pt-BR', formato);
        },

        handleLogout () {
            this.$router.push({name: 'Home'});
        },

        async handleGetData () {
            this.isLoading = true;

            if(!this.cpf)
                this.$router.push({name: 'Home'});

            await axios.post('/divida', { cpf: this.cpf })
            .then(res => {
                console.log('admin', res.data);
                this.data = res.data;
                this.isLoading = false;
            })
            .catch(err => {

            });

            if (Object.keys(this.data.negociados).length > 0) {
                this.setActiveMenu(0);
            }
        }
    }
}
</script>