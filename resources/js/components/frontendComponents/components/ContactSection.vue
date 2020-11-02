<template>
<div class="contact-section">
      <div class="container">
        <div class="contact-area">
          <div class="row align-items-center">
            <div class="col-lg-6 col-md-6">
              <div class="contact-img">
                <img src="public/assets/img/contact-img.png" alt="contact image" />
              </div>
            </div>

            <div class="col-lg-6 col-md-6">
              <div class="section-head">
                <h2>
                  We Love to
                  <span>Hear from You</span>
                </h2>
                <p>Feel free and share with us. We will get you</p>
              </div>

              <div class="contact-form">
                <form id="contactForm">
                  <div class="row">
                    <div class="col-md-12 col-sm-6">
                      <div class="form-group">
                        <input
                          type="text"
                          name="name"
                          id="name"
                          class="form-control"
                          required
                          data-error="Please enter your name"
                          placeholder="Your Name"
                        />
                        <div class="help-block with-errors"></div>
                      </div>
                    </div>

                    <div class="col-md-12 col-sm-6">
                      <div class="form-group">
                        <input
                          type="email"
                          name="email"
                          id="email"
                          class="form-control"
                          required
                          data-error="Please enter your email"
                          placeholder="Your Email"
                        />
                        <div class="help-block with-errors"></div>
                      </div>
                    </div>

                    <div class="col-lg-12 col-md-12">
                      <div class="form-group">
                        <textarea
                          name="message"
                          class="form-control"
                          id="message"
                          cols="30"
                          rows="5"
                          required
                          data-error="Write your message"
                          placeholder="Your Message"
                        ></textarea>
                        <div class="help-block with-errors"></div>
                      </div>
                    </div>

                    <div class="col-lg-12 col-md-12">
                      <button type="submit" class="default-btn page-btn">Send Message</button>
                      <div id="msgSubmit" class="h3 text-center hidden"></div>
                      <div class="clearfix"></div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
        
    
</template>
<script>
export default {
    
}
</script>