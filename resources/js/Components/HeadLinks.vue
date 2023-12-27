<script setup>
import {Link}  from "@inertiajs/inertia-vue3";
import logoMonkey from '@/Components/logoMonkey.vue'
</script>

<template>
    <header>
    <logoMonkey></logoMonkey>
        <nav>
          <ul class="nav container">
            <li class="nav-item">
              <Link :href="route('home')" class="nav-link">Accueil</Link>
            </li>
            <li class="nav-item">
              <Link :href="route('programme')" class="nav-link">Programme</Link>
            </li>
            <li class="nav-item">
              <Link :href="route('galerie')" class="nav-link">Galerie</Link>
            </li>
            <li class="nav-item">
              <Link :href="route('contact')" class="nav-link">Contact</Link>
            </li>
            <li class="nav-item">
              <Link :href="route('quizz')" class="nav-link">Quizz</Link>
            </li>
          </ul>
        </nav>
    </header>
    <div class="gradient"></div>
</template>

<style scoped>
header {
    height:var(--height-header);
    display:flex;
    align-items:center;
    background-color: #FFDFC2;
    border-bottom: 1px #8C6249 solid; 
    flex-direction: column;
    width: 100%;
    z-index: 2;
    top: 0;
    
  }
header div {
    display: flex;
    flex-direction: column;
}
header ul{
    font-family: 'GoboldUplow';
    font-size: 21px;
   
} 
.container {
  width: 100%; 
  max-width: 75rem; 
  margin: 0 auto; 
  padding: 15px; 
  box-sizing: border-box; 
}
.nav {
  display: flex;
  flex-wrap: wrap;
  margin-bottom: 0;
  list-style: none;
  justify-content: center;
  transform: translateY(-3.2rem);
}
.nav .container {
  display: flex;
}
.nav-link {
    display: list-item;
    color:#402927;
    padding-left: 1rem;
    padding-right: 1rem;
    padding-bottom: 0.5rem;
    height: auto;
    width: auto;
  }
.nav-link:hover {
  color:#8C324A;  
}  
.gradient{
    width: 100%;
    height: 10px;
    margin-bottom: 40px; /*alors a voir si on garde ca */
    background: linear-gradient(#8C6249,#ffffff);
  }
@media screen and (min-width: 768px){  
}
@media (min-width: 992px) {
  .col-lg-4 {
    width: 33.3333%;
    float: left;
  }
}
@media (min-width: 576px) and (max-width: 991px) {
  .col-sm-6 {
    width: 50%;
    float: left;
}
}
</style>

