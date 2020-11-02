<template>
   <header class="site-header header-5">
    <title>{{pageTitle}}</title>
    <div class="header-top bg-black pt-1">
      <div class="container">
        <div class="col-md-12">
          <div class="row justify-content-end">
            <ul class="header_list">
              


              <li>
                <router-link to="/stores">
                  <i class="icon fa fa-store text-white"></i>
                  <span class="text-white">Discover Stores</span>
                </router-link>
              </li>
              <li>
                <router-link to="/pages/track">
                  <i class="icon fa fa-history text-white">
                  </i>
                  <span class="text-white">Track Order</span>
                </router-link>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="py-md-4 py-4">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-12 col-lg-3 d-none d-md-flex align-items-center">
             <router-link class="navbar-brand logo d-none d-lg-block" to="/"> 
               <img class="img-fluid mobile-logo" src="/assets/images/5logo.png" alt=""> 
               <!-- <span class="eleven_mock">5Eleven</span> -->
              </router-link>
            </div>
          <div class="col-md-8 col-lg-7 col-sm-10 col-10">
            <div class="right-nav align-items-center d-flex justify-content-end">
              <form class="form-inline w-100">
                <input class="form-control form-breaker border-0 rounded-0 border-left col" type="search" placeholder="Enter Your Keyword" aria-label="Search">
                <button class="btn btn-black bg-black text-white col-auto rounded-right" type="submit"><i class="fa fa-search" aria-hidden="true"></i> </button>
              </form>
            </div>
          </div>
          <div class="col-md-4 col-lg-2 col-sm-2 col-2 pl-0">
            <div class="dropdown cart_dropdown"> 
              <a class="d-flex align-items-center cart-d" href="#"> <span class="px-2 py-1 rounded" data-cart-items="2"> <i class="fa fa-shopping-cart" aria-hidden="true"></i> </span>
                <div class="ml-2 d-none d-md-block cart-details"> <span class="text-white"><span class="label">Cart -</span> ₦7,052.00</span> </div>
              </a>
              <div class="cart_box dropdown-menu dropdown-menu-right">
                <ul class="cart_list">
                  <li> <a href="#" class="item_remove"><i class="ion-ios-close-empty"></i></a> <a href="#"><img src="assets/images/demo/f1.jpg" alt="cart_thumb1">Custom product 001</a> <span class="cart_quantity"> 1 x <span class="cart_amount"> <span class="price_symbole">₦</span></span>8,000.00</span> </li>
                  <li> <a href="#" class="item_remove"><i class="ion-ios-close-empty"></i></a> <a href="#"><img src="assets/images/demo/f1.jpg" alt="cart_thumb2">Demo Product 1</a> <span class="cart_quantity"> 1 x <span class="cart_amount"> <span class="price_symbole">₦</span></span>8,100.00</span> </li>
                </ul>
                <div class="cart_footer">
                  <p class="cart_total"><strong>Subtotal:</strong> <span class="cart_price"> <span class="price_symbole">₦</span></span>159.00</p>
                  <p class="cart_buttons">
                    <router-link to="/shop/cart" class="btn btn-secondary view-cart ml-2 mr-2">View Cart</router-link>
                    <router-link to="/shop/checkout" class="btn btn-yellow-dark ml-2 mr-2 checkout">Checkout</router-link>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="header-wrap" class="shadow-sm">
      <div class="container">
        <div class="row m-0"> 
          <!--menu start-->
               
          <div class="col p-0">
            <nav class="navbar navbar-expand-lg navbar-light position-static"> <a class="navbar-brand logo d-lg-none" href="index.html"> 
            <img class="img-fluid mobile-logo" src="/assets/images/5logo.png" alt="">
                           <!-- <span class="eleven_mock">5Eleven</span> -->

             </a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
              <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                  <li class="nav-item "> <a class="nav-link active" href="#" >Home</a>
                  </li>
                  <li class="nav-item dropdown position-static"> <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">All Products</a>
                    <div class="dropdown-menu w-100"> 
                      <!-- Tabs -->
                      <div class="container p-0">
                        <div class="row w-100 no-gutters">
                          <div class="col-lg-8 p-lg-3">
                            <div class="row">
                              <!-- enter feeds -->
                              <div class="col-12 col-md-3 col-sm-6" v-for="cat in cats" :key="cat.id"> 
                                <!-- Heading -->
                                <div class="mb-2 font-w-5 text-link">{{cat.category_name}}</div>
                                <!-- Links -->
                                <ul class="list-unstyled mb-6 mb-md-0">
                                    <li v-for="product in cat.products" :key="product.id"> 
                                      <router-link :to="'/product/'+product.product_slug">{{product.product_title}}</router-link>
                                      </li>
                                   
                                </ul>
                              </div>
                             

                            </div>
                          </div>
                          <div class="col-lg-4 d-none d-lg-block pr-2"> <img class="img-fluid rounded-bottom rounded-top" src="assets/images/demo/car_mock.png" alt="..."> </div>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li class="nav-item  position-static"> <a class="nav-link" href="#" >Business Cards </a>
                  </li>
                  <li class="nav-item "> <a class="nav-link " href="#" >Get Price Quote</a>
                  </li>
                  <li class="nav-item "> <a class="nav-link " href="#" >Reseller</a></li>
                  <li class="nav-item"> <a class="nav-link" href="#">Logo Design</a> </li>
                  <li class="nav-item"> <a class="nav-link" href="#">Cost Calculator</a> </li>
                  <li class="nav-item"> <a class="nav-link" href="#">How it Works</a> </li>
                  <li class="nav-item"> <a class="nav-link text-white"  href="#">Help Desk</a> </li>
                  <!-- <li class="nav-item"> <a class="nav-link text-yellow" href="#">Todays Offer</a> </li> -->
                </ul>
              </div>
            </nav>
          </div>
          <!--menu end--> 
        </div>
      </div>
    </div>
  </header>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
export default {
  mounted() {
    console.log("header mounted.");
  },
    
  props: ['pageTitle'],
  data() {
    return {
      activeItem: 0,
      cats: {},
    };
  },
  computed: {
    ...mapGetters({
      authenticated: "auth/authenticated",
      user: "auth/user"
    })
  },
  methods: {
    ...mapActions({
      signOutAction: "auth/signOut"
    }),
    signOut() {
      this.signOutAction().then(() => {
        this.$router.replace({
          name: "home"
        });
      });
    },

    loadTopCats() {
      axios
        .get("/api/sc_front/top_cats")
        .then(({ data }) => (this.cats = data));
    },

  },
  
  created() {
    this.loadTopCats();
  }
};
</script>

