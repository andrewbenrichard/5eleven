<template>
  <div class="site-wrapper">
    <topHeader v-bind:pageTitle="pageName" />
    <breadCrum v-bind:pageTitle="pageName" />

    <Pricing />
    <ContactSection />

    <Bottomfooter />
  </div>
</template>

<script>
import topHeader from "../layouts/header.vue";
import Bottomfooter from "../layouts/footer.vue";
import preloader from "../widgets/preloader.vue";
import breadCrum from "../components/breadcrum.vue";
import Pricing from "../components/Pricing-style-1.vue";
import ContactSection from "../components/ContactSection.vue";

export default {
  mounted() {
  },
  components: {
    topHeader,
    Bottomfooter,
    breadCrum,
    Pricing,
    ContactSection,
  },
  data() {
    return {
      testimonials: {},
      services: {},
      pageName: "Our Pricing"
    };
  },
  methods: {
    loadServices() {
      axios
        .get("/api/sc_front/articles_mini")
        .then(({ data }) => (this.services = data));
    }
  },
  created() {
    this.$route.params;
  }
};
</script>
