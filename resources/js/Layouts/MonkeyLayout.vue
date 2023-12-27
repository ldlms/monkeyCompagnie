<script setup>
import HeadLink from '@/Components/HeadLinks.vue'
import FooterMonkey from '@/Components/FooterMonkey.vue'
import {Head} from '@inertiajs/vue3';
</script>

<template>
<Head>
    <title>Monkey Compagnie</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Language" content="fr">
    <meta name="description" content="Site de la monkey Compagnie, animation et fêtes en bar">
    <meta name="author" content="Leo Delmas, Kelly Garcia">
    <meta property="og:title" content="La monkey compagnie">
    <meta property="og:description" content="Site de la monkey Compagnie, animation et fêtes en bar">
    <meta property="og:image" content="/assets/images/logochelou.png">
    <meta name="twitter:card" content="/assets/images/logochelou.png">
    <meta name="twitter:site" content="@nom_du_site">
    <meta name="twitter:title" content="La monkey compagnie">
    <meta name="twitter:description" content="Site de la monkey Compagnie, animation et fêtes en bar">
    <meta name="twitter:image" content="/assets/images/logochelou.png">
    <link rel="icon" href="/assets/images/logochelou.png" type="image/png">
</head>
<HeadLink></HeadLink>
<slot/>
<FooterMonkey></FooterMonkey>
</template>

<style scoped>
</style>