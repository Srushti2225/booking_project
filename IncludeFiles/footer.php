<div class="container-fluid mt-5 section">
    <div class="row text-center">
        <!-- Column 1: About -->
        <div class="col-lg-4 p-4">
            <img src="images/img5.jpg" width="500px" style="border-radius: 10px; margin-bottom: 20px;">
            <h3 class="h-font fw-bold fs-3 mb-3" style="color: #ecf0f1;">Pawana Camping</h3>
            <p style="color: #ecf0f1; line-height: 1.6;">
                Experience the best lakeside camping with breathtaking views, adventure activities, and cozy bonfires
                under
                the stars.
            </p>
        </div>

        <!-- Column 2: Quick Links -->
        <div class="col-lg-4 p-4">
            <h5 class="mb-4" style="color: #ecf0f1; text-transform: uppercase; font-weight: bold;">Quick Links</h5>
            <ul style="list-style: none; padding: 0;">
                <li style="margin-bottom: 10px;"><a href="index.php" class="text-decoration-none"
                        style="color: #ecf0f1;">Home</a>
                </li>
                <li style="margin-bottom: 10px;"><a href="packages.php" class="text-decoration-none"
                        style="color: #ecf0f1;">Packages</a></li>
                <li style="margin-bottom: 10px;"><a href="Gallery.php" class="text-decoration-none"
                        style="color: #ecf0f1;">Gallery</a></li>
                <li style="margin-bottom: 10px;"><a href="Contact.php" class="text-decoration-none"
                        style="color: #ecf0f1;">Contact
                        Us</a></li>
                <li style="margin-bottom: 10px;"><a href="AboutUs.php" class="text-decoration-none"
                        style="color: #ecf0f1;">About Us</a></li>
                <li style="margin-bottom: 10px;"><a href="Cancellation.php" class="text-decoration-none"
                        style="color: #ecf0f1;">Cancellation Policy</a></li>
            </ul>
        </div>

        <!-- Column 3: Follow Us -->
        <div class="col-lg-4 p-4">
            <h5 class="mb-4" style="color: #ecf0f1; text-transform: uppercase; font-weight: bold;">Follow Us</h5>
            <ul style="list-style: none; padding: 0;">
                <!--<li style="margin-bottom: 10px;">
                    <a href="#" class="text-decoration-none" style="color: #ecf0f1;">
                        <i class="bi bi-twitter me-2"></i> Twitter
                    </a>
                </li>
                <li style="margin-bottom: 10px;">
                    <a href="#" class="text-decoration-none" style="color: #ecf0f1;">
                        <i class="bi bi-facebook me-2"></i> Facebook
                    </a>
                </li>-->
                <li>
                    <a href="<?php echo $contact_r['insta'] ?>" class="text-decoration-none" style="color: #ecf0f1;">
                        <i class="bi bi-instagram me-2"></i> Instagram
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<h6 class="text-center bg-dark text-white p-3 m-0">&copy; 2025 Lakeshore Camping. All rights reserved.</h6>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>

<script>
    function setActive() {
        let navbar = document.getElementById('nav-bar');
        let a_tags = navbar.getElementsByTagName('a');
        for (i = 0; i < a_tags.length; i++) {
            let file = a_tags[i].href.split('/').pop();
            let file_name = file.split('.')[0];

            if(document.location.href.indexOf(file_name) >= 0){
                a_tags[i].classList.add('active');
            }

        }
    }
    setActive();
</script>