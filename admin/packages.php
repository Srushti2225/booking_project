<?php
require('Includes/essentials.php');
require('Includes/db_Configuration.php');
adminLogin();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Packages</title>
    <?php require('Includes/links.php'); ?>
</head>

<body class="bg-light">

    <?php require('Includes/header.php'); ?>

    <div class="container-fluid main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-3">PACKAGES</h3>
                <!-- Packages section -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="text-end mb-3">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn custom-bg shadow-none btn-sm text-white"
                                data-bs-toggle="modal" data-bs-target="#add-package">
                                <i class="bi bi-pencil-square"></i> Add
                            </button>
                        </div>
                        <div class="table-responsive-lg" style="height: 450px; overflow-y: scroll;">
                            <table class="table table-hover border text-center">
                                <thead>
                                    <tr class="custom-bg text-white">
                                        <th scope="col">#</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Packages Include</th>
                                        <th scope="col">Add-On Activities</th>
                                        <th scope="col">Check-In Time</th>
                                        <th scope="col">Check-Out Time</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="packages-data">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add packages Modal -->
    <div class="modal fade" id="add-package" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form id="add_package_form" autocomplete="off">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Package</h5>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row g-3">

                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Name</label>
                                    <input type="text" name="name" class="form-control shadow-none" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Image</label>
                                    <input type="file" name="image" accept=".jpg, .png, .webp, .jpeg"
                                        class="form-control shadow-none" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Price</label>
                                    <input type="number" name="price" class="form-control shadow-none" step="0.01"
                                        required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Check-in Time</label>
                                    <input type="time" name="check_in" class="form-control shadow-none" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Check-out Time</label>
                                    <input type="time" name="check_out" class="form-control shadow-none" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Add-on Activities</label>
                                    <textarea name="addons" class="form-control shadow-none" rows="3"
                                        required></textarea>
                                </div>

                                <div class="col-12">
                                    <label class="form-label fw-bold">Packages Include</label>
                                    <textarea name="inclusions" class="form-control shadow-none" rows="4"
                                        required></textarea>
                                </div>

                            </div>
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

    <?php require('Includes/scripts.php'); ?>

    <script>
        let add_package_form = document.getElementById('add_package_form');
        add_package_form.addEventListener('submit', function (e) {
            e.preventDefault();
            add_package();
        })

        function add_package() {
            let data = new FormData;
            data.append('add_package', '');
            data.append('name', add_package_form.elements['name'].value);
            data.append('image', add_package_form.elements['image'].files[0]);
            data.append('price', add_package_form.elements['price'].value);
            data.append('inclusions', add_package_form.elements['inclusions'].value);
            data.append('addons', add_package_form.elements['addons'].value);
            data.append('check_in', add_package_form.elements['check_in'].value);
            data.append('check_out', add_package_form.elements['check_out'].value);
            

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/packages_crud.php", true);

            xhr.onload = function () {
                var myModal = document.getElementById('add-package');
                var modal = bootstrap.Modal.getInstance(myModal);
                modal.hide();

                if (this.responseText == 1) {
                    alert('success', 'New package added!');
                    add_package_form.reset();
                    get_packages();
                } else if (this.responseText == 'inv_img') {
                    alert('error', 'Only JPG, PNG, and WEBP images are allowed!');
                } else if (this.responseText == 'inv_size') {
                    alert('error', 'Image should be less than 2MB!');
                } else if (this.responseText == 'upd_failed') {
                    alert('error', 'Image upload failed. Server Down!');
                } else {
                    alert('error', 'Server error: ' + this.responseText);
                }
        }
        xhr.send(data);
    }


        function get_packages() {
            //console.log(this.responseText);

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/packages_crud.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function () {
                document.getElementById('packages-data').innerHTML = this.responseText;
            }
            xhr.send('get_packages=1');

        }
        function rem_package(val) {
            if (!confirm('Are you sure?')) return;
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/packages_crud.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (this.status === 200 && this.responseText === '1') {
                    alert('success', 'Package deleted successfully!');
                    get_packages();
                } else {
                    alert('error', 'Deletion failed!');
                }
            };
            xhr.send('rem_package='+val);
        }
        function toggle_status(id,val)
        {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/packages_crud.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function(){
                if(this.responseText==1){
                    alert('success', 'Status toggled!');
                }
                else{
                    alert('error', 'Server down!');
                }

            }
            xhr.send('toggle_status='+id+'&value='+val);
        }

        window.onload = function () {
            get_packages();
        }

    </script>
</body>

</html>
