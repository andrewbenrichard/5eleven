<template>
        <section class="service-section pt-100 pb-70">
            <div class="container">
                <div class="section-head text-center">
                    <h2>Find a <span>Handyman</span></h2>
                    <p>We have handymen to help with all your property maintenance needs.
                       Whether it’s an emergency call, regular repairs, a scheduled inspection,
                        or large scale refurbishment work, you’ll find the right handymen with us. </p>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-md-6" v-for="(service, id) in services" :key="id">
                        <div class="service-card">
                            <img :src="'/public/assets/icons/svg/'+service.service_img"/>
            <h3>{{service.service_name}}</h3>
            <p>
{{service.service_des}}


            </p>
                            <div class="theme-button">
                                <router-link to="/booking" class="default-btn">Book now</router-link>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
</template>

<script>
export default {
  mounted() {},
  props: ["services"],
  created() {}
};
</script>
