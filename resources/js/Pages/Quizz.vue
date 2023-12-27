<template>
<section>
<planning :evenements="evenements"></planning>
<div class="mainQuizz">
<div v-for="(quizz, key) in quizzs"
        :key="key"
        v-show="show === key">
<div v-if="quizz.quizzable_type === 'QuizzImage'" class="containerImageQuizz">
        <div class="titreImageQuizz">Question Image</div>
        <div class="questionImage"> {{ quizz.question }}</div>
        <img class="image" :src="`../${quizz.quizzable.image}`"/>
        <input class="input" type="text" v-model="reponse" @keyup.enter="checkReponse">
        <img class="singe" src="../../../storage/app/public/images/singe (3).png" alt="imageSinge"/>
</div>
<div v-if="quizz.quizzable_type === 'Qcm'" class="containerQcm">
        <div class="titreQcm">Choix multiples</div>
        <div class="question"> {{ quizz.question }}</div>
        <img class="singe" src="../../../storage/app/public/images/singe (4).png" alt="imageSinge"/>
        <div class="reponseQcm" :class="{ selected: isSelected('A') }" @click="selectionnerChoix('A')"> A. {{ quizz.quizzable.choix1 }}</div>
        <div class="reponseQcm" :class="{ selected: isSelected('B') }" @click="selectionnerChoix('B')"> B. {{ quizz.quizzable.choix2 }}</div>
        <div class="reponseQcm" :class="{ selected: isSelected('C') }" @click="selectionnerChoix('C')"> C. {{ quizz.quizzable.choix3 }}</div>
        <div class="reponseQcm" :class="{ selected: isSelected('D') }" @click="selectionnerChoix('D')"> D. {{ quizz.quizzable.choix4 }}</div>
        <button @click="checkReponse">Vérifier</button>
</div>
<div v-if="quizz.quizzable_type === 'VraiFaux'" class="containerVf">
        <div class="titreVf">Vrais ou faux ?</div>
        <div class="question"> {{ quizz.question }} </div>
        <div class="reponse" @click="checkReponse('vrai')">
            <img class="imageVf" src="../../../storage/app/public/images/singe (2).png" alt="imageSinge"/>
            <p><b>VRAI</b></p>
            <img class="imageVf" src="../../../storage/app/public/images/verifier.png" alt="imageSinge"/>
        </div>
        <div class="reponse" @click="checkReponse('faux')">
            <img class="imageVf" src="../../../storage/app/public/images/singe (1).png" alt="imageSinge"/>
            <p><b>FAUX</b></p>
            <img class="imageVf" src="../../../storage/app/public/images/traverser.png" alt="imageSinge"/>
        </div>
</div>
</div>
<div v-if="show >= quizzs.length" class="resultatQuizz">
    <p>Vous avez fait un score de {{ points }}/{{ quizzs.length }} !</p>
    <p v-if="points/quizzs.length == 1">Felicitation ! Venez mesurer vos connaissances aux autres lors de nos évènements !</p>
    <p v-else-if="points/quizzs.length == 0">Vous voulez venir vous entrainer lors d'un de nos event ?</p>
    <p v-else>Pas mal ! On se retrouve lors d'un de nos prochains évènements !</p>
</div>
</div>
</section>

</template>

<script>
import { reactive } from 'vue'
import MonkeyLayout from "@/Layouts/MonkeyLayout.vue";
import  planning  from "./Planning.vue";
import { Inertia } from '@inertiajs/inertia';
export default{
layout:MonkeyLayout,
components:{
    planning,
},
props:{
evenements:{
    type:Array,
    default:() =>[],
},
quizzs:{
    type:Array,
}
},
data(){
    return{
        show:0,
        points:0,
        reponse:'',
        choixSelectionnes: [],
        allCorrectSelected:Boolean
    }
},
methods: {

    selectionnerChoix(choix) {
        // Ajoutez le choix à la liste des choix sélectionnés
        if (!this.choixSelectionnes.includes(choix)) {
            this.choixSelectionnes.push(choix);
        } else {
            const index = this.choixSelectionnes.indexOf(choix);
            this.choixSelectionnes.splice(index, 1);
        }
        console.log(this.choixSelectionnes);
    },
    // A voir si elle peut passer en computed
    isSelected(choix) {
    return this.choixSelectionnes.includes(choix);
    },
    checkReponse(selectedResponse) {
        const currentQuizz = this.quizzs[this.show];
        if (currentQuizz.quizzable_type === 'QuizzImage') {
            if (this.reponse && this.reponse.toLowerCase() === currentQuizz.reponse.toLowerCase()) {
            this.points += 1;
            }
        } else if (this.quizzs[this.show].quizzable_type === 'Qcm') {
            const choixCorrect = currentQuizz.reponse.split(' ');
            this.allCorrectSelected = choixCorrect.every(val => this.choixSelectionnes.includes(val));
            if (this.allCorrectSelected && choixCorrect.length === this.choixSelectionnes.length) {
            this.points += 1;
            }     
        } else if (this.quizzs[this.show].quizzable_type === 'Vraifaux') {
            if (selectedResponse === (currentQuizz.reponse.toLowerCase() )) {
                this.points += 1;
            }
        }
        this.show++;
        console.log(this.points) 
    },
}}
</script>

<style scoped>
.planning{
  display: flex;
  width: 100%;
  overflow-x: scroll;
  margin-top: 5%;
}
section{
    display: flex;
    flex-direction: column-reverse;
    align-items: flex-start;
    position: relative;
}
.mainQuizz{
    width:90%;
    text-align: start;
    margin-left: auto;
    margin-right: auto;
}
.containerImageQuizz{
    display: flex;
    flex-direction: column;
    z-index: 1;
    position: relative;
    overflow: hidden;
    align-items: center;
    height: 70%;
    width: 90%;
    margin: auto;
    border: 4px solid #F2D5BB ;
    border-radius: 10%;
}
.containerImageQuizz::before{
    background-image: url("../../../storage/app/public/images/5411030.jpg");
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
    background-size: cover;
    pointer-events: none;
}
.containerQcm{
    display: flex;
    flex-direction: column;
    z-index: 1;
    position: relative;
    overflow: hidden;
    align-items: center;
    height: 70%;
    width: 90%;
    margin: auto;
    border: 4px solid #F2D5BB ;
    border-radius: 10%;
}
.containerQcm::before{
    background-image: url("../../../storage/app/public/images/5411030.jpg");
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
    background-size: cover;
    pointer-events: none;
}
.containerVf{
    display: flex;
    flex-direction: column;
    z-index: 1;
    position: relative;
    overflow: hidden;
    align-items: center;
    justify-content: space-around;
    height: 25rem;
    width: 90%;
    margin: auto;
    border: 4px solid #F2D5BB ;
    border-radius: 10%;
}
.containerVf::before{
    background-image: url("../../../storage/app/public/images/5411030.jpg");
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
    background-size: cover;
    pointer-events: none;
}
.singe{
    height: 3rem;
    width: 3rem;
    margin:0.5rem 0;
}
.image{
    height: 12rem;
    width: 70%;
    margin: 1rem auto;
}
.titreImageQuizz{
    background-color: #FFEE88;
    padding: 1rem 2rem;
    border-radius: 100em;
    text-align: center;
    font-size: 1.5rem;
    margin: 2rem 1rem;
    font-family: 'GoboldUplow';
}
.titreQcm{
    background-color: #F2D5BB;
    padding: 1rem 2rem;
    border-radius: 100em;
    text-align: center;
    font-size: 1.5rem;
    margin: 2rem 1rem;
    font-family: 'GoboldUplow';
}
.titreVf{
    background-color: #8C324A;
    padding: 1rem 2rem;
    border-radius: 100em;
    text-align: center;
    font-size: 1.5rem;
    margin: 2rem 1rem;
    font-family: 'GoboldUplow';
}
.question{
    text-align: center;
    font-size: 1.5rem;
    font-family: 'GoboldUplow';
    color: #402927;
}
.questionImage{
    text-align: center;
    font-size: 1.5rem;
    font-family: 'GoboldUplow';
    color: #402927;
    margin-top: 1rem;
}
.reponseQcm{
    text-align: center;
    font-size: 1.5rem;
    font-family: 'GoboldUplow';
    color: #402927;
    margin: 1rem 0;
}
input{
    width: 80%;
    height: 2.5rem;
    border-radius: 1.8em;
    padding: 0.8em 1em;
}
.reponse{
    display: flex;
    font-size: xx-large;
    color:  #8C6249;
    align-items: center;
    justify-content: space-evenly;
    width: 100%;
}
.imageVf{
    height: 2rem;
    width: 2rem;
}

.selected {
    color: green; /* Ou la couleur que vous préférez */
}
.resultatQuizz{
    font-family: 'GoboldUplow';
    font-size: 1.5rem;
    text-align: center;
    /* margin-right:21%; */
}
@media screen and (min-width: 768px){
section{
    display: flex;
    position: relative;
    flex-direction: row;
}
.mainQuizz{
    width:40%;
    height: auto;
    text-align: start;
    margin-left: auto;
    margin-right: auto;
    margin-bottom: 5%;
}
.planning{
  display: block;
  width: auto;
  height: 60vh;
  overflow-y: scroll;
  overflow-x: hidden;
  margin-top: 0;
}
.planningText{
  display: flex;
  margin:0 5%;
  width:auto;
  white-space: nowrap;
}
.containerImageQuizz{
    position: absolute;
    left: 40%;
    display: flex;
    flex-direction: column;
    justify-content: space-around;
    overflow: hidden;
    align-items: center;
    width: 25rem;
    border: 4px solid #F2D5BB ;
    border-radius: 10%;
}
.containerQcm{
    position: absolute;
    left: 40%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    overflow: hidden;
    align-items: center;
    height: 30rem;
    width: 25rem;
    border: 4px solid #F2D5BB ;
    border-radius: 10%;
    justify-content: space-around;
}
.reponseQcm{
    text-align: center;
    font-size: 1.5rem;
    font-family: 'GoboldUplow';
    color: #402927;
    margin: 0 0;
}
.containerVf{
    position: absolute;
    left: 40%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    overflow: hidden;
    align-items: center;
    height: 30rem;
    width: 25rem;
    border: 4px solid #F2D5BB ;
    border-radius: 10%;
    justify-content: space-around;
}
.titreImageQuizz{
    background-color: #FFEE88;
    width: 90%;
    padding: 2.5rem 0;
    text-align: center;
    font-size: 1.5rem;
    margin: 0.2rem 0.2rem;
    font-family: 'GoboldUplow';
    border-radius: 2em;
}
.titreQcm{
    background-color: #F2D5BB;;
    width: 90%;
    padding: 2.5rem 0;
    text-align: center;
    font-size: 1.5rem;
    margin: 0.2rem 0.2rem;
    font-family: 'GoboldUplow';
    border-radius: 2em;
}
.titreVf{
    background-color: #8C324A;
    width: 90%;
    padding: 2.5rem 0;
    text-align: center;
    font-size: 1.5rem;
    margin: 0.2rem 0.2rem;
    font-family: 'GoboldUplow';
    border-radius: 2em;
}
.question{
    text-align: center;
    font-size: 1.5rem;
    font-family: 'GoboldUplow';
    color: #402927;
}
.questionImage{
    text-align: center;
    font-size: 1.5rem;
    font-family: 'GoboldUplow';
    color: #402927;
    margin-top: 1rem;
}
.planning::-webkit-scrollbar {
  width: 0.5em; 
}

.planning::-webkit-scrollbar-thumb {
  background-color: transparent; 
}
.imageVf{
    height: 5rem;
    width: 5rem;
}
.selected {
    color:  #8C324A; 
}
.resultatQuizz{
    font-family: 'GoboldUplow';
    font-size: 2rem;
    transform: translateY(50%) translateX(-10%);
}
}
</style>