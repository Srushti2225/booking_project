<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Packages</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <?php require('IncludeFiles/links.php'); ?>
  <style>
    .pop:hover {
      border-top-color: var(--184C89) !important;
      transform: scale(1.03);
      transition: all 0.3s;
    }


    
  </style>
</head>

<body>
  <?php require('IncludeFiles/header.php'); ?>

  <!--Packages-->
  <div>
    <h2 class="text-center mb-4 h-font pt-5">OUR PACKAGES</h2>
    <p class="mt-3 mb-4 description-font">
      Choose from a variety of thoughtfully curated packages to make your Pawana Camping experience unforgettable. From
      cozy camping tents to luxurious Black Pearl cottages, each package includes delicious meals, bonfire evenings,
      games, music, and optional activities like boating and paragliding. Enjoy breathtaking lakeside views and create
      lasting memories with flexible check-in and check-out times and plenty of facilities to ensure your comfort.
    </p>
  </div>
  <div class="container">
    <div class="row justify-content-center gap-5">
      <?php
      $res = selectAll('packages');
      $path = PACKAGE_IMG_PATH;
      while ($row = mysqli_fetch_assoc($res)) {
        //Split inclusions by newlines and create list items
        $inclusion_items = explode("\n", trim($row['inclusions']));
        $list_items = array_map(function ($item) {
          return "<li>$item</li>";
        }, $inclusion_items);
        $ul_content = implode("\n", $list_items);
        echo <<<data
                    <div class="col-lg-4 col-md-6 my-3">
                        <div class="card border-0 shadow border-top border-4 pop" style="max-width: 350px; margin: auto;">
                            <img src="$path$row[image]" class="card-img-top" style="height: 250px; border: 15px solid white;">
                            <div class="card-body">
                                <h3 class="card-title fw-bold">$row[name]</h3>
                                <h6 class="mb-4">₹$row[price] per person</h6>
                                <div class="includes">
                                    <h4 class="mt-4 mb-3 description-font">Package includes :</h4>
                                    <ul>
                                      $ul_content
                                    </ul>

                                    <h4 class="mt-4 mb-3 description-font">Add-on Activities (optional) :</h4>
                                    <p>$row[addons]</p>
                                    <h4 class="mt-4 mb-3 description-font">Time :</h4>
                                    <p class="text-center">Check-in : $row[check_in] | Check-out : $row[check_out]</p>
                                </div>
                                <p class="card-text"></p>
                                <a href="confirm_booking.php?id=$row[id]" class="btn btn-primary book-now-btn">Book Now</a>

                            </div>
                        </div>
                    </div>
                data;
      }
      ?>
    </div>
  </div>
  

  <?php require('IncludeFiles/footer.php'); ?>
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</body>

</html>