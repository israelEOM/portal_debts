<template>
    <footer class="text-white bg-dark pt-5 pb-3">
        <div class="container">
            <div class="row">
                <!-- <div class="col-md-4 align-self-center">
                    <p>Acompanhe nossas redes:</p>
                </div> -->
                <div class="col-md-8">
                    <div class="icons">
                        <a href="https://www.facebook.com/creditcashcomunicacao/" target="_blank">
                            <img class="ml-2" :src="facebookIcon" height="40" width="40">
                        </a>
                        <a href="https://www.instagram.com/creditcashcomunicacao/" target="_blank">
                            <img class="ml-2" :src="instagramIcon" height="40" width="40">
                        </a>
                        <a href="https://pt.linkedin.com/company/credit-cash-assessoria-financeira-ltda" target="_blank">
                            <img class="ml-2" :src="linkedinIcon" height="40" width="40">
                        </a>
                        <a href="https://twitter.com/CCashComunica?s=09" target="_blank">
                            <img class="ml-2" :src="twitterIcon" height="40" width="40">
                        </a>
                        <a href="https://www.youtube.com/channel/UCx8VpQv8eCqAaPFolbLtxgw" target="_blank">
                            <img class="ml-2" :src="youtubeIcon" height="40" width="40">
                        </a>
                    </div>
                    
                </div>

                <div class="col-md-12 mt-5">
                    <p>&copy; Copyright 2020 Credit Cash, todos os direitos reservados.</p>
                </div>
            </div>
        </div>
    </footer> 
</template>

<style lang="scss" scoped>
    @media only screen and (max-width: 600px) {
        .bg-dark {
            padding: 2rem !important;
        }

        p {
            text-align: center;
            font-size: .7rem;
            letter-spacing: -0.03rem
        }

        .icons {
            display: flex;
            justify-content: center;
        }

        .icons img {
            height: 2rem;
            width: 2rem;
        }

        .col-md-12.mt-5 {
            margin-top: 1rem !important;
        }
    }
</style>

<script>
import facebookIcon from '../assets/images/icon_facebook.png';
import instagramIcon from '../assets/images/icon_instagram.png';
import linkedinIcon from '../assets/images/icon_linkedin.png';
import twitterIcon from '../assets/images/icon_twitter.png';
import youtubeIcon from '../assets/images/icon_youtube.png';

export default {
    data() {
        return {
            facebookIcon: facebookIcon,
            instagramIcon: instagramIcon,
            linkedinIcon: linkedinIcon,
            twitterIcon: twitterIcon,
            youtubeIcon: youtubeIcon,
        }
    },
}
</script>