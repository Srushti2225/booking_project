<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pawana Camping - About Us</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <?php require('IncludeFiles/links.php'); ?>
</head>
<style>
    * {
        margin: 0;
        padding: 0;
    }

    .img-gallery {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        /* Responsive grid */
        gap: 15px;
        padding: 20px;
    }

    .img-gallery img {
        width: 100%;
        height: auto;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease-in-out;
        cursor: pointer;
    }

    .img-gallery img:hover {
        transform: scale(1.03);
        transition: all 0.3s;
    }

    .lightbox {
        display: none;
        /* Hidden by default */
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.8);
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }

    .lightbox img {
        max-width: 90%;
        max-height: 90%;
        border-radius: 8px;
    }
</style>

<body class="bg-light">
    <?php require('IncludeFiles/header.php'); ?>

    </head>

    <body>
        <div class="lightbox" id="lightbox" onclick="closeLightbox()">
            <img src="images/img1.jpg" alt="Full Image">
        </div>
        <h1 class="text-center mb-4 h-font pt-5">GALLERY</h1>
        <div class="img-gallery">
            <img src="images/img1.jpg" onclick="openLightbox(this)">
            <img src="images/img2.jpg" onclick="openLightbox(this)">
            <img src="images/img3.jpg" onclick="openLightbox(this)">
            <img src="images/img9.jpg" onclick="openLightbox(this)">
            <img src="images/img4.jpg" onclick="openLightbox(this)">
            <img src="images/img26.jpg" onclick="openLightbox(this)">
            <img src="images/img31.jpg" onclick="openLightbox(this)">
            <img src="images/img32.jpg" onclick="openLightbox(this)">
            <img src="images/img27.jpg" onclick="openLightbox(this)">
            <img src="images/img23.jpg" onclick="openLightbox(this)">
            <img src="images/img40.jpg" onclick="openLightbox(this)">
            <img src="images/img20.jpg" onclick="openLightbox(this)">
            <img src="images/img8.jpg" onclick="openLightbox(this)">
            <img src="images/img19.jpg" onclick="openLightbox(this)">
            <img src="images/img25.jpg" onclick="openLightbox(this)">
            <img src="images/img28.jpg" onclick="openLightbox(this)">
            <img src="images/img37.jpg" onclick="openLightbox(this)">
            <img src="images/img38.jpg" onclick="openLightbox(this)">
            <img src="images/img12.jpg" onclick="openLightbox(this)">
            <img src="images/img24.jpg" onclick="openLightbox(this)">
        </div>


        <script>
            // Open lightbox
            function openLightbox(image) {
                const lightbox = document.getElementById('lightbox');
                const lightboxImage = lightbox.querySelector('img');
                lightboxImage.src = image.src;
                lightbox.style.display = 'flex';
            }

            // Close lightbox
            function closeLightbox() {
                const lightbox = document.getElementById('lightbox');
                lightbox.style.display = 'none';
            }
        </script>
        <!--Footer-->
        <?php require('IncludeFiles/footer.php'); ?>
    </body>

</html>