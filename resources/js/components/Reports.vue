<template>
    <div>
        <div class="container py-5">
            <h1 class="text-center text-success mb-5">Quem negociou indica</h1>

            <div class="row mb-3">
                <div class="col-md-4">
                    <GreenCard :icon="icon1">
                        "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. <br><br>
                        Ut enum ad minum veniam, quis nostrud execitation ullamco laboris nisi ut aliquip ex ea commodo consequat."
                    </GreenCard>
                </div>
                <div class="col-md-4">
                    <GreenCard :icon="icon2">
                        "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. <br><br>
                        Ut enum ad minum veniam, quis nostrud execitation ullamco laboris nisi ut aliquip ex ea commodo consequat."
                    </GreenCard>
                </div>
                <div class="col-md-4">
                    <GreenCard :icon="icon3">
                        "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. <br><br>
                        Ut enum ad minum veniam, quis nostrud execitation ullamco laboris nisi ut aliquip ex ea commodo consequat."
                    </GreenCard>
                </div>
            </div>
            
        </div>
        
    </div>
</template>

<script>
import icon1 from '../assets/images/icon1.png';
import icon2 from '../assets/images/icon2.png';
import icon3 from '../assets/images/icon3.png';
import GreenCard from './GreenCard.vue';

export default {
    components: { GreenCard },

    data() {
        return {
            icon1: icon1,
            icon2: icon2,
            icon3: icon3,
        }
    },
}
</script>