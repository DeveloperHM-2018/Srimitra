<!doctype html>
<html lang="en">


<?php $this->load->view('admin/template/header_link'); ?>


<body data-topbar="colored">
    <div id="layout-wrapper">
        <?php $this->load->view('admin/template/header'); ?>

        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">
                    <div class="page-title-box">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="page-title">
                                        <h4 class="mb-0 font-size-18"> <button type="button" class="badge btn-warning" onclick="history.back();">Back</button> | Add <?= $title ?></h4>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 text-right">
                                <a href="<?= base_url(
                                                'admin_Dashboard/child_care_home'
                                            ) ?>" class="btn btn-light"> View <?= $title ?> </a>

                            </div>
                        </div>
                    </div>

                    <div class="page-content-wrapper">

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <form method="post" enctype="multipart/form-data" class="custom-validation">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label class="form-label">Organisation Name</label>
                                                    <input type="text" class="form-control" name="fullname" required />
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">Contact No.</label>
                                                    <input type="text" class="form-control phoneval" name="number" maxlength="10" data-parsley-type="number" required />
                                                    <span class="phonemsg  " style="color:#9F0B0B;"></span>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">Email</label>
                                                    <input type="email" class="form-control" name="email" parsley-type="email" placeholder="Enter a valid e-mail" required />
                                                </div>

                                                <div class="col-md-3">
                                                    <label class="form-label">Category</label>
                                                    <select class="form-control" name="category" required>
                                                        <option value="">Select category</option>
                                                        <option value="Institute/university">Institute/university</option>
                                                        <option value="Hospital">Hospital</option>
                                                        <option value="Child Home Care">Child Home Care</option>
                                                        <option value="Schools">Schools</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-3">
                                                    <label class="form-label">State</label>
                                                    <select class="form-control" name="state" id="state" required>
                                                        <option value="">Select state </option>
                                                        <?php if ($state_list) {
                                                            foreach ($state_list
                                                                as $state) { ?>
                                                                <option value="<?= $state['state_id'] ?>"><?= $state['state_name'] ?></option>
                                                        <?php }
                                                        } ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">City</label>
                                                    <select name="city" class="form-control" id="city" required>
                                                        <option value="">Select city</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">Pincode</label>
                                                    <input type="text" class="form-control" name="pincode" />
                                                </div>


                                                <div class="col-md-3">
                                                    <label class="form-label">Address</label>
                                                    <input type="text" class="form-control" name="address" />
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">Address GEO Codeing</label>
                                                    <input type="text" class="form-control" name="geo_coding" />
                                                </div>


                                                <div class="col-md-3">
                                                    <label class="form-label">Trust/Foundation Name </label>
                                                    <input type="text" class="form-control" name="trust_name" />
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">Trustee/Founder Name</label>
                                                    <input type="text" class="form-control" name="trustee_name" />
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">Select profile type</label>
                                                    <select class="form-control" name="profile_type" id="profile_type">
                                                        <option value="0">Image</option>
                                                        <option value="1">Video</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3" id="profile_img">
                                                    <label class="form-label">Profile Image</label>
                                                    <input type="file" class="form-control" name="profile" accept="image/*,.pdf" />
                                                    <p style="color:#9F0B0B;"> Maximum File Size Limit is 5MB. </p>
                                                </div>
                                                <div class="col-md-3" id="profile_video" style="display:none">
                                                    <label class="form-label">Profile Video</label>
                                                    <input type="file" class="form-control" name="profile_video" accept="video/*" />
                                                    <p style="color:#9F0B0B;"> Maximum File Size Limit is 1MB. </p>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">Demography Section</label>
                                                    <select class="form-control" name="demography" id="demography">
                                                        <option>Select demography</option>
                                                        <?php foreach ($demography as $row) {
                                                        ?>
                                                            <option value="<?= $row['name']; ?>"><?= $row['name']; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>


                                                <!-- <h5> </br> </h5> -->

                                                <div class="col-md-3">
                                                    <label class="form-label">Gallery</label>
                                                    <input class="form-control pd-r-80" type="file" name="img[]" multiple accept="image/*,.pdf">
                                                    <p style="color:#9F0B0B;"> Maximum File Size Limit is 5MB. </p>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">Tagline</label>
                                                    <input type="text" class="form-control" name="tagline" value="Congratulations for becoming a part of extended family !!" />
                                                </div>
                                                </br>

                                                <!-- <h5> </br>Document Section <span style="color:#9F0B0B;">(Please uploads small than 5MB File)</span></h5>
                                                <div class="col-md-3">
                                                    <label class="form-label">Organisation registartion certificate</label>
                                                    <input type="file" class="form-control" name="govt_regis_cert" accept="image/*,.pdf">
                                                    <p style="color:#9F0B0B;"> Maximum File Size Limit is 5MB. </p>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">PAN of Trustee/Manager</label>
                                                    <input type="file" class="form-control" name="pan_trustee" accept="image/*,.pdf" />
                                                    <p style="color:#9F0B0B;"> Maximum File Size Limit is 5MB. </p>
                                                </div>


                                                <div class="col-md-3">
                                                    <label class="form-label"> Aadhar Front of Trustee/Manager </label>
                                                    <input type="file" class="form-control" name="adhar_trustee" accept="image/*,.pdf" />
                                                    <p style="color:#9F0B0B;"> Maximum File Size Limit is 5MB. </p>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">Aadhar Back of Trustee/Manager</label>
                                                    <input type="file" class="form-control" name="adhar_trustee_back" accept="image/*,.pdf" />
                                                    <p style="color:#9F0B0B;"> Maximum File Size Limit is 5MB. </p>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">Tax registration certificate </label>
                                                    <input type="file" class="form-control" name="tax_cert" accept="image/*,.pdf" />
                                                    <p style="color:#9F0B0B;"> Maximum File Size Limit is 5MB. </p>
                                                </div> -->
                                                <h5>
                                                    <br>Account Details
                                                </h5>

                                                <div class="col-md-3">
                                                    <label class="form-label">Bank</label>
                                                    <input type="text" class="form-control" name="bank" />
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">Account Number</label>
                                                    <input type="text" class="form-control ccval" name="acc_no" maxlength="20" />

                                                </div>
                                                <!-- <div class="col-md-3">
                                                    <label class="form-label">Cancel Cheque Image</label>
                                                    <input type="file" class="form-control" name="cancel_check" accept="image/*,.pdf" />
                                                    <p style="color:#9F0B0B;"> Maximum File Size Limit is 5MB. </p>
                                                </div> -->
                                                <div class="col-md-3">
                                                    <label class="form-label">IFSC</label>
                                                    <input type="text" class="form-control" name="ifsc" pattern="^[A-Z]{4}0[A-Z0-9]{6}$" title="Valid IFSC Format - SBIN0125620 " />
                                                    <span style="color:#9F0B0B;">Valid IFSC Format - SBIN0125620</span>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">Bank address</label>
                                                    <input type="text" class="form-control" name="bank_address" />
                                                </div>




                                                <div class="col-md-12">
                                                    <br>
                                                    <label class="form-label">Description for Child care homes</label>
                                                    <textarea id="editor1" name="description"></textarea>
                                                </div>

                                                <div class="col-md-12">
                                                    <h5> </br>Document Section <span style="color:#9F0B0B;">(Please uploads small than 5MB File)</span></h5>
                                                    <div class="fieldGroup row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Document Name</label>
                                                                <input type="text" class="form-control" name="document_title[]" placeholder="Document Name">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label>Document Image</label>
                                                                <input type="file" class="form-control" name="document_file[]" placeholder="Document Image">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <label> ADD</label>
                                                            <a href="javascript:void(0)" class="form-control btn btn-success addMore"> Add</a>
                                                        </div>
                                                    </div>
                                                    <div class="fieldGroupCopy row" style="display: none;">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Document Name</label>
                                                                <input type="text" class="form-control" name="document_title[]" placeholder="Document Name">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label>Document Image</label>
                                                                <input type="file" class="form-control" name="document_file[]" placeholder="Document Image">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1">
                                                            </br>
                                                            <a href="javascript:void(0)" class="form-control btn btn-danger remove">Cancel</a>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="mb-0">
                                                <div class="col-md-3">
                                                    <br>
                                                    <button type="submit" id="subcch" class="btn btn-primary waves-effect waves-light me-1">
                                                        Submit
                                                    </button>
                                                    <span class="phonemsg  " style="color:#9F0B0B;"></span>
                                                </div>
                                            </div>
                                        </form>
                                        <!-- End Form -->
                                    </div>
                                    <!-- End Cardbody -->
                                </div>
                                <!-- End Card -->
                            </div>

                        </div>

                    </div>
                </div>



            </div>

        </div>


        <?php include 'template/footer_link.php'; ?>


</body>

</html>


<script>
    $(document).on('change', '#state', function() {

        var state = $(this).val();
        // console.log(state);
        $.ajax({
            method: "POST",
            url: "<?= base_url('Admin_Dashboard/getcity') ?>",
            data: {
                state: state
            },
            success: function(response) {
                // console.log(response);
                $('#city').html(response);
            }
        });
    });
    $(document).on('keyup', '.phoneval', function(evt) {

        //$('.phoneval').keyup(function(evt) {
        if (evt.which < 48 || evt.which > 57) {
            evt.preventDefault();
        }

        $.ajax({
            method: "POST",
            url: "<?= base_url('Ajax/getcchcontact') ?>",
            data: {
                contact: $(this).val()
            },
            success: function(response) {

                $('.phonemsg').text(response);

                if (response == ' ') {
                    $('#subcch').prop('disabled', false);
                } else {
                    $('#subcch').prop('disabled', true);
                }
            }
        });

    });
    $(document).on('keyup', '.accval', function(evt) {
        //$('.accval').keyup(function(evt) {
        if (evt.which < 48 || evt.which > 57) {
            evt.preventDefault();
        }
    });
    $('#profile_type').change(function() {
        var profile_type = $('#profile_type').val();

        if (profile_type == 0) {

            $('#profile_img').show();
            $('#profile_video').hide();
        } else {

            $('#profile_img').hide();
            $('#profile_video').show();
        }
    });
</script>

<script>
    $(document).ready(function() {
        //group add limit
        var maxGroup = 200;
        //add more fields group
        $(".addMore").click(function() {
            console.log('asd');
            if ($('body').find('.fieldGroup').length < maxGroup) {
                var fieldHTML = '<div class="fieldGroup row">' + $(".fieldGroupCopy").html() + '</div>';
                $('body').find('.fieldGroup:last').after(fieldHTML);
            } else {
                alert('Maximum ' + maxGroup + ' groups are allowed.');
            }
        });
        $("body").on("click",
            ".remove",
            function() {
                $(this).parents(".fieldGroup").remove();
            });
    });
</script>