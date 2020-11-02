<template>
  <div class="componet_holder">
    <topHeader />

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">
      <div class="overlay"></div>
      <div class="search-overlay"></div>

      <sidebar />

      <!--  BEGIN CONTENT AREA  -->
      <div id="content" class="main-content">
        <div class="layout-px-spacing">
          <div class="row layout-top-spacing">
            <div class="col-md-12"></div>

            <div class="col-xl-4 col-lg-6 col-md-6 mb-4">
              <div class="card component-card_9">
                <img
                  :src="'/uploads/' + product.product_image"
                  class="card-img-top"
                  alt="widget-card-2"
                />
                <div class="card-body">
                  <h5 class="card-title">{{ product.product_title }}</h5>
                  <p class="card-text" v-html="product.product_des"/>

                  <div class="meta-info">

                    <div class="meta-action">
                     

                      <div class="meta-view">{{ product.category }}</div>
                    </div>
                  </div>
                

                  <router-link class="btn btn-dark btn-block mb-2 mr-2 btn-rounded" :to="'/prime/dashboard/product/materials/' + main_slug"
                  >
                    Add Materials
                   
                  </router-link>
                </div>
              </div>
            </div>

            <div
              class="col-xl-8 col-lg-6 col-md-6 col-sm-12 col-12"
              style="margin-bottom: 24px"
            >
              <div class="statbox widget box box-shadow">
                
                <div
                  class="widget-content widget-content-area"
                  style="height: 571px"
                >
                <h4>Add {{product.category}} Images</h4>
                 
              <button class="btn btn-primary btn-block mb-2 mr-2 btn-rounded" @click="newImage"
                  >
                    Add Gallery
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      width="24"
                      height="24"
                      viewBox="0 0 24 24"
                      fill="none"
                      stroke="currentColor"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      class="feather feather-image"
                    >
                      <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />
                      <circle cx="8.5" cy="8.5" r="1.5" />
                      <polyline points="21 15 16 10 5 21" />
                    </svg>
                  </button>
                  <div class="galleries_">
                    
                    <div class="row">
                      <div class="col-md-4" v-for="gallery in galleries" :key="gallery.id">
                        <div class="card component-card_9">
                          <img
                              :src="'/uploads/' + gallery.image"
                              class="card-img-top"
                              alt="widget-card-2"
                            />
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>

        <div
          class="modal fade"
          id="newImage"
          tabindex="-1"
          role="dialog"
          aria-labelledby="MealModalLabel"
          aria-hidden="true"
        >
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="MealModalLabel">Add Product Images</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form @submit.prevent="saveUpload">
                  <div class="modal-body">
                     
                    <div class="form-group">
                      <input
                        name="product_image"
                        @change="CreateImage"
                        type="file"
                        :class="{
                                                    'is-invalid': uploadForm.errors.has(
                                                        'product_image'
                                                    )
                                                }"
                      />
                      <has-error :uploadForm="form" field="product_image"></has-error>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" v-show="!uploadSavingBtn" class="btn btn-primary">upload</button>
                    <button class="btn btn-primary" v-show="uploadSavingBtn">
                      <div class="spinner-border text-white align-self-center loader-sm"></div>Loading
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

        <bottomFooter />
      </div>
      <!--  END CONTENT AREA  -->
    </div>
    <!-- END MAIN CONTAINER -->
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import topHeader from "../layouts/header.vue";
import sidebar from "../layouts/sidebar.vue";
import bottomFooter from "../layouts/footer.vue";

export default {
  mounted() {
    this.$route.params;
  },
  data() {
    return {
      main_slug: this.$route.params.slug,
      product: {
        id: "",
        product_title: "",
        product_image: "",
        product_slug: "",
      },
      galleries: {},
      savingBtn: false,
      uploadSavingBtn: false,
     
      uploadForm: new Form({
        product: this.$route.params.slug,
        product_image: "",
      }),
    };
  },
  components: {
    topHeader,
    bottomFooter,
    sidebar,
  },
  computed: {
    ...mapGetters({
      authenticated: "auth/authenticated",
      user: "auth/user",
    }),
  },
  methods: {
    ...mapActions({
      signOutAction: "auth/signOut",
    }),
    signOut() {
      this.signOutAction().then(() => {
        this.$router.replace({
          name: "home",
        });
      });
    },

   newImage() {
      this.uploadForm.reset();
      $("#newImage").modal("show");
    },
      saveUpload() {
      this.$Progress.start();
      this.uploadSavingBtn = true;
      this.uploadForm
        .post("/api/sc_admin/post/p/gallery")
        .then(() => {
          Fire.$emit("AfterCreate");
          $("#newImage").modal("hide");
          Toast.fire({
            type: "success",
            title: "Image added successfully",
          });
          this.$Progress.finish();
          this.uploadSavingBtn = false;
        })
        .catch(() => {
          this.uploadSavingBtn = false;
           Toast.fire({
            type: "warning",
            title: "An Error occurred",
          });
        });
    },
   
 CreateImage(e) {
      let file = e.target.files[0];
      let reader = new FileReader();
      //   let vm = this;
      reader.onloadend = file => {
        this.uploadForm.product_image = reader.result;
        console.log(reader.result);
      };
      reader.readAsDataURL(file);
    },
    loadProduct() {
      axios
        .get("/api/sc_admin/single/product/" + this.$route.params.slug)
        .then(({ data }) => (this.product = data));
        
    },
    loadGallery() {
      axios
        .get("/api/sc_admin/single/product/gallery/" + this.$route.params.slug)
        .then(({ data }) => (this.galleries = data));
    },

  },
  created() {
    this.$Progress.start();
    Fire.$on("AfterCreate", () => {
      this.loadProduct();
      this.loadGallery();
    });
    this.loadProduct();
   this.loadGallery();
   
    this.$Progress.finish();
  },
};
</script>