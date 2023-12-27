<template>

<div class="container">
<ul v-for="newlet in news">
<li>{{ newlet.mail }}</li>
<td v-if="supprimer!=null"><button @click="deleten(newlet)">Supprimer</button></td>
</ul>
<button @click="supp()">Supprimer une adresse mail</button>
</div>

</template>

<script>
import { Link } from '@inertiajs/vue3';
import panel from './Panel.vue'
export default{
    layout:panel,
    props:{
        news:{
            type:Array,
            default:() => {}
        }
    },
    data(){
        return{
            supprimer:null
        }
    },
    methods:{
        deleten(newlet){
            if (!confirm('Supprimer le mail ?')) return;
            this.$inertia.delete('/admin/newsletter/' + newlet.id)
        },
        supp(){
            if(this.supprimer==null){
                this.supprimer = 1;
            }else{
                this.supprimer = null
            }
        }
    }
}
</script>

<style scoped></style>