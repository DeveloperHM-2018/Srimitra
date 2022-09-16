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
                            <div class="col-md-10">
                                <div class=" d-flex align-items-center justify-content-between">
                                    <div class="page-title">
                                        <h4 class="mb-0 font-size-18"> <button type="button" class="badge btn-warning" onclick="history.back();">Back</button> | <?= $title; ?></h4>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class=" d-flex align-items-center justify-content-between">
                                    <!-- <a href="<?= base_url('admin_Dashboard/add_category') ?>" class="btn btn-light">Add <?= $title ?></a> -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="page-content-wrapper">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">

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
                                                    <th>Title </th>
                                                    <th>Price </th>
                                                    <th>Products</th>
                                                    <th>Cover</th>
                                                    <th>Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                if (!empty($request)) {
                                                    $i = 1;
                                                    foreach ($request as $orderrow) {

                                                        $count = getNumRows('order_request_template_product', array('ort_id' => $orderrow['ortid']));
                                                ?>
                                                        <tr>
                                                            <td><?php echo $i; ?></td>
                                                            <td><?= $orderrow['product_title']; ?></td>
                                                            <td><?= $orderrow['combo_price']; ?></td>
                                                            <td> <button class="btn btn-primary mt-1" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample<?= $orderrow['ortid']; ?>" aria-expanded="false" aria-controls="collapseExample<?= $orderrow['ortid']; ?>">
                                                                    View products (<?= $count ?>)
                                                                </button>
                                                                <div class="collapse  " id="collapseExample<?= $orderrow['ortid']; ?>">
                                                                    <div class="card card-body mb-0 p-0">
                                                                        <table class="table mb-0">

                                                                            <thead class="table-light">
                                                                                <tr>
                                                                                    <th>#</th>
                                                                                    <th>Product</th>
                                                                                    <th>Qty.</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <?php
                                                                                $i = 1;
                                                                                $data = getRowById('order_request_template_product', 'ort_id', $orderrow['ortid']);
                                                                                if (!empty($data)) {
                                                                                    foreach ($data as $datarow) {
                                                                                        $data = getSingleRowById('products', array('product_id' => $datarow['product']));
                                                                                ?>
                                                                                        <tr>
                                                                                            <th scope="row"><?= $i ?></th>
                                                                                            <td><?= $data['pro_name']; ?></td>
                                                                                            <td><?= $datarow['quantity']; ?> <?= $data['quantity_type']; ?></td>

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
                                                            </td>
                                                            <td><img src="<?= base_url('uploads/ordercover/'.$orderrow['cover']) ?>" width="50px"/></td>
                                                            <td> <a href="<?= base_url('admin_Dashboard/edit_order_request_template/' . encryptId($orderrow['ortid'])) ?>">
                                                                    <button class="btn btn-success float-right mt-1 ml-1" type="button">
                                                                        <i class="fa fa-edit"></i> Edit
                                                                    </button>
                                                                </a></td>

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

                    </div>
                    </section>
                    <!--END PAGE CONTENT -->
                </div>

                <?php include 'template/footer_link.php'; ?>
                <script>
                $(document).on('click', '.status', function(){
                  //  $('.status').click(function() {
                        var id = $(this).data('id');
                        var status = $(this).data('status');
                        console.log(id);
                        console.log(status);
                        var msg = confirm('Are you sure ?');
                        if (msg) {
                            $.ajax({
                                method: "POST",
                                url: "<?= base_url('Ajax/requestStatus') ?>",
                                data: {
                                    id: id,
                                    status: status
                                },
                                beforeSend: function() {
                                    $(this).text("").html("Loading.. <i class='fa fa-spin fa-spinner'></i>").attr('disabled', true);
                                },
                                success: function(response) {
                                    console.log(response);
                                    if (response == '0') {
                                        $('.reject' + id).hide();
                                    } else if (response == '1') {
                                        $('.accept' + id).hide();
                                    } else if (response == '2') {
                                        alert('Server Error');
                                    } else {}
                                }
                            });
                        }

                    });
                </script>

</body>

</html>