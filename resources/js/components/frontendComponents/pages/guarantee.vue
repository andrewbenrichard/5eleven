<template>
  <div class="home__holder">
    <topHeader v-bind:pageTitle="pageTitle"/>

<breadCrum v-bind:pageTitle="pageTitle"/>
       <div class="about-style-two about-style-three ">
            <div class="container">
                <div class="row ">
                    <div class="col-md-12 text_per">
                      
                            <h2>Our guarantee
</h2>
                           <p>We only recruit skilled tradesmen who have the appropriate certifications, knowledge, experience and tools to carry out the jobs they’re booked to do. As part of our commitment to ensure that high standards are met for every job, our operations team continually assesses the quality of each tradesman’s work.</p>
                           <p>On occasion the quality of work on a job might not meet the standards we or our customer require. When the workmanship on a job has failed to meet the levels expected, we aim to correct things at no cost to the customer. We call it the Aspect Guarantee.

</p>
<p></p>



  </div>
                </div>

                
            </div>
        </div>


    <Bottomfooter />
  </div>
</template>
<script>
import topHeader from "../layouts/header.vue";
import Bottomfooter from "../layouts/footer.vue";
import breadCrum from "../components/breadcrum.vue";

export default {
  mounted() {
    console.log("Component mounted.");
  },
  data() {
    return {
      pageTitle: "Guarantees"
    }
  },
  components: {
    topHeader,
    Bottomfooter,
    breadCrum
  }
};
</script>
