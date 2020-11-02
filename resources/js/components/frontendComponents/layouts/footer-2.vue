<template>
 <footer class="footer-area footer-style-two pt-100">
            <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-6">
          <div class="footer-widget">
            <div class="logo">
              <router-link to="/">
                <img src="public/assets/img/logo-2.png" alt="logo" />
              </router-link>
            </div>
            <p>Book professional handymen with ease.</p>
           
          </div>
        </div>

        <div class="col-lg-3 col-md-6">
          <div class="footer-widget pl-40">
            <h3>Services</h3>
            <ul>
             <li v-for="(service, id) in services" :key="id">
                <i class="icofont-simple-right"></i>
                <router-link to="/booking">{{service.service_name}}</router-link>
              </li>
            </ul>
          </div>
        </div>

        <div class="col-lg-3 col-md-6">
          <div class="footer-widget pl-40">
            <h3>Company</h3>
            <ul>
              <li>
                <i class="icofont-simple-right"></i>
                <router-link to="/about-us">About us</router-link>
              </li>
              <li>
                <i class="icofont-simple-right"></i>
                <router-link to="/guarantee">Guarantee</router-link>
              </li>
              <li>
                <i class="icofont-simple-right"></i>
                <router-link to="/recruitment">Recruitment</router-link>
              </li>
              <li>
                <i class="icofont-simple-right"></i>
                <router-link to="/contact">Contact us</router-link>
              </li>
              
            </ul>
          </div>
        </div>

        <div class="col-lg-3 col-md-6">
          <div class="footer-widget">
            <h3>Find Us</h3>
            <ul class="find-us">
              <li>
                <i class="icofont-location-pin"></i>
               70 Airport Road, Benin city, Nigeria
              </li>
              <li>
                <i class="icofont-phone"></i>
                <a href="tel:+2348153372133">+234 8153 3721 33</a>
              </li>
              <li>
                <i class="icofont-ui-message"></i>
                <a href="mailto:bookings@myempirehomes.com">bookings@myempirehomes.com</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="bottom-footer">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6">
            <div class="footer-social">
              <ul>
                <li>
                  <a target="_blank" href="https://web.facebook.com/myempirehome">
                    <i class="icofont-facebook"></i>
                  </a>
                </li>
                <li>
                  <a  target="_blank" href="https://twitter.com/myempirehome">
                    <i class="icofont-twitter"></i>
                  </a>
                </li>
                <li>
                  <a target="_blank" href="https://www.instagram.com/myempirehome/">
                    <i class="icofont-instagram"></i>
                  </a>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="copyright-text text-right">
              <p>
                &copy;2020 My Empire Homes. All Rights Reserved 
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
        </footer>
        
    
</template>
<script>
export default {
  mounted() {
    console.log("footer mounted.");
  },
  data() {
    return {
      services: {}
    };
  },
  methods: {
     loadServices() {
      axios
        .get("/api/sc_front/services")
        .then(({ data }) => (this.services = data));
    },
  },
  created() {
    this.loadServices();
  }
};
</script>