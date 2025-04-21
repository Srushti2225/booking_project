<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pawana Camping - About Us</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <?php require('IncludeFiles/links.php'); ?>
</head>

<body class="bg-light">
    <?php require('IncludeFiles/header.php'); ?>

    <div class="my-5 px-4">
        <h2 class="h-font text-center fw-bold mb-5">CONTACT US</h2>
        <div class="h-line bg-dark"></div>
        <p class="mt-3 description-font">
            Discover the charm of Pawana Camping—a perfect destination for connecting with nature and embracing
            adventure. Situated by a tranquil lakeside, our campsite offers scenic views, delightful activities, and a
            refreshing break from daily life. Whether you're seeking excitement in outdoor adventures or looking to
            relax around a cozy bonfire beneath a starlit sky, Pawana Camping has something for everyone!
        </p>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-6 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4">
                    <iframe class="w-100 rounded mb-4"
                        src="<?php echo $contact_r['iframe']?>"
                        height="350px" loading="lazy"></iframe>
                    <h5>Address</h5>
                    <a href="<?php echo $contact_r['gMap']?>" target="_blank"
                        class="d-inline-block text-decoration-none text-dark">
                        <i class="bi bi-geo-alt-fill"></i> <?php echo $contact_r['address']?>
                    </a>
                    <h5 class="mt-4">Call Us</h5>
                    <a href="tel: +<?php echo $contact_r['pn']?>" class="d-inline-block mb-2 text-decoration-none text-dark"><i
                            class="bi bi-telephone-fill"></i> +<?php echo $contact_r['pn']?></a>
                    <h5 class="mt-4">Mail</h5>
                    <a href="mailto: <?php echo $contact_r['email']?>" target="_blank"
                        class="d-inline-block text-decoration-none text-dark"><i class="bi bi-envelope-fill"></i>
                        <?php echo $contact_r['email']?></a>
                    <h5 class="mt-4">Follow Us</h5>
                    <!--Instagram-->
                    <a href="<?php echo $contact_r['insta']?>"
                        class="d-inline-block mb-3 text-decoration-none text-dark">
                        <i class="bi bi-instagram me1"></i> Instagram
                    </a>

                </div>
            </div>
            <div class="col-lg-6 col-md-6 px-4">
                <div class="bg-white rounded shadow p-4">
                    <form method="POST">
                    <h5>Send a Message</h5>
                    <div class="mt-3">
                        <label class="form-label" style="font-weight: 500;">Name</label>
                        <input name="name" required type="text" class="form-control" placeholder="Enter Name">
                    </div>
                    <div class="mt-3">
                        <label class="form-label" style="font-weight: 500;">Email</label>
                        <input name="email" required type="email" class="form-control" placeholder="Enter Email">
                    </div>
                    <div class="mt-3">
                        <label class="form-label" style="font-weight: 500;">Subject</label>
                        <input name="subject" required type="text" class="form-control" placeholder="Enter Subject">
                    </div>
                    <div class="mt-3">
                        <label class="form-label" style="font-weight: 500;">Message</label>
                        <textarea name="message" required class="form-control shadow-none" rows="3" placeholder="Enter Your Message" style="resize: none"></textarea>
                    </div>
                    <div>
                    <button name="send" type="submit" class="btn text-white custom-bg mt-3">SEND</button>
                    </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <?php
    if(isset($_POST['send']))
    {
        $frm_data = filter($_POST);
        $q = "INSERT INTO `user_queries`(`name`, `email`, `subject`, `message`) VALUES (?,?,?,?)";
        $values = [$frm_data['name'],$frm_data['email'],$frm_data['subject'],$frm_data['message']];

        $res = insert($q,$values,'ssss');
        if($res==1){
            alert('success', 'Mail sent!');
        }
        else{
            alert('error', 'Server down! Try again later.');
        }
    }    
    ?>

    <!--Footer-->
    <?php require('IncludeFiles/footer.php'); ?>
    </body>
    </html>