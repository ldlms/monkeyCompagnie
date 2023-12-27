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
      default:()=>[],
    }
},
methods:{},
  setup(){
    const form = reactive({
      nom:null,
      email:null,
      demande:null,
      mess:null
    })

  const submit = () => {
  Inertia.post('/contact', form, {
    onError: (errors) => {
      // Gérer les erreurs ici, par exemple afficher un message d'erreur
      console.log(errors);
    },
    onSuccess: () => {
      // Réinitialiser les champs du formulaire après une soumission réussie
      form.nom = '';
      form.email = '';
      form.demande = '';
      form.mess = '';
      console.log('Formulaire soumis avec succès !');
    },
  });
};
    return{
    form,
    submit,
  }
  }
}
</script>


<template>
  <section>
    <planning :evenements="evenements"></planning>
    <div class="mainContact">
    <div class="containerContact">
      <div class="card">
        <form @submit.prevent="submit" class="contact" method="POST">
          <div class="form-row">
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" v-model="form.nom" required>
  
            <label for="email">Mail :</label>
            <input type="email" id="email" name="email" v-model="form.email" required>
          </div>
  
          <div class="form-row select-row">
            <label for="demande">Votre demande :</label><br>
            <select id="demande" name="demande" v-model="form.demande" required>
              <option value="A">Option A</option>
              <option value="B">Option B</option>
              <option value="C">Option C</option>
              <option value="D">Option D</option>
            </select>
          </div>
  
          <div class="form-row">
            <label for="message">Votre message :</label>
            <textarea id="message" type="text" name="message" rows="5" v-model="form.mess"></textarea>
          </div>
  
          <input type="submit" value="Envoyer">
        </form>
      </div>
    </div>
  </div>
  </section>
</template>


<style scoped>
.mainContact{
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
section{
    display: flex;
    flex-direction: column-reverse;
    align-items: flex-start;
    position: relative;
  }
.containerContact{
  margin: 0;
  height: auto;
}
.containerContact .card {
    background-color: #FFDFC2;;
    margin-left: 2rem;
    margin-right: 2rem;
    z-index: 1;
    position: relative;
    overflow: hidden;
}
    
.containerContact .card:before{
    background-image: url("../../../storage/app/public/images/clipart4245967.png");
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
    
.contact {
    width: 100%;
    margin: 0 auto;
    display: grid;
    grid-gap: 0.625rem;
    position: relative;
}
    
.contact #nom
.contact #email {
    display: grid;
    grid-template-columns: 1fr 1fr;
}
    
.contact label,
.contact select,
.contact textarea {
    display: inline-block;
    margin-left: 5%;
    font-size: 1.5em;
    font-family: 'Nunito';
    z-index: 2;
}
    
#demande{
    margin-top: 10%;
    margin-left:5%;
    margin-bottom: 4%;
}

    
.contact input[type="text"],
.contact input[type="email"],
.contact select{
  padding: 0.313rem;
  border: 0.063rem solid #ccc;
  border-radius: 0.188rem;
  margin-left: 7%;
  margin-bottom: 3%;
  margin-right: 50%;
  z-index: 1;
  position: relative;
}
    
.contact textarea{
      width:80%;
      margin-left:10%;
      position: relative;
    }
    
.contact input[type="submit"] {
    background-color: #8b6b58;
    color: white;
    border: none;
    padding: 0.625rem 0.938rem;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 1rem;
    margin-top: 0.625rem;
    cursor: pointer;
    }

.form-row {
  display: flex;
  flex-wrap: wrap; 
  margin: -0.313rem; 
  align-items: baseline;
}
@media screen and (min-width: 768px){

.mainContact {
  width: 50%;
  height: var(--height-main);
}
.planning::-webkit-scrollbar {
  width: 0.5em; /* Largeur de la barre de défilement */
}

.planning::-webkit-scrollbar-thumb {
  background-color: transparent; /* Couleur de la barre de défilement */
}
.planning{
  display: block;
  width: auto;
  overflow-y: scroll;
  overflow-x: scroll;
}
section{
  display: flex;
  position: relative;
  flex-direction: row;
}
.containerContact .card {
  top: 1%;
  background-color: #FFDFC2;
  z-index: 1;
  overflow: hidden;
  font-family: 'Nunito';
  position: relative;
  box-shadow: 0.5rem 0.313rem 0.25rem 0.063rem rgba(0,0,0,0.43);
  }
  
.containerContact .card:before{
    background-image: url("../../../storage/app/public/images/clipart4245967.png");
    content: ' ';
      display: block;
      position: absolute;
      left: 0;
      top: 0;
      width: 100%;
      height: 80%;
      z-index: -1;
      opacity: 0.4;
      background-repeat: no-repeat;
      background-position: 50% 0;
      background-size: cover;
      pointer-events: none;
  }
  
.contact {
    width: 100%;
    margin: 0 auto;
    display: grid;
    grid-gap: 0.625rem;
    justify-items: stretch;
  }
  
.contact #nom
.contact #email {
    display: grid;
    grid-template-columns: 1fr 1fr;
}
  
.contact label,
.contact select,
.contact textarea {
    /* margin-bottom: 10px; */
    margin-left: 5%;
    font-size: 1.5em;
    font-family: 'Nunito';
    z-index: 2;
  }
  
#demande{
    margin-top: 5%;
    /* margin-left:40%; */
}
.contact input[type="text"]{
  margin-right: 8rem;
}  
  
.contact input[type="text"],
.contact input[type="email"],
.contact select{
    width: 20rem;
    padding: 0.313rem;
    border: 0.063rem solid #ccc;
    border-radius: 0.188rem;
    margin-top:6%;
    margin-right: 30%;
    z-index: 1;
    position: relative;
  }
  
.contact textarea{
    width:80%;
    margin-left:10%;
    position: relative;
  }
  
.contact input[type="submit"] {
    background-color: #8b6b58;
    color: white;
    border: none;
    padding: 0.625rem 0.938rem;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 1rem;
    margin-top: 0.625rem;
    cursor: pointer;
  }
  
.contact input,
.contact textarea{
    box-shadow: inset 0.313rem 0.25rem 0.25rem rgba(0, 0, 0, 0.1);
}
.form-row.select-row {
  display: grid;
  grid-template-columns: auto auto;
  align-items: center;
  justify-items: start;
  margin-left: 1%;
  /* justify-content: space-around;
  transform: translateX(-5.2rem); */
}
  }
</style>