<script>
import MonkeyLayout from '../Layouts/MonkeyLayout.vue';
import  {Link}  from "@inertiajs/inertia-vue3";
import  planning  from "./Planning.vue";
export default{
layout:MonkeyLayout,
components: {
    Link,
    planning
  },
props:{
  evenements:{
    type:Array,
    default:()=>[],
  },
  images:{
    type:Array,
    default:()=>[],
  },
  albums:{
    type:Array,
    default:()=>[],
  }
},
data(){
  return{
    isHovered:null,
  }
}
}
</script>

<template>
<section> 
  <planning :evenements="evenements"></planning>
  <div class="containerGalerie">
    <div class="album" v-for="album in albums" :key="album.id" @mouseover="isHovered = album.id" @mouseleave="isHovered = null">
    <Link :href="`/galerie/${album.id}`">
    <img class="imageAlbum" :src="`../${album.images[0].url}`">
    <hr>
    <p class="albumtext"><b>{{ album.titre }}</b></p>
    </Link>
    </div>
  </div>
</section>
</template>

<!-- <template>
  <section> 
    <planning :evenements="evenements"></planning>
    <div class="containerGalerie">
      <div class="album" v-for="album in albums" :key="album.id" @mouseover="isHovered = album.id" @mouseleave="isHovered = null">
      <Link :href="`/galerie/${album.id}`">
      <img class="imageAlbum" :src="`../${album.images[0].url}`">
      <Transition name="fade">
      <p v-if="isHovered===album.id" class="albumtext"><b>{{ album.titre }}</b></p>
      </Transition>
      </Link>
      </div>
    </div>
  </section>
  </template> -->


<style scoped>
section{
    display: flex;
    flex-direction: column-reverse;
    align-items: flex-start;
    position: relative;
  }
.mainGalerie{
    width:90%;
    text-align: start;
    margin-left: auto;
    margin-right: auto;
}
.planning{
  display: flex;
  width: 100%;
  overflow-x: scroll;
}
.imageAlbum{
    height: 15em;
    width: 18em;
}
.containerGalerie{
    display:flex;
    flex-wrap: wrap;
    margin-left: 0%;
    width: 90%;
    justify-content: center;
}
.album{
  border: 2px solid black;
  padding: 1%;
  margin: 5% 10%;
  box-shadow: 8px 5px 4px 1px rgba(0,0,0,0.43);
}
hr{
  color: black;
}
.albumtext{
  text-align: center;
  margin: 0%;
  color: black;
}
@media screen and (min-width: 768px){

.planning::-webkit-scrollbar {
  width: 0.5em; /* Largeur de la barre de défilement */
}

.planning::-webkit-scrollbar-thumb {
  background-color: transparent; /* Couleur de la barre de défilement */
}
.containerGalerie{
    display:flex;
    flex-wrap: wrap;
    width: 90%;
}
section{
    display: flex;
    position: relative;
    flex-direction: row;
}
.planning{
  display: block;
  width: auto;
  height: 65vh;
  overflow-y: scroll;
  overflow-x: hidden;
}
.mainGalerie {
    width: 60%;
    margin: auto;
}
.fade-enter-active,
.fade-leave-active {
  transition: opacity 1s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
}
</style>