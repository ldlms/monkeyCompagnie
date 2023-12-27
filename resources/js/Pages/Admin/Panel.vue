<script>
import { Link } from "@inertiajs/inertia-vue3";
export default{
  data(){
  },
  components:{
    Link
  },
  methods:{
    deco(){
      const url = route('logout');
      visit(url);
    }
  }
}


</script>

<template>
    <nav class="navbar">
          <ul>
            <li>
              <Link href="/admin/evenements" class="nav-link">Evenement</Link>
            </li>
            <li>
              <Link href="/admin/images" class="nav-link">Images</Link>
            </li>
            <li>
              <Link href="/admin/equipe" class="nav-link">Equipiers</Link>
            </li>
            <li>
              <Link href="/admin/quizz" class="nav-link">Quizz</Link>
            </li>
            <li>
              <Link href="/admin/albums" class="nav-link">Album</Link>
            </li>
            <li>
              <Link href="/admin/newsletter" class="nav-link">Newsletter</Link>
            </li>
          </ul>
          <Link href="/logout" method="post" as="button" type="button">Logout</Link>
        </nav>
        <slot></slot>
</template>

<style scoped>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

/* Styles généraux de la barre de navigation */
.navbar {
  display: flex;
  align-items: center; /* Alignement vertical des éléments */
  background-color: #222;
  padding: 20px;
  color: #fff;
}

/* Styles de la liste */
.navbar ul {
  list-style: none;
  display: flex; /* Afficher les éléments en ligne */
}

/* Styles des éléments de la liste */
.navbar li {
  margin: 0 10px; /* Espacement entre les éléments */
}

/* Styles des liens */
.navbar a {
  text-decoration: none;
  color: #fff;
  transition: 0.3s;
  padding: 5px 10px;
}

/* Styles au survol des liens */
.navbar a:hover {
  color: #00bcd4;
}

/* Styles du bouton */
.navbar button {
  margin-left: auto; /* Pousse le bouton à droite */
  padding: 10px 20px;
  background-color: #00bcd4;
  color: #fff;
  border: none;
  cursor: pointer;
  transition: 0.3s;
}

/* Styles au survol du bouton */
.navbar button:hover {
  background-color: #008c9e;
}
</style>