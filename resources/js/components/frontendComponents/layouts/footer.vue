<template>

<footer class="py-7 bg-white">
  <div class="container">
    <div class="row">
      <div class="col-12 col-lg-4"> <a class="footer-logo text-dark h2 mb-0" href="index.html">
        <img class="img-fluid footer-logo" src="assets/images/LOGO 5ELEVEN.png" alt="">
        <!-- <span class="eleven_mock_footer">5Eleven</span> -->
      </a>
        <p class="my-3 text-dark pr-6">Demo Content here</p>
        <ul class="list-inline mb-0">
          <li class="list-inline-item"><a class=" text-dark ic-2x" href="#"><i class="la la-facebook"></i></a>
          </li>
          <li class="list-inline-item"><a class=" text-dark ic-2x" href="#"><i class="la la-instagram"></i></a>
          </li>
          <li class="list-inline-item"><a class=" text-dark ic-2x" href="#"><i class="la la-twitter"></i></a>
          </li>
          <li class="list-inline-item"><a class=" text-dark ic-2x" href="#"><i class="la la-linkedin"></i></a>
          </li>
        </ul>
      </div>
      <div class="col-12 col-lg-8 mt-6 mt-lg-0">
        <div class="row">
          <div class="col-12 col-sm-4 navbar-white">
            <h6 class="mb-4 text-dark font-w-5 txt-transform">Quick Links</h6>
            <ul class="navbar-nav list-unstyled mb-0">
              <li class="mb-3 nav-item"><a class="nav-link text-dark font-w-4" href="#">Shipment</a>
              </li>
              <li class="mb-3 nav-item"><a class="nav-link text-dark font-w-4" href="#">About</a>
              </li>
              <li class="mb-3 nav-item"><a class="nav-link text-dark font-w-4" href="#">Shop</a>
              </li>
              <li class="mb-3 nav-item"><a class="nav-link text-dark font-w-4" href="#">Faq</a>
              </li>
              <li class="mb-3 nav-item"><a class="nav-link text-dark font-w-4" href="#">Blogs</a>
              </li>
              <li class="nav-item"><a class="nav-link text-dark font-w-4" href="#">Contact Us</a>
              </li>
            </ul>
          </div>
          
          <div class="col-12 col-sm-4 mt-6 mt-sm-0 navbar-white">
            <h6 class="mb-4 text-dark font-w-5 txt-transform">Information</h6>
            <ul class="navbar-nav list-unstyled mb-0">
              <li class="mb-3 nav-item"><a class="nav-link text-dark font-w-4" href="#">Term Of Service</a>
              </li>
              <li class="mb-3 nav-item"><a class="nav-link text-dark font-w-4" href="#">Privacy Policy</a>
              </li>
              <li class="mb-3 nav-item"><a class="nav-link text-dark font-w-4" href="#">Support</a>
              </li>
              <li class="mb-3 nav-item"><a class="nav-link text-dark font-w-4" href="#">Orders History</a>
              </li>
              <li class="mb-3 nav-item"><a class="nav-link text-dark font-w-4" href="#">Your Account</a>
              </li>
              <li class="nav-item"><a class="nav-link text-dark font-w-4" href="#">Suppliers</a>
              </li>
            </ul>
          </div>
          <div class="col-12 col-sm-4 mt-6 mt-sm-0 navbar-white">
            <h6 class="mb-4 text-dark font-w-5 txt-transform">Shopping Guide</h6>
            <ul class="navbar-nav list-unstyled mb-0">
              <li class="mb-3 nav-item"><a class="nav-link text-dark font-w-4" href="#">Site Map</a>
              </li>
              <li class="mb-3 nav-item"><a class="nav-link text-dark font-w-4" href="#">Search Terms</a>
              </li>
              <li class="mb-3 nav-item"><a class="nav-link text-dark font-w-4" href="#">Advanced Search</a>
              </li>
              <li class="mb-3 nav-item"><a class="nav-link text-dark font-w-4" href="#">Return policy</a>
              </li>
              <li class="mb-3 nav-item"><a class="nav-link text-dark font-w-4" href="#">Where is my order?</a>
              </li>
              <li class="nav-item"><a class="nav-link text-dark font-w-4" href="#">Our Story</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      
    </div>
    
    <hr class="my-6 light-border">
    <div class="row text-dark align-items-center">
      <div class="col-md-7 font-w-4"><small>Copyright ©2020 5Eleven. All Rights Reserved.</small>
      </div>
      <!-- <div class="col-md-5 text-md-right mt-3 mt-md-0">
        <ul class="list-inline mb-0">
          <li class="list-inline-item">
            <a href="#">
              <img class="img-fluid" src="assets/images/pay-icon/01.png" alt="">
            </a>
          </li>
          <li class="list-inline-item">
            <a href="#">
              <img class="img-fluid" src="assets/images/pay-icon/02.png" alt="">
            </a>
          </li>
          <li class="list-inline-item">
            <a href="#">
              <img class="img-fluid" src="assets/images/pay-icon/03.png" alt="">
            </a>
          </li>
          <li class="list-inline-item">
            <a href="#">
              <img class="img-fluid" src="assets/images/pay-icon/04.png" alt="">
            </a>
          </li>
        </ul>
      </div> -->
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
