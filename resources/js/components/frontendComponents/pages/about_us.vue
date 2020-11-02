<template>
  <div class="home__holder">
    <topHeader />

<breadCrum />
       <div class="about-style-two about-style-three ">
            <div class="container">
                <div class="row ">
                    <div class="col-md-12">
                      
                            <h2>About Empire Homes</h2>
                           <p>Ever struggled to find a professional handyman you can trust? Someone you can rely on to turn up when they say they will and do the work properly?

We’re guessing the answer’s “yes”.

Wouldn’t it be great if there were a property maintenance company with all the people you need, that knows its stuff and keeps its promises. A company that’s super-efficient and makes your life that much easier.

That’s exactly why we exist.

Plumbing, electrics, heating, roofing, glazing, drainage, decorating, pest control… we do the lot. Emergency repairs, planned maintenance or refurbishment work, you won’t come across a better team of experts.

You’ll find us easy to deal with and extremely helpful. Just the way a property maintenance company should be.</p>

<br>
<h2>Service support
</h2>
<p>You want the best possible job. We want the happiest customers.

So, we vet all of our handymen and make sure they stay up-to-date with the latest trade guidelines and regulations.

We give top-up training wherever it’s needed and most importantly, we have a team of Service Support Managers to back up our handymen.

This managed service means every job is completed properly and our work always hits the spot.

</p>

<h2>24 hours a day
</h2>                  


  </div>
                </div>

                
            </div>
        </div>


    <Bottomfooter />
  </div>
</template>
<script>
import topHeader from "../layouts/header.vue";
import Bottomfooter from "../layouts/footer.vue";
import breadCrum from "../components/breadcrum.vue";

export default {
  mounted() {
    console.log("Component mounted.");
  },
  components: {
    topHeader,
    Bottomfooter,
    breadCrum
  }
};
</script>
