<script>
import MonkeyLayout from "@/Layouts/MonkeyLayout.vue";
export default{
    layout:MonkeyLayout,
}
</script>

<template>
    <section>
        <div class="mainText">
            <div class="katcent">404</div>
            <div class="text">Ce n'est pas la page que vous cherchez !</div>
        </div>
    </section>
</template>

<style scoped>
section{
    display: flex;
    flex-direction: column-reverse;
    align-items: flex-start;
    position: relative;
    height: 100vh;
}
.mainText:before{
    background-image: url("../../../storage/app/public/images/jungle.jpg");
    content: ' ';
    display: block;
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    z-index: -1;
    opacity: 0.4;
    background-repeat: no-repeat;
    background-position: 50% 0;
    background-size: cover;
    pointer-events: none;
}
.mainText{
    width: 60%;
    margin: auto;
    margin-top: calc(var(--height-header) + 17rem);
    display: flex;
    flex-direction: column;
    align-items: center;
}
.katcent{
    font-size:20rem;
    color:#8b6b58;
}
.text{
    font-size: 2rem;
    color:#582d15;
    margin-bottom: 2rem;
}
</style>