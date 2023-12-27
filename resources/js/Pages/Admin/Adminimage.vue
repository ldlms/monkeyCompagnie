<template>
    <table class="styled-table">
        <thead>
            <tr></tr>
        </thead>
    <tbody>
        <tr v-if="!showEdit" v-for="image in images" :key="image.id">
            <td><img class="image-cell" :src="`../${image.url}`" alt="image"></td>
            <td>{{ image.description }}</td>
            <td><button @click="editI(image)">Modifier</button></td>
            <td><button @click="deleteI(image)">Supprimer</button></td>
        </tr>
    </tbody>
    </table>
    <div class="form-buttons">
    <button class="form-button" @click="openModal">Ajouter une image</button>
    </div>

    <!-- Modal -->
<teleport to="body">
    <div v-if="showModal">
        <form class="form-container" @submit.prevent="createI" enctype="multipart/form-data">

            <label class="form-input" for="description">Description :</label>
            <input id="description" name="description" v-model="description"><br>

            <label class="form-label" for="images">Images:</label>
            <input class="form-input" type="file" id="images" name="images[]" accept="image/jpeg, image/png" multiple @change="handleMultipleFileChange" required><br>

            <label class="form-label" for="album">Album :</label>
            <select class="form-select" id="album" name="album[]" v-model="album" multiple> 
            <option v-for="album in albums" :value="album.id" :key="album.id">{{ album.titre }}</option>
            </select>
            <br>

            <input class="form-input" type="submit" value="Créer">

        </form>
    </div>
</teleport>

<teleport to="tbody">
    <div v-if="showEdit">
        <form class="form-container" @submit.prevent="updateI" enctype="multipart/form-data">

            <label class="form-label" for="description">Description :</label>
            <textarea id="description" name="description" v-model="description"></textarea><br>

            <label class="form-label" for="url">Image :</label>
            <input class="form-input" type="file" id="url" name="url" accept="image/jpeg, image/png" @change="handleFileChange" required><br>

            <label class="form-label" for="album">Album :</label>
            <select class="form-select" id="album" name="album[]" v-model="album" multiple>
             
            <option v-for="album in albums" :value="album.id" :key="album.id">{{ album.titre }}</option>
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
        Link
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
            description:null,
            url:null,
            album:[],
            id:null,
        }
    },
    methods:{
        handleFileChange(event) {
            this.url = event.target.files[0]; 
        },
        handleMultipleFileChange(event){
            this.url = event.target.files;
        },
        closeModal() {
            this.showModal = false;
            this.reset();
        },
        openModal() {
            this.showModal = !this.showModal;
        },
        reset() {
            this.description = null,
            this.url = null,
            this.album = null,
            this.id = null
        },
        createI() {
            const formData = new FormData();
                formData.append('description', this.description);
                for (let i = 0; i < this.url.length; i++) {
                    formData.append(`url[${i}]`, this.url[i]);
                } 
                formData.append('album', this.album); 

                this.$inertia.post('/admin/images', formData,{
                onError: (errors) => {
                    console.error(errors);
                }}
                );
                this.reset();
                this.closeModal();
        },
        editI(image){
            this.showEdit = !this.showEdit;
            if(this.showEdit == true){
                this.titre = image.titre,
                this.description = image.description,
                this.album = image.albums.map(album => album.id),
                this.url = image.url,
                this.id = image.id
            }else{
                this.titre = null,
                this.description = null,
                this.album = [],
                this.url = null,
                this.id = null
            }
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
        updateI() {
            const formDataUpdate = new FormData();
            formDataUpdate.append('_method', 'PUT');
            formDataUpdate.append('titre', this.titre);
            formDataUpdate.append('description', this.description);
            formDataUpdate.append('url', this.url); 
            formDataUpdate.append('album', this.album); 

            this.$inertia.post('/admin/images/' + this.id, formDataUpdate,{
                onError: (errors) => {
                    console.error(errors);
                }})
            this.reset();
            this.showEdit = !this.showEdit;
        },
        deleteI(image) {
                if (!confirm('Supprimer l\'image ?')) return;
                this.$inertia.delete('/admin/images/' + image.id)
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