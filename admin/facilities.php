<?php
require('Includes/essentials.php');
require('Includes/db_configuration.php');
adminLogin();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - About Us</title>
    <?php require('Includes/links.php'); ?>
</head>

<body class="bg-light">

    <?php require('Includes/header.php'); ?>

    <div class="container-fluid main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-3">ABOUT SETTINGS</h3>
                <!-- Facilities section -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">Facilities</h5>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn custom-bg shadow-none btn-sm text-white"
                                data-bs-toggle="modal" data-bs-target="#facility-settings">
                                <i class="bi bi-pencil-square"></i> Add
                            </button>
                        </div>
                        <div class="table-responsive-md" style="height: 450px; overflow-y; scroll;">
                            <table class="table table-hover border">
                                <thead>
                                    <tr class="custom-bg text-white">
                                        <th scope="col">#</th>
                                        <th scope="col">Icon</th>
                                        <th scope="col">Name</th>
                                        <th scope="col" width="40%">Description</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="facilities-data">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Facility Modal -->
                <div class="modal fade" id="facility-settings" data-bs-backdrop="static" data-bs-keyboard="true"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form id="facility_s_form">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add Facility</h5>
                                </div>
                                <div class="modal-body">
                                    <div class=" mb-3">
                                        <label class="form-label fw-bold">Name</label>
                                        <input type="text" name="facility_name" class="form-control shadow-none"
                                            required>
                                    </div>
                                    <div class=" mb-3">
                                        <label class="form-label fw-bold">Icon</label>
                                        <input type="file" name="facility_icon" accept=".jpg, .png, .webp, .jpeg"
                                            class="form-control shadow-none" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Description</label>
                                        <textarea name="facility_description" class="form-control shadow-none" rows="3"
                                            required></textarea>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="reset" class="btn text-secondary shadow-none"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn custom-bg text-white shadow-none">Submit</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>

                <!-- About us setion -->
                <!-- <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">About Us</h5>
                           
                            <button type="button" class="btn custom-bg shadow-none btn-sm text-white"
                                data-bs-toggle="modal" data-bs-target="#about_section-settings">
                                <i class="bi bi-pencil-square"></i> Edit
                            </button>
                        </div>
                        <div class="table-responsive-md" style="height: 450px; overflow-y; scroll;">
                            <table class="table table-hover border">
                                <thead>
                                    <tr class="custom-bg text-white">
                                        <th scope="col">#</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="about_section_data">
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                </div> -->

                <!-- About us modal -->
                <!-- <div class="modal fade" id="about_section-settings" data-bs-backdrop="static" data-bs-keyboard="true"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form id="about_section_form">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add Facility</h5>
                                </div>
                                <div class="modal-body">
                                    <div class=" mb-3">
                                        <label class="form-label fw-bold">Title</label>
                                        <input type="text" name="about_section_title" class="form-control shadow-none"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Description</label>
                                        <textarea name="about_section_description" class="form-control shadow-none" rows="3"
                                            required></textarea>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="reset" class="btn text-secondary shadow-none"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn custom-bg text-white shadow-none">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div> -->

            </div>
        </div>
    </div>



    <?php require('Includes/scripts.php'); ?>
    <script src="scripts/facilities.js"></script>


</body>

</html>