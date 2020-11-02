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
          <!-- form -->
          <form @submit.prevent="createProduct">
            <div class="row layout-top-spacing">
              <div class="col-md-4">
                <div class="form-group mb-4">
                  <label for="inputTitle">Title</label>
                  <input
                    v-model="form.product_title"
                    name="product_title"
                    type="text"
                    class="form-control"
                    id="inputTitle"
                    placeholder="Product Title"
                    :class="{
                      'is-invalid': form.errors.has('product_title'),
                    }"
                  />
                  <has-error :form="form" field="product_title"></has-error>
                </div>
                <div class="form-group col-md-12">
                  <textarea
                    style="display: none"
                    v-model="form.product_des"
                    name="product_des"
                    cols="30"
                    sty
                    rows="10"
                    placeholder="Product description"
                    class="form-control"
                    :class="{
                      'is-invalid': form.errors.has('product_des'),
                    }"
                  ></textarea>
                  <has-error :form="form" field="product_des"></has-error>
                  <editor
                    :initialValue="editorText"
                    :options="editorOptions"
                    height="200px"
                    initialEditType="wysiwyg"
                    @change="onEditorChange"
                    previewStyle="vertical"
                    ref="toastuiEditor"
                  />
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group col-md-12">
                  <label for="inputTitle">Background color</label>
                  <input
                    v-model="form.product_background"
                    name="product_background"
                    type="text"
                    class="form-control"
                    id="inputTitle"
                    placeholder="Product Background color"
                    :class="{
                      'is-invalid': form.errors.has('product_background'),
                    }"
                  />
                  <has-error :form="form" field="product_background"></has-error>
                </div>
                <div class="form-group col-md-12">
                  <label for="inputTitle">Materials</label>
                  <input
                    v-model="form.product_material"
                    name="product_material"
                    type="text"
                    class="form-control"
                    id="inputTitle"
                    placeholder="Product Materials"
                    :class="{
                      'is-invalid': form.errors.has('product_material'),
                    }"
                  />
                  <has-error :form="form" field="product_material"></has-error>
                </div>

                <div class="form-group col-md-12">
                  <label for="inputTitle">Finishing</label>
                  <input
                    v-model="form.product_finishing"
                    name="product_finishing"
                    type="text"
                    class="form-control"
                    id="inputTitle"
                    placeholder="Product Finishing"
                    :class="{
                      'is-invalid': form.errors.has('product_finishing'),
                    }"
                  />
                  <has-error :form="form" field="product_finishing"></has-error>
                </div>

                <div class="form-group col-md-12">
                  <label for="inputTitle">Product use</label>
                  <input
                    v-model="form.product_use"
                    name="product_use"
                    type="text"
                    class="form-control"
                    id="inputTitle"
                    placeholder="Product Finishing"
                    :class="{
                      'is-invalid': form.errors.has('product_use'),
                    }"
                  />
                  <has-error :form="form" field="product_use"></has-error>
                </div>

                <div class="form-group col-md-12">
                  <label for="inputTitle">Delivery</label>
                  <input
                    v-model="form.product_delivery"
                    name="product_delivery"
                    type="text"
                    class="form-control"
                    id="inputTitle"
                    placeholder="Product Delivery"
                    :class="{
                      'is-invalid': form.errors.has('product_delivery'),
                    }"
                  />
                  <has-error :form="form" field="product_delivery"></has-error>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group" v-if="categories.length">
                  <label for="selectCategory">Category</label>
                  <select
                    v-model="form.category"
                    class="custom-select mb-4"
                    name="category"
                    id="selectCategory"
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

                <div class="form-group" v-else>
                  <option disabled>No category list added</option>
                  <router-link :to="{ name: 'categories' }"
                    >Add category</router-link
                  >
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
                <div v-show="!toPicture" class="">
                  <button
                    v-show="!savingBtn"
                    type="submit"
                    class="btn btn-primary mt-3"
                  >
                    Create Product
                  </button>
                  <button class="btn btn-primary" v-show="savingBtn">
                    <div
                      class="spinner-border text-white align-self-center loader-sm"
                    ></div>
                    Loading
                  </button>
                </div>
                <div v-show="toPicture" class="">
                  <router-link
                    :to="
                      '/prime/dashboard/product/prices/' + product.product_slug
                    "
                    class="btn btn-primary mt-3"
                    >Add Prices</router-link
                  >
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
      <bottomFooter />
    </div>
    <!--  END CONTENT AREA  -->
  </div>
  <!-- END MAIN CONTAINER -->
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import topHeader from "../layouts/header.vue";
import sidebar from "../layouts/sidebar.vue";
import bottomFooter from "../layouts/footer.vue";
import "@toast-ui/editor/dist/toastui-editor.css";
import { Editor } from "@toast-ui/vue-editor";

export default {
  mounted() {
    console.log("Component mounted.");
  },
  data() {
    return {
      categories: {},
      product: {},
      firstloading: true,
      savingBtn: false,
      toPicture: false,
      form: new Form({
        category: "",
        product_des: "",
        product_title: "",
        product_material: "",
        product_finishing: "",
        product_use: "",
        product_image: "",
        product_delivery: "",
        product_background: "",
      }),
      editorText: "Enter Description.",
      editorOptions: {
        hideModeSwitch: true,
      },
    };
  },
  components: {
    topHeader,
    sidebar,
    bottomFooter,
    editor: Editor,
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
        console.log(reader.result);
      };
      reader.readAsDataURL(file);
    },
    onEditorChange() {
      this.form.product_des = this.$refs.toastuiEditor.invoke("getHtml");
      // console.log(this.form.product_des);
    },
    loadCategories() {
      axios
        .get("/api/sc_admin/categories")
        .then(({ data }) => (this.categories = data));
    },
    NextAction() {
      this.savingBtn = false;
      this.toPicture = true;
    },
    createProduct() {
      this.$Progress.start();
      this.savingBtn = true;
      this.form
        .post("/api/sc_admin/post/product")
        .then((data) => {
          this.product = data.data;
          Fire.$emit("AfterCreate");
          Toast.fire({
            type: "success",
            title: "product added successfully",
          });
          this.$Progress.finish();
          this.NextAction();
        })
        .catch(() => {
          this.savingBtn = false;
        });
    },
  },

  created() {
    this.$Progress.start();
    Fire.$on("AfterCreate", () => {
      this.loadCategories();
    });
    this.loadCategories();
    this.$Progress.finish();
  },
};
</script>
