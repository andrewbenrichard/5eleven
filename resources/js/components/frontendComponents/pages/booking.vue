<template>
  <div>
    <topHeader v-bind:pageTitle="pageTitle"/>
    <breadCrum v-bind:pageTitle="pageTitle" />
    <div class="container booker-cont">
      <div class="row">
        <div class="col-md-12">
          <h1 class="book-header">Book a maintenance service</h1>
          <h4 class="book-subheader">Find the right handyman for as low as ₦3,000</h4>
        </div> 
        <div class="col-md-12">
          <form-wizard @on-complete="onComplete" 
                       shape="tab"
                       color="#333333">
     <tab-content title="Select Services"
                  icon="ti-view-grid" :before-change="beforeTabSwitch">

      <div v-if="services.length">
        <h6 class="ser__header">What maintenance service do you want?</h6>
        <label class="ser_label" for="select_service">Select a service</label>
        <select class="ser_select" id="select_service" v-model="selected_service" name="district" @click="serviceClicked(selected_service);" >
  <option value="">Choose from list</option>
  <optgroup >
    <option v-for="(service, id) in services"  v-bind:key="id" :value="service.service_name">{{ service.service_name }}</option>
  </optgroup>
 </select>
                     <p id="select_ss" class="hideCheck">Please select the service you want</p>


                      <label for="BookDate" class="ser_label" slot="before">Your preferred date*</label>
 <datetime v-model="book_d" type="date" input-id="BookDate"  v-on:change="dated()">
                    </datetime>
                    <p id="select_d" class="hideCheck">Please select a date</p>
      </div>
      <div v-else>
        <p>Loading services</p>
      </div>
      <div class="hideCheck" id="service_selected__">
        <h4><strong>{{ selected_service }}</strong> - Please click next to provide your contact details.</h4>
      </div>

     </tab-content>
     <tab-content title="Contact"
                  icon="ti-user" :before-change="beforeSwitchContact">
       <div class="form-group">
                 <h6 class="ser__header">Please provide us with your contact details?</h6>

         <label for="username" class="ser_label">Full name</label>
         <input id="username" placeholder=" Enter your full name" v-model="user_name"  type="text" class="ser_select">
                             <p id="user_name" class="hideCheck">please enter your full name</p>

       </div>
       <div class="form-group">
         <label for="usenumber" class="ser_label">Phone Number</label>
         <input id="usenumber" placeholder="whats your phone number" v-model="user_number"  type="text" class="ser_select">
                             <p id="user_number" class="hideCheck">please enter your 11 digit phone number</p>
       </div>
       <div id="save_loader" v-bind:class="{ hideCheck: !is_saving}">

<div class="lds-ring"><div></div><div></div><div></div><div></div></div>
<p>Please wait </p>
</div>
     </tab-content>
     <tab-content title="Confirmation"
                  icon="ti-check">
       <div class="confirm_body">
         <h4 class="confirm_header">We've got your maintenance booking</h4>
       <p class="confirm_des">Our team would call you soon for more details</p>
       </div>
     </tab-content>
 </form-wizard>
    
  </div>

        </div>
      </div>
    <Bottomfooter />
    </div>
</template>

<script>

import {FormWizard, TabContent} from 'vue-form-wizard'
import 'vue-form-wizard/dist/vue-form-wizard.min.css'
import topHeader from "../layouts/header.vue";
import Bottomfooter from "../layouts/footer-2.vue";
import preloader from "../widgets/preloader.vue";
import breadCrum from "../components/breadcrum.vue";
import { Datetime } from "vue-datetime";
import "vue-datetime/dist/vue-datetime.css";
// import Services from "../components/service-book.vue";
import paystack from "vue-paystack";

export default {
  mounted() {
    this.$route.params;
  },
  components: {
    topHeader,
    Bottomfooter,
    breadCrum,
    FormWizard,
    TabContent,
    datetime: Datetime

  },
  data() {
    return {
      pageTitle: "Booking",
      form: new Form({
        full_name: "",
        service: "",
        booking_date: "",
        number: "",
      }),
      services: {},
      selected_service: "",
      book_d: "",
      user_name: "",
      user_number: "",
      booking_saved: false,
      is_saving: false,
    };
  },
  computed: {
   
  },
  methods: {
       onComplete: function(){
          alert('Yay. Done!');
       },
       beforeTabSwitch: function(){
         /* lets set all data to form before we go to the next slide */

           const togg_s = document.getElementById("select_ss");
           const togg_d = document.getElementById("select_d");
        
         /* here we check if the user has selected a service */
         if (this.selected_service.length > 3) {
           this.form.service = this.selected_service;
           togg_s.classList.add("hideCheck")
           
         } else {
                 togg_s.classList.remove("hideCheck")
                 return false;
         }
         /* check if the user select date */
         if (this.book_d.length) {
           this.form.booking_date = new Date(
        Date.parse(this.book_d)
      ).toLocaleDateString();
           togg_d.classList.add("hideCheck")
         }else{
                 togg_d.classList.remove("hideCheck")

           return false

         }
       
          return true;
        },
       beforeSwitchContact: function(){
         /* lets set all data to form before we go to the next slide */

         
           const togg_name = document.getElementById("user_name");
           const togg_number = document.getElementById("user_number");

        
         /* here we check if the user entered his full name */
           if (this.user_name.length > 3) {
           this.form.full_name = this.user_name;
           togg_name.classList.add("hideCheck")
           
         } else {
                 togg_name.classList.remove("hideCheck")
                 return false;
         }
         /* here we check if the user entered his number */
           if (this.user_number.length >= 11) {
           this.form.number = this.user_number;
           togg_number.classList.add("hideCheck")
           
         } else {
                 togg_number.classList.remove("hideCheck")
                 return false;
         }
         this.saveService();
        //  if (!this.booking_saved) {
        //    return true;
        //  }else{
        //    return false;
        //  }
          return true;
        },
        loadServices() {
      axios
        .get("/api/sc_front/services")
        .then(({ data }) => (this.services = data));
    },
    saveService(){
                this.is_saving = true;
      this.form
        .post("/api/sc_admin/post/booking")
        .then(() => {
          Fire.$emit("AfterCreate");
        })
        .catch(() => {
          return false;
          this.is_saving = false;
        });
    },
    serviceClicked(value){
      const togg = document.getElementById("service_selected__");
                 const togg_s = document.getElementById("select_ss");

      if (value.length > 3) {
      console.log(value);
                     togg.classList.remove("hideCheck")
                     togg_s.classList.add("hideCheck")
      
      }else{
                     togg.classList.add("hideCheck")

      }
    },
    dated(){
      console.log("demo day");
     
    }
  },
  watch: {
    
  },
  created() {
    this.loadServices();
  }
};
</script>
