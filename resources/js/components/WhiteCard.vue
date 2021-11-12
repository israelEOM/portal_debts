<template>
    <div class="card" >
        <div class="card-body">
            <img :src="icon" alt="" class="header-icon">
            <!-- <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6> -->
            <p class="card-text">
                <slot></slot>
            </p>
        </div>
    </div>
</template>

<style lang="scss" scoped>
    .card {
        border: 0;
        border-radius: .1rem;
        height: 100%;
    }

    .header-icon {
        max-height: 3rem;
        margin-bottom: 3rem;
    }

    @media only screen and (max-width: 600px) {
        .card-body {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 2rem 3rem;
        }

        .card-text {
            text-align: center;
        }

        .header-icon {
            width: 2.3rem;
            margin-bottom: 2rem;
        }
    }
</style>

<script>

export default {
    props: ['icon'],
}
</script>