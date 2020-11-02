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
                

                  <button class="btn btn-dark btn-block mb-2 mr-2 btn-rounded" @click="newImage"
                  >
                    Add gallery
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
                  <router-link :to="'/prime/dashboard/product/gallery/' + main_slug">or view product gallery </router-link>
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
                <h4>Add {{product.category}} Materials</h4>
                  <form @submit.prevent="saveMaterial">
                    <div class="form-row mb-4">
                       <div class="form-group col-md-12">
                        <label for="inputState">Material</label>
                        <select id="inputState" class="form-control"
                         v-model="form.material_type"   v-on:change="loadSubMaterial($event.target.value)" 
                         :class="{
                      'is-invalid': form.errors.has('material_type'),
                    }">
                          <option selected>Choose...</option>
                          <option
                      v-for="material in materials"
                      :key="material.id"
                      :value="material.id"
                    >
                      {{ material.material_name }}
                    </option>
                        </select>
                  <has-error :form="form" field="material_type"></has-error>
                      </div>

                       <div v-if="submaterials.length" class="form-group col-md-12">
                        <label for="inputState">Select sub Material</label>
                        <select id="inputState" class="form-control"
                         v-model="form.sub_material"    
                         :class="{
                      'is-invalid': form.errors.has('sub_material'),
                    }">
                          <option selected>Choose...</option>
                          <option
                      v-for="material in submaterials"
                      :key="material.id"
                      :value="material.id"
                    >
                      {{ material.item_name }}
                    </option>
                        </select>
                  <has-error :form="form" field="submaterial"></has-error>
                      </div>
                      <p v-else>Select Material type </p>

                    </div>
                    <button
                      type="submit"
                      v-show="!savingBtn"
                      class="btn btn-primary"
                    >
                      Add Material
                    </button>
                    <button class="btn btn-primary" v-show="savingBtn">
                      <div
                        class="spinner-border text-white align-self-center loader-sm"
                      ></div>
                      Loading
                    </button>
                  </form>

                  <div class="materials_">
                    <div class="ma" v-for="material in productMaterials" :key="material.id">
                      <p>
                        {{material.material_name}}
                      </p>
                      <div class="sub_materials row">
                        <div class="col-md-3 card" v-for="sub in material.sub_material" :key="sub.id">
                          <p>{{sub.item_name}}</p>
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
      materials: {},
      productMaterials: {},
      submaterials: {},
      savingBtn: false,
      uploadSavingBtn: false,
      form: new Form({
        product: this.$route.params,
        material_type: "",
        sub_material: "",
      }),
      uploadForm: new Form({
        product: this.$route.params,
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
      this.form.reset();
      $("#newImage").modal("show");
    },
       saveMaterial() {
      this.$Progress.start();
      this.savingBtn = true;
      this.form
        .post("/api/sc_admin/post/p/material")
        .then(() => {
          Fire.$emit("AfterCreate");
          Toast.fire({
            type: "success",
            title: "Material added successfully",
          });
          this.submaterials = null;
          this.$Progress.finish();
          this.savingBtn = false;
        })
        .catch(() => {
          this.savingBtn = false;
           Toast.fire({
            type: "warning",
            title: "An Error occurred",
          });
        });
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
        .then(({ data }) => (this.product = data, this.loadMaterial()));
        
    },
    loadMaterial() {
      axios
        .get("/api/sc_admin/single/cat/mat/" + this.$route.params.slug)
        .then(({ data }) => (this.materials = data));
    },
    loadProductMaterial() {
      axios
        .get("/api/sc_admin/single/product/mat/" + this.$route.params.slug)
        .then(({ data }) => (this.productMaterials = data));
    },
    loadSubMaterial(value) {
      axios
        .get("/api/sc_admin/single/material/p/sub/" + value)
        .then(({ data }) => (this.submaterials = data));
    },

  },
  created() {
    this.$Progress.start();
    Fire.$on("AfterCreate", () => {
      this.loadProduct();
      this.loadMaterial();
    });
    this.loadProduct();
    this.loadProductMaterial();
   
    this.$Progress.finish();
  },
};
</script>