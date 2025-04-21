<?php
require('admin/Includes/db_configuration.php');

if (isset($_POST['name']) && isset($_POST['review']) && isset($_POST['rating'])) {
  $name = $con->real_escape_string($_POST['name']);
  $review = $con->real_escape_string($_POST['review']);
  $rating = intval($_POST['rating']);

  $image_path = '';
  if (!empty($_FILES['profile_image']['name'])) {
    $img_name = time() . '_' . basename($_FILES['profile_image']['name']);
    $target_dir = 'uploads/reviews/';
    $target_file = $target_dir . $img_name;

    if (!file_exists($target_dir)) {
      mkdir($target_dir, 0777, true);
    }

    if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $target_file)) {
      $image_path = $target_file;
    }
  }

  $stmt = $con->prepare("INSERT INTO reviews (name, review, rating, profile_image, added_on) VALUES (?, ?, ?, ?, NOW())");
  $stmt->bind_param("ssis", $name, $review, $rating, $image_path);

  if ($stmt->execute()) {
    header("Location: " . $_SERVER['PHP_SELF']); // Redirect to avoid resubmission
    exit();
  }

  $stmt->close();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pawana Camping</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <?php require('IncludeFiles/links.php'); ?>
  <style>
    .check-availability {
      margin-top: -50px;
      z-index: 2;
      position: relative;
    }

    @media screen and (max-width: 575px) {
      .check-availability {
        margin-top: 25px;
        z-index: 2;
        position: 0 35px;
      }
    }

    .pop:hover {
      border-top-color: var(--184C89) !important;
      transform: scale(1.03);
      transition: all 0.3s;
    }
  </style>
</head>

<body class="bg-light">
  <?php require('IncludeFiles/header.php'); ?>
  <!--home-->

  <div class="container-fluid px-lg-4 mt-4">
    <div class="swiper mySwiper">
      <div class="swiper-wrapper">

        <?php
        $res = selectAll('carousel');


        while ($row = mysqli_fetch_assoc($res)) {
          $path = CAROUSEL_IMG_PATH;
          echo <<<data
              <div class="swiper-slide">
                <img src="$path$row[image]" class="w-100 logo d-block" style="height: 550px" />
              </div>
            data;
        }
        ?>
      </div>
    </div>

  </div>

  <!--Check Availability-->
  <!-- <div class="container check-availability">
    <div class="row">
      <div class="col-lg-12 bg-white shadow p-4 rounded">
        <h4 class="mb-4">Check Booking Availability</h4>
        <form>
          <div class="row align-items-end">
            <div class="col-lg-3 mb-3">
              <label class="form-label" style="font-weight: 500">Check-in</label>
              <input type="date" class="form-control shadow-none">
            </div>
            <div class="col-lg-3 mb-3">
              <label class="form-label" style="font-weight: 500">Check-out</label>
              <input type="date" class="form-control shadow-none">
            </div>
            <div class="col-lg-3 mb-3">
              <label class="form-label" style="font-weight: 500">Adults</label>
              <select class="form-select" aria-label="Default select example">
                <option selected>Select</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
              </select>
            </div>
            <div class="col-lg-3 mb-3">
              <label class="form-label" style="font-weight: 500">Childrens</label>
              <select class="form-select" aria-label="Default select example">
                <option selected>Select</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
              </select>
            </div>
            <div class="col-lg-1 mb-lg-3 mt-2 mx-auto">
              <button type="submit" class="btn text-white shadow-none custom-bg mx-auto d-block">Submit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div> -->

  <div>
    <h2 class="mt-12 pt-5 mb-4 text-center h-font fw-bold">LAKESHORE CAMPING</h2>
    <h5 class="text-center description-font mb-4">
      Escape to a serene lakeside paradise with cozy tents or cottages that
      offer stunning lake views. Enjoy BBQ nights under the stars, thrilling adventure activities, and unforgettable
      moments surrounded by nature. Perfect for a peaceful getaway or an exciting adventure! Book your package now!
    </h5>
  </div>



  <!-- Packages
    <h2 class="mt-5 pt-5 text-center fw-bold h-font mb-4">OUR PACKAGES</h2>
    <div class="container">
      <div class="row justify-content-center gap-5">
        <div class="col-lg-4 col-md-6 my-3">
          <div class="card border-0 shadow border-top border-4 pop" style="max-width: 350px; margin: auto;">
            <img src="images/rooms/img30.jpg" class="card-img-top">
            <div class="card-body">
              <h3 class="card-title fw-bold">Camping Tents</h3>
              <h6 class="mb-4">₹999 per person</h6>
              <div class="includes">
                <h4 class="mt-4 mb-3 description-font">Package includes : </h4>
                <ul>
                  <li>Evening Snacks</li>
                  <li>BBQ (Veg / Nonveg)</li>
                  <li>Unlimited Dinner (Veg / Nonveg)</li>
                  <li>Morning Breakfast</li>
                  <li>Campfire</li>
                  <li>Music / Live Music (on Saturday)</li>
                  <li>Games</li>
                  <li>Movie Screening</li>
                  <li>Free Parking</li>
                  <li>Hygienic Toilets</li>
                  <li>Mobile Charging Point</li>
                </ul>
                <h4 class="mt-4 mb-3 description-font">Add-on Activities (optional) : </h4>
                <p>Boating | Paragliding | Camel Riding | Horse Riding | Kayaking</p>
                <h4 class="mt-4 mb-3 description-font">Time : </h4>
                <p class="text-center">Check-in : 4.00pm | Check-out : 11.00am</p>
              </div>
              <p class="card-text"></p>
              <a href="#" class="btn btn-primary book-now-btn">Book Now</a>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 my-3">
          <div class="card border-0 shadow border-top border-4 pop" style="max-width: 350px; margin: auto;">
            <img src="images/rooms/img37.jpg" class="card-img-top" style="height: 250px; border: 15px solid white;">
            <div class="card-body">
              <h3 class="card-title fw-bold">Black Pearl Cottages</h3>
              <h6 class="mb-4">₹3999 per couple</h6>
              <div class="includes">
                <h4 class="mt-4 mb-3 description-font">Package includes : </h4>
                <ul>
                  <li>Evening Snacks</li>
                  <li>BBQ (Veg / Nonveg)</li>
                  <li>Unlimited Dinner (Veg / Nonveg)</li>
                  <li>Morning Breakfast</li>
                  <li>Campfire</li>
                  <li>Music / Live Music (on Saturday)</li>
                  <li>Games</li>
                  <li>Movie Screening</li>
                  <li>Free Parking</li>
                  <li>Hygienic Toilets</li>
                  <li>Mobile Charging Point</li>
                  <li>Cooler Inside Cottage</li>
                </ul>
                <h4 class="mt-4 mb-3 description-font">Add-on Activities (optional) : </h4>
                <p>Boating | Paragliding | Camel Riding | Horse Riding | Kayaking</p>
                <h4 class="mt-4 mb-3 description-font">Time : </h4>
                <p class="text-center">Check-in : 4.00pm | Check-out : 11.00am</p>
              </div>

              <p class="card-text"></p>
              <a href="#" class="btn btn-primary book-now-btn">Book Now</a>
            </div>

          </div>
        </div>
      </div>
    </div>

  Content Section-->

  <!-- Content Section -->
  <div class=" section mt-5">
    <div class="container">
      <!-- Image Row -->
      <div class="row justify-content-center g-4">
        <div class="col-lg-3 col-md-4 col-sm-6 d-flex justify-content-center">
          <img src="images/img14.jpg" class="img-fluid rounded" style="max-width: 100%; height: auto;">
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 d-flex justify-content-center">
          <img src="images/img15.jpg" class="img-fluid rounded" style="max-width: 100%; height: auto;">
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 d-flex justify-content-center">
          <img src="images/img39.jpg" class="img-fluid rounded" style="max-width: 100%; height: auto;">
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 d-flex justify-content-center">
          <img src="images/img18.jpg" class="img-fluid rounded" style="max-width: 100%; height: auto;">
        </div>
      </div>

      <!-- Text Section -->
      <div class="text-center mt-5">
        <h3 class="fw-bold description-font" style="color: white; font-style: italic;">Experience a Fun & Relaxing
          Camping in Lonavala
        </h3><br>
        <p class="description-font fs-5 px-3 px-md-5" style="color: white;">
          Welcome to your ultimate lakeside retreat booking platform! Immerse yourself in the beauty of nature with
          our
          handpicked lakeside camping experiences. Choose from cozy tents and charming cottages, each offering
          breathtaking
          views of the tranquil lake. Picture yourself waking up to the gentle sounds of nature, enjoying a delicious
          BBQ
          under the stars, and indulging in thrilling adventure activities like kayaking, boating, paragliding, and
          bonfires.
          Whether you're seeking a serene getaway or an action-packed adventure, our website helps you plan an
          unforgettable
          stay by the lakeside. Perfect for families, couples, and groups of friends, we make your lakeside escape
          easy and
          hassle-free. Start your journey to tranquility today! How does that sound?
        </p><br><br>
        <h3 class="fw-bold description-font" style="color: white; font-style: italic;">Thrilling Activities to Try at
          Pawana Lake
        </h3><br>
        <ul type="none" style="color: white;">
          <li>BOATING : ₹200 - 300 per person</li><br>
          <li>KAYAKING : ₹200 per person</li><br>
          <li>CAMEL RIDING : ₹100 per person</li><br>
          <li>HORSE RIDING : ₹150 per person</li><br>
          <li>PARAGLIDING : ₹3500 per person</li><br>
        </ul>
        <h3 class="fw-bold description-font" style="color: white; font-style: italic;">Nearby Tourist Places
        </h3><br>
        <ul type="none" style="color: white;">
          <li>FORTS : Lohagad Fort | Visapur Fort | Tung Fort | Tikona Fort | Morgiri Fort</li><br>
          <li>CAVES : Bedse Caves</li><br>
          <li>DINOSAUR PARK</li><br>
          <li>PRATI PANDHARPUR TEMPLE</li><br>
          <li>SATYSAI BABA TEMPLE HADSHI</li><br>
          <li>SANTDARSHAN MUSEUM</li><br>
        </ul>
      </div>
    </div>
  </div>
  <!--Testimonials-->
  <!-- Testimonials Section -->
  <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">TESTIMONIALS</h2>
  <div class="container mt-5">
    <div class="swiper Testimonial-Swiper">
      <div class="swiper-wrapper mb-5">
        <?php
        $res = $con->query("SELECT * FROM reviews ORDER BY added_on DESC");
        while ($row = $res->fetch_assoc()):
          ?>
          <div class="swiper-slide bg-white p-4">
            <div class="profile d-flex align-items-center mb-2">
              <?php
              $profile_img = (!empty($row['profile_image']) && file_exists($row['profile_image']))
                ? $row['profile_image']
                : 'uploads/reviews/user.png';
              ?>
              <img src="<?= $profile_img ?>" width="40" height="40" class="rounded-circle me-2">

              <h6 class="m-0"><?= htmlspecialchars($row['name']) ?></h6>
            </div>
            <p><?= htmlspecialchars($row['review']) ?></p>
            <div class="rating">
              <?php for ($i = 0; $i < $row['rating']; $i++): ?>
                <i class="bi bi-star-fill text-warning"></i>
              <?php endfor; ?>
            </div>
          </div>
        <?php endwhile; ?>
      </div>
      <div class="swiper-pagination"></div>
    </div>
  </div>

  <div class="mt-4 text-center">
    <button type="button" class="btn custom-bg text-white" id="openReviewModal">Add Review</button>
  </div>

  <!-- Review Modal -->
  <div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form method="POST" enctype="multipart/form-data" class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add Your Review</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="text" name="name" class="form-control mb-3" placeholder="Name" required>
          <select name="rating" class="form-select mb-3" required>
            <option value="">Select Rating</option>
            <option value="5">⭐⭐⭐⭐⭐</option>
            <option value="4">⭐⭐⭐⭐</option>
            <option value="3">⭐⭐⭐</option>
            <option value="2">⭐⭐</option>
            <option value="1">⭐</option>
          </select>
          <textarea name="review" class="form-control mb-3" rows="3" placeholder="Your review" required></textarea>
          <input type="file" name="profile_image" class="form-control" accept=".jpg,.jpeg,.png">
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn custom-bg text-white">Submit</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    document.getElementById("openReviewModal").addEventListener("click", function () {
      var reviewModal = new bootstrap.Modal(document.getElementById("reviewModal"));
      reviewModal.show();
    });
  </script>


  <!-- Trigger Button -->
  <!-- <script>
  document.querySelector(".btn.custom-bg").addEventListener("click", function () {
    var reviewModal = new bootstrap.Modal(document.getElementById("reviewModal"));
    reviewModal.show();
  });
</script> -->



  <!--Reach us-->


  <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">REACH US</h2>
  <div class="container">
    <div class="row">

      <!--Map-->

      <div class="col-lg-8 col-md-8 p-4 mb-1g-0 mb-3 bg-white rounded">
        <iframe class="w-100 rounded" src="<?php echo $contact_r['iframe'] ?>" height="350px" loading="lazy"></iframe>
      </div>

      <!--Contact-->
      <div class="col-lg-4 col-md-4">
        <!--Call-->
        <div class="bg-white p-4 rounded mb-4">
          <h5>Call Us</h5>
          <a href="tel: +<?php echo $contact_r['pn'] ?>" class="d-inline-block mb-2 text-decoration-none text-dark"><i
              class="bi bi-telephone-fill"></i> +<?php echo $contact_r['pn'] ?></a>
        </div>

        <div class="bg-white p-4 rounded mb-4">
          <h5>Follow Us</h5>
          <!--Twitter
            <a href="#" class="d-inline-block mb-3">
              <span class="badge bg-light text-dark fs-6 p-2">
                <i class="bi bi-twitter me1"></i> Twitter
              </span>
            </a>
            <br>-->
          <!--Instagram-->
          <a href="<?php echo $contact_r['insta'] ?>" class="d-inline-block mb-3">
            <span class="badge bg-light text-dark fs-6 p-2">
              <i class="bi bi-instagram me1"></i> Instagram
            </span>
          </a>
          <br>

          <!--Facebook
            <a href="" class="d-inline-block mb-3">
              <span class="badge bg-light text-dark fs-6 p-2">
                <i class="bi bi-facebook me1"></i> Facebook
              </span>
            </a>-->
        </div>


      </div>

    </div>
  </div>

  <!--Footer-->
  <?php require('IncludeFiles/footer.php'); ?>


  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script>
    var swiper = new Swiper(".mySwiper", {
      spaceBetween: 30,
      effect: "fade",
      loop: true,
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      autoplay: {
        delay: 3500,
        disableOnInteraction: false,
      },
    });
    var swiper = new Swiper(".Testimonial-Swiper", {
      effect: "coverflow",
      grabCursor: true,
      centeredSlides: true,
      slidesPerView: "auto",
      slidesPerView: "3",
      coverflowEffect: {
        rotate: 50,
        stretch: 0,
        depth: 100,
        modifier: 1,
        slideShadows: false,
      },
      pagination: {
        el: ".swiper-pagination",
      },
      breakpoints: {
        320: {
          slidesPerView: 1,
        },
        640: {
          slidesPerView: 1,
        },
        768: {
          slidesPerView: 2,
        },
        1024: {
          slidesPerView: 3,
        },
      }
    });
  </script>
</body>

</html>

<!--rgb(248, 241, 241)-->