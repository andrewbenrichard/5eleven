<template>
    <div class="page-wrapper">
        <topHeader
            pageTitle="Design and Print Business Cards, Flyers Online in Nigeria"
        />

        <section class=" py-4" v-bind:style="{'background-color':  product.product_bg_color}">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <div class="card card__paddig">
                            <div class="card__normal">
                                <p>{{ product.product_title }}</p>

                                <div class="order__form">
                                    <h4>
                                        Select Quantity
                                    </h4>
                                    <select
                                        class="custom-select mt-3 mt-sm-0"
                                        id="inputGroupSelect02"
                                    >
                                        <option selected>1</option>
                                        <option value="1">2</option>
                                        <option value="2">3</option>
                                        <option value="3">4</option>
                                        <option value="3">5</option>
                                        <option value="3">6</option>
                                        <option value="3">7</option>
                                    </select>
                                    <h4>
                                        {{ first_materials.material_name }}
                                    </h4>
                                    <select
                                        class="custom-select mt-3 mt-sm-0"
                                        id="inputGroupSelect02"
                                    >
                                        <option
                                            v-for="sub in first_materials.sub_material"
                                            :key="sub.id"
                                            :value="sub.item_name"
                                            >{{ sub.item_name }}</option
                                        >
                                    </select>
                                </div>
                            </div>
                            <div class="order_cta bg-light">
                                <button
                                    class="btn btn-dark btn-animated mr-sm-3 mb-3 mb-sm-0"
                                >
                                    Proceed
                                </button>
                            </div>
                        </div>
                    </div>
                   
                </div>
                <!-- / .row -->
            </div>
            <!-- / .container -->
        </section>

        <div class="page-content">
            <!--product details start-->

            <section>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <div class="product-image">
                                <div class="product_img_box" >
                        
                                  <img :src="'/uploads/'+product.product_image">
                                </div>
                   
                            </div>
                        </div>
                        <div class="col-lg-6 col-12 mt-5 mt-lg-0">
                            <div class="product-details">
                                <h1 class="h4 mb-0 font-w-6">
                                    {{ product.product_title }}
                                </h1>

                                <p
                                    class="mb-5 border-top border-bottom pb-5 pt-5 desc"
                                    v-html="product.product_des"
                                />
                                <h5>Other information</h5>
                                <p v-if="product.product_finishing"><strong>Finishing options: </strong> {{product.product_finishing}}</p>
                                <p v-if="product.product_material"><strong>Material options:: </strong> {{product.product_material}}</p>

                                <div class="d-sm-flex align-items-center mt-5">
                                    <button
                                        class="btn btn-dark btn-animated mr-sm-3 mb-3 mb-sm-0"
                                    >
                                         Order Now
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!--product details end-->

 <section class="pb-6 border-top pt-7 custom_bg_designer" >
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="custom_holder">
                                <div class="custom__text_holder">
                                    <p>Get a design specially made for you</p>
                                    <h5 class="custom__text_details">
                                        Let our in-house creative team make your {{product.product_title}} and start presenting your business in awesome ways.

                                    </h5>
                                     <div class=" mt-5">
                                    <button
                                        class="btn btn-dark btn-animated mr-sm-3 mb-3 mb-sm-0"
                                    >
                                    Request a Design
                                    </button>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg_gradient"></div>
            </section>

            <!--recent product start-->

            <CustomDesigns :product="product.product_title"/>

            <!--recent product end-->
           

            <!-- testimonias -->
            <Testimonial/>

            <!--multi sec start-->

            <section class="bg-pink py-9 position-relative overflow-hidden">
                <div class="container">
                    <div class="row justify-content-center text-center mb-1">
                        <div class="col-lg-6 col-md-10">
                            <div class="mb-4">
                                <h2 class="mb-0">
                                    Be the first and get weekly updates
                                </h2>
                            </div>
                            <div class="subscribe-form">
                                <form
                                    id="mc-form"
                                    class="row align-items-center no-gutters mb-3"
                                >
                                    <div class="col">
                                        <input
                                            value=""
                                            name="EMAIL"
                                            class="email form-control input-2 bg-white"
                                            id="mc-email"
                                            placeholder="Email Address"
                                            required
                                            type="email"
                                        />
                                    </div>
                                    <div class="col-auto">
                                        <input
                                            class="btn dark-btn overflow-auto"
                                            name="subscribe"
                                            value="Subscribe"
                                            type="submit"
                                        />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--multi sec end-->

        </div>

        <Bottomfooter />
    </div>
</template>

<script>
import topHeader from "../layouts/header.vue";
import Bottomfooter from "../layouts/footer.vue";
import ProductOwl from "../components/products-owl.vue";
import Testimonial from "../components/Testimonial.vue";
import CustomDesigns from "../components/CustomDesigns.vue";

import carousel from 'vue-owl-carousel'

export default {
    mounted() {
        this.$route.params;
    },
    components: {
        topHeader,
        Bottomfooter,
        ProductOwl,
        carousel,
        Testimonial,
        CustomDesigns
    },
    data() {
        return {
            product: {
                id: "",
                product_title: "",
                product_image: "",
                product_slug: "",
                product_bg_color: ""
            },
            materials: {},
            first_materials: {
                material_id: "",
                material_name: "",
                sub_material: {}
            },
            gallery: {},
            // bgStyle: {
            //     'background-color': this.product.product_bg_color
            // }
        };
    },
    methods: {
        loadProduct() {
            axios
                .get("/api/sc_front/single/product/" + this.$route.params.slug)
                .then(
                    ({ data }) => (
                        (this.product = data.product),
                        (this.materials = data.materials),
                        (this.gallery = data.gallery),
                        (this.first_materials = data.materials[0])
                    )
                );
        }
    },
    created() {
        this.loadProduct();
    }
};
</script>
