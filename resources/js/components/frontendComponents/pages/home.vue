<template>
  <div class="page-wrapper">
    <topHeader pageTitle="Design and Print Business Cards, Flyers Online in Nigeria" />

 
  <section class="banner pos-r p-0 banner-full-img">
   <div class="container-fluid">
     <div class="row">
       <div class="col-lg-6 col-sm-12">
         <div class="header_banner">
           <h1>Get your premium and quality prints</h1>
           <p>Quickly print your business stationary, business cards, letter heads and more 
          </p>
          <div class="header_cta">
            <p class="explore_but">
              <a href="#" class="btn btn-secondary  ml-2 mr-2">Browse designs</a>
              <a href="#" class="btn btn-yellow-dark ml-2 mr-2 upload_btn"><i class="las la-magic"></i>  Upload your design</a></p>

          </div>
         </div>
       </div>
       <div class="col-lg-6 showviewer">
         <div class="service_holder">
           <div class="tech-slideshow">
             <div class="mover-1">
               <figure  class="holders">
                 <img src="assets/images/header_animate/1.png" alt="">
               </figure>
               <figure  class="holders">
                 <img src="assets/images/header_animate/2.png" alt="">
               </figure>
               <figure  class="holders">
                 <img src="assets/images/header_animate/3.png" alt="">
               </figure>
               <figure  class="holders">
                 <img src="assets/images/header_animate/4.png" alt="">
               </figure>
               <figure class="holders">
                 <img src="assets/images/header_animate/5.png" alt="">
               </figure>
               <figure class="holders">
                 <img src="assets/images/header_animate/6.png" alt="">
               </figure>
               <figure class="holders">
                 <img src="assets/images/header_animate/7.png" alt="">
               </figure>
               <figure class="holders">
                 <img src="assets/images/header_animate/8.png" alt="">
               </figure>
               <figure class="holders">
                 <img src="assets/images/header_animate/9.png" alt="">
               </figure>
               <figure class="holders">
                 <img src="assets/images/header_animate/10.png" alt="">
               </figure>
               <figure class="holders">
                 <img src="assets/images/header_animate/11.png" alt="">
               </figure>
               <figure class="holders">
                 <img src="assets/images/header_animate/12.png" alt="">
               </figure>
             </div>
             <div class="mover-2"></div>
           </div>

         </div>
       </div>
     </div>
   </div>
  </section>
  
  <stepsHTW/>


  <div class="page-content"> 
   <TopService/>
   <HomeProducts/>
   <Testimonial/>

  
    <!-- <ProductOwl v-bind:services="services"/> -->
    <ProductOwl/>
    

   <Features />
   </div>

    <Bottomfooter />
  </div>
</template>

<script>
import topHeader from "../layouts/header.vue";
import Bottomfooter from "../layouts/footer.vue";
import stepsHTW from "../components/5step.vue";
import TopService from "../components/TopService.vue";
import ProductOwl from "../components/products-owl.vue";
import HomeProducts from "../components/5products.vue";
import Features from "../components/features.vue";
import Testimonial from "../components/Testimonial.vue";
// import BlogSection from "../components/BlogSection.vue";

export default {
  mounted() {
    console.log("Component mounted.");
  },
  components: {
    topHeader,
    Bottomfooter,
    ProductOwl,
    stepsHTW,
    TopService,
    Features,
    Testimonial,
    HomeProducts,
    // BlogSection,
  },
  data() {
    return {
      services: {}
    };
  },
   methods: {
   
  },
  created() {
  }
};
</script>

