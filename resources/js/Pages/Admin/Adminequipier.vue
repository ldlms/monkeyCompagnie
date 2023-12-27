<template>
    <table class="styled-table">
        <thead>
            <tr></tr>
        </thead>
    <tbody>
        <tr v-if="!showEdit" v-for="equipier in equipiers" :key="equipier.id">
            <td><img class="image-cell" :src="`../${equipier.image}`" alt="image"></td>
            <td>{{ equipier.nom }}</td>
            <td>{{ equipier.description }}</td>
            <td><button @click="editE(equipier)">Modifier</button></td>
            <td><button @click="deleteE(equipier)">Supprimer</button></td>
        </tr>
    </tbody>
    </table>
    <div class="form-buttons">
    <button class="form-button" @click="openModal">Ajouter un equipier</button>
    </div>

    <!-- Modal -->
<teleport to="body">
    <div v-if="showModal">
        <form class="form-container" @submit.prevent="createE()" enctype="multipart/form-data">
            <label class="form-label" for="nom">Nom :</label>
            <input class="form-input" type="text" id="nom" name="nom" v-model="nom" required><br>

            <label class="form-label" for="description">Description :</label>
            <textarea class="form-input" type="text" id="description" name="description" v-model="description" required><br></textarea>

            <label for="image">Image :</label>
            <input type="file" id="image" name="image" accept="image/jpeg, image/png" @change="handleFileChange" required><br>

            <input class="form-button" type="submit" value="Créer">

        </form>
    </div>
</teleport>

<teleport to="tbody">
    <div v-if="showEdit">
        <form class="form-container" @submit.prevent="updateE()" enctype="multipart/form-data">
            <label class="form-label" for="nom">Nom :</label>
            <input class="form-input" type="text" id="nom" name="nom" v-model="nom" required><br>

            <label class="form-label" for="description">Description :</label>
            <textarea class="form-input" type="text" id="description" name="description" v-model="description" required><br></textarea>

            <label for="image">Image :</label>
            <input type="file" id="image" name="image" accept="image/jpeg, image/png" @change="handleFileChange" required><br>

            <div class="form-buttons">
            <input class="form-button" type="submit" value="Modifier">
            <button class="form-button" @click="hideEdit">Retour</button>
            </div>

        </form>
    </div>
</teleport>


</template>

<script>
import { Link } from '@inertiajs/vue3';
import panel from './Panel.vue'
export default{
    layout:panel,
    components:{
        Link
    },
    props:{
       equipiers:{
        type:Array,
        default:()=>[],
       }, 
    },
    data(){
        return{
            showModal:false,
            showEdit:false,
            nom:null,
            description:null,
            image:null,
            id:null
        }
    },
    methods:{
        
        handleFileChange(event) {
            this.image = event.target.files[0]; 
        },
        closeModal() {
            this.showModal = false;
            this.reset();
        },
        openModal() {
            this.showModal = !this.showModal;
        },
        reset() {
            this.nom=null,
            this.description=null,
            this.image=null
        },
        createE(){
            const formData = new FormData();
                formData.append('nom', this.nom);
                formData.append('description', this.description);
                formData.append('image', this.image);
            this.$inertia.post('/admin/equipe', formData)
            console.log(formData);
            this.reset();
            this.closeModal();
            this.editMode = false;
        },
        hideEdit(){
            this.showEdit = !this.showEdit;
            if(this.showEdit == true){
                this.id = equipier.id
                this.nom = equipier.nom;
                this.description = equipier.description
                this.image = equipier.image;
            }else{
                this.id = null;
                this.nom = null;
                this.description = null;
                this.image = [];
            }
        },
        editE(equipier) {
            this.showEdit = !this.showEdit;
            if(this.showEdit === true){
                this.nom = equipier.nom,
                this.description = equipier.description,
                this.image = equipier.image,
                this.id = equipier.id
            }else{
                this.nom = null,
                this.description = null,
                this.image = null,
                this.id = null
            }
            },
        updateE(data) {
            const formData = new FormData();
                formData.append('_method', 'PUT');
                formData.append('nom', this.nom);
                formData.append('description', this.description);
                formData.append('image', this.image);
            this.$inertia.post('/admin/equipe/' + this.id, formData)
            this.reset();
            this.showEdit = false;
        },
        deleteE(equipier) {
            if (!confirm('Supprimer l\'equipier ?')) return;
            this.$inertia.delete('/admin/equipe/' + equipier.id)
        }
    }
}
</script>

<style scoped>

.styled-table {
  width: 100%;
  border-collapse: collapse;
  border: 1px solid #ccc;
  font-family: Arial, sans-serif;
}

/* Style de l'en-tête */
.styled-table th {
  background-color: #f2f2f2;
  padding: 10px;
  text-align: left;
}

/* Style des cellules de données */
.styled-table td {
  border: 1px solid #ddd;
  padding: 10px;
}

/* Style de la cellule contenant l'image */
.styled-table .image-cell {
  text-align: center;
}

/* Style de l'image */
.styled-table img {
  max-width: 100px;
  max-height: 100px;
}

/* Style de survol des lignes */
.styled-table tbody tr:hover {
  background-color: #f2f2f2;
}
.form-container {
  max-width: 40rem; /* Ajuster la largeur maximale du formulaire selon vos besoins */
  margin: auto;
  padding: 2rem;
  background-color: #f9f9f9; /* Couleur de fond du formulaire */
  border-radius: 0.8rem;
  box-shadow: 0px 0.2rem 0.4rem rgba(0, 0, 0, 0.1);
}

/* Style pour les étiquettes du formulaire */
.form-label {
  display: block;
  margin-bottom: 0.8rem;
  font-weight: bold;
}

/* Style pour les champs de saisie */
.form-input {
  width: 100%;
  padding: 0.8rem;
  font-size: 1rem;
  border: 0.1rem solid #ccc;
  border-radius: 0.4rem;
}
.form-buttons {
  display: flex;
  gap: 1rem; /* Espacement entre les boutons */
  justify-content: center; /* Centrer les boutons horizontalement */
  margin-top: 1rem; /* Espacement depuis le formulaire */
}
/* Style pour les boutons du formulaire */
.form-button {
  padding: 1rem 2rem;
  font-size: 1rem;
  background-color: #007bff; /* Couleur de fond du bouton (bleu par défaut) */
  color: #fff; /* Couleur du texte du bouton */
  border: none;
  border-radius: 0.4rem;
  cursor: pointer;
}

.form-select {
  width: 100%;
  padding: 0.8rem;
  font-size: 1rem;
  border: 0.1rem solid #ccc;
  border-radius: 0.4rem;
  background-color: #fff;
}

/* Style pour les champs de date */
.form-date {
  width: 100%;
  padding: 0.8rem;
  font-size: 1rem;
  border: 0.1rem solid #ccc;
  border-radius: 0.4rem;
  background-color: #fff;
}
</style>