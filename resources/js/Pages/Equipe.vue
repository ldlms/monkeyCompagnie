<style scoped>
.planning{
  display: flex;
  width: 100%;
  overflow-x: scroll;
  margin-top: 10%;
}
section{
    display: flex;
    flex-direction: column-reverse;
    align-items: flex-start;
    position: relative;
  }
.mainEquipe{
    width:90%;
    text-align: start;
    margin-left: auto;
    margin-right: auto;
}
.histoire {
    background: linear-gradient(to bottom, #0A8754 0.125rem, white 0.063rem, white calc(100% - 0.125rem), #0A8754 calc(100% - 0.063rem)) no-repeat, linear-gradient(to left, #0A8754 0.125rem, white 0.063rem, white calc(100% - 0.125rem), #0A8754 calc(100% - 0.063rem)) no-repeat;
    background-position: center;
    background-size: calc(100% - 2em) 100%, 100% calc(100% - 2em);
    margin:auto;
    width: 100%;
    height: max-content;
    padding: 0.563rem;
    margin-bottom: 8rem;
}
.histoire p{
  color:#402927;
  width:100%;
  text-align:center;
  font-family: 'Nunito';
  padding: 0.688rem;
  font-size: 0.9em;
  
}
.histoire h4 {
  color: #f2d5bb;
  border-color: white;
  width:100%;
  text-align:left;
  padding: 1.063;
  font-size: 2em;
  font-style: italic;
  margin-bottom: 1em;
  font-family: 'Nunito';
}
.equipe_container {
    display: flex;
    justify-content: space-between;
    flex-direction: column;
    align-items: center;
  }
.equipe{
    position: relative;
    width: 18.75rem;
    height: 12.5rem;
    border-radius: 0.625rem;
    box-shadow: 0rem 0.313rem 1.25rem rgba(0, 0,0, 0.5);
    transition: 0.3s;
    padding: 1.875rem 3.125rem ;
    background: #fff;
    cursor:pointer;
}
.equipe:first-child{
  margin-top: 0;
}
.content_equipe {
  display: flex;
  flex-direction: column;
  text-align: center;
  max-height: 0; 
  overflow: hidden; 
  opacity: 0;
  transition: max-height 0.3s ease, opacity 0.3s ease; 
}
.content_equipe-active {
  opacity: 1;  
  max-height: 100%;
  transform: translateY(-98%);
}
.content_equipe:not(.content_equipe-active) {
  transition: transform 0s ease;
}
.equipe:hover{
  height: 40rem;
}
.imgbox_equipe{
    position: relative;
    width: 100%;
    height: 100%;
    transform: translateY(-7.5rem);
    z-index: 1;
}
.img_equipe{
    width: 100%;
    max-height: 15.625rem;
    border-radius: 0.625rem;
    box-shadow:0rem 0.313rem 1.25rem rgba(0, 0,0, 0.5); ;
}

.content_equipe h2{
    color:#D7B49E;
}
@media screen and (min-width: 768px){
section{
    display: flex;
    position: relative;
    flex-direction: row;
}

.equipe_container {
    display: flex;
    justify-content: space-between;
    flex-direction: row;
    align-items: normal;
}
  .equipe{
    position: relative;
    width: 18.75rem;
    height: 12.5rem;
    border-radius: 0.625rem;
    box-shadow: 0rem 0.313rem 1.25rem rgba(0, 0,0, 0.5);
    transition: 0.3s;
    padding: 1.875rem 3.125rem ;
    background: #fff;
    cursor:pointer;
}
.mainEquipe {
    width: 60%;
}
.planning::-webkit-scrollbar {
  width: 0.5em; 
}

.planning::-webkit-scrollbar-thumb {
  background-color: transparent; 
}
.planning{
  display: block;
  width: auto;
  height: 100vh;
  overflow-y: scroll;
  overflow-x: hidden;
  margin-top: 0%;
}
.planningText{
  display: flex;
  margin:0 5%;
  width:auto;
  white-space: nowrap;
}
}
</style>

<script>
import MonkeyLayout from "@/Layouts/MonkeyLayout.vue";
import planning from "./Planning.vue";
export default{
    layout: MonkeyLayout,
    components:{
    planning,
},
    props:{
        equipiers:{
            type:Array,
            default:()=>[]
        },
        evenements:{
        type:Array,
        default:()=>[],
    }
    },
data(){
  return{
    isHovered:null,
    dynamicHeight:0,
  }
},
methods:{
  // getHeightOfDiv1() {
  //     const equipeContainer = this.$refs.equipeContainer;
  //     this.dynamicHeight = equipeContainer.clientHeight;
  //     console.log(this.dynamicHeight)
  //   }
}
}
</script>

<template>
<section>
<planning v-bind:evenements="evenements"></planning>
<div class="mainEquipe">
  <div class="histoire">
      <h4>Notre Histoire </h4>
      <p>Haec igitur lex in amicitia sanciatur, ut neque rogemus res turpes nec faciamus rogati. Turpis enim excusatio est et minime accipienda cum in ceteris peccatis, tum si quis contra rem publicam se amici causa fecisse fateatur. Etenim eo loco, Fanni et Scaevola, locati sumus ut nos longe prospicere oporteat futuros casus rei publicae. Deflexit iam aliquantum de spatio curriculoque consuetudo maiorum. <br/><br/>
  
         et Scaevola, locati sumus ut nos longe prospicere oporteat futuros casus rei publicae. Deflexit iam aliquantum de spatio curriculoque consuetudo maiorum. <br/><br/>
      Fieri, inquam, Triari, nullo pacto potest, ut non dicas, quid non probes eius, a quo dissentias. quid enim me prohiberet Epicureum esse, si probarem, quae ille diceret? cum praesertim illa perdiscere ludus esset. Quam ob rem dissentientium inter se reprehe solent.</p>
      
  </div>
  <div class="equipe_container">
    <div class="equipe" v-for="equipier in equipiers" :key="equipier.id" @mouseover="isHovered = equipier.id" @mouseleave="isHovered = null">
      <div class="imgbox_equipe">
          <img class="img_equipe" :src="`../${equipier.image}`" alt="avatar"/>
      </div>
      <div :class="['content_equipe', { 'content_equipe-active': isHovered === equipier.id }]">
          <h2>{{ equipier.nom }}</h2>
          <p>{{ equipier.description }}</p>
      </div>
  </div>
  </div>
  </div>
</section>
</template>

