<template>
    <div class="card bg-success" >
        <div class="card-body">
            <div class="header-report row">
                <img src="https://media-exp1.licdn.com/dms/image/C4D03AQFa1zjp_QU7Zw/profile-displayphoto-shrink_100_100/0/1590779437004?e=1613606400&v=beta&t=kg3Xljr2E8k5sqP9kaQQWuYEZ8PZhuvQZuKR0P-Q5Mk" alt="" class="header-avatar">
                <h6>
                    Nome Sobrenome  <br>
                    <div class="stars">
                        <font-awesome-icon icon="star" />
                        <font-awesome-icon icon="star" />
                        <font-awesome-icon icon="star" />
                    </div>
                </h6>
                
            </div>
            
            <p class="card-text">
                <slot></slot>
            </p>
        </div>
    </div>
</template>

<style lang="scss" scoped>
    .card {
        border: 0;
        border-radius: 3rem;
        height: 100%;
        padding: 0rem 1rem;
        color: white;
        text-align: center;
    }

    .card p {
        font-size: 1rem;
        font-weight: 100;
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    }

    .header-report {
        margin-bottom: 1rem;
        justify-content: center;
    }

    .header-report h6 {
        margin-top:.4rem
    }

    .header-report .stars {
        text-align: start;
        font-size: .8rem;
        margin-top: .4rem;
    }

    .header-avatar {
        max-height: 3.5rem;
        border-radius: 50%;
        margin-right: 1.2rem;
    }

</style>

<script>

export default {
    props: ['icon'],
}
</script>