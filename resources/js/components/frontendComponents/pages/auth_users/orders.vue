<template>
  <div class="home__holder">
    <topHeader />

    <Bottomfooter />
  </div>
</template>
<script>
import topHeader from "../layouts/header.vue";
import Bottomfooter from "../layouts/footer.vue";
export default {
  mounted() {
    console.log("Component mounted.");
  },
  components: {
    topHeader,
    Bottomfooter
  }
};
</script>
