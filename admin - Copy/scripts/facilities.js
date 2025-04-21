        let facility_s_form = document.getElementById('facility_s_form');
        facility_s_form.addEventListener('submit', function(e){
            e.preventDefault();
            add_facility();
        })

        function add_facility()
        {
            let data = new FormData;
            data.append('name',facility_s_form.elements['facility_name'].value);
            data.append('icon',facility_s_form.elements['facility_icon'].files[0]);
            data.append('description',facility_s_form.elements['facility_description'].value);
            data.append('add_facility','');

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/facilities_crud.php", true);

            xhr.onload = function(){
                var myModal = document.getElementById('facility-settings');
                var modal = bootstrap.Modal.getInstance(myModal);
                modal.hide();

                if(this.responseText == 'inv_img'){
                    alert('error', 'Only JPG and PNG images are allowed!');
                }
                else if(this.responseText == 'inv_size'){
                    alert('error', 'Image should be less than 2MB!');
                }
                else if(this.responseText == 'upd_failed'){
                    alert('error', 'Image upload failed. Server Down!');
                }
                else{
                    alert('success', 'New Facility added successfully!');
                    facility_s_form.reset();
                    //get_carousel();
                }
            }
            xhr.send(data);
        }


        function get_facilities()
        {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/facilities_crud.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function(){
                document.getElementById('facilities-data').innerHTML = this.responseText;
            }
            xhr.send('get_facilities');
        
        }
        function rem_facility(val)
        {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/facilities_crud.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function(){
                if(this.responseText == 1){
                    alert('success', 'Facility removed!');
                    get_facilities();
                }
                else{
                    alert('error', 'Server down!');
                }
            }
            xhr.send('rem_facility='+val);
        }

    // let about_section_form = document.getElementById('about_section_form');
    // let about_section_data = document.getElementById('about_section_data');

    // Add section
    //     about_section_form.addEventListener('submit', function(e) {
    //         e.preventDefault();
    //         add_section();
    //     })

    // function add_section() {
    //     let data = new FormData(about_section_form); // Supports form data if expanded later
    //     data.append('add_section', '');

    //     let xhr = new XMLHttpRequest();
    //     xhr.open("POST", "ajax/facilities_crud.php", true);

    //     xhr.onload = function() {
    //         var myModal = document.getElementById('about_section-settings');
    //         var modal = bootstrap.Modal.getInstance(myModal);
    //         modal.hide();

    //         if (this.responseText == 1) {
    //             alert('success', 'New section added!');
    //             add_section_form.reset();
    //             get_sections();
    //         } else {
    //             alert('error', 'Server error: ' + this.responseText);
    //         }
    //     };
    //     xhr.send(data);
    // }

    // // Get sections
    // function get_sections() {
    //     let xhr = new XMLHttpRequest();
    //     xhr.open("POST", "ajax/facilities_crud.php", true);
    //     xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    //     xhr.onload = function() {
    //         if (about_section_data) {
    //             about_section_data.innerHTML = this.responseText;
    //         }
    //     };
    //     xhr.send('get_sections');
    // }

    // // Remove section
    // function rem_section(id) {
    //     if (!confirm('Are you sure?')) return;
    //     let xhr = new XMLHttpRequest();
    //     xhr.open("POST", "ajax/facilities_crud.php", true);
    //     xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    //     xhr.onload = function() {
    //         if (this.status === 200 && this.responseText === '1') {
    //             alert('success', 'Section deleted successfully!');
    //             get_sections();
    //         } else {
    //             alert('error', 'Deletion failed!');
    //         }
    //     };
    //     xhr.send('remove_section=1&section_id=' + id);
    // }

    // // Update section (placeholder - to be expanded with modal)
    // function update_section(about_title_val, about_description_val) {
    //     let xhr = new XMLHttpRequest();
    //     xhr.open("POST", "ajax/facilities_crud.php", true);
    //     xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    //     xhr.onload = function () {

    //         var myModal = document.getElementById('about_section-settings');
    //         var modal = bootstrap.Modal.getInstance(myModal);
    //         modal.hide();

    //         if (this.responseText == 1) {
    //             alert('success', 'Changes saved successfully!')
    //             get_sections();
    //         } else if (this.responseText == 'no_changes') {
    //             alert('error', 'No changes made!')
    //         } else {
    //             console.error('Update failed: ' + this.responseText);
    //         }
    //     };
    //     xhr.onerror = function () {
    //         console.error('AJAX request failed');
    //     };
    //     xhr.send('about_section_title=' + about_title_val + '&about_section_description=' + about_description_val + '&update_section');
    // }

        window.onload = function(){
            get_facilities();
            //get_sections();
        }
