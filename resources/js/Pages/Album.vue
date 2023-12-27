<template>
  <section>
  <planning :evenements="evenements"></planning>
  <div class="containerGalerie">
      <div class="album" v-for="(image,key) in images" :key="key" @mouseover="isHovered = key" @mouseleave="isHovered = null">
          <img class="imageAlbum" :src="`../${image.url}`">
          <Transition name="fade">
          <p v-if="isHovered===key" class="albumtext" @click="openModal"><b>{{ image.description }}</b></p>
          </Transition>
    </div>
  </div>
</section>

<!-- MODAL -->
  <teleport to="section">>
          <img class="imageModal" v-if="modal" @click="openModal" :src="`../${images[selectedImage].url}`">
  </teleport>
</template>

<script>
import MonkeyLayout from '../Layouts/MonkeyLayout.vue';
import  planning  from "./Planning.vue";
export default{
layout: MonkeyLayout,
components:{
  planning,
},
props:{
images:{
  type:Array,
  default:()=>[],
},
album:{
  type:Object,
},
evenements:{
  type:Array,
  default:()=>[],
}
},
data(){
return{
  isHovered:null,
  modal:false,
  selectedImage:null,
}
},
methods:{
openModal(){
  this.modal = !this.modal;
  this.selectedImage = this.isHovered;
  console.log(key);
  console.log(this.selectedImage);
}
}
}
</script>

<style scoped>
section{
  display: flex;
  flex-direction: column-reverse;
  align-items: flex-start;
  position: relative;
}
.album{
  border: 2px solid black;
  position: relative;
  margin-top: 5%;
  margin-bottom: 5%;
  margin-left: 2%;
  box-shadow: 0.5rem 0.313rem 0.25rem 0.063rem rgba(0,0,0,0.43);
  overflow: hidden;
}
.imageAlbum{
  height: 7rem;
  width: 7rem;
}
.planning{
display: flex;
width: 100%;
overflow-x: scroll;
}
.containerGalerie{
  display:flex;
  flex-wrap: wrap;
  margin-left: 0%;
  width: 90%;
  margin-bottom: 8%;
  justify-content: center;
}
.albumtext{
display: flex;
position: absolute;    
top: 0;
bottom: 0;
background-color: rgba(0,0,0,0.6);
width: 100%;
height: 100%;
display: flex;
justify-content: center;
align-items: center;
color: aliceblue;
font-size: 1.3rem;
}
.imageModal{
position: absolute;
height: 25rem;
width: 25rem;
top:40%;
left: 50%;
transform: translate(-50%, -50%);
background-color: white;
padding: 20px;
border-radius: 5px;
z-index: 2;
border: 0.3rem solid black;
}
.textModal{
border: 0.3rem solid black;
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
.planningText{
display: flex;
margin:0 5%;
width:auto;
white-space: nowrap;
}
.mainAlbum {
  width: 60%;
  margin: auto;
  margin-top: 12%;
}
.imageAlbum{
  height: 15em;
  width: 15em;
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