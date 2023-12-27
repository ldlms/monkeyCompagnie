<template>
    <section>
      <div class="mainProgramme">
    <div class="containerProgramme"> 
      <div v-for="evenement in evenements">
      <div class="programme">
      <div class="dateProgramme">
        <h1 class="jour"><span class="badge">{{ evenement.jour }}</span></h1>
          <h2 class="mois">{{ evenement.mois }}</h2>
      </div>
          <h3 class="event">{{ evenement.nom }}</h3>
          <h3 class="loc">{{evenement.heure}}H au {{ evenement.lieu }}</h3>
          <h3 id="metro">{{ evenement.metro }}</h3>
        <div class="imageProgramme">
          <img class="affichePlanning" :src="`../${evenement.image}`"  alt="affiche">
        </div>
      </div>
      <hr>
    </div>
    </div>
  </div>
    </section>
</template>

<script>
import MonkeyLayout from '../Layouts/MonkeyLayout.vue';
export default{
layout: MonkeyLayout,
props:{
  evenements:{
    type:Array,
    default:()=>[],
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
.mainProgramme{
  display: flex;
  height: 80vh;
  margin: auto;
  text-align: start;
  overflow-y: scroll;
  margin-top: -10%;
}
.mainProgramme::-webkit-scrollbar {
  width: 0.5em; 
}

.mainProgramme::-webkit-scrollbar-thumb {
  background-color: transparent; 
}
.programme {
    display: grid;
    grid-template-columns: 1fr;
    grid-template-rows: auto auto auto auto auto auto;
    grid-column-gap: 0px;
    grid-row-gap: 0px;
    justify-items: center;
    align-items: center;
}
  .badge {
    color: #000;
    background-color: #FFDFC2;
    display: inline-block;
    padding: 0.35rem 0.65rem;
    font-size: 2.5rem;
    font-weight: 700;
    line-height: 1;
    color: #fff;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: 0.375rem;
}
.mois{
  font-size: 2rem;
}
.dateProgramme{ 
    display: flex;
    flex-direction: column;
    align-items: center;
    grid-area: auto; 
}
.event { 
  grid-area: auto; 
  font-size: 1.5rem;
}
.loc { 
  grid-area: auto; 
  font-size: 1.5rem;
}

#metro { 
  grid-area: auto; 
  font-size: 1.5rem;
}
.imageProgramme { 
    grid-area: auto; 
}
.metro {
    list-style-image: url("../../../storage/app/public/images/metro.png");
    font-family: 'Nunito';
  }
.affichePlanning{
    width: 10em;
    height: 12em;
}
.jour{
  font-size: 2.5rem;
}
.contentProgramme{
  display: grid;
}
@media screen and (min-width: 768px){
.containerProgramme{
  margin-top: 0;
}
/* penser a bidouiller ces deux classes ci-dessous pour faire un truc bien */
section{
  display: flex;
  position: relative;
  flex-direction: row;
  justify-content: center;
}
.mainProgramme {
  display: flex;
  width: 60%;
  min-width: 768px;
  justify-content: center;
  margin-top: -2.5%;
}
.badge {
    color: #000;
    background-color: #FFDFC2;
    display: inline-block;
    padding: 0.35rem 0.65rem;
    font-size: 2.5rem;
    font-weight: 700;
    line-height: 1;
    color: #fff;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: 0.375rem;
}
.mois{
  font-size: 2.5rem;
}
.dateProgramme{ 
    grid-area: 2 / 1 / 3 / 2; 
}
.event { 
  grid-area: 1 / 2 / 2 / 6; 
  font-size: 2rem;
  text-decoration: underline;
}
.loc { 
  grid-area: 2 / 2 / 3 / 6; 
  font-size: 1.5rem;
  margin: 0 2rem;
}

#metro { 
  grid-area: 3 / 2 / 4 / 6; 
  font-size: 1.5rem;
}
.imageProgramme { 
    grid-area: 1 / 6 / 4 / 7; 
}
.affichePlanning{
    width: 13em;
    height: 16em;
}   
}
</style>