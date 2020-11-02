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
            <div class="col-md-12">
              <router-link
                class="btn btn-primary mb-4 mr-2 btn-lg"
                to="product/add-new"
              >
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
                  class="feather feather-edit"
                >
                  <path
                    d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"
                  />
                  <path
                    d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"
                  />
                </svg>
                Add Product
              </router-link>
            </div>

            <div class="col-md-12">
              <div class="cotainer">
                <div class="row" v-if="products.length">
                  <div
                    class="col-md-4"
                    v-for="product in products"
                    :key="product.id"
                  >
                    <div class="card component-card_9">
                      <img
                        :src="'/uploads/' + product.product_image"
                        class="card-img-top"
                        alt="widget-card-2"
                      />
                      <div class="card-body">
                        <p class="meta-date">{{ product.product_date }}</p>

                        <h5 class="card-title">{{ product.product_name }}</h5>
                        <p class="card-text" v-html="product.product_des"/>

                        <div class="meta-info">
                          <div class="meta-user">
                            <div class="user-name">
                              {{ product.product_price }}
                            </div>
                          </div>

                          <div class="meta-action">
                            <div class="meta-likes">
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
                                class="feather feather-heart"
                              >
                                <path
                                  d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"
                                />
                              </svg>
                              {{ product.product_orders }}
                            </div>

                            <div class="meta-view">
                              {{ product.product_category }}
                            </div>
                          </div>
                        </div>
                        <button
                          @click="editModal(product)"
                          class="btn btn-dark btn-block mb-2 mr-2 btn-rounded"
                        >
                          Edit
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
                            class="feather feather-edit-2"
                          >
                            <path
                              d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"
                            />
                          </svg>
                        </button>
                        <router-link
                          :to="'/prime/dashboard/product/materials/' + product.product_slug"
                          class="btn btn-dark btn-block mb-2 mr-2 btn-rounded"
                        >
                          Materials
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
                            class="feather feather-edit-2"
                          >
                            <path
                              d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"
                            />
                          </svg>
                        </router-link>

                        <router-link
                          :to="
                            '/prime/dashboard/product/' + product.product_slug
                          "
                          class="btn btn-dark btn-block mb-2 mr-2 btn-rounded"
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
                            <rect
                              x="3"
                              y="3"
                              width="18"
                              height="18"
                              rx="2"
                              ry="2"
                            />
                            <circle cx="8.5" cy="8.5" r="1.5" />
                            <polyline points="21 15 16 10 5 21" />
                          </svg>
                        </router-link>

                        <button
                          @click="deleteproduct(product.id)"
                          class="btn btn-danger btn-block mb-2 mr-2 btn-rounded"
                        >
                          Delete
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
                            class="feather feather-trash-2"
                          >
                            <polyline points="3 6 5 6 21 6" />
                            <path
                              d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"
                            />
                            <line x1="10" y1="11" x2="10" y2="17" />
                            <line x1="14" y1="11" x2="14" y2="17" />
                          </svg>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <div v-else>
                  <div class="infobox-3">
                    <div class="info-icon">
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
                        class="feather feather-box"
                      >
                        <path
                          d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"
                        />
                        <polyline points="3.27 6.96 12 12.01 20.73 6.96" />
                        <line x1="12" y1="22.08" x2="12" y2="12" />
                      </svg>
                    </div>
                    <h5 class="info-heading">No products Found</h5>
                    <p class="info-text">
                      You've not added any product, add a product to your new
                      5Eleven website.
                    </p>
                    <a class="info-link" href="#" @click="newproduct">
                      Add product
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
                        class="feather feather-arrow-right"
                      >
                        <line x1="5" y1="12" x2="19" y2="12" />
                        <polyline points="12 5 19 12 12 19" />
                      </svg>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div
          class="modal fade"
          id="newproduct"
          tabindex="-1"
          role="dialog"
          aria-labelledby="productModalLabel"
          aria-hidden="true"
        >
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="productModalLabel">Modal title</h5>
                <button
                  type="button"
                  class="close"
                  data-dismiss="modal"
                  aria-label="Close"
                ></button>
              </div>
              <div class="modal-body">
                <form @submit.prevent="createproduct">
                  <div class="modal-body">
                    <div class="form-group">
                      <input
                        v-model="form.product_name"
                        type="text"
                        name="product_name"
                        placeholder="name"
                        class="form-control"
                        :class="{
                          'is-invalid': form.errors.has('product_name'),
                        }"
                      />
                      <has-error :form="form" field="product_name"></has-error>
                    </div>
                    <div class="form-group">
                      <input
                        v-model="form.product_price"
                        type="text"
                        name="product_price"
                        placeholder="Price"
                        class="form-control"
                        :class="{
                          'is-invalid': form.errors.has('product_price'),
                        }"
                      />
                      <has-error :form="form" field="product_price"></has-error>
                    </div>
                    <div class="form-group" v-if="deliveries.length">
                      <select
                        v-model="form.product_delivery_type"
                        class="custom-select mb-4"
                        name="product_delivery_type"
                        :class="{
                          'is-invalid': form.errors.has(
                            'product_delivery_type'
                          ),
                        }"
                      >
                        <option disabled>Open this select menu</option>
                        <option
                          v-for="delivery in deliveries"
                          :key="delivery.id"
                          :value="delivery.id"
                        >
                          {{ delivery.delivery_name }} (
                          {{ delivery.package_time }} )
                        </option>
                      </select>
                      <has-error
                        :form="form"
                        field="product_delivery_type"
                      ></has-error>
                    </div>
                    <div class="form-group" v-else>
                      <router-link :to="{ name: 'delivery-types' }"
                        >Add delivery Type</router-link
                      >
                    </div>
                    <div class="form-group" v-if="categories.length">
                      <select
                        v-model="form.product_category"
                        class="custom-select mb-4"
                        name="product_category"
                        :class="{
                          'is-invalid': form.errors.has('product_category'),
                        }"
                      >
                        <option
                          v-for="category in categories"
                          :key="category.id"
                          :value="category.id"
                        >
                          {{ category.category_name }}
                        </option>
                      </select>

                      <has-error
                        :form="form"
                        field="product_category"
                      ></has-error>
                    </div>
                    <div class="form-group" v-else>
                      <option disabled>No category list added</option>
                      <router-link :to="{ name: 'categories' }"
                        >Add category</router-link
                      >
                    </div>
                    <div class="form-group">
                      <textarea
                        v-model="form.product_description"
                        name="product_description"
                        cols="30"
                        rows="10"
                        placeholder="product description"
                        class="form-control"
                        :class="{
                          'is-invalid': form.errors.has('product_description'),
                        }"
                      ></textarea>
                      <has-error
                        :form="form"
                        field="product_description"
                      ></has-error>
                    </div>
                    <div class="form-group">
                      <input
                        name="product_image"
                        @change="CreateImage"
                        type="file"
                        :class="{
                          'is-invalid': form.errors.has('product_image'),
                        }"
                      />
                      <has-error :form="form" field="product_image"></has-error>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button
                      type="button"
                      class="btn btn-secondary"
                      data-dismiss="modal"
                    >
                      Close
                    </button>
                    <button
                      type="submit"
                      v-show="!savingBtn"
                      class="btn btn-primary"
                    >
                      Create
                    </button>
                    <button class="btn btn-primary" v-show="savingBtn">
                      <div
                        class="spinner-border text-white align-self-center loader-sm"
                      ></div>
                      Loading
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
import topHeader from "./layouts/header.vue";
import sidebar from "./layouts/sidebar.vue";
import bottomFooter from "./layouts/footer.vue";

export default {
  mounted() {
    console.log("Component mounted.");
  },
  data() {
    return {
      products: {},
      deliveries: {},
      categories: {},
      savingBtn: false,
      form: new Form({
        product_name: "",
        product_image: "",
        product_des: "",
        product_category: "",
        product_price: "",
        product_delivery_type: "",
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
    CreateImage(e) {
      let file = e.target.files[0];
      let reader = new FileReader();
      //   let vm = this;
      reader.onloadend = (file) => {
        this.form.product_image = reader.result;
      };
      reader.readAsDataURL(file);
    },
    newproduct() {
      this.form.reset();
      $("#newproduct").modal("show");
    },
    editModal(product) {
      this.form.reset();
      $("#newproduct").modal("show");
      this.form.fill(product);
    },
    deleteproduct(id) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        // send request to the server
        if (result.value) {
          this.form
            .delete("/api/sc_admin/delete/product/" + id)
            .then(() => {
              if (result.value) {
                Swal.fire(
                  "Deleted!",
                  "The product menu has been deleted.",
                  "success"
                );
              }
              Fire.$emit("AfterCreate");
            })
            .catch(() => {
              Swal("Failed", "There was something wrong.", "warning");
            });
        }
      });
    },
    createproduct() {
      this.$Progress.start();
      this.savingBtn = true;
      this.form
        .post("/api/sc_admin/post/product")
        .then(() => {
          Fire.$emit("AfterCreate");
          $("#newproduct").modal("hide");
          this.savingBtn = false;
          Toast.fire({
            type: "success",
            title: "product created successfully",
          });
          this.$Progress.finish();
        })
        .catch(() => {
          this.savingBtn = false;
        });
    },
    laodProducts() {
      axios
        .get("/api/sc_admin/list/products")
        .then(({ data }) => (this.products = data));
    },
    // laodCategories() {
    //   axios
    //     .get("/api/sc_admin/categories")
    //     .then(({ data }) => (this.categories = data));
    // },
    // loadDeliveryType() {
    //   axios
    //     .get("/api/sc_admin/deliveries")
    //     .then(({ data }) => (this.deliveries = data));
    // }
  },
  created() {
    this.$Progress.start();
    Fire.$on("AfterCreate", () => {
      this.laodProducts();
    });
    this.laodProducts();
    // this.laodCategories();
    // this.loadDeliveryType();
    this.$Progress.finish();
  },
};
</script>