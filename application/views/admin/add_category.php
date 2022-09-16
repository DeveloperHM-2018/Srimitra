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
                            <div class="col-md-10">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="page-title">

                                        <h4 class="mb-0 font-size-18"> <button type="button" class="badge btn-warning" onclick="history.back();">Back</button> | Add <?= $title; ?></h4>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="d-flex align-items-center justify-content-between">
                                    <a href="<?= base_url('admin_Dashboard/view_category') ?>" class="btn btn-light"> <?= $title ?> List</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="page-content-wrapper">

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">

                                        <form action="<?php echo base_url('admin_Dashboard/addcategory') ?>" method="post" enctype="multipart/form-data">
                                            <div class="row">

                                                <div class="col-md-12 col-lg-12 col-xl-12">
                                                    <div class="">
                                                        <div class="form-group">
                                                            <label class="">Main Category Name</label>
                                                            <input class="form-control" required="" type="text" name="cat_name" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="">Main Category Image</label>
                                                            <div class="pos-relative">
                                                                <input class="form-control pd-r-80" required="" type="file" name="image" accept="image/*,.pdf">
                                                                <p style="color:#FF0000;"> Maximum File Size Limit is 5MB. </p>
                                                            </div>
                                                        </div>

                                                        <button name="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </div>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </section>

                    </div>
                    <?php $this->load->view('admin/template/footer_link'); ?>
</body>

</html>