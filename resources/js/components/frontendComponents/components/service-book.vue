<template>
              <div class="row">

                    <div class="col-lg-3 col-md-6" v-for="(service, id) in services"  v-bind:key="id" @click="ServiceSelected(service.id);" >
                        <div class="book-card">
                            <div :id="service.id" class="booking-checked hideCheck">
                                <i class="ti-check"></i>
                            </div>
                            <img :src="'/public/assets/icons/svg/'+service.service_img"/>
                            <h3>{{service.service_name}}</h3>
                        </div>
                    </div>
              </div>
                    
                   
    
</template>
<script>
export default {
    props: ["services"],
    
    data() {
        return {
            service_id: "",
            first_clicked: false
        }
    },
    methods: {
        ServiceSelected(id){
            
            if (this.first_clicked) {
                
                }
                this.service_id = id;
            // console.log(this.service_id);
             let serviceID = document.getElementById(this.service_id);
                 $(this).parent().find('.hideCheck').addClass('hideCheck');

             if (serviceID.id != this.service_id) {
                                     serviceID.classList.toggle("hideCheck");

             }else{
                 serviceID.classList.toggle("hideCheck");
                  this.$emit('serviceClicked', this.service_id)

             }

        }

    },
    created() {
        
    },
    
}
</script>