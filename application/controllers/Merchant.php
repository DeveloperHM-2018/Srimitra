<?php
defined('BASEPATH') or exit('no direct access allowed');

class Merchant extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (sessionId('marchid') == "") {
            redirect(base_url('merchant_login'));
        }

        date_default_timezone_set("Asia/Kolkata");
    }

    public function index()
    {
        $table = "checkout";
        $data['favicon'] = base_url() . 'assets/images/favicon.png';
        $data['title'] = "Order List";
        $id = $this->uri->segment(3);
        $data['all'] = $this->CommonModal->getNumRows('checkout', array('merchant_id' => sessionId('marchid')));
        $data['new'] = $this->CommonModal->getNumRows('checkout', array('merchant_id' => sessionId('marchid'), 'status' => '0'));
        $data['accepted'] = $this->CommonModal->getNumRows('checkout', array('merchant_id' => sessionId('marchid'), 'status' => '1'));
        $data['process'] = $this->CommonModal->getNumRows('checkout', array('merchant_id' => sessionId('marchid'), 'chechout_status' => '3'));
        $data['completed'] = $this->CommonModal->getNumRows('checkout', array('merchant_id' => sessionId('marchid'), 'chechout_status' => '6'));

        $this->load->view('merchant/home', $data);
    }

    public function statusupdate()
    {
        extract($this->input->post());
        $this->CommonModal->updateRowById('checkout', 'id', $id, array('status' => $status, 'update_date' => date("Y-m-d H:i:s")));
        redirect(base_url('Merchant/orderPlaced'));
    }

    public function orderPlaced()
    {
        $table = "checkout";
        $data['favicon'] = base_url() . 'assets/images/favicon.png';
        $data['title'] = "New Order List";
        $data['checkout'] = $this->CommonModal->runQuery("SELECT * FROM `checkout` WHERE (`chechout_status` = '1' AND `merchant_id` = '" . sessionId('mid') . "') OR (`chechout_status` = '3' AND `merchant_id` = '" . sessionId('mid') . "' )"); 
        $this->load->view('merchant/view_orderPlced', $data);
    }
    public function onprocess_order()
    {
        $table = "checkout";
        $data['favicon'] = base_url() . 'assets/images/favicon.png';
        $data['title'] = "Onprocess Order List";
        $data['checkout'] = $this->CommonModal->getRowByIdInOrder('checkout', array('status' => '1', 'chechout_status' => '3', 'merchant_id' => sessionId('mid')), 'id', 'desc');

        $this->load->view('merchant/view_orderPlced', $data);
    }
    public function delivered_order()
    {
        $table = "checkout";
        $data['favicon'] = base_url() . 'assets/images/favicon.png';
        $data['title'] = "Delivered Order List";
        $data['checkout'] = $this->CommonModal->getRowByIdInOrder('checkout', array('status' => '1', 'chechout_status' => '5', 'merchant_id' => sessionId('mid')), 'id', 'desc');

        $this->load->view('merchant/view_orderPlced', $data);
    }
    public function confirmed_delivered_order()
    {
        $table = "checkout";
        $data['favicon'] = base_url() . 'assets/images/favicon.png';
        $data['title'] = "Delivered Order List";
        $data['checkout'] = $this->CommonModal->getRowByIdInOrder('checkout', array('status' => '1', 'chechout_status' => '6', 'merchant_id' => sessionId('mid')), 'id', 'desc');

        $this->load->view('merchant/view_orderPlced', $data);
    }
    public function restocking_order()
    {
        $table = "checkout";
        $data['favicon'] = base_url() . 'assets/images/favicon.png';
        $data['title'] = "Restocking Order List";
        $data['checkout'] = $this->CommonModal->getRowByIdInOrder('checkout', array('status' => '1', 'chechout_status' => '4', 'merchant_id' => sessionId('mid')), 'id', 'desc');

        $this->load->view('merchant/view_orderPlced', $data);
    }

    public function OrderPlacedDetails()
    {
        $id = $this->uri->segment(3);
        $data['favicon'] = base_url() . 'assets/images/favicon.png';
        $data['title'] = "Order placed Details";
        $data['checkout'] = $this->CommonModal->getRowById('checkout', 'id', $id);
        $data['checkoutProduct'] = $this->CommonModal->getRowById('checkout_product', 'checkoutid', $id);
        $this->load->view('merchant/OrderPlacedDetails', $data);
    }

    public function fetchorder()
    {
        $filter_status = $this->input->post('filter_status');
        if ($filter_status == '') {

            $data['checkout'] = $this->CommonModal->getRowByIdInOrder('checkout', array('merchant_id' => sessionId('mid')), 'id', 'desc');
        } else {
            $data['checkout'] = $this->CommonModal->getRowByIdInOrder('checkout', array('status' => $filter_status, 'merchant_id' => sessionId('mid')), 'id', 'desc');
        }
        $this->load->view('merchant/orderlist', $data);
    }
    public function my_products_list()
    {
        $data['favicon'] = base_url() . 'assets/images/favicon.png';

        $data['title'] = "Products";
        // echo sessionId('mid');
        $data['products'] = $this->CommonModal->getRowByMoreIdInOrder('merchant_products', array('merchant_id' => sessionId('mid'), 'is_delete' => '0'), 'id', 'DESC');

        $this->load->view('merchant/my_products_list', $data);
    }
    public function add_products()
    {
        $data['favicon'] = base_url() . 'assets/images/favicon.png';
        $data['title'] = "  Product";
        $data['product'] = $this->CommonModal->getRowById('products', 'is_delete', '0');
        $data['merchant_products'] = $this->CommonModal->getRowByMoreId('merchant_products', array('merchant_id' => sessionId('mid'), 'is_delete' => '0'));
        if (count($_POST) > 0) {
            $product_nm = $this->input->post('product_nm');
            $img = imageUpload('img', 'uploads/merchant_products/');
            $productData = $this->CommonModal->getSingleRowById('products', array('product_id' => $this->input->post('product_nm')));

            $pro = array('merchant_id' => sessionId('mid'), 'product_id' => $this->input->post('product_nm'), 'subcategory_id' => $this->input->post('subcategory_id'), 'category_id' => $this->input->post('category_id'), 'product_price' => $this->input->post('price'), 'sale_price' => $this->input->post('sale_price'), 'purchase_price' => $this->input->post('purchase_price'), 'quantity' => $this->input->post('quantity'), 'quantity_type' => $this->input->post('quantity_type'), 'description' => $this->input->post('description'), 'img' => $img, 'is_delete' => '0', 'product_name' => $productData['pro_name'].' - '.$this->input->post('title'));
            $product_option_item_id = $this->CommonModal->insertRowReturnId('merchant_products', $pro);
            redirect(base_url('merchant/my_products_list'));
        }
        $table = "category";
        $data['category'] = $this->Dashboard_model->fetchall($table);

        $this->load->view('merchant/add_products', $data);
    }
    public function import_products()
    {
        $data['favicon'] = base_url() . 'assets/images/favicon.png';
        $data['title'] = "Import Product";
        $data['product'] = $this->CommonModal->getRowByMoreId('products', array('status' => '0', 'is_delete' => '0'));
        $data['merchant_products'] = $this->CommonModal->getRowByMoreId('merchant_products', array('merchant_id' => sessionId('mid'), 'is_delete' => '0'));
        $data['category'] = $this->Dashboard_model->fetchall('category');

        $this->load->view('merchant/import_products', $data);
    }
    public function importdata()
    {
        $post['category_id'] = $_POST['category_id'];
        $post['subcategory_id'] = $_POST['subcategory_id'];
        $post['product_id'] = $_POST['product_nm'];
        $file = $_FILES['pname']['tmp_name'];
        $handle = fopen($file, "r");
        $c = 0; //
        $msg = 'Saved List - <br>';
        while (($filesop = fgetcsv($handle, 1000, ",")) !== false) {
            // $post = array();
            // // echo '<br>'; 
            $productData = $this->CommonModal->getSingleRowById('products', array('product_id' => $this->input->post('product_nm')));
            $post['product_name'] = $productData['pro_name'].' - '.$filesop[1]; 
            $post['quantity'] = $filesop[2];
            $post['quantity_type'] = $filesop[3];
            $post['product_price'] = $filesop[4];
            $stock = $filesop[5];
            $post['sale_price'] = $filesop[6];
            $post['purchase_price'] = $filesop[7];
            $post['description'] = $filesop[8];
            $post['is_delete'] = '0';
            $post['approved'] = '0';
            
            if ($c <> 0 || $c <> 1) {
                if ($filesop[1] != '') {
                    $post['merchant_id'] = sessionId('mid');
                    $product_option_item_id = $this->CommonModal->insertRowReturnId('merchant_products', $post);
                    $msg .= '<br>' . $filesop[3];
                }
            }
            $c = $c + 1;
        }
        // userData('msg', $msg);
        redirect(base_url('merchant/my_products_list'));
    }
    public function create_products()
    {
        $data['favicon'] = base_url() . 'assets/images/favicon.png';
        $data['title'] = "  Product";
        $table = "category";
        $data['category'] = $this->Dashboard_model->fetchall($table);
        $data['merchant'] = $this->CommonModal->getAllRows('tbl_merchant_registration');
        $this->load->view('merchant/create_products', $data);
    }

    public function addproducts()
    {
        $data['favicon'] = base_url() . 'assets/images/favicon.png';
        if (count($_POST) > 0) {

            $post = $this->input->post();
            $post['approved'] = '1';
            $post['mid'] = sessionId('mid');
            $post['img'] = imageUpload('img', 'uploads/merchant_products/');
            $productId = $this->CommonModal->insertRowReturnId('products', $post);
            $productId = $this->CommonModal->insertRowReturnId('merchant_products', array('merchant_id' => sessionId('mid'), 'product_id' => $productId, 'approved' => '1', 'product_price' => $post['price'], 'sale_price' => $post['sale_price'], 'purchase_price' => $post['purchase_price']));
            if ($productId) {
                $this->session->set_flashdata('msg', 'Product  Add successfully');
                $this->session->set_flashdata('msg_class', 'alert-success');
            } else {
                $this->session->set_flashdata('msg', 'Something went wrong Please try again!!');
                $this->session->set_flashdata('msg_class', 'alert-danger');
            }

            redirect(base_url() . 'merchant/my_products_list');
        } else {
            redirect(base_url() . 'merchant/add_products');
        }
    }

    public function edit_products($mpid = true)
    {
        $data['favicon'] = base_url() . 'assets/images/favicon.png';
        $data['title'] = "Edit Products";
        $data['productInfo'] = $this->CommonModal->getSingleRowById('merchant_products', array('id' => $mpid));
        $data['product'] = $this->CommonModal->getRowByMoreId('products', array('status' => '0', 'is_delete' => '0', 'subcategory_id' => $data['productInfo']['subcategory_id']));
        $data['category'] = $this->CommonModal->getAllRows('category');
        if (count($_POST) > 0) {
            $post = $this->input->post();
            $img = $post['img'];
            if ($_FILES['img_temp']['name'] != '') {
                $imge = imageUpload('img_temp', 'uploads/merchant_products/');
                $post['img'] = $imge;
                if ($imge != "") {
                    unlink('uploads/merchant_products/' . $img);
                }
            }
            $update = $this->CommonModal->updateRowById('merchant_products', 'id', $mpid, $post);
            if ($update) {
                $this->session->set_flashdata('msg', 'Product Update Successfully');
                $this->session->set_flashdata('msg_class', 'alert-success');
            }
            redirect(base_url() . 'merchant/my_products_list');
        } else {
            $this->load->view('merchant/edit_products', $data);
        }
    }



    public function deleteproducts($id)
    {
        $data['favicon'] = base_url() . 'assets/images/favicon.png';
        $table = "merchant_products";
        $this->CommonModal->updateRowById($table, 'id', $id, array('is_delete' => '1'));
        redirect('merchant/my_products_list');
    }

    public function change_password()
    {
        $data['favicon'] = base_url() . 'assets/images/favicon.png';
        $data['title'] = "Change password";
        if (count($_POST) > 0) {
            $oldpassword = $this->input->post('oldpassword');
            $password = $this->input->post('password');
            $confirmpassword = $this->input->post('confirmpassword');
            $profile = $this->CommonModal->getsingleRowById('tbl_merchant_registration', array('id' => sessionId('mid')));
            if (decryptId($profile['password']) == $oldpassword) {
                if ($password == $confirmpassword) {
                    $update = $this->CommonModal->updateRowById('tbl_merchant_registration', 'id', sessionId('mid'), array('password' => encryptId($password)));
                    if ($update) {
                        $this->session->set_flashdata('msg', 'Password Changed Successfully');
                        $this->session->set_flashdata('msg_class', 'alert-success');
                    } else {
                        $this->session->set_flashdata('msg', 'Password not changed , try again later');
                        $this->session->set_flashdata('msg_class', 'alert-danger');
                    }
                } else {
                    $this->session->set_flashdata('msg', 'Password and confirm password doesnt matched.');
                    $this->session->set_flashdata('msg_class', 'alert-danger');
                }
            } else {
                $this->session->set_flashdata('msg', 'Old password doesnt matched');
                $this->session->set_flashdata('msg_class', 'alert-danger');
            }

            redirect(base_url() . 'merchant/change_password');
        } else {
            $this->load->view('merchant/change_password', $data);
        }
    }
    public function report()
    {
        $data['favicon'] = base_url() . 'assets/images/favicon.png';
        $data['title'] = "Report Product";
        $data['checkout'] = $this->CommonModal->getRowByMoreId('checkout', array('merchant_id' => sessionId('mid')));
        $this->load->view('merchant/report', $data);
    }
}
