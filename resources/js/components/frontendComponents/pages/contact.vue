<template>
  <div class="site-wrapper">
    <topHeader v-bind:pageTitle="pageName" />
    <breadCrum v-bind:pageTitle="pageName" />

    <Priing />
    <ContactSection />
    <ContactInfo />

    <Bottomfooter />
  </div>
</template>

<script>
import topHeader from "../layouts/header.vue";
import Bottomfooter from "../layouts/footer-2.vue";
import preloader from "../widgets/preloader.vue";
import breadCrum from "../components/breadcrum.vue";
import ContactSection from "../components/ContactSection2.vue";
import ContactInfo from "../components/ContactInfo.vue";

export default {
  mounted() {
  },
  components: {
    topHeader,
    Bottomfooter,
    breadCrum,
    ContactSection,
    ContactInfo,
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
