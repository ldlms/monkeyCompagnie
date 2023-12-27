<template>
    <table class="styled-table">
        <thead>
            <tr></tr>
        </thead>
    <tbody>
        <tr v-if="!showEdit" v-for="evenement in evenements" :key="evenement.id">
            <td><img class="image-cell" :src="`../${evenement.image}`" alt="image"></td>
            <td>{{ evenement.nom }}</td>
            <td>{{ evenement.date }}</td>
            <td>{{ evenement.jour }}</td>
            <td>{{ evenement.heure }}H</td>
            <td>{{ evenement.lieu }}</td>
            <td>{{ evenement.metro }}</td>
            <td><button @click="editEV(evenement)">Modifier</button></td>
            <td><button @click="deleteEV(evenement)">Supprimer</button></td>
        </tr>
    </tbody>
    </table>
    <div class="form-buttons">
    <button class="form-button" @click="openModal">Ajouter un evènement</button>
    <button class="form-button" @click="openModalR">Ajouter un evènement hebdomadaire</button>
    </div>

    <!-- Modal -->
<teleport to="body">
    <div v-if="showModal">
        <form class="form-container" @submit.prevent="createEV" enctype="multipart/form-data">
            <label class="form-label" for="nom">Nom :</label>
            <input class="form-input" type="text" id="nom" name="nom" v-model="nom" required><br>

            <label class="form-label" for="date">Date :</label>
            <input class="form-input" type="date" id="date" name="date" v-model="date" required><br>

            <label class="form-label" for="jour">Jour :</label>
            <input class="form-input" type="text" id="jour" name="jour" v-model="jour" required><br>

            <label class="form-label" for="mois">Mois :</label>
            <input class="form-input" type="text" id="mois" name="mois" v-model="mois" required><br>

            <label class="form-label" for="heure">heure :</label>
            <input class="form-input" type="number" id="heure" name="heure" v-model="heure" required><br>

            <label class="form-label" for="lieu">lieu :</label>
            <input class="form-input" type="text" id="lieu" name="lieu" v-model="lieu" required><br>

            <label class="form-label" for="metro">metro :</label>
            <input class="form-input" type="text" id="metro" name="metro" v-model="metro" required><br>

            <label class="form-label" for="image">Image :</label>
            <input class="form-input" type="file" id="image" name="image" accept="image/jpeg, image/png" @change="handleFileChange" required><br>

            <input class="form-button" type="submit" value="Créer">

        </form>
    </div>
    <div v-if="showModalRecurring">
        <form class="form-container" @submit.prevent="createEVR" enctype="multipart/form-data">
        <label class="form-label" for="nom">nom :</label>
        <input class="form-input" type="text" id="nom" name="nom" v-model="nom" required><br>

        <label for="selected_day">Sélectionner le jour de la semaine :</label>
        <select id="selected_day" name="selected_day" v-model="jour" required>
            <option value="0">Dimanche</option>
            <option value="1">Lundi</option>
            <option value="2">Mardi</option>
            <option value="3">Mercredi</option>
            <option value="4">Jeudi</option>
            <option value="5">Vendredi</option>
            <option value="6">Samedi</option>
        </select>

        <label class="form-label" for="heure">heure :</label>
        <input class="form-input" type="number" id="heure" name="heure" v-model="heure" required><br>
        <label class="form-label" for="lieu">lieu :</label>
        <input class="form-input" type="text" id="lieu" name="lieu" v-model="lieu" required><br>

        <label class="form-label" for="metro">metro :</label>
        <input class="form-input" type="text" id="metro" name="metro" v-model="metro" required><br>

        <label class="form-label" for="image">Image :</label>
        <input class="form-input" type="file" id="image" name="image" accept="image/jpeg, image/png" @change="handleFileChange" required><br>

    <button type="submit">Créer l'évènement récurrent</button>
    </form>
    </div>
</teleport>

<teleport to="tbody">
    <div v-if="showEdit">
        <form class="form-container" @submit.prevent="updateEV()" enctype="multipart/form-data">
            <label class="form-label" for="nom">Nom :</label>
            <input class="form-input" type="text" id="nom" name="nom" v-model="nom" required><br>

            <label class="form-label" for="date">Date :</label>
            <textarea id="date" name="date" v-model="date" required></textarea><br>

            <label class="form-label" for="jour">Jour :</label>
            <input class="form-input" type="text" id="jour" name="jour" v-model="jour" required><br>

            <label class="form-label" for="mois">Mois :</label>
            <input class="form-input" type="text" id="mois" name="mois" v-model="mois" required><br>

            <label class="form-label" for="heure">heure :</label>
            <input class="form-input" type="number" id="heure" name="heure" v-model="heure" required><br>

            <label class="form-label" for="lieu">lieu :</label>
            <input class="form-input" type="text" id="lieu" name="lieu" v-model="lieu" required><br>

            <label class="form-label" for="metro">metro :</label>
            <input class="form-input" type="text" id="metro" name="metro" v-model="metro" required><br>

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
       evenements:{
        type:Array,
        default:()=>[],
       }, 
    },
    data(){
        return{
            showModal:false,
            showModalRecurring:false,
            showEdit:false,
                nom:null,
                jour:null,
                date:null,
                mois:null,
                heure:null,
                lieu:null,
                image:null,
                metro:null
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
        openModalR(){
            this.showModalRecurring = !this.showModalRecurring;
        },
        reset() {
            this.nom=null,
            this.jour=null,
            this.date=null,
            this.mois=null,
            this.heure=null,
            this.lieu=null,
            this.image=null,
            this.metro=null,
            this.id=null

        },
        createEV() {
            const formData = new FormData();
                formData.append('nom', this.nom);
                formData.append('jour', this.jour);
                formData.append('date', this.date); 
                formData.append('mois', this.mois);
                formData.append('heure', this.heure);
                formData.append('lieu', this.lieu);
                formData.append('image', this.image);
                formData.append('metro', this.metro);

            this.$inertia.post('/admin/evenements', formData)
            this.reset();
            this.closeModal();
        },
        createEVR(){
            const formData = new FormData();
                formData.append('_method', 'POST');
                formData.append('nom', this.nom);
                formData.append('heure', this.heure);
                formData.append('lieu', this.lieu);
                formData.append('image', this.image);
                formData.append('metro', this.metro);
                formData.append('selected_day',this.jour);

                this.$inertia.post('/admin/evenements/recurring', formData) 
            this.reset();
            this.closeModal();
        },
        editEV(evenement) {
            this.showEdit = !this.showEdit;
            if(this.showEdit === true){
                this.nom = evenement.nom,
                this.jour = evenement.jour,
                this.date = evenement.date,
                this.mois = evenement.mois,
                this.heure = evenement.heure,
                this.lieu = evenement.lieu,
                this.image = evenement.image,
                this.metro = evenement.metro
                this.id = evenement.id
            }else{
                this.nom = null,
                this.jour = null,
                this.date = null,
                this.mois = null,
                this.heure = null,
                this.lieu = null,
                this.image = null,
                this.metro = null,
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
        updateEV() {
            const formDataUpdate = new FormData();
                formDataUpdate.append('_method', 'PUT');
                formDataUpdate.append('nom', this.nom);
                formDataUpdate.append('jour', this.jour);
                formDataUpdate.append('date', this.date); 
                formDataUpdate.append('mois', this.mois);
                formDataUpdate.append('heure', this.heure);
                formDataUpdate.append('lieu', this.lieu);
                formDataUpdate.append('image', this.image);
                formDataUpdate.append('metro', this.metro);

            this.$inertia.post('/admin/evenements/'+this.id, formDataUpdate)
            this.reset();
            this.showEdit = false;
        },
        deleteEV(evenement) {
                if (!confirm('Supprimer l\'evenement ?')) return;
                this.$inertia.delete('/admin/evenements/' + evenement.id)
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