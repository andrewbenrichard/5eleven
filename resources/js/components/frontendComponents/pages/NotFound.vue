<template>
  <div>
    <topHeader v-bind:pageTitle="pageTitle"/>
        <breadCrum v-bind:pageTitle="pageTitle" />

    
  <!-- 404 Title Section Start -->
        <div class="error-title">
            <div class="d-table">
                <div class="d-table-cell">
                    <h2><span>Oops!</span> Page not found</h2>
                </div>
            </div> 
        </div>
        <!-- 404 Title Section End -->

        <!-- 404 Section Start -->
        <div class="error-section pt-100 pb-70">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <div class="error-img">
                            <img src="assets/img/404.png" alt="error image">
                        </div>
                    </div>
                </div>

                <div class="theme-button text-center">
                    <a href="/" class="default-btn">go to home page</a>
                </div>
            </div>
        </div>
        <!-- 404 Section End -->
<Bottomfooter/>
  </div>
</template>

   
<script>
import topHeader from "../layouts/header.vue";
import Bottomfooter from "../layouts/footer.vue";
import breadCrum from "../components/breadcrum.vue";


export default {
  mounted() {
    console.log("404 mounted.");
  },
  components: {
    topHeader,
    Bottomfooter,
    breadCrum
  }, 
  data() {
    return {
       pageTitle: "Page not found",
    }
  },
};
</script>