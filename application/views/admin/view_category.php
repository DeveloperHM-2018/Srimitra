<!doctype html>
<html lang="en">


<?php $this->load->view('admin/template/header_link'); ?>

<body data-topbar="colored">
    <div id="layout-wrapper">
        <?php $this->load->view('admin/template/header'); ?>
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid ">
                    <div class="page-title-box">
                        <div class="row ">
                            <div class="col-md-8">
                                <div class=" d-flex align-items-center justify-content-between">
                                    <div class="page-title">
                                        <h4 class="mb-0 font-size-18"> <button type="button" class="badge btn-warning" onclick="history.back();">Back</button> | <?= $title; ?></h4>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 col-6">
                                <div class=" d-flex align-items-center justify-content-between">
                                    <a href="<?= base_url('admin_Dashboard/add_category') ?>" class="btn btn-light">Add <?= $title ?></a>
                                </div>
                            </div>
                            <div class="col-md-2 col-6">
                                <div class=" d-flex align-items-center justify-content-between">
                                    <a href="<?= base_url('admin_Dashboard/add_subcategory') ?>" class="btn btn-light">Add Sub <?= $title ?></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="page-content-wrapper">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="card">

                                    <div class="card-body">
                                        <h4>Category List</h4>
                                        <?php if ($msg = $this->session->flashdata('msg')) :
                                            $msg_class = $this->session->flashdata('msg_class') ?>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="alert  <?= $msg_class; ?>"><?= $msg; ?></div>
                                                </div>
                                            </div>
                                        <?php
                                            $this->session->unset_userdata('msg');
                                        endif; ?>

                                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="
                                    border-collapse: collapse;
                                    border-spacing: 0;
                                    width: 100%;
                                    ">
                                            <thead>
                                                <tr>
                                                    <th>S No</th>
                                                    <th>Category Name</th>
                                                    <th>Image</th>

                                                    <!-- <th>Disable</th> -->
                                                    <th>Edit</th>
                                                    <th>Delete</th>


                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 1;
                                                foreach ($category as $row) {
                                                    

                                                ?>

                                                    <tr>
                                                        <td><?php echo $i; ?></td>

                                                        <td><?php echo $row['cat_name']; ?><br>
                                                            <span class="badge btn-info"><?php echo getNumRows('products', array('category_id' => $row['category_id'])); ?> products</span>
                                                        </td>
                                                        <td>
                                                            <img src="<?= setImage($row['image'],'uploads/category/') ?>" style="width: 50px;height: 50px;" />
                                                        </td>




                                                        <!-- <td>
                                                            <a href="<?php echo base_url() . 'admin_Dashboard/disable/' . $row['category_id'] . '/category/' . (($row['status'] == 1) ? '0' : '1'); ?>" class="btn btn-light"><?php if ($row['status'] == 0) { ?><i class="fas fa-eye"></i><?php } else { ?> <i class="fas fa-eye-slash"></i><?php } ?></a>
                                                        </td> -->
                                                        <td>
                                                            <a href="<?php echo base_url() . 'admin_Dashboard/edit_category/' . $row['category_id']; ?>" class="btn btn-success edit"><i class="fas fa-pencil-alt"></i></a>
                                                        </td>
                                                        <td>
                                                            <a href="<?php echo base_url() . 'admin_Dashboard/deletecategory/' . $row['category_id']; ?>" class="btn btn-primary delete"  onclick="return confirm('Are you sure to delete ?')"><i class="fas fa-trash-alt"></i></a>
                                                        </td>
                                                    </tr>

                                                <?php
                                                    $i++;
                                                }
                                                ?>
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4>Sub Category List</h4>
                                        <?php if ($msg = $this->session->flashdata('msg')) :
                                            $msg_class = $this->session->flashdata('msg_class') ?>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="alert  <?= $msg_class; ?>"><?= $msg; ?></div>
                                                </div>
                                            </div>
                                        <?php
                                            $this->session->unset_userdata('msg');
                                        endif; ?>

                                        <table id="datatable2" class="table table-bordered dt-responsive nowrap" style="
                                    border-collapse: collapse;
                                    border-spacing: 0;
                                    width: 100%;
                                    ">
                                            <thead>
                                                <tr>
                                                    <th>S No</th>

                                                    <th>Sub Category Name</th>
                                                    <th>Image</th>
                                                    <!-- <th>Disable</th> -->
                                                    <th>Action</th>
                                                    <!--<th>Delete</th>-->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 1;
                                                if ($subcategory != '') {
                                                    foreach ($subcategory as $row) {
                                                         
                                                        $cat = getRowById('category', 'category_id', $row['cat_id']);
                                                ?>

                                                        <tr>
                                                            <td><?php echo $i; ?></td>

                                                            <td><?php echo $row['subcat_name']; ?><br>
                                                                <span class="badge btn-info"><?php echo ((empty($cat[0]['cat_name'])) ? 'deleted' : $cat[0]['cat_name']); ?></span>
                                                            </td>
                                                            <td>
                                                                <img src="<?= setImage($row['image'],'uploads/subcategory/') ?>" style="width: 50px;height: 50px;" />
                                                            </td>

                                                            <!-- <td>
                                                        <a href="<?php echo base_url() . 'admin_Dashboard/disable/' . $row['sub_category_id'] . '/sub_category/' . (($row['status'] == 1) ? '0' : '1'); ?>" class="btn btn-light delete"><?php if ($row['status'] == 0) { ?><i class="fas fa-eye"></i><?php } else { ?> <i class="fas fa-eye-slash"></i><?php } ?></a>
                                                    </td> -->

                                                            <td>
                                                                <a href="<?php echo base_url() . 'admin_Dashboard/edit_subcategory/' . $row['sub_category_id']; ?>" class="btn btn-success edit"><i class="fas fa-pencil-alt"></i></a>
                                                                <!--</td>-->
                                                                <!--<td>-->

                                                                <a href="<?php echo base_url() . 'admin_Dashboard/deletesubcategory/' . $row['sub_category_id']; ?>" class="btn btn-danger delete"  onclick="return confirm('Are you sure to delete ?')"><i class="fas fa-trash-alt"></i></a>
                                                            </td>


                                                        </tr>

                                                <?php
                                                        $i++;
                                                    }
                                                }
                                                ?>
                                            </tbody>

                                        </table>

                                    </div>
                                </div>
                            </div>

                        </div>
                        </section>
                        <!--END PAGE CONTENT -->
                    </div>

                    <?php include 'template/footer_link.php'; ?>


</body>

</html>