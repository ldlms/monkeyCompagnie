<template>
    <table class="styled-table">
        <thead>
            <tr></tr>
        </thead>
    <tbody>
        <tr v-if="!showEdit" v-for="album in albums" :key="album.id">
            <td><img v-if="album.images[0] != empty" class="image-cell" :src="`../${album.images[0].url}`" alt="image"></td>
            <td>{{ album.titre }}</td>
            <td><button @click="editA(album)">Modifier</button></td>
            <td><button @click="deleteA(album)">Supprimer</button></td>
        </tr>
    </tbody>
    </table>
    <div class="form-buttons">
    <button class="form-button" @click="openModal">Ajouter un album</button>
    </div>

    <!-- Modal -->
<teleport to="body">
    <div class="form-container" v-if="showModal">
        <form @submit.prevent="createA" enctype="multipart/form-data">
            <label class="form-label" for="nom">Titre :</label>
            <input class="form-input" type="text" id="titre" name="titre" v-model="titre" required><br>

            <label class="form-label" for="image">Images :</label>
            <select class="form-select" id="image" name="image[]" v-model="image" multiple>
             
            <option v-for="image in images" :value="image.id">{{ image.description }}</option>
            </select>
            <br>

            <input class="form-button" type="submit" value="Créer">

        </form>
    </div>
</teleport>

<teleport to="tbody">
    <div class="form-container" v-if="showEdit">
        <form @submit.prevent="updateA" enctype="multipart/form-data">
            <label class="form-label" for="nom">Titre :</label>
            <input class="form-input" type="text" id="titre" name="titre" v-model="titre" required><br>

            <label class="form-label" for="image">Images :</label>
            <select class="form-select"  id="image" name="image[]" v-model="image" multiple>
             
            <option v-for="image in images" :value="image.id">{{ image.description }}</option>
            </select>
            <br>
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
        Link,
    },
    props:{
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
            showModal:false,
            showEdit:false,
            titre:null,
            image:[]
        }
    },
    methods:{
        closeModal() {
            this.showModal = false;
            this.reset();
        },
        openModal() {
            this.showModal = !this.showModal;
        },
        reset() {
            this.titre = null,
            this.image = [],
            this.id

        },
        hideEdit(){
            this.showEdit = !this.showEdit;
            if(this.showEdit == true){
                this.titre = album.titre;
                this.image = album.images.map(image=>image.id);
                this.id = album.id
            }else{
                this.titre = null,
                this.image = []
            }
        },
        createA() {
            const formData = new FormData();
                formData.append('titre', this.titre);
                formData.append('image', this.image);
            this.$inertia.post('/admin/albums', formData)
            this.reset();
            this.closeModal();
        },
        editA(album) {
            this.showEdit = !this.showEdit;
            if(this.showEdit == true){
                this.titre = album.titre;
                this.image = album.images.map(image=>image.id);
                this.id = album.id
            }else{
                this.titre = null,
                this.image = []
            }
            },
        updateA() {
            const formData = new FormData();
                formData.append('_method', 'PUT');
                formData.append('titre', this.titre);
                formData.append('image', this.image);
            this.$inertia.post('/admin/albums/' + this.id, formData)
            this.reset();
            this.showEdit = !this.showEdit;
        },
        deleteA(album) {
                if (!confirm('Supprimer l\'album ?')) return;
                this.$inertia.delete('/admin/albums/' + album.id)
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