<template>
    <div>
        <nav class="navbar navbar-dark bg-white">
            <a class="navbar-brand" href="#">
                <img src="../assets/images/carrefour.png" class="original-logo" loading="lazy">
            </a>
            <div>
                <img class="credit-logo">
            </div>
        </nav>
     </div>
</template>

<style lang="scss" scoped>
    .credit-logo {
        content: url(../assets/images/credit.png);
        height: 3rem;
    }

    .original-logo {
        height: 5rem;
    }

    .navbar {
        padding: .5rem 2.5rem;
    }

    @media only screen and (max-width: 600px) {
        .navbar {
            padding: .5rem 1.5rem;
        }

        .credit-logo {
            content: url(../assets/images/credit-icon.png);
            height: 2rem;
        }

        .original-logo {
            height: 2rem;
        }
    }
</style>

<script>
export default {
    
}
</script>