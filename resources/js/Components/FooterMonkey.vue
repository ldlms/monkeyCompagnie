<script>
export default{
    data(){
        return{
            email:null,
        }
    },
    methods:{
        subscribe(){
            this.$inertia.post('/newsletter',{mail:this.email});
            this.email = null;
        }
    }
}
</script>

<template>
    <div class="gradient-inverser"></div>
    <footer>
      <div class="footer-top">
          <div class="container-top">
              <div class="row-top">
                  <div class="col-lg-4 col-sm-6">
                      <div class="address">
                          <h4>La Monkey compagnie</h4>
                          <p class="mb-4 mt-4">Adresse postale</p>
                          <p><strong>Phone:</strong> 0607080910</p>
                          <p><strong>Email:</strong> monkey.compagnie@outlook.fr</p>
                      </div>
                  </div>

                  <div class="col-lg-4 col-sm-6 footer-menus">
                      <h4>Liens utiles</h4>
                      <ul>
                          <li><i class="fas fa-check"></i> <a href="/mentions">Mentions légales</a></li>
                      </ul>
                  </div>

               

                  <div class="col-lg-4 col-sm-6 newsletter">
                      <h4>Newsletter</h4>
                      <p>Restez informés des évènements à venir en vous inscrivant à la newsletter de la compagnie.</p>
                      <form @submit.prevent="subscribe"><input type="email" name="email" v-model="email" /><input type="submit" value="S'inscrire" /></form>

                      <div class="social-links mt-3">
                          <a href="https://www.facebook.com/profile.php?id=100093526685100" target="_blank" rel="external" alt="facebook"><i class="fab fa-facebook"></i></a>
                          <a href="https://www.linkedin.com/company/la-monkey-compagnie/" target="_blank" rel="external" alt="linkedin"><i class="fab fa-linkedin-in"></i></a>
                          <a href="https://www.instagram.com/monkey.compagnie/" target="_blank" rel="external" alt="instagram"><i class="fab fa-instagram"></i></a>
                      </div>
                  </div>
              </div>
          </div>
      </div>

      <div class="footer-bottom">
          <div class="container-bot">
              <div class="row-bot">
                  <div class="col-12">
                      <p class="text-center mb-2">&copy; Copyright <strong>La Monkey compagnie</strong>. Tous droits réservés.</p>
                      <p class="text-center mb-0">Made with ❤️  by <a href="#">Sayuri</a></p>
                  </div>
              </div>
          </div>
      </div>
    </footer>
</template>

<style scoped>
footer {
    background: #8C6249;
    color: #fff;
    font-size: 0.875rem;
    width: 100%;
    bottom: 0rem;
}
.container-top { 
width: 100%; 
padding-right: calc(1.5rem * 1);
padding-left: calc(1.5rem * 1);
}
.container-bot{
width: 100%; 
padding-right: calc(1.5rem * 1);
padding-left: calc(1.5rem * 1);
} 
.row-top{
    display: flex;
    flex-wrap: wrap;
    margin-top: calc(-1.5rem * 0.5);
}
.row-bot{
    display: flex;
    flex-wrap: wrap;
    margin-top: calc(-1.5rem * 0.5);
    justify-content: center;
}
footer .footer-top {
    background: #402927;
    padding: 1rem 0rem 1.25rem;
}
footer .address p {
    font-size: 16px;
    color: #ddd;
    font-style: italic;
}
footer .social-links a {
    font-size: 17px;
    display: inline-block;
    background: #28251f;
    color: #fff;
  
    line-height: 1;
    padding: 9px 0;
    margin-right: 5px;
    border-radius: 100%;
    text-align: center;
    width: 36px;
    height: 36px;
    transition: 0.4s;
}
footer .social-links a:hover {
    background: #BF455B;
}
footer h4 {
    font-size: 18px;
    color: #f2d5bb;
    padding-bottom: 12px;
}
footer .footer-menus {
    margin-bottom: 30px;
}
footer .footer-menus ul {
    list-style: none;
    padding: 0;
    margin: 0;
}
footer .footer-menus ul li {
    margin-bottom: 10px;
}
footer .footer-menus ul i {
    color: #ffffff;
    font-size: 12px;
    margin-right: 3px;
}
footer .footer-menus ul a {
    color: #fff;
    text-decoration: none;
}
footer .footer-menus ul a:hover {
    text-decoration: underline;
}
footer .newsletter form {
    margin-top: 30px;
    background: #fff;
    padding: 6px 10px;
    position: relative;
    border-radius: 50px;
    border: 1px solid #3a3a3a;
}
footer .newsletter form input[type="email"] {
    border: 0;
    padding: 5px;
    background: #fff;
    color: #000;
}
footer .newsletter form input[type="email"]:focus {
    outline: none;
}
footer .newsletter form input[type="submit"] {
    position: absolute;
    top: -1px;
    right: -1px;
    bottom: -1px;
    border: 0;
    font-size: 16px;
    background: #28251f;
    color: #fff;
    border-bottom-right-radius: 50px;
    border-top-right-radius: 50px;
}
footer .newsletter form input[type="submit"]:hover {
    background: #BF455B;
}
.footer-bottom {
    padding: 20px 0px;
}
footer .footer-bottom a {
    color: #61F2C2;
    text-decoration: none;
} 
.nav-container {
  display: flex;
  justify-content: center;
}
.mb-4 {
  margin-bottom: 1.5rem; /* Ajoute une marge de 1.5 rem en bas */
}
.mt-4 {
  margin-top: 1.5rem; /* Ajoute une marge de 1.5 rem en haut */
}
.text-center {
  text-align: center; /* Centre le texte horizontalement */
}

.mb-2 {
  margin-bottom: 0.5rem; /* Ajoute une marge de 0.5 rem en bas */
}
.row-top>*{
    padding-left: calc(-1.5rem * 0.5);
    padding-right: calc(-1.5rem * 0.5);
}
.mb-0 {
  margin-bottom: 0;
}
.gradient-inverser{
    height: 10px;
    background: linear-gradient(#ffffff,#402927);
}
/* .newsletter{
    margin-right: 5%;
} */
@media screen and (min-width: 768px){ 
    footer {
    background: #8C6249;
    height: var(--height-footer);
    color: #fff;
    font-size: 0.875rem;
    width: 100%;
    position: relative;
    bottom: 0rem;
}
.gradient-inverser{
    width: 100%;
    height: 10px;
    background: linear-gradient(#ffffff,#402927);
}
}
@media (min-width: 992px) {
  .col-lg-4 {
    width: 33.3333%;
    flex: 0 0 auto;
  }
}
@media (min-width: 576px) and (max-width: 991px) {
  .col-sm-6 {
    width: 50%;
    flex: 0 0 auto;
  }
}
</style>