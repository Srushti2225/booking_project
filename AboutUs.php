<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pawana Camping - About Us</title>
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

<body class="bg-light">
    <?php require('IncludeFiles/header.php'); ?>

    <div class="my-5 px-4">
        <h2 class="h-font text-center fw-bold">ABOUT US</h2>
        <div class="h-line bg-dark"></div>
        <p class="mt-3 description-font">
            Discover the charm of Pawana Camping—a perfect destination for connecting with nature and embracing
            adventure. Situated by a tranquil lakeside, our campsite offers scenic views, delightful activities, and a
            refreshing break from daily life. Whether you're seeking excitement in outdoor adventures or looking to
            relax around a cozy bonfire beneath a starlit sky, Pawana Camping has something for everyone!
        </p>
    </div>
    <!-- <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-6 col-md-5 mb-4 order-lg-1 order-md-1 order-2">
                <h3 class="mb-3">Lorem ipsum dolor sit amet.</h3>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore nam rem in suscipit eligendi. Ea!
                </p>
            </div>
            <div class="col-lg-5 col-md-5 mb-4 order-lg-2 order-md-2 order-1">
                <img src="images/img39.jpg" class="w-100">
            </div>
        </div>
    </div> -->
    <div class="container mt-5">
        <div class="row">

            <?php
            $res = selectAll('facilities');
            $path = ABOUT_IMG_PATH;
            while ($row = mysqli_fetch_assoc($res)) {
                echo <<<data
                    <div class="col-lg-3 col-md-6 mb-4 px-4">
                        <div class="bg-white rounded shadow p-4 border-top border-4 text-center pop">
                            <img src="$path$row[icon]" width="100px">
                            <h5 class="mt-3">$row[name]</h5>
                            <h6 class="description-font">$row[description]</h6>
                </div>
            </div>
            data;
            }
            ?>

            <!-- <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center pop">
                    <img src="images/about/tent.png" width="100px">
                    <h5 class="mt-3">100+ Tents & Cottages</h5>
                    <h6 class="description-font">A wide variety of accommodations to suit your comfort, offering cozy
                        cottages and spacious tents.</h6>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center pop">
                    <img src="images/about/calendar.png" width="100px">
                    <h5 class="mt-3">Since 2010</h5>
                    <h6 class="description-font">Over a decade of providing unforgettable camping experiences by the
                        serene lakeside.</h6>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center pop">
                    <img src="images/about/feedback.png" width="100px">
                    <h5 class="mt-3">150+ Reviews</h5>
                    <h6 class="description-font">Loved by many—our glowing reviews highlight the joy and memories
                        created here.</h6>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center pop">
                    <img src="images/about/satisfaction.png" width="100px">
                    <h5 class="mt-3">100+ Satisfied Campers</h5>
                    <h6 class="description-font">We've hosted countless happy campers who return for the magic of nature
                        and adventure.</h6>
                </div>
            </div> -->
        </div>
    </div>

    <!--Why choose us-->
    <div class="container py-5">
        <h3 class="h-font text-center fw-bold pt-5">Why Choose Us?</h3>
        <p class="pt-3 description-font">At Pawana Camping, we pride ourselves on delivering a comprehensive and
            unforgettable camping experience. Enjoy a delicious BBQ with both vegetarian and non-vegetarian options,
            unlimited dinner, and a wholesome morning breakfast to start your day. Relax by the campfire, sing along to
            music, or immerse yourself in live music performances on Saturdays. Participate in exciting games, catch a
            movie
            screening under the stars, and take advantage of free parking and clean, hygienic toilets.
            Thrill-seekers can indulge in a variety of adventure activities like boating, kayaking, camel riding, horse
            riding, and even paragliding. For those who love exploration, nearby attractions include historic forts such
            as
            Lohagad, Visapur, Tung, Tikona, and Morgiri; natural wonders like Bedse Caves; and unique destinations like
            Dinosaur Park, Prati Pandharpur Temple, Satya Sai Baba Temple Hadshi, and the Santdarshan Museum.
            With comfort, adventure, and stunning surroundings, Pawana Camping is your ultimate destination for creating
            cherished memories.</p>

        <!--Mission & Vision-->
        <h3 class="h-font text-center fw-bold pt-5">Our Mission & Vision</h3>
        <p class="pt-3 description-font">At Pawna Camp, we invite you to immerse yourself in a unique lakeside getaway.
            Here, you can unwind with peaceful surroundings, enjoy warm evenings by the fire, and soak in the beauty of
            Pawna Lake. With a focus on sustainable practices, unmatched hospitality, and breathtaking views, we aim to
            create a welcoming space where relaxation and adventure come together, allowing guests to savor nature and
            build
            lasting memories.</p>

        <!--Service overview-->
        <h3 class="h-font text-center fw-bold pt-5">Service Overview</h3>
        <p class="pt-3 description-font">At Pawana Camping, our dedicated team ensures every guest enjoys an exceptional
            experience. From warm and welcoming hospitality to expertly organized activities, we strive to create a
            seamless
            and memorable stay. Indulge in delicious meals prepared with care, relax in thoughtfully maintained
            accommodations, and rely on our attentive staff for all your needs. Whether it's arranging adventure
            activities
            or providing personalized assistance, our team is committed to making your lakeside getaway truly special.
        </p>

        <!--Testimonials-->
        <h3 class="h-font text-center fw-bold pt-5">Testimonials</h3>
        <p class="pt-3 description-font">See what our happy campers have to say about their unforgettable experiences at
            Pawana Camping!</p>
        <div style="text-align: center;">
            <a href="index.php" class="description-font">Visit Our Homepage!</a>
        </div>

        <!--Packages-->
        <h3 class="h-font text-center fw-bold pt-5">Packages</h3>
        <p class="pt-3 description-font">Explore our exciting camping packages designed for adventure and relaxation!
        </p>
        <div style="text-align: center;">
            <a href="packages.php" class="description-font">Check out our packages for more details</a>
        </div>
    </div>




    <!--Footer-->
    <?php require('IncludeFiles/footer.php'); ?>


    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</body>

</html>

<!--rgb(248, 241, 241)-->