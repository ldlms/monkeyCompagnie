<template>
<aside class="planning">
    <div v-for="evenement in evenements">
    <div class="date">
      <div><span class="badge">{{ evenement.jour }}</span></div>
      <div class="mois">{{ evenement.mois }}</div>
    </div>
    <div class="planningText">
      <h4 class="text-uppercase"><strong>{{ evenement.nom }}</strong></h4>
      <ul class="list-inline">
        <li class="list-inline-item"><i class="fa fa-clock"></i> {{evenement.heure}}H</li>
        <li class="list-inline-item"><i class="fa fa-location-arrow" aria-hidden="true"></i> {{ evenement.lieu }}</li>
      </ul>
      
      <ul class="metro-container">
        <li class="metro">{{ evenement.metro }}</li>
      </ul>
    
    </div>
      <div class="line"></div>
  </div>
</aside>
</template>

<script>
export default{
    name:"planning",
    props:{
        evenements:{
        type:Array,
        default:()=>[],
    }
    },
}
</script>

<style scoped>
.planning div{
  margin: 0 0.8rem;
}
aside {
    display: flex;
    margin-left: 0rem;
}
aside div {
  display: flex;
  align-items: center;
  flex-direction: row;
}
aside div h2 {
  font-size: 1.5em;
}
  
aside div h4 {
  font-size: 1em;
}
.planningText{
  display: flex;
  margin:0 10%;
  width:auto;
  white-space: nowrap;
  flex-direction: column;
}
.date{
  margin:0 20%;
  display: flex;
  flex-direction: column;
}
.mois{
  font-size: larger;
}
h1, .h1{
  font-size: calc(1.375rem + 1.5vw);
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
.metro {
    list-style-image: url("../../../storage/app/public/images/metro.png");
    font-family: 'Nunito';
}
.metro-container {
    text-align: center;
    transform: translateY(-0.625rem);
}
.text-uppercase {
  text-transform: uppercase;
}
.list-inline{
  list-style: none; 
  padding-left: 0;
}
.list-inline-item {
  display: inline-block; 
  /* margin-right: 0.6rem;  */
}
.list-inline-item:last-child {
    margin-right: 0;
    margin-left: 0.6rem;
}
.line {
    width: 0.063rem;
    height:5rem;
    background-color:#000000;
    margin:auto;
    transform: translateY(-0.625rem);
  
}
@media screen and (min-width: 768px){
/* Cacher la barre de défilement verticale */
.date{
  margin:0 10%;
}
aside {
    display: flex;
    height: 75vh;
    overflow-y: scroll hidden;
    flex-direction: column;
  }
aside div {
    display: flex;
    align-items: center;
    flex-direction: column;
  }
.planningText{
  display: flex;
  margin:0 5%;
  width:auto;
  white-space: nowrap;
}
}
</style>