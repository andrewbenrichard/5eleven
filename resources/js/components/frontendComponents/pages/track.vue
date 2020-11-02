<template>
  <div class="page-content">
    <topHeader v-bind:pageTitle="pageTitle" />
    <breadCrum v-bind:pageTitle="BreadTitle" />


<section>
  <div class="container">
   <div class="row">
     <div class="col-md-8">
       <h3>Track your print order without <br> hassle</h3>
       <p>Easily track the status your 5Eleven order using your order number <br> and see step by step progress on your order.</p>
      <form action="" method="post">
         <input type="text" placeholder="Order number" class=" form-breaker-border form-control border-0 rounded-0 border-left col">
       <button class="btn btn-info">Track now</button>
      </form>
       <p>If you would prefer to speak to someone personally <br> about the status of your order, please call </p>
     </div>
     <div class="col-md-4">
       <img class="track_header" src="/assets/images/about/eleven_delivery.svg" alt="">
     </div>
   </div>
  </div>
</section>
<Newsletter />

    <Bottomfooter />
  </div>
</template>
<script>
import topHeader from "../layouts/header.vue";
import Bottomfooter from "../layouts/footer.vue";
import breadCrum from "../components/breadcrum.vue";
import Newsletter from "../components/newsletter.vue";
export default {
  mounted() {
    console.log("Component mounted.");
  },
  components: {
    topHeader,
    Bottomfooter,
    breadCrum,
    Newsletter
  }, 
  data() {
    return {
    pageTitle: "Design and Print Business Cards, Flyers Online in Nigeria",
    BreadTitle: "Track orders",
    }
  }
};
</script>

<style lang="css">
  img.track_header {
    width: 120%;
}


</style>