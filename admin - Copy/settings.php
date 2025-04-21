<?php
require('Includes/essentials.php');
adminLogin();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Settings</title>
    <?php require('Includes/links.php'); ?>
</head>

<body class="bg-light">

    <?php require('Includes/header.php'); ?>

    <div class="container-fluid main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-3">SETTINGS</h3>

                <!--General settings-->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">General Settings</h5>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn custom-bg shadow-none btn-sm text-white"
                                data-bs-toggle="modal" data-bs-target="#general-settings">
                                <i class="bi bi-pencil-square"></i> Edit
                            </button>
                        </div>
                        <h6 class="card-subtitle mb-1 fw-bold">Site title</h6>
                        <p class="card-text" id="site_title"></p>
                        <h6 class="card-subtitle mb-1 fw-bold">About us</h6>
                        <p class="card-text" id="site_about"></p>
                    </div>
                </div>

                <!--General settings modal-->
                <div class="modal fade" id="general-settings" data-bs-backdrop="static" data-bs-keyboard="true"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form id="general_s_form">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">General Settings</h5>
                                </div>
                                <div class="modal-body">
                                    <div class=" mb-3">
                                        <label class="form-label fw-bold">Site Title</label>
                                        <input type="text" name="site_title" id="site_title_inp"
                                            class="form-control shadow-none" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">About us</label>
                                        <textarea name="site_about" id="site_about_inp" class="form-control shadow-none"
                                            rows="6" required></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button"
                                        onclick="site_title.value = general_data.site_title, site_about.value = general_data.site_about"
                                        class="btn text-secondary shadow-none" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn custom-bg text-white shadow-none">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!--Shutdown modal-->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">Shutdown</h5>
                            <div class="form-check form-switch">
                                <form>
                                    <input onchange="upd_shutdown(this.value)" class="form-check-input" type="checkbox"
                                        id="shutdown-toggle">
                                </form>
                            </div>
                        </div>

                        <p class="card-text">
                            No customers will be allowed to book tents and cottages, when shutdown is turned on.
                        </p>
                    </div>
                </div>

                <!-- Contact section details -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">Contact Settings</h5>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn custom-bg shadow-none btn-sm text-white"
                                data-bs-toggle="modal" data-bs-target="#contact-settings">
                                <i class="bi bi-pencil-square"></i> Edit
                            </button>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold">Address</h6>
                                    <p class="card-text" id="address"></p>
                                </div>
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold">Google Map</h6>
                                    <p class="card-text" id="gMap"></p>
                                </div>
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold">Phone Number</h6>
                                    <p class="card-text">
                                        <i class="bi bi-telephone-fill"></i>
                                        <span id="pn"></span>
                                    </p>
                                </div>
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold">E-mail</h6>
                                    <p class="card-text" id="email"></p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold">Social Link</h6>
                                    <p class="card-text mb-1">
                                        <i class="bi bi-instagram me-1"></i>
                                        <span id="insta"></span>
                                    </p>
                                </div>
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold">iFrame</h6>
                                    <iframe id="iframe" class="border p-2 w-100" loading="lazy"></iframe>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <!--Contact settings modal-->
                <div class="modal fade" id="contact-settings" data-bs-backdrop="static" data-bs-keyboard="true"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <form id="contacts_s_form">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Contacts Settings</h5>
                                </div>
                                <div class="modal-body">

                                    <div class="container-fluid p-0">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class=" mb-3">
                                                    <label class="form-label fw-bold">Address</label>
                                                    <input type="text" name="address" id="address_inp"
                                                        class="form-control shadow-none" required>
                                                </div>
                                                <div class=" mb-3">
                                                    <label class="form-label fw-bold">Google Map Link</label>
                                                    <input type="text" name="gMap" id="gMap_inp"
                                                        class="form-control shadow-none" required>
                                                </div>
                                                <div class=" mb-3">
                                                    <label class="form-label fw-bold">Phone Number (with country
                                                        code)</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text"><i
                                                                class="bi bi-telephone-fill"></i></span>
                                                        <input type="number" name="pn" id="pn_inp"
                                                            class="form-control shadow-none" required>
                                                    </div>
                                                </div>
                                                <div class=" mb-3">
                                                    <label class="form-label fw-bold">E-mail</label>
                                                    <input type="text" name="email" id="email_inp"
                                                        class="form-control shadow-none" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class=" mb-3">
                                                    <label class="form-label fw-bold">Social Links</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text"><i
                                                                class="bi bi-instagram"></i></span>
                                                        <input type="text" name="insta" id="insta_inp"
                                                            class="form-control shadow-none" required>
                                                    </div>
                                                </div>
                                                <div class=" mb-3">
                                                    <label class="form-label fw-bold">iFrame src</label>
                                                    <input type="text" name="iframe" id="iframe_inp"
                                                        class="form-control shadow-none" required>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" onclick="contacts_inp(contacts_data)"
                                        class="btn text-secondary shadow-none" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn custom-bg text-white shadow-none">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <?php require('Includes/scripts.php'); ?>
    <script src="scripts/settings.js"></script>
</body>

</html>