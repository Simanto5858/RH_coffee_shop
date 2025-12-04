<?php require_once "includes/header.php"; ?>

<section class="ftco-section contact-section">
  <div class="container mt-5">
    <div class="row block-9">
      <div class="col-md-4 contact-info ftco-animate">
        <div class="row">
          <div class="col-md-12 mb-4">
            <h2 class="h4">Contact Information</h2>
          </div>
          <div class="col-md-12 mb-3">
            <p>
              <span>Address:</span> 203  St. , Feni Sadar, Feni, Bangladesh
            </p>
          </div>
          <div class="col-md-12 mb-3">
            <p>
              <span>Phone:</span>
              <a href="#">0187*******</a>
            </p>
          </div>
          <div class="col-md-12 mb-3">
            <p>
              <span>Email:</span>
              <a href="#">rh.coffeeshop@gmail.com</a>
            </p>
          </div>
          <div class="col-md-12 mb-3">
            <p><span>Website:</span> <a href="#">rh-coffee-shop.com</a></p>
          </div>
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-6 ftco-animate">
        <form action="submit.php" method="POST" class="contact-form">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Your Name" name="name" />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Your Email" name="email" />
              </div>
            </div>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Subject" name="subject" />
          </div>
          <div class="form-group">
            <textarea name="message" id="" cols="30" rows="7" class="form-control" placeholder="Message"></textarea>
          </div>
          <div class="form-group">
            <input type="submit" value="Send Message" class="btn btn-primary py-3 px-5" />
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<?php require_once "includes/footer.php"; ?>