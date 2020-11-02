<template>
  <div class="page-content">
    <topHeader v-bind:pageTitle="pageTitle" />
    <breadCrum v-bind:pageTitle="BreadTitle" />

    
  
<section class="bg-light">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-lg-6 col-md-8 col-sm-11">
        <div class="shadow p-6 login bg-white">
         <div class="store-name">5Eleven</div>
          <h4 class="text-left mb-3 font-w-5">Customer Login</h4>
           <form id="contact-form" @submit.prevent="submit" @keydown="form.onKeydown($event)">
            <div class="messages"></div>
            <div class="form-group">
              <input 
               v-model="form.email"
                type="text"
                name="email"
                class="form-control"
                :class="{
                                    'is-invalid': form.errors.has('email')
                                }"
              id="form_name" placeholder="Email Address" required data-error="email is required.">
              <div class="help-block with-errors"></div>
                            <has-error :form="form" field="email"></has-error>

            </div>
            <div class="form-group">
              <input 
               v-model="form.password"
                type="password"
                name="password"
                class="form-control"
                :class="{
                                    'is-invalid': form.errors.has('password')
                                }"
              id="form_password"  placeholder="Password" required data-error="password is required.">
              <div class="help-block with-errors"></div>
               <has-error :form="form" field="password"></has-error>
            </div>
            <div class="form-group mt-4 mb-5">
              <div class="remember-checkbox d-flex align-items-center justify-content-between">
                <div class="checkbox">
                  <input type="checkbox" id="check2" name="check2">
                  <label for="check2">Remember me</label>
                </div>
                 <a href="#">Forgot Password?</a>
              </div>
            </div> <button  :disabled="form.busy"  class="btn btn-yellow-dark btn-block">Login Now</button >
           
           
          </form>
          <div class="another_login"><span> or</span></div>
          <ul class="login-btn list_none text-center">
                            <li><a href="#" class="btn facebook-btn"><i class="ion-social-facebook"></i>Facebook</a></li>
                            <li><a href="#" class="btn google-btn"><i class="ion-social-googleplus"></i>Google</a></li>
                        </ul>
          <div class="d-flex align-items-center text-center justify-content-center mt-4">
                <span class="text-muted mr-1">Don't have an account?</span>
                   <a href="signup.html">Sign Up</a>
                </div>
        </div>
      </div>
    </div>
  </div>
</section>

   
    
<Newsletter />

    <Bottomfooter />

  </div>
</template>

<script>

import topHeader from "../layouts/header.vue";
import Bottomfooter from "../layouts/footer.vue";
import breadCrum from "../components/breadcrum.vue";
import Newsletter from "../components/newsletter.vue";
import { mapActions } from "vuex";

export default {
  data() {
    return {
      form: new Form({
        email: "",
        password: "",
        remember: false
      })
    };
  },
  methods: {
    ...mapActions({
      signIn: "auth/signIn"
    }),
    submit() {
      this.signIn(this.form)
        .then(() => {
          window.location.href = "/dashboard";
        })
        .catch(() => {
          console.log("failed");
        });
    }
    // login() {
    //   // Submit the form via a POST request
    //   this.form.post("api/auth/signin").then(({ data }) => {
    //     console.log(data);
    //   });
    // }
  },
  mounted() {
    console.log("login component mounted.");
  },
  components: {
    topHeader
  }
};
</script>
