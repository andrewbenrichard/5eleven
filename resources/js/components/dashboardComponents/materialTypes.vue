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
              <button
                class="btn btn-primary mb-4 mr-2 btn-lg"
                @click="newMaterial"
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
                Add Category
              </button>
            </div>
            <div class="col-md-12">
              <div class="cotainer">
                <div class="row" v-show="firstloading">
                  <button class="btn btn-primary">
                    <div
                      class="spinner-border text-white align-self-center loader-sm"
                    ></div>
                  </button>
                  <span>Loading Categories</span>
                </div>
                <div class="row" v-if="materials.length">
                  <div
                    class="col-md-4"
                    v-for="category in materials"
                    :key="category.id"
                  >
                    <router-link
                      :to="'material-types/cat/' + category.category_slug"
                    >
                      <div class="card component-card_9">
                        <div class="card-body">
                          <h5 class="card-title">
                            {{ category.category_name }}
                          </h5>
                          <div class="meta-info">
                            <div class="meta-user">
                              <div class="user-name">
                                Materials count {{ category.material_count }}
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </router-link>
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
                    <h5 class="info-heading">No Category Materials Found</h5>
                    <p class="info-text">
                      You've not added any materials, add materials to 5Eleven
                      website.
                    </p>
                    <a class="info-link" href="#" @click="newMaterial">
                      Add Material
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
          id="newMaterial"
          tabindex="-1"
          role="dialog"
          aria-labelledby="MealModalLabel"
          aria-hidden="true"
        >
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="MealModalLabel">Add Material</h5>
                <button
                  type="button"
                  class="close"
                  data-dismiss="modal"
                  aria-label="Close"
                ></button>
              </div>
              <div class="modal-body">
                <form @submit.prevent="createMaterial">
                  <div class="modal-body">
                    <div class="form-group">
                      <label for="categories">Select Category</label>
                      <select
                        v-model="form.category"
                        class="custom-select mb-4"
                        name="category"
                        id="categories"
                        :class="{
                          'is-invalid': form.errors.has('category'),
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
                      <has-error :form="form" field="category"></has-error>
                    </div>
                    <div class="form-group">
                      <input
                        v-model="form.material_name"
                        type="text"
                        name="material_name"
                        placeholder="material name"
                        class="form-control"
                        :class="{
                          'is-invalid': form.errors.has('material_name'),
                        }"
                      />
                      <has-error :form="form" field="material_name"></has-error>
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
      categories: {},
      materials: {},
      firstloading: true,
      savingBtn: false,
      form: new Form({
        material_name: "",
        category: "",
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

    newMaterial() {
      this.form.reset();
      $("#newMaterial").modal("show");
    },
    editModal(material) {
      this.form.reset();
      $("#newMaterial").modal("show");
      this.form.fill(material);
    },
    deleteMaterial(id) {
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
            .delete("/api/sc_admin/delete/material/" + id)
            .then(() => {
              if (result.value) {
                Swal.fire(
                  "Deleted!",
                  "The Material has been deleted.",
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
    createMaterial() {
      this.$Progress.start();
      this.savingBtn = true;
      this.form
        .post("/api/sc_admin/post/material")
        .then(() => {
          Fire.$emit("AfterCreate");
          $("#newMaterial").modal("hide");
          Toast.fire({
            type: "success",
            title: "Material created successfully",
          });
          this.form.material_image = null;
          this.$Progress.finish();
          this.savingBtn = false;
        })
        .catch(() => {
          this.savingBtn = false;
        });
    },
    loadCategories() {
      axios
        .get("/api/sc_admin/categories")
        .then(({ data }) => (this.categories = data));
    },
    loadMaterials() {
      axios
        .get("/api/sc_admin/materials")
        .then(({ data }) => (this.materials = data));
    },
  },
  created() {
    this.$Progress.start();
    Fire.$on("AfterCreate", () => {
      this.loadCategories();
      this.loadMaterials();
    });
    this.loadCategories();
    this.loadMaterials();
    this.firstloading = false;
    this.$Progress.finish();
  },
};
</script>
