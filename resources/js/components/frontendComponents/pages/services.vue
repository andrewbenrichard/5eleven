<template>
  <div class="site-wrapper">
    <topHeader v-bind:pageTitle="pageName" />
    <breadCrum v-bind:pageTitle="pageName" />

    <ServicesGrid v-bind:services="services"/>
    <ContactSection />

    <Bottomfooter />
  </div>
</template>

<script>
import topHeader from "../layouts/header.vue";
import Bottomfooter from "../layouts/footer.vue";
import preloader from "../widgets/preloader.vue";
import breadCrum from "../components/breadcrum.vue";
import ServicesGrid from "../components/services-grid.vue";
import ContactSection from "../components/ContactSection.vue";

export default {
  mounted() {
  },
  components: {
    topHeader,
    Bottomfooter,
    breadCrum,
    ServicesGrid,
    ContactSection,
  },
  data() {
    return {
      testimonials: {},
      services: {},
      pageName: "Services"
    };
  },
  methods: {
    loadServices() {
      axios
        .get("/api/sc_front/services")
        .then(({ data }) => (this.services = data));
    }
  },
  created() {
    this.loadServices();
  }
};
</script>
