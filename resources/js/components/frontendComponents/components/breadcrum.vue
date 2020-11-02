<template>
 <section class="bg-light py-6">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-6">
        <h1 class="h2 mb-0">{{pageTitle}}</h1>
      </div>
      <div class="col-md-6 mt-3 mt-md-0">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb justify-content-md-end bg-transparent p-0 m-0">
            <li class="breadcrumb-item"><router-link class="link-title" to="/">Home</router-link>
            </li>
            <li class="breadcrumb-item active text-primary" aria-current="page">{{pageTitle}}</li>
          </ol>
        </nav>
      </div>
    </div>
    <!-- / .row -->
  </div>
  <!-- / .container -->
</section>

</template>

<script>
export default {
  mounted() {},
  props: ['pageTitle'],
  created() {}
};
</script>
