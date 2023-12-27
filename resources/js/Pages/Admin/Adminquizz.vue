<template>
    <table class="styled-table">
    <tbody>
    <tr v-for="quizz in quizzs">
        <div class="quizz" v-if="quizz.quizzable_type === 'QuizzImage'">
            <td><img class="image-cell" :src="`../${quizz.quizzable.image}`" alt="image"></td>
            <td>{{ quizz.question }}</td>
            <td>{{ quizz.reponse }}</td>
            <td><button @click="editImage(quizz)">Modifier</button></td>
            <td><button @click="deleteImage(quizz)">Supprimer</button></td>
        </div>
    </tr>
    <div class="form-buttons">
    <button class="form-button" @click="openModalImage">Ajouter un Quizz image</button>
    </div>
    <tr v-for="quizz in quizzs">
        <div v-if="quizz.quizzable_type === 'Qcm'">
            <td>{{ quizz.question }}</td>
            <td>{{ quizz.quizzable.choix1 }}</td>
            <td>{{ quizz.quizzable.choix2 }}</td>
            <td>{{ quizz.quizzable.choix3 }}</td>
            <td>{{ quizz.quizzable.choix4 }}</td>
            <td>{{ quizz.reponse }}</td>
            <td><button @click="editQcm(quizz)">Modifier</button></td>
            <td><button @click="deleteImage(quizz)">Supprimer</button></td>
        </div>
    </tr>
    <div class="form-buttons">
    <button class="form-button" @click="openModalQcm">Ajouter un QCM</button>
    </div>
    <tr v-for="quizz in quizzs">
        <div class="quizz" v-if="quizz.quizzable_type === 'vraifaux'">
            <td>{{ quizz.question }}</td>
            <td>{{ quizz.reponse }}</td>
            <td><button @click="editVf(quizz)">Modifier</button></td>
            <td><button @click="deleteImage(quizz)">Supprimer</button></td>
        </div>
    </tr>
    <div class="form-buttons">
    <button class="form-button" @click="openModalVf">Ajouter un Vrai ou faux</button>
    </div>
    </tbody>
</table>


<!-- MODAUX IMAGES -->
    <teleport to="body">
    <div v-if="showModalImage">
        <form class="form-container" @submit.prevent="createImage" enctype="multipart/form-data">

            <label class="form-input" for="question">Question :</label>
            <textarea id="question" name="question" v-model="question" required></textarea><br>

            <label class="form-label" for="image">Image:</label>
            <input class="form-input" type="file" id="image" name="image" accept="image/jpeg, image/png" @change="handleFileChange" required><br>

            <label class="form-label" for="reponse">Reponse :</label>
            <textarea class="form-select" id="reponse" name="reponse" v-model="reponse" multiple></textarea><br>             

            <input class="form-input" type="submit" value="Créer">

        </form>
    </div>
</teleport>

<teleport to="tbody">
    <div v-if="showEditImage">
        <form class="form-container" @submit.prevent="updateImage" enctype="multipart/form-data">

            <label class="form-input" for="question">Question :</label>
            <textarea id="question" name="question" v-model="question" required></textarea><br>

            <label class="form-label" for="image">Image:</label>
            <input class="form-input" type="file" id="image" name="image" accept="image/jpeg, image/png" @change="handleFileChange" required><br>

            <label class="form-label" for="reponse">Reponse :</label>
            <textarea class="form-select" id="reponse" name="reponse" v-model="reponse" multiple></textarea><br>             

            <input class="form-input" type="submit" value="modifier">
        </form>
    </div>
</teleport>

<!-- MODAUX QCM -->

<teleport to="body">
    <div v-if="showModalQcm">
        <form class="form-container" @submit.prevent="createQcm" enctype="multipart/form-data">

          <label class="form-input" for="question">Question :</label>
          <textarea id="question" name="question" v-model="question" required></textarea><br>

          <label class="form-label" for="choix1"> Reponse 1 :</label>
          <input class="form-input" type="text" id="choix1" name="choix1" v-model="choix1" required><br>
          
          <label class="form-label" for="choix2">Reponse 2 :</label>
          <input class="form-input" type="text" id="choix2" name="choix2" v-model="choix2" required><br> 

          <label class="form-label" for="choix3">Reponse 3 :</label>
          <input class="form-input" type="text" id="choix3" name="choix3" v-model="choix3" required><br> 

          <label class="form-label" for="choix4">Reponse 4 :</label>
          <input class="form-input" type="text" id="choix4" name="choix4" v-model="choix4" required><br> 

          <label class="form-label" for="reponse">Reponse :</label>
          <textarea class="form-select" id="reponse" name="reponse" v-model="reponse" multiple></textarea><br>

          <input class="form-input" type="submit" value="Créer">

        </form>
    </div>
</teleport>

<teleport to="tbody">
    <div v-if="showEditQcm">
        <form class="form-container" @submit.prevent="updateQcm" enctype="multipart/form-data">

          <label class="form-input" for="question">Question :</label>
          <textarea id="question" name="question" v-model="question" required></textarea><br>

          <label class="form-label" for="choix1"> Reponse 1 :</label>
          <input class="form-input" type="text" id="choix1" name="choix1" v-model="choix1" required><br>
          
          <label class="form-label" for="choix2">Reponse 2 :</label>
          <input class="form-input" type="text" id="choix2" name="choix2" v-model="choix2" required><br> 

          <label class="form-label" for="choix3">Reponse 3 :</label>
          <input class="form-input" type="text" id="choix3" name="choix3" v-model="choix3" required><br> 

          <label class="form-label" for="choix4">Reponse 4 :</label>
          <input class="form-input" type="text" id="choix4" name="choix4" v-model="choix4" required><br> 

          <label class="form-label" for="reponse">Reponse :</label>
          <textarea class="form-select" id="reponse" name="reponse" v-model="reponse" multiple></textarea><br>

          <input class="form-input" type="submit" value="modifier">

        </form>
    </div>
</teleport>


<!-- MODAUX VRAI FAUX -->
<teleport to="body">
    <div v-if="showModalVf">
        <form class="form-container" @submit.prevent="createVf" enctype="multipart/form-data">

          <label class="form-input" for="question">Question :</label>
          <textarea id="question" name="question" v-model="question" required></textarea><br>

          <label class="form-label" for="reponse">Reponse :</label>
          <textarea class="form-select" id="reponse" name="reponse" v-model="reponse" multiple></textarea><br>

          <input class="form-input" type="submit" value="Créer">

        </form>
    </div>
</teleport>

<teleport to="tbody">
    <div v-if="showEditVf">
        <form class="form-container" @submit.prevent="updateVf" enctype="multipart/form-data">

          <label class="form-input" for="question">Question :</label>
          <textarea id="question" name="question" v-model="question" required></textarea><br>

          <label class="form-label" for="reponse">Reponse :</label>
          <textarea class="form-select" id="reponse" name="reponse" v-model="reponse" multiple></textarea><br>

          <input class="form-input" type="submit" value="modifier">

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
      quizzs:{
        type:Array,
        default:()=>[],
      }
    },
    data(){
        return{
            showModalImage:false,
            showModalQcm:false,
            showModalVf:false,
            showEditQcm:false,
            showEditImage:false,
            showEditVf:false,
            question:null,
            image:null,
            reponse:null,
            choix1:null,
            choix2:null,
            choix3:null,
            choix4:null,
            id:null,
        }
    },
    methods:{
        handleFileChange(event) {
            this.image = event.target.files[0]; 
        },
        reset() {
            this.question = null,
            this.image = null,
            this.reponse = null,
            this.choix1 = null,
            this.choix2 = null,
            this.choix3 = null,
            this.choix4 = null,
            this.id = null
        },
        hideEditImage(){
            this.showEditImage = !this.showEditImage;
            if(this.showEditImage == true){
                this.question = quizz.question;
                this.image = quizz.image;
                this.reponse = quizz.reponse;
                this.id = quizz.id
            }else{
                this.question = null;
                this.image = null;
                this.reponse = quizz.reponse;
                this.id = null;

            }
        },

        // gérer les quizz images
        closeModalImage() {
            this.showModalImage = false;
            this.reset();
        },
        openModalImage() {
            this.showModalImage = !this.showModalImage;
        },
        createImage() {
            const formData = new FormData();
                formData.append('question', this.question);
                formData.append('image', this.image);
                formData.append('reponse',this.reponse); 

                this.$inertia.post('/admin/quizzimage', formData,{
                onError: (errors) => {
                    console.error(errors);
                }}
                );
                this.reset();
                this.closeModalImage();
        },
        editImage(quizz){
            this.showEditImage = !this.showEditImage;
            if(this.showEditImage == true){
                this.question = quizz.question,
                this.image = quizz.quizzable.image,
                this.reponse = quizz.reponse
                this.id = quizz.id
            }else{
                this.question = null,
                this.image = null,
                this.reponse = null,
                this.id = null
            }
        },
        updateImage() {
            const formDataUpdate = new FormData();
            formDataUpdate.append('_method', 'PUT');
            formDataUpdate.append('question', this.question);
            formDataUpdate.append('image', this.image);
            formDataUpdate.append('reponse',this.reponse);  

            this.$inertia.post('/admin/quizzimage/' + this.id, formDataUpdate,{
                onError: (errors) => {
                    console.error(errors);
                }})
            this.reset();
            this.showEditImage = !this.showEditImage;
        },
        deleteImage(quizzimage) {
                if (!confirm('Supprimer le Quizz ?')) return;
                this.$inertia.delete('/admin/quizz/' + quizzimage.id)
        },

        // Gérer les QCM
        closeModalQcm() {
            this.showModalQcm = false;
            this.reset();
        },
        openModalQcm() {
            this.showModalQcm = !this.showModalQcm;
        },
        createQcm() {
            const formData = new FormData();
                formData.append('question', this.question);
                formData.append('reponse',this.reponse); 
                formData.append('choix1',this.choix1);
                formData.append('choix2',this.choix2);
                formData.append('choix3',this.choix3);
                formData.append('choix4',this.choix4);
                this.$inertia.post('/admin/qcm', formData,{
                onError: (errors) => {
                    console.error(errors);
                }}
                );
                this.reset();
                this.closeModalQcm();
        },
        editQcm(quizz){
            this.showEditQcm = !this.showEditQcm;
            if(this.showEditQcm == true){
                this.question = quizz.question,
                this.reponse = quizz.reponse,
                this.choix1 = quizz.quizzable.choix1,
                this.choix2 = quizz.quizzable.choix2,
                this.choix3 = quizz.quizzable.choix3,
                this.choix4 = quizz.quizzable.choix4,
                this.id = quizz.id
            }else{
                this.question = null,
                this.reponse = null,
                this.choix1 = null,
                this.choix2 = null,
                this.choix3 = null,
                this.choix4 = null,
                this.id = null
            }
        },
        updateQcm() {
            const formDataUpdate = new FormData();
            formDataUpdate.append('_method', 'PUT');
            formDataUpdate.append('question', this.question);
            formDataUpdate.append('reponse',this.reponse); 
            formDataUpdate.append('choix1',this.choix1);
            formDataUpdate.append('choix2',this.choix2);
            formDataUpdate.append('choix3',this.choix3);
            formDataUpdate.append('choix4',this.choix4);  

            this.$inertia.post('/admin/qcm/' + this.id, formDataUpdate,{
                onError: (errors) => {
                    console.error(errors);
                }})
            this.reset();
            this.showEditQcm = !this.showEditQcm;
        }, 
        deleteQcm(qcm) {
                if (!confirm('Supprimer le QCM ?')) return;
                this.$inertia.delete('/admin/quizz/' + qcm.id)
            },
        // Gérer les vrai ou faux

        closeModalVf() {
            this.showModalVf = false;
            this.reset();
        },
        openModalVf() {
            this.showModalVf = !this.showModalVf;
        },
        createVf() {
            const formData = new FormData();
                formData.append('question', this.question);
                formData.append('reponse',this.reponse); 
                this.$inertia.post('/admin/vraifaux', formData,{
                onError: (errors) => {
                    console.error(errors);
                }}
                );
                this.reset();
                this.closeModalVf();
        },
        editVf(quizz){
            this.showEditVf = !this.showEditVf;
            if(this.showEditVf == true){
                this.question = quizz.question,
                this.reponse = quizz.reponse
                this.id = quizz.id
            }else{
                this.question = null,
                this.reponse = null,
                this.id = null
            }
        },
        updateVf() {
            const formDataUpdate = new FormData();
            formDataUpdate.append('_method', 'PUT');
            formDataUpdate.append('question', this.question);
            formDataUpdate.append('reponse',this.reponse);  
            this.$inertia.post('/admin/vraifaux/' + this.id, formDataUpdate,{
                onError: (errors) => {
                    console.error(errors);
                }})
            this.reset();
            this.showEditVf = !this.showEditVf;
        }, 
        deleteVf(vf) {
                if (!confirm('Supprimer le vrai ou faux ?')) return;
                this.$inertia.delete('/admin/vraifaux/' + vf.id)
            }

    }
}</script>

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
    tr {
    display: table-row;
    vertical-align: inherit;
    border-color: inherit;
}
.row{
    display: flex;
    justify-content: space-between;
    align-items: center;
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

.quizz{
    width: 100rem;
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

textarea {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  font-size: 14px;
  resize: vertical; /* Permet de redimensionner la textarea verticalement */
}
</style>