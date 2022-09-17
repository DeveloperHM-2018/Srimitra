<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Index extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function Index()
    {
        $data['contactdetails'] = $this->CommonModal->getRowById('contactdetails', 'cid', '1');
        $data['logo'] = 'assets/logo.png';
        $data['title'] = 'Home | SriMitra';

        $data['city_list'] = $this->CommonModal->getAllRows('tbl_cities');
        $data['all_orphanage'] = $this->CommonModal->getAllRowsInOrder('tbl_orphanage', 'id', 'desc');
        $data['statelist'] = $this->CommonModal->getDistinctRow('tbl_orphanage', 'state');
        $data['state_list'] = $this->CommonModal->getAllRows('tbl_state');
        $data['request'] = $this->CommonModal->getAllRows('order_request_template');
        $data['order'] = $this->CommonModal->getRowByMoreId('tbl_orphange_order', array('status' => '1'));
        if (count($_POST) > 0) {
            $post = $this->input->post();
            $insert = $this->CommonModal->insertRowReturnId('tbl_collaborate_with_us', $post);
            if ($insert) {
                $this->session->set_userdata('msg', '<div class="alert alert-success">Thanks for contacting us.We will come to you as soon as possible.</div>');
            } else {
                $this->session->set_userdata('msg', 'div class="alert alert-success">We are facing technical error ,please try again later or get in touch with Email ID provided in contact section.</div>');
            }
            redirect(base_url('#collaborate'));
        } else {
        }

        $this->load->view('home', $data);
    }

    public function celebrate_with_us()
    {
        $data['contactdetails'] = $this->CommonModal->getRowById('contactdetails', 'cid', '1');
        $data['logo'] = 'assets/logo.png';
        $data['title'] = 'Home | SriMitra';
        $data['all_orphanage'] = $this->CommonModal->getAllRowsInOrder('tbl_orphanage', 'id', 'desc');
        $data['statelist'] = $this->CommonModal->getDistinctRow('tbl_orphanage', 'state');
        $data['request'] = $this->CommonModal->getAllRows('order_request_template');
        $data['order'] = $this->CommonModal->getRowByMoreId('tbl_orphange_order', array('status' => '1'));
        if (count($_POST) > 0) {
            $post = $this->input->post();
            $insert = $this->CommonModal->insertRowReturnId('tbl_collaborate_with_us', $post);
            if ($insert) {
                $this->session->set_userdata('msg', '<div class="alert alert-success">Thanks for contacting us.We will come to you as soon as possible.</div>');
            } else {
                $this->session->set_userdata('msg', 'div class="alert alert-success">We are facing technical error ,please try again later or get in touch with Email ID provided in contact section.</div>');
            }
            redirect(base_url('#collaborate'));
        } else {
        }

        $this->load->view('celebrate_with_us', $data);
    }
    public function home()
    {
        $data['contactdetails'] = $this->CommonModal->getRowById('contactdetails', 'cid', '1');
        $data['logo'] = 'assets/logo.png';
        $data['title'] = 'Home | SriMitra';
        $data['all_orphanage'] = $this->CommonModal->getAllRowsInOrder('tbl_orphanage', 'id', 'desc');
        $data['statelist'] = $this->CommonModal->getDistinctRow('tbl_orphanage', 'state');
        $data['request'] = $this->CommonModal->getAllRows('order_request_template');
        $this->load->view('home_old', $data);
    }

    public function gallery()
    {
        $data['logo'] = 'assets/logo.png';
        $data['title'] = 'Gallery | SriMitra';
        $data['contactdetails'] = $this->CommonModal->getRowById('contactdetails', 'cid', '1');
        $data['gallery'] = $this->CommonModal->getAllRows('gallery');
        $this->load->view('gallery', $data);
    }

    public function child_care_homes()
    {
        $data['search'] = (((isset($_GET['search'])) ? $_GET['search'] : ''));
        $data['contactdetails'] = $this->CommonModal->getRowById('contactdetails', 'cid', '1');
        $data['all_orphanage'] = $this->CommonModal->getAllRowsInOrder('tbl_orphanage', 'id', 'desc');
        $data['mer'] = $this->CommonModal->getRowById('tbl_merchant_registration', 'id',  $data['all_orphanage'][0]['assign_merchant']);
        $data['merchant'] = $this->CommonModal->getAllRows('tbl_merchant_registration');
        $data['title'] = 'Child Care Homes | SriMitra';
        $this->load->view('orphanage', $data);
    }

    // public function child_care_homes_search()
    // {
    //     $data['search'] = (((isset($_POST['search'])) ? $_POST['search'] : ''));
    //     $data['contactdetails'] = $this->CommonModal->getRowById('contactdetails', 'cid', '1');
    //     $data['all_orphanage'] = $this->CommonModal->getAllRowsInOrder('tbl_orphanage', 'id', 'desc');
    //     $data['mer'] = $this->CommonModal->getRowById('tbl_merchant_registration', 'id',  $data['all_orphanage'][0]['assign_merchant']);
    //     $data['merchant'] = $this->CommonModal->getAllRows('tbl_merchant_registration');

    //     $data['title'] = 'Child Care Homes | SriMitra';

    //     $this->load->view('orphanage', $data);
    // }

    public function child_care_home_profile()

    {
        $key = $this->uri->segment(2);

        $id =  decryptId($key);
        $data['contactdetails'] = $this->CommonModal->getRowById('contactdetails', 'cid', '1');
        $data['mar'] = $this->CommonModal->getRowById('tbl_orphanage', 'id', $id);
        $data['city'] = $this->CommonModal->getRowById('tbl_cities', 'id', $data['mar'][0]['city']);
        $data['state'] = $this->CommonModal->getRowById('tbl_state', 'state_id', $data['mar'][0]['state']);
        $data['gallery'] = $this->CommonModal->getRowById('tbl_orphanage_gallery', 'orphanage_id', $data['mar'][0]['id']);
        $data['title'] = $data['mar'][0]['name'] . ' Details';

        $data['order'] = $this->CommonModal->getRowByMoreIdInOrder('tbl_orphange_order', array('orphan_id' => $data['mar'][0]['id'], 'status' => '1'), 'oid', 'DESC');
        $data['testimonials'] = $this->CommonModal->getAllRows('tbl_testimonial');
        $data['request'] = $this->CommonModal->getAllRows('order_request_template');
        $data['feedback'] = $this->CommonModal->getAllRows('tbl_feedback');

        $data['countrequest'] = $this->CommonModal->getNumRows('tbl_orphange_order', array('orphan_id' => $data['mar'][0]['id'], 'status' => '3'));
        $data['totalrequest'] = $this->CommonModal->getNumRows('tbl_orphange_order', array('orphan_id' => $data['mar'][0]['id']));
        $data['countdonation'] = $this->CommonModal->getNumRows('checkout', array('orphane_id' => $data['mar'][0]['id'], 'chechout_status' => '6'));
        $data['totaldonation'] = $this->CommonModal->getNumRows('checkout', array('orphane_id' => $data['mar'][0]['id']));
        $data['totaldoner'] = $this->CommonModal->getNumRow('tbl_user');

        if (count($_POST) > 0) {
            $post = $this->input->post();
            $insert = $this->CommonModal->insertRowReturnId('tbl_feedback', $post);
            if ($insert) {
                $this->session->set_userdata('feedbackmsg', '<p class="text-success">Thanks for your feedback.</p>');
            } else {
                $this->session->set_userdata('feedbackmsg', '<p class="text-danger">We are facing technical error ,please try again later or get in touch with Email ID provided in contact section.</p>');
            }
        } else {
        }

        $this->load->view('orphanage_profile', $data);
        $this->cart->destroy();
    }

    public function login_here()
    {
        if ($this->session->has_userdata('login_user_id') && $this->session->userdata('login_user_id') != 0) {
            redirect('Index');
        }
        $data['show'] = 'no';
        $data['contactdetails'] = $this->CommonModal->getRowById('contactdetails', 'cid', '1');
        $data['all_orphanage'] = $this->CommonModal->getAllRowsInOrder('tbl_orphanage', 'id', 'desc');
        $data['mer'] = $this->CommonModal->getRowById('tbl_merchant_registration', 'id',  $data['all_orphanage'][0]['assign_merchant']);
        $data['merchant'] = $this->CommonModal->getAllRows('tbl_merchant_registration');
        $data['title'] = 'Login | SriMitra';

        $this->load->view('login', $data);
    }


    public function login()
    {
        if (count($_POST) > 0) {
            extract($this->input->post());
            $table = "tbl_user";
            $login_data = $this->CommonModal->getRowByOr($table, array('email' => $email), array('number' => $email));
            // print_r($login_data);
            if (!empty($login_data)) {
                $enc_password ==  md5($login_data[0]['password']);
                if ($enc_password == $password) {
                    $session = $this->session->set_userdata(array('login_user_id' => $login_data[0]['uid'], 'login_user_name' => $login_data[0]['name'], 'login_user_emailid' => $login_data[0]['email'], 'login_user_contact' => $login_data[0]['number']));
                    $this->session->set_userdata(array('check_name' =>  $login_data[0]['name'], 'check_number' => $login_data[0]['number'], 'check_email' => $login_data[0]['email'])); // redirect(base_url('Index/profile'));
                    echo '1';
                } else {
                    echo 'Password you have entered is wrong. Please try with correct password or try forget password in case.';
                    // redirect(base_url('login'));
                }
            } else {
                echo 'You are not registered with us. Please confirm you have entered correct Email ID.';
                // redirect(base_url('login'));
            }
        } else {
            if ($this->session->userdata('login_user_id')) {
                echo '2';
                //  redirect(base_url('Index/profile'));
            }
        }
    }
    public function check_user()
    {
        if (count($_POST) > 0) {
            $checkoutdata = $this->input->post();
            $login_data = $this->CommonModal->getRowById('tbl_user', 'number', $checkoutdata['number']);
            if (!empty($login_data)) {
                $user_id = $login_data[0]['uid'];
                $session = $this->session->set_userdata(array('login_user_id' => $user_id, 'login_user_name' => $login_data[0]['name'], 'login_user_emailid' => $login_data[0]['email'], 'login_user_contact' => $login_data[0]['number']));
            } else {
                $formdata['name'] = $checkoutdata['name'];
                $formdata['email'] = $checkoutdata['email'];
                $formdata['number'] = $checkoutdata['number'];
                $formdata['password'] =   substr($formdata['name'], 0, 3) . substr($formdata['number'], 0, 3);
                $user_id = $this->CommonModal->insertRowReturnId('tbl_user', $formdata);
                $session = $this->session->set_userdata(array(
                    'login_user_id' => $user_id, 'login_user_name' => $checkoutdata['name'],
                    'login_user_emailid' => $checkoutdata['email'], 'login_user_contact' => $checkoutdata['number']
                ));
            }
            $session = $this->session->set_userdata(array('check_name' =>  $checkoutdata['name'], 'check_number' => $checkoutdata['number'], 'check_email' => $checkoutdata['email']));
            echo $user_id;
        }
    }
    public function subscribe()
    {
        if (count($_POST) > 0) {
            $login_data = $this->CommonModal->insertRowReturnId('tbl_suscribers', $this->input->post());
            if ($login_data) {
                echo '1';
            } else {
                echo 'Server error';
            }
        }
    }

    public function forget_password()
    {
        $data['title'] = 'SriMitra | Forget password';
        $data['logo'] = 'assets/logo.png';
        $data['subcate'] = $this->CommonModal->getAllRowsInOrder('sub_category', 'sub_category_id', 'desc');
        $data['contactdetails'] = $this->CommonModal->getRowById('contactdetails', 'cid', '1');
        if (count($_POST) > 0) {
            extract($this->input->post());
            $email = $this->input->post('email');
            $table = "tbl_user";
            $login_data = $this->CommonModal->getSingleRowById($table, array('email' => $email));

            if (!empty($login_data)) {



                $message = forgotPassword($login_data['password'], base_url(), $data['contactdetails'][0]['facebook'], $data['contactdetails'][0]['instagram'], $data['contactdetails'][0]['linkedin'], $data['contactdetails'][0]['twitter']);
                sendmail($email, 'Forgot Password  | From SriMitra', $message);

                $this->session->set_userdata('forget', '<span class="text-success">Check your mail ID for Password</span>');
                // redirect(base_url('Index/forget_password'));
            } else {
                $this->session->set_userdata('forget', '<span class="text-danger">No username found</span>');
                redirect(base_url('Index/forget_password'));
            }
        } else {
        }
        $this->load->view('forget_password', $data);
    }
    public function cch_forget_password()
    {
        $data['title'] = 'SriMitra | Forget password';
        $data['logo'] = 'assets/logo.png';
        $data['subcate'] = $this->CommonModal->getAllRowsInOrder('sub_category', 'sub_category_id', 'desc');
        $data['contactdetails'] = $this->CommonModal->getRowById('contactdetails', 'cid', '1');
        if (count($_POST) > 0) {
            extract($this->input->post());
            $table = "tbl_orphanage";
            $login_data = $this->CommonModal->getSingleRowById($table, array('email' => $email));

            if (!empty($login_data)) {


                $message = forgotPassword($login_data['password'], base_url() . 'childcare_homes_login', $data['contactdetails'][0]['facebook'], $data['contactdetails'][0]['instagram'], $data['contactdetails'][0]['linkedin'], $data['contactdetails'][0]['twitter']);
                sendmail($login_data['email'], 'Forgot Password  | From SriMitra', $message);

                $this->session->set_userdata('forget', '<span class="text-success">Check your mail ID for Password</span>');
                // redirect(base_url('Index/forget_password'));
            } else {
                $this->session->set_userdata('forget', '<span class="text-danger">CCH not registered with this email Id.</span>');
                redirect(base_url('Index/cch_forget_password'));
            }
        } else {
        }
        $this->load->view('forget_password', $data);
    }
    public function merchant_forget_password()
    {
        $data['title'] = 'SriMitra | Forget password';
        $data['logo'] = 'assets/logo.png';
        $data['subcate'] = $this->CommonModal->getAllRowsInOrder('sub_category', 'sub_category_id', 'desc');
        $data['contactdetails'] = $this->CommonModal->getRowById('contactdetails', 'cid', '1');
        if (count($_POST) > 0) {
            extract($this->input->post());
            $table = "tbl_merchant_registration";
            $login_data = $this->CommonModal->getSingleRowById($table, array('email' => $email));

            if (!empty($login_data)) {



                $message = forgotPassword($login_data['password'], base_url() . 'merchant_login', $data['contactdetails'][0]['facebook'], $data['contactdetails'][0]['instagram'], $data['contactdetails'][0]['linkedin'], $data['contactdetails'][0]['twitter']);
                sendmail($login_data['email'], 'Forgot Password  | From SriMitra', $message);
                $this->session->set_userdata('forget', '<span class="text-success">Check your mail ID for Password</span>');
                // redirect(base_url('Index/forget_password'));
            } else {
                $this->session->set_userdata('forget', '<span class="text-danger">No username found</span>');
                redirect(base_url('Index/merchant_forget_password'));
            }
        } else {
        }
        $this->load->view('forget_password', $data);
    }
    public function register()
    {

        $this->load->library('email');
        if ($this->session->has_userdata('login_user_id')) {
            redirect(base_url('Index/profile'));
        }
        $data['contactdetails'] = $this->CommonModal->getRowById('contactdetails', 'cid', '1');

        if (count($_POST) > 0) {
            $formdata = $this->input->post();
            $table = "tbl_user";
            if (strlen($formdata['number']) == 10) {
                $regdata = $this->CommonModal->getRowById('tbl_user', 'number', $formdata['number']);

                if (empty($regdata)) {
                    $regdataemail = $this->CommonModal->getRowById('tbl_user', 'email', $formdata['email']);
                    if (empty($regdataemail)) {

                        $formdata['password'] =   substr($formdata['name'], 0, 3) . substr($formdata['number'], 0, 3);
                        print_r($formdata['password']);
                        md5($formdata['password']);

                        $this->CommonModal->insertRowReturnId($table, $formdata);

                        // $message = 'Dear  '.$formdata['name'].',<br><br>
                        // Thank You for Registration In SriMitra.<br>
                        // To login with us <a href="https://www.webangeltech.com/SriMitra">click here</a><br><br>
                        // Use these credentials to continue login:<br>
                        // Your Login id is  - ' . $formdata['email'] . '  <br>
                        // & Login password is - ' . $formdata['password'].'<br><br>
                        // Regards,<br>SriMitraIndia';

                        $message = donormail($formdata['email'] . ' / ' . $formdata['number'],  $formdata['password']);


                        sendmail($formdata['email'], 'SriMitra Registration', $message);
                        $this->session->set_userdata('loginmsg', 'You have registered successfully. check mail ID to get your password.');
                        redirect(base_url('Index/thankyou'));
                    } elseif (count($regdataemail) == 1) {
                        $this->session->set_userdata('regmsg', 'Mail ID Already registered');
                        redirect(base_url('Index/thankyou'));
                    } else {
                        $this->session->set_userdata('regmsg', 'Your account is been blocked with multiple  mail ID ' . $formdata['email']);
                        redirect(base_url('Index/thankyou'));
                    }
                } elseif (count($regdata) == 1) {
                    $this->session->set_userdata('regmsg', 'Contact no. Already registered');
                    redirect(base_url('Index/thankyou'));
                } else {
                    $this->session->set_userdata('regmsg', 'Your account is been blocked with with multiple contact no. ' . $formdata['contact']);
                    redirect(base_url('Index/thankyou'));
                }
            } else {
                $this->session->set_userdata('regmsg', 'Invalid Contact no. Contact no. should be of 10 digit');
                redirect(base_url('Index/thankyou'));
            }
            // redirect('login');
        } else {
            $data['title'] = 'SriMitra | User Registeration';
            $data['logo'] = 'assets/logo.png';
            $this->load->view('register', $data);
            // redirect(base_url('Index'));
        }
    }

    public function thankyou()
    {
        $data['subcate'] = $this->CommonModal->getAllRowsInOrder('sub_category', 'sub_category_id', 'desc');
        $data['contactdetails'] = $this->CommonModal->getRowById('contactdetails', 'cid', '1');
        // print_r($this->session->userdata);
        $data['title'] = 'SriMitra | Phone verification';
        $data['logo'] = 'assets/logo.png';
        $this->load->view('thankyou', $data);
    }

    public function changePassword()
    {
        extract($this->input->post());
        $tbl_user = $this->CommonModal->getRowById('tbl_user', 'uid', $this->session->has_userdata('login_user_id'));
        print_r($current);
        print_r($tbl_user[0]['password']);
        if ($current == $tbl_user[0]['password']) {
            if ($new == $confirm) {
                $this->session->set_userdata('msg', 'Password is submitted successfully');
                $this->CommonModal->updateRowById('tbl_user', 'uid', $this->session->has_userdata('login_user_id'), array('password' => $new));
            } else {
                $this->session->set_userdata('msg', 'New password and Confirm password does\'nt match');
            }
        } else {
            $this->session->set_userdata('msg', 'You have entered wrong Current password');
        }
        redirect(base_url('Index/profile'));
    }
    public function about()
    {
        $data['subcate'] = $this->CommonModal->getAllRowsInOrder('sub_category', 'sub_category_id', 'desc');

        $data['contactdetails'] = $this->CommonModal->getRowById('contactdetails', 'cid', '1');


        $data['title'] = 'SriMitra | About Us';
        $data['logo'] = 'assets/logo.png';
        $this->load->view('about', $data);
    }
    public function contact()
    {
        echo sessionId('otp');
        $data['subcate'] = $this->CommonModal->getAllRowsInOrder('sub_category', 'sub_category_id', 'desc');

        $data['contactdetails'] = $this->CommonModal->getRowById('contactdetails', 'cid', '1');

        if (count($_POST) > 0) {
            $post = $this->input->post();
            $insert = $this->CommonModal->insertRowReturnId('contact_query', $post);
            if ($insert) {
                $this->session->set_userdata('msg', 'Your query is successfully submit. We will contact you as soon as possible.');
            } else {
                $this->session->set_userdata('msg', 'We are facing technical error ,please try again later or get in touch with Email ID provided in contact section.');
            }
        } else {
        }
        $data['title'] = 'SriMitra | Contact Us';
        $data['logo'] = 'assets/logo.png';
        $this->load->view('contact', $data);
    }

    public function enquiry_now()
    {
        if (count($_POST) > 0) {
            $post = $this->input->post();
            $insert = $this->CommonModal->insertRowReturnId('enquiry_form', $post);
            if ($insert) {
                $this->session->set_userdata('msg', 'Thankyou for your query. We will get back to you soon.');
            } else {
                $this->session->set_userdata('msg', 'We are facing technical error ,please try again later or get in touch with Email ID provided in contact section.');
            }
            redirect($_SERVER['HTTP_REFERER']);
            // redirect(base_url());
        }
    }
    public function getcity()
    {
        $state = $this->input->post('state');
        $data['city'] = $this->CommonModal->getRowByIdInOrder('tbl_cities', array('state_id' => $state), 'name', 'asc');
        $this->load->view('dropdown', $data);
    }


    public function cart_checkout()
    {
        if (!$this->session->has_userdata('login_user_id')) {
            $this->session->set_userdata('checkout', 'Login here to continue');
        } else {
            $data['login'] = $this->CommonModal->getRowById('tbl_user', 'uid', $this->session->userdata('login_user_id'));
        }

        $data['contactdetails'] = $this->CommonModal->getRowById('contactdetails', 'cid', '1');


        $data['title'] = 'SriMitra | Add to cart';
        $data['logo'] = 'assets/logo.png';
        $this->load->view('add_to_cart', $data);
    }
    public function profile()
    {
        if (!$this->session->has_userdata('login_user_id')) {
            redirect('Index');
        }

        $data['subcate'] = $this->CommonModal->getAllRowsInOrder('sub_category', 'sub_category_id', 'desc');

        $data['contactdetails'] = $this->CommonModal->getRowById('contactdetails', 'cid', '1');
        $data['all_orphanage'] = $this->CommonModal->runQuery("SELECT * FROM `tbl_orphanage` WHERE `assign_merchant` != '' ORDER BY id DESC");
        $data['statelist'] = $this->CommonModal->getDistinctRow('tbl_orphanage', 'state');
        $data['logni_user'] = $this->session->userdata();
        $data['orderDetails'] = $this->CommonModal->getRowById('checkout', 'user_id', $this->session->userdata('login_user_id'));
        $data['profiledata'] = $this->CommonModal->getRowById('tbl_user', 'uid', $this->session->userdata('login_user_id'))[0];
        $data['title'] = 'SriMitra | Profile';
        $data['logo'] = 'assets/logo.png';
        if (count($_POST) > 0) {
            $post = $this->input->post();
            $update = $this->CommonModal->updateRowById('tbl_user', 'uid', $this->session->userdata('login_user_id'), $post);
            redirect(base_url('profile'));
        } else {
            $this->load->view('profile', $data);
        }
    }
    public function my_confirmed_donation()
    { {
            if (!$this->session->has_userdata('login_user_id')) {
                redirect('Index');
            }

            $data['subcate'] = $this->CommonModal->getAllRowsInOrder('sub_category', 'sub_category_id', 'desc');

            $data['contactdetails'] = $this->CommonModal->getRowById('contactdetails', 'cid', '1');

            $data['logni_user'] = $this->session->userdata();
            $data['orderDetails'] = $this->CommonModal->getRowByMoreId('checkout', array('user_id' => $this->session->userdata('login_user_id'), 'chechout_status' => '6'));
            $data['profiledata'] = $this->CommonModal->getRowById('tbl_user', 'uid', $this->session->userdata('login_user_id'))[0];
            $data['title'] = 'SriMitra | Profile';
            $data['logo'] = 'assets/logo.png';
            if (count($_POST) > 0) {
                $post = $this->input->post();

                $update = $this->CommonModal->updateRowById('tbl_user', 'uid', $this->session->userdata('login_user_id'), $post);

                redirect(base_url('profile'));
            } else {
                $this->load->view('my_donation', $data);
            }
        }
    }
    public function my_donation()
    {
        if (!$this->session->has_userdata('login_user_id')) {
            redirect('Index');
        }

        $data['subcate'] = $this->CommonModal->getAllRowsInOrder('sub_category', 'sub_category_id', 'desc');

        $data['contactdetails'] = $this->CommonModal->getRowById('contactdetails', 'cid', '1');

        $data['logni_user'] = $this->session->userdata();
        // $data['orderDetails'] = $this->CommonModal->getRowByMoreId('checkout', array('user_id' => $this->session->userdata('login_user_id'), 'chechout_status' => '6'));
        $data['profiledata'] = $this->CommonModal->getRowById('tbl_user', 'uid', $this->session->userdata('login_user_id'))[0];
        $data['title'] = 'SriMitra | Profile';
        $data['logo'] = 'assets/logo.png';
        if (count($_POST) > 0) {
            $post = $this->input->post();

            $update = $this->CommonModal->updateRowById('tbl_user', 'uid', $this->session->userdata('login_user_id'), $post);

            redirect(base_url('profile'));
        } else {
            $this->load->view('my_donation', $data);
        }
    }
    public function my_celebration()
    {
        if (!$this->session->has_userdata('login_user_id')) {
            redirect('Index');
        }

        $data['subcate'] = $this->CommonModal->getAllRowsInOrder('sub_category', 'sub_category_id', 'desc');

        $data['contactdetails'] = $this->CommonModal->getRowById('contactdetails', 'cid', '1');

        $data['logni_user'] = $this->session->userdata();
        // $data['orderDetails'] = $this->CommonModal->getRowByMoreId('checkout', array('user_id' => $this->session->userdata('login_user_id'), 'chechout_status' => '6'));
        $data['profiledata'] = $this->CommonModal->getRowById('tbl_user', 'uid', $this->session->userdata('login_user_id'))[0];
        $data['title'] = 'SriMitra | My celebration with CCH';
        $data['logo'] = 'assets/logo.png';
        if (count($_POST) > 0) {
            $post = $this->input->post();

            $update = $this->CommonModal->updateRowById('tbl_user', 'uid', $this->session->userdata('login_user_id'), $post);

            redirect(base_url('profile'));
        } else {
            $this->load->view('my_celebration', $data);
        }
    }
    public function my_inprocess_donation()
    {
        if (!$this->session->has_userdata('login_user_id')) {
            redirect('Index');
        }

        $data['subcate'] = $this->CommonModal->getAllRowsInOrder('sub_category', 'sub_category_id', 'desc');

        $data['contactdetails'] = $this->CommonModal->getRowById('contactdetails', 'cid', '1');

        $data['logni_user'] = $this->session->userdata();
        $data['orderDetails'] = $this->CommonModal->getRowByMoreId('checkout', array('user_id' => $this->session->userdata('login_user_id'), 'chechout_status' => '3'));
        $data['profiledata'] = $this->CommonModal->getRowById('tbl_user', 'uid', $this->session->userdata('login_user_id'))[0];
        $data['title'] = 'SriMitra | Profile';
        $data['logo'] = 'assets/logo.png';
        if (count($_POST) > 0) {
            $post = $this->input->post();
            $update = $this->CommonModal->updateRowById('tbl_user', 'uid', $this->session->userdata('login_user_id'), $post);

            redirect(base_url('profile'));
        } else {
            $this->load->view('my_donation', $data);
        }
    }

    public function my_cancelled_donation()
    {
        if (!$this->session->has_userdata('login_user_id')) {
            redirect('Index');
        }

        $data['subcate'] = $this->CommonModal->getAllRowsInOrder('sub_category', 'sub_category_id', 'desc');

        $data['contactdetails'] = $this->CommonModal->getRowById('contactdetails', 'cid', '1');

        $data['logni_user'] = $this->session->userdata();
        $data['orderDetails'] = $this->CommonModal->getRowByMoreId('checkout', array('user_id' => $this->session->userdata('login_user_id'), 'status' => '2'));
        $data['profiledata'] = $this->CommonModal->getRowById('tbl_user', 'uid', $this->session->userdata('login_user_id'))[0];
        $data['title'] = 'SriMitra | Profile';
        $data['logo'] = 'assets/logo.png';
        if (count($_POST) > 0) {
            $post = $this->input->post();
            $update = $this->CommonModal->updateRowById('tbl_user', 'uid', $this->session->userdata('login_user_id'), $post);

            redirect(base_url('profile'));
        } else {
            $this->load->view('my_donation', $data);
        }
    }
    public function update_profile()
    {
        if (!$this->session->has_userdata('login_user_id')) {
            redirect('Index');
        }
        $data['contactdetails'] = $this->CommonModal->getRowById('contactdetails', 'cid', '1');
        $data['logni_user'] = $this->session->userdata();
        $data['profiledata'] = $this->CommonModal->getRowById('tbl_user', 'uid', $this->session->userdata('login_user_id'))[0];
        $data['state_list'] = $this->CommonModal->getAllRows('tbl_state');

        $data['title'] = 'SriMitra | Profile';
        $data['logo'] = 'assets/logo.png';
        if (count($_POST) > 0) {
            $post = $this->input->post();
            if (!empty($_FILES['imgprofile'])) {
                $post['img'] = imageUpload('imgprofile', 'uploads/user/');
            } else {
                $post['img'] = $data['profiledata']['img'];
            }
            $update = $this->CommonModal->updateRowById('tbl_user', 'uid', $this->session->userdata('login_user_id'), $post);
            redirect(base_url('Index/profile'));
        } else {
            $this->load->view('update_profile', $data);
        }
    }


    public function change_password()
    {

        if (count($_POST) > 0) {
            $oldpassword = $this->input->post('oldpassword');
            $password = $this->input->post('password');
            $confirmpassword = $this->input->post('confirmpassword');


            $profile = $this->CommonModal->getsingleRowById('tbl_user', array('uid' => $this->session->userdata('login_user_id')));
            if ($profile['password'] == $oldpassword) {
                if ($password == $confirmpassword) {
                    $update = $this->CommonModal->updateRowById('tbl_user', 'uid', $this->session->userdata('login_user_id'), array('password' => $password));
                    if ($update) {
                        $this->session->set_flashdata('cmsg', 'Password Changed Successfully');
                        $this->session->set_flashdata('cmsg_class', 'alert-success');
                    } else {
                        $this->session->set_flashdata('cmsg', 'Password not changed , try again later');
                        $this->session->set_flashdata('cmsg_class', 'alert-danger');
                    }
                } else {
                    $this->session->set_flashdata('cmsg', 'Password and confirm password doesnt matched.');
                    $this->session->set_flashdata('cmsg_class', 'alert-danger');
                }
            } else {
                $this->session->set_flashdata('cmsg', 'Old password doesnt matched');
                $this->session->set_flashdata('cmsg_class', 'alert-danger');
            }

            redirect(base_url('Index/update_profile'));
        } else {
            redirect(base_url('Index/update_profile'));
        }
    }



    public function orders()
    {
        if (!$this->session->has_userdata('login_user_id')) {
            redirect('Index');
        }

        $data['subcate'] = $this->CommonModal->getAllRowsInOrder('sub_category', 'sub_category_id', 'desc');
        $data['contactdetails'] = $this->CommonModal->getRowById('contactdetails', 'cid', '1');

        $data['login_user'] = $this->session->userdata();
        $data['orderDetails'] = $this->CommonModal->getRowByIdInOrder('checkout', array('user_id' => $this->session->userdata('login_user_id')), 'id', 'DESC');
        $data['profiledata'] = $this->CommonModal->getRowById('tbl_user', 'uid', $this->session->userdata('login_user_id'));

        $data['title'] = 'SriMitra | Profile';
        $data['logo'] = 'assets/logo.png';
        $this->load->view('orders', $data);
    }
    public function cancelorder()
    {
        $id = $this->input->post('id');
        $upd = $this->CommonModal->updateRowById('checkout', 'id', $id, array('status' => '2'));
        if ($upd) {
            return '0';
        } else {
            return '1';
        }
    }
    public function wishlist()
    {
        if (!$this->session->has_userdata('login_user_id')) {
            redirect('Index');
        }
        $data['subcate'] = $this->CommonModal->getAllRowsInOrder('sub_category', 'sub_category_id', 'desc');
        $data['contactdetails'] = $this->CommonModal->getRowById('contactdetails', 'cid', '1');
        $data['login_user'] = $this->session->userdata();
        $data['wishList'] = $this->CommonModal->getRowById('products_wishlist', 'user_id', $this->session->userdata('login_user_id'));
        $data['title'] = 'SriMitra | Wishlist';
        $data['logo'] = 'assets/logo.png';
        $this->load->view('wishlist', $data);
    }

    public function orderDetails()
    {
        if (!$this->session->has_userdata('login_user_id')) {
            redirect('Index');
        }
        $checkoutID = $this->uri->segment(3);
        $data['subcate'] = $this->CommonModal->getAllRowsInOrder('sub_category', 'sub_category_id', 'desc');

        $data['contactdetails'] = $this->CommonModal->getRowById('contactdetails', 'cid', '1');

        $data['orderDetails'] = $this->CommonModal->getRowById('checkout', 'id', $checkoutID);
        $data['orderProductDetails'] = $this->CommonModal->getRowById('checkout_product', 'checkoutid', $checkoutID);
        $data['title'] = 'SriMitra | Profile';
        $data['logo'] = 'assets/logo.png';
        $this->load->view('orderDetails', $data);
    }
    public function orderInvoice()
    {
        if (!$this->session->has_userdata('login_user_id')) {
            redirect('Index');
        }
        $checkoutID = $this->uri->segment(3);
        $data['subcate'] = $this->CommonModal->getAllRowsInOrder('sub_category', 'sub_category_id', 'desc');

        $data['contactdetails'] = $this->CommonModal->getRowById('contactdetails', 'cid', '1');

        $data['orderDetails'] = $this->CommonModal->getRowById('checkout', 'id', $checkoutID);
        $data['orderProductDetails'] = $this->CommonModal->getRowById('checkout_product', 'checkoutid', $checkoutID);
        $data['title'] = 'SriMitra | Profile';
        $data['logo'] = 'assets/logo.png';
        $this->load->view('orderInvoice', $data);
    }

    public function logout()
    {
        $this->session->unset_userdata('login_user_id');
        $this->session->unset_userdata('login_user_name');
        $this->session->unset_userdata('login_user_emailid');
        $this->session->unset_userdata('login_user_contact');
        $this->session->unset_userdata('login_user_type');
        redirect(base_url('Index'));
    }

    // payu code
    public function checkoutpay()
    {

        $data['title'] = 'SriMitra | Payment Update';
        $data['logo'] = 'assets/logo.png';
        $data['show'] = 'yes';
        $data['subcate'] = $this->CommonModal->getAllRowsInOrder('sub_category', 'sub_category_id', 'desc');
        $data['contactdetails'] = $this->CommonModal->getRowById('contactdetails', 'cid', '1');
        if ($this->session->has_userdata('login_user_id')) {
            $this->load->view('payout', $data);
        } else {
            $this->load->view('login', $data);
        }
    }
    public function payubiz()
    {
        $msg = '';
        $msgpro = '';
        $admmsg = '';
        $checkoutdata   = $this->input->post();
        $checkoutdata['create_date_only'] = setDateOnly();
        $orphane = $this->CommonModal->getRowById('tbl_orphanage', 'id',  $checkoutdata['orphane_id']);
        $checkoutdata['merchant_id'] =   $orphane[0]['assign_merchant'];
        $marchant = $this->CommonModal->getRowById('tbl_merchant_registration', 'id', $orphane[0]['assign_merchant']);
        $post = $this->CommonModal->insertRowReturnId('checkout', $checkoutdata);
        $product = '';
        $product_list = array();

        foreach ($this->cart->contents() as $items) :
            $product = array(
                'checkoutid' => $post, 'product_id' => $items['id'], 'orphan_id' => $items['orphane'],  'product_img' => $items['image'],
                'product_name' => $items['name'], 'product_price' => $items['price'], 'product_quantity' => $items['qty'], 'total_pro_amt' => ($items['price'] * $items['qty']),  'product_status' => $items['product_status']
            );
            $this->CommonModal->insertRowReturnId('checkout_product', $product);
            $product_list[] = $product;
            $msgpro .= 'Product Details - ' . $items['name'] . '<br> [ ' . $items['price'] . ' * ' . $items['qty'] . '] <br>';
        endforeach;
        $data['order_id'] = $post;

        $message = orderIdmail(str_replace('-', '', setDateOnly()) . $post);
        // sendmail(sessionId('login_user_emailid'), 'OrderId from SriMitra  | Thankyou for ordering with us', $message);

        if ($post != '') {
            $this->cart->destroy();
            // redirect('Index/payment_id_update_view');
        } else {
            // echo 'Check Form Data';
        }

        $data['mid'] = "gzemsh";
        $data['salt'] = "iZspKOPu";

        $data['txnid'] = substr(hash('sha256', mt_rand() . microtime()), 0, 20);

        $data['grandtotal'] = (float)$_POST['grand_total'];
        $data['productinfo'] =  $post;
        $data['fname'] = $_POST['name'];
        $data['email'] = $_POST['email'];

        $data['udf1'] = '';
        $data['udf2'] = '';
        $data['udf3'] = '';
        $data['udf4'] = '';
        $data['udf5'] = '';

        $hashstring = $data['mid'] . '|' . $data['txnid'] . '|' . $data['grandtotal'] . '|' . $data['productinfo'] . '|' . $data['fname'] . '|' . $data['email'] . '|' . $data['udf1'] . '|' . $data['udf2'] . '|' . $data['udf3'] . '|' . $data['udf4'] . '|' . $data['udf5'] . '||||||' . $data['salt'];

        $hash = strtolower(hash('sha512', $hashstring));
        $data['hash'] = $hash;

        //Loading checkout view
        $this->load->view('checkout', $data);
    }
    public function payment_success()
    {
        $data['title'] = 'SriMitra | Payment Page';
        $data['logo'] = 'assets/logo.png';
        $data['response'] = $_POST;
        $data['subcate'] = $this->CommonModal->getAllRowsInOrder('sub_category', 'sub_category_id', 'desc');
        $data['contactdetails'] = $this->CommonModal->getRowById('contactdetails', 'cid', '1');
        $post = $this->CommonModal->updateRowById('checkout', 'id', $_POST['productinfo'], array('payment_id' => $_POST['mihpayid']));
        $orderDetails = $this->CommonModal->getRowById('checkout', 'id', $_POST['productinfo']);
        $login_data = $this->CommonModal->getRowByMoreId('tbl_user', array('uid' => $orderDetails[0]['user_id']));
        $session = $this->session->set_userdata(array('login_user_id' => $login_data[0]['uid'], 'login_user_name' => $login_data[0]['name'], 'login_user_emailid' => $login_data[0]['email'], 'login_user_contact' => $login_data[0]['number']));
        $this->session->set_userdata(array('check_name' =>  $login_data[0]['name'], 'check_number' => $login_data[0]['number'], 'check_email' => $login_data[0]['email']));

        $this->load->view('payout_msg', $data);
    }
    public function payment_failure()
    {
        $data['title'] = 'SriMitra | Payment Page';
        $data['logo'] = 'assets/logo.png';
        $data['response'] = $_POST;
        $data['subcate'] = $this->CommonModal->getAllRowsInOrder('sub_category', 'sub_category_id', 'desc');
        $data['contactdetails'] = $this->CommonModal->getRowById('contactdetails', 'cid', '1');
        $post = $this->CommonModal->updateRowById('checkout', 'id', $_POST['productinfo'], array('payment_id' => $_POST['mihpayid']));
        $this->load->view('payout_msg', $data);
    }

    // public function checkoutpay()
    // {
    //     $msg = '';
    //     $msgpro = '';
    //     $admmsg = '';
    //     $data['title'] = 'SriMitra | Payment Update';
    //     $data['logo'] = 'assets/logo.png';
    //     $data['subcate'] = $this->CommonModal->getAllRowsInOrder('sub_category', 'sub_category_id', 'desc');

    //     $data['contactdetails'] = $this->CommonModal->getRowById('contactdetails', 'cid', '1');
    //     if (count($_POST) > 0) {
    //         $checkoutdata   = $this->input->post();
    //         $checkoutdata['create_date_only'] = setDateOnly();
    //         $orphane = $this->CommonModal->getRowById('tbl_orphanage', 'id',  $checkoutdata['orphane_id']);
    //         $checkoutdata['merchant_id'] =   $orphane[0]['assign_merchant'];
    //         $marchant = $this->CommonModal->getRowById('tbl_merchant_registration', 'id', $orphane[0]['assign_merchant']);
    //         $post = $this->CommonModal->insertRowReturnId('checkout', $checkoutdata);
    //         $product = '';
    //         $product_list = array();

    //         foreach ($this->cart->contents() as $items) :
    //             $product = array(
    //                 'checkoutid' => $post, 'product_id' => $items['id'], 'orphan_id' => $items['orphane'],  'product_img' => $items['image'],
    //                 'product_name' => $items['name'], 'product_price' => $items['price'], 'product_quantity' => $items['qty'], 'total_pro_amt' => ($items['price'] * $items['qty']),  'product_status' => $items['product_status']
    //             );
    //             $this->CommonModal->insertRowReturnId('checkout_product', $product);
    //             $product_list[] = $product;
    //             $msgpro .= 'Product Details - ' . $items['name'] . '<br> [ ' . $items['price'] . ' * ' . $items['qty'] . '] <br>';
    //         endforeach;
    //         $data['order_id'] = $post;

    //         $message = orderIdmail(str_replace('-', '', setDateOnly()) . $post);
    //         sendmail(sessionId('login_user_emailid'), 'OrderId from SriMitra  | Thankyou for ordering with us', $message);






    //         if ($post != '') {
    //             $this->cart->destroy();
    //             redirect('Index/payment_id_update_view');
    //         } else {
    //             echo 'Check Form Data';
    //         }
    //     }
    //     $this->load->view('payout', $data);
    // }

    public function checkoutpay_celebrate()
    {
        $data['title'] = 'SriMitra | Payment Update';
        $data['logo'] = 'assets/logo.png';
        $data['subcate'] = $this->CommonModal->getAllRowsInOrder('sub_category', 'sub_category_id', 'desc');
        $data['contactdetails'] = $this->CommonModal->getRowById('contactdetails', 'cid', '1');
        if (count($_POST) > 0) {
            $checkoutdata   = $this->input->post();
            $data['info'] = $this->input->post();
            if ($checkoutdata['min_adv'] >= 500) {
                $login_data = $this->CommonModal->getRowById('tbl_user', 'number', $checkoutdata['number']);
                if (!empty($login_data)) {
                    $user_id = $login_data[0]['uid'];
                    $session = $this->session->set_userdata(array('login_user_id' => $user_id, 'login_user_name' => $login_data[0]['name'], 'login_user_emailid' => $login_data[0]['email'], 'login_user_contact' => $login_data[0]['number']));
                } else {
                    $formdata['name'] = $checkoutdata['name'];
                    $formdata['email'] = $checkoutdata['email'];
                    $formdata['number'] = $checkoutdata['number'];
                    $formdata['password'] =   substr($formdata['name'], 0, 3) . substr($formdata['number'], 0, 3);
                    $user_id = $this->CommonModal->insertRowReturnId('tbl_user', $formdata);
                    $session = $this->session->set_userdata(array(
                        'login_user_id' => $user_id, 'login_user_name' => $checkoutdata['name'],
                        'login_user_emailid' => $checkoutdata['email'], 'login_user_contact' => $checkoutdata['number']
                    ));
                }
                $session = $this->session->set_userdata(array('check_name' =>  $checkoutdata['name'], 'check_number' => $checkoutdata['number'], 'check_email' => $checkoutdata['email']));

                $checkoutdata['user_id'] = $user_id;
                $post = $this->CommonModal->insertRowReturnId('checkout_events', $checkoutdata);
                $data['celebrate_id'] = $post;
                if ($post != '') {
                    setdata('eventid', $post);
                } else {
                    setData('msg', 'Server error, Please try again later or you can call us on given contact no. stated in contact page.');
                    redirect('celebrate_with_us');
                }
            } else {
                setData('msg', 'Minimum Amount should be Rs. 500 for confirmation of your celebration with us.');
                redirect('celebrate_with_us');
            }
        } else {
            redirect('celebrate_with_us');
        }
        $this->load->view('payout_event', $data);
    }

    public function checkoutpay_celebrate_payment()
    {
        if (count($_POST) > 0) {
            $checkoutdata   = $this->input->post();
            // print_r($checkoutdata);
            $post = $this->CommonModal->updateRowById('checkout_events', 'eve_id', $checkoutdata['eve_id'], array('amount' => $checkoutdata['amount'], 'payment_id' => $checkoutdata['payment_id']));
            print_r($post);
            if ($post != '') {
                setData('msg', 'Your Event request will be reviewed and will be confirmed via call or Text message.');
            } else {
                setData('msg', 'Server error, Please try again later or you can call us on given contact no. stated in contact page.');
            }
        } else {
            redirect('celebrate_with_us');
        }
        $data['title'] = 'SriMitra | Payment Page';
        $data['logo'] = 'assets/logo.png';
        $data['subcate'] = $this->CommonModal->getAllRowsInOrder('sub_category', 'sub_category_id', 'desc');
        $data['contactdetails'] = $this->CommonModal->getRowById('contactdetails', 'cid', '1');
        $this->load->view('payout_celebrate_msg', $data);
    }
    public function payment_id_update()
    {
        $data['title'] = 'SriMitra |Payment Id ';
        $data['logo'] = 'assets/logo.png';
        $data['subcate'] = $this->CommonModal->getAllRowsInOrder('sub_category', 'sub_category_id', 'desc');
        $data['contactdetails'] = $this->CommonModal->getRowById('contactdetails', 'cid', '1');
        $post = $this->input->post();
        $this->CommonModal->updateRowById('checkout', 'id', $post['order_id'], array('payment_id' => $post['transaction']));
        redirect('Index/payment_id_update_view');
    }
    public function payment_id_update_view()
    {
        $data['title'] = 'SriMitra | Payment Page';
        $data['logo'] = 'assets/logo.png';
        $data['subcate'] = $this->CommonModal->getAllRowsInOrder('sub_category', 'sub_category_id', 'desc');
        $data['contactdetails'] = $this->CommonModal->getRowById('contactdetails', 'cid', '1');


        $this->load->view('payout_msg', $data);
    }
    public function check()
    {
        //check whether stripe token is not empty

    }
    public function success()
    {
        $data['subcate'] = $this->CommonModal->getAllRowsInOrder('sub_category', 'sub_category_id', 'desc');

        $data['contactdetails'] = $this->CommonModal->getRowById('contactdetails', 'cid', '1');
        $data['logo'] = 'assets/logo.png';
        $data['title'] = 'Razorpay Success | SriMitra';
        $msg = '';
        $msg .= "<h4>Your transaction is successful</h4>";
        $msg .= "<br/>";
        $msg .= "<p>Transaction ID: " . $this->session->flashdata('razorpay_payment_id') . '</p>';
        $msg .= "<br/>";
        $msg .= "<p>Order ID: " . $this->session->flashdata('merchant_order_id') . '</p>';
        $data['message'] = $msg;
        $this->load->view('payment_msg', $data);
    }
    public function failed()
    {
        $data['subcate'] = $this->CommonModal->getAllRowsInOrder('sub_category', 'sub_category_id', 'desc');

        $data['contactdetails'] = $this->CommonModal->getRowById('contactdetails', 'cid', '1');
        $data['logo'] = 'assets/logo.png';
        $data['title'] = 'Razorpay Failed | SriMitra';
        $msg = '';
        $msg .= "<h4>Your transaction got Failed</h4>";
        $msg .= "<br/>";
        $msg .= "<p>Transaction ID: " . $this->session->flashdata('razorpay_payment_id') . '</p>';
        $msg .= "<br/>";
        $msg .= "<p>Order ID: " . $this->session->flashdata('merchant_order_id') . '</p>';
        $data['message'] = $msg;
        $this->load->view('payment_msg', $data);
    }
    public function booking_status()
    {
        // $data['subcate'] = $this->CommonModal->getAllRowsInOrder('sub_category', 'sub_category_id', 'desc');

        $data['contactdetails'] = $this->CommonModal->getRowById('contactdetails', 'cid', '1');
        $data['profiledata'] = $this->CommonModal->getRowById('tbl_user', 'uid', $this->session->userdata('login_user_id'));
        $data['logo'] = 'assets/logo.png';
        $data['title'] = 'Payment Status';
        $msg = '';
        $msg .= "<h4>Your Order has been Made successfully </h4>";
        $msg .= "<br/>";
        $msg .= "<p>Thank You for Taking Small Steps to Spread Big Smiles</p> ";
        $msg .= "<br/>";
        // $msg .= "<p>Till then - Happy shopping</p>";
        $data['message'] = $msg;
        $this->load->view('thankyou', $data);
    }
    public function addToCart()
    {
        $product_id = $this->input->post('pid');
        $orphan_id = $this->input->post('oid');
        $order_request_id = $this->input->post('orid');
        $order_type = $this->input->post('order_type');
        $qty = $this->input->post('qty');

        $product = $this->CommonModal->getRowById('merchant_products', 'id', $product_id);
        $product_details = $this->CommonModal->getRowById('products', 'product_id', $product[0]['product_id']);
        $data = array(
            'id'                => $product[0]['id'],
            'qty'               => $qty,
            'price'             => $product[0]['srimitra_price'],
            'name'              => clean($product_details[0]['pro_name']),
            'orphane'           => $orphan_id,
            'product_status'    => 1,
            'image'             => $product[0]['img']
        );

        $this->cart->insert($data);
        $this->session->set_userdata('order_request', $order_request_id);
        $this->session->set_userdata('order_type', $order_type);
    }

    public function addInToCart()
    {
        $rid = $this->input->post('rid');
        $orid = $this->input->post('orid');
        $order_request_id = $this->input->post('ortid');
        $order_type = $this->input->post('order_type');

        $product = $this->CommonModal->getRowByIdfield('order_request_template', 'ortid', $rid, array('ortid', 'product_title', 'combo_price', 'cover'));
        $data = array(
            'id'      => $product[0]['ortid'],
            'qty'     => 1,
            'price'   => $product[0]['combo_price'],
            'name'    => clean($product[0]['product_title']),
            'orphane'    => $orid,
            'product_status'    => 0,
            'image'    => $product[0]['cover']
        );

        $this->cart->insert($data);
        $this->session->set_userdata('order_request', $order_request_id);
        $this->session->set_userdata('order_type', $order_type);
        // print_r($data);
    }

    // public function home_addInToCart()
    // {


    //     $data['title'] = 'SriMitra | Payment Update';
    //     $data['logo'] = 'assets/logo.png';
    //     $data['subcate'] = $this->CommonModal->getAllRowsInOrder('sub_category', 'sub_category_id', 'desc');
    //     $msgpro = '';
    //     $data['contactdetails'] = $this->CommonModal->getRowById('contactdetails', 'cid', '1');
    //     if (count($_POST) > 0) {
    //         $checkoutdata   = $this->input->post();
    //         $checkoutdata['create_date_only'] = setDateOnly();

    //         $orphane = $this->CommonModal->getRowById('tbl_orphanage', 'id',  $checkoutdata['orphane_id']);
    //         $checkoutdata['merchant_id'] =   $orphane[0]['assign_merchant'];
    //         $login_data = $this->CommonModal->getRowById('tbl_user', 'number', $checkoutdata['number']);

    //         if (!empty($login_data)) {
    //             $checkoutdata['user_id'] = $login_data[0]['uid'];
    //         } else {
    //             $formdata['name'] = $checkoutdata['name'];
    //             $formdata['email'] = $checkoutdata['email'];
    //             $formdata['number'] = $checkoutdata['number'];
    //             $formdata['password'] =   substr($formdata['name'], 0, 3) . substr($formdata['number'], 0, 3);
    //             $checkoutdata['user_id'] = $this->CommonModal->insertRowReturnId('tbl_user', $formdata);
    //         }

    //         $product = $this->CommonModal->getRowById('order_request_template', 'ortid', $checkoutdata['order_request_id']);
    //         $checkoutdata['totalamount'] = $product[0]['combo_price'];
    //         $checkoutdata['grand_total'] = $product[0]['combo_price'];

    //         $marchant = $this->CommonModal->getRowById('tbl_merchant_registration', 'id', $orphane[0]['assign_merchant']);
    //         $post = $this->CommonModal->insertRowReturnId('checkout', $checkoutdata);
    //         $data = array(
    //             'id'      => $product[0]['ortid'],
    //             'qty'     => 1,
    //             'price'   => $product[0]['combo_price'],
    //             'name'    => clean($product[0]['product_title']),
    //             'orphane'    => $checkoutdata['orphane_id'],
    //             'product_status'    => 0,
    //             'image'    => $product[0]['cover']
    //         );

    //         foreach ($this->cart->contents() as $items) :
    //             $product = array(
    //                 'checkoutid' => $post, 'product_id' => $data['id'], 'orphan_id' => $data['orphane'],  'product_img' => $data['image'],
    //                 'product_name' => $data['name'], 'product_price' => $data['price'], 'product_quantity' => $data['qty'], 'total_pro_amt' => ($data['price'] * $data['qty']),  'product_status' => $data['product_status']
    //             );
    //             $this->CommonModal->insertRowReturnId('checkout_product', $product);
    //             $product_list[] = $product;
    //             $msgpro .= 'Product Details - ' . $items['name'] . '<br> [ ' . $items['price'] . ' * ' . $items['qty'] . '] <br>';
    //         endforeach;
    //         $data['order_id'] = $post;
    //         if ($post != '') {
    //             $this->cart->destroy();
    //             redirect('Index/payment_id_update_view');
    //         } else {
    //             echo 'Check Form Data';
    //         }
    //     }
    //     $this->load->view('payout', $data);
    // }



    public function cart_list()
    {
        $data['category'] = $this->CommonModal->getAllRowsInOrder('category', 'category_id', 'desc');
        $data['contactdetails'] = $this->CommonModal->getRowById('contactdetails', 'cid', '1');
        $data['logo'] = 'assets/logo.png';
        $data['title'] = 'Disclaimer | Whole sale kirana Wala';

        $this->load->view('cart_list', $data);
    }
    public function update_qty()
    {
        extract($this->input->post());
        // print_r($this->input->post());
        $data = array(
            'rowid' => $rowid,
            'qty'   => $qty
        );


        $this->cart->update($data);
        // echo 're';
        // print_r($data);
    }

    public function addTowishlist()
    {
        $product_id = $this->input->post('pid');
        $user_id = $this->session->userdata('login_user_id');
        $post = array('product_id' => $product_id, 'user_id' => $user_id);
        $ret =  $this->CommonModal->insertRow('products_wishlist', $post);
        if ($ret) {
            echo  '1';
        } else {
            echo '0';
        }
    }
    public function removewishlist()
    {
        $pw_id = $this->input->post('pid');
        $ret = $this->CommonModal->deleteRowById('products_wishlist', array('pw_id' => $pw_id));


        if ($ret) {
            echo  '1';
        } else {
            echo '0';
        }
    }

    public function fetch_totalitems()
    {
        echo $this->cart->total_items();
    }
    public function fetch_totalamount()
    {
        echo $this->cart->total();
    }
    public function delete_item()
    {
        $product_id = $this->input->post('pid');
        $data = array(
            'rowid' => $product_id,
            'qty'   => 0
        );


        $this->cart->update($data);
    }
    public function cart()
    {

        $data['title'] = 'Cart List';
        $data['contactdetails'] = $this->CommonModal->getRowById('contactdetails', 'cid', '1');

        $this->load->view('cart',  $data);
    }
    public function cartAjax()
    {
        // $data['subcate'] = $this->CommonModal->getAllRowsInOrder('sub_category', 'sub_category_id', 'desc');

        $this->load->view('cartListAjax');
    }
    public function cartAjax2()
    {
        // $data['subcate'] = $this->CommonModal->getAllRowsInOrder('sub_category', 'sub_category_id', 'desc');

        $this->load->view('cartListAjax2');
    }





    public function filterData()
    {
        // $data['subcate'] = $this->CommonModal->getAllRowsInOrder('sub_category', 'sub_category_id', 'desc');


        $search = ((isset($_POST['search'])) ? $_POST['search'] : '');
        // $category = ((isset($_POST['category'])) ? $_POST['category'] : '');
        // $subcategory = ((isset($_POST['subcategory'])) ? $_POST['subcategory'] : '');
        $query = "SELECT * FROM `tbl_orphanage` WHERE  `assign_merchant` != '' AND `id` IS NOT NULL ";
        // print_r($search);

        if ($search != '') {

            $query .= " AND `name` LIKE '%" . trim($search) . "%'  OR `state_name` LIKE '%" . trim($search) . "%' OR `city_name` LIKE '%" . trim($search) . "%'  OR `address` LIKE '%" . trim($search) . "%' OR `trust_name` LIKE '%" . trim($search) . "%' OR `description` LIKE '%" . trim($search) . "%' ";
        }

        // if ($category != '') {
        //     $cate = implode("','", $category);
        //     $query .= " AND category_id IN('" . $cate . "')";
        // }

        // if ($subcategory != '') {
        //     $subcate = implode("','", $subcategory);
        //     $query .= " AND subcategory_id IN('" . $subcate . "')";
        // }

        // echo $query;
        $data['all_data'] = $this->CommonModal->runQuery($query);

        // print_r($all_data);


        $this->load->view('get_home', $data);
    }
    public function filterData_state()
    {
        $statelist = ((isset($_POST['statelist'])) ? $_POST['statelist'] : '');
        $query = "SELECT * FROM `tbl_orphanage` WHERE  `assign_merchant` != '' AND  `id` IS NOT NULL ";
        if ($statelist != '') {
            $query .= " AND `state` IN ('" . trim($statelist) . "')";
        }
        // echo $query;
        $data['all_data'] = $this->CommonModal->runQuery($query);
        $this->load->view('get_home_front', $data);
    }


    public function filtercelebrateData()
    {
        $getuser = $this->session->userdata('login_user_id');
        $status = ((isset($_POST['status'])) ? $_POST['status'] : '');
        $query = "SELECT * FROM `checkout_events` WHERE `user_id`= '" . $getuser . "'";
        if ($status != '') {
            $query .= "  AND `status` =  '" . $status . "' ";
        }
        $query .= " ORDER BY `eve_id` DESC";
        // echo $query;
        $data['orderDetails'] = $this->CommonModal->runQuery($query);

        $this->load->view('fetch-celebration', $data);
    }
    public function filterOrderData()
    {
        $getuser = $this->session->userdata('login_user_id');
        $status = ((isset($_POST['status'])) ? $_POST['status'] : '');
        $query = "SELECT * FROM `checkout` WHERE `user_id`= '" . $getuser . "'";
        if ($status != '') {
            $query .= "  AND `chechout_status` =  '" . $status . "' ";
        }
        $query .= " ORDER BY `id` DESC";
        // echo $query;
        $data['orderDetails'] = $this->CommonModal->runQuery($query);

        $this->load->view('fetch-donation', $data);
    }



    public function getProduct()
    {

        $data['subcate'] = $this->CommonModal->getAllRowsInOrder('sub_category', 'sub_category_id', 'desc');

        $categoryid = $this->input->post('catid');
        $subcategoryid = $this->input->post('subcatid');
        $limit = $this->input->post('limit');
        $offset = $this->input->post('offset');
        if ($subcategoryid != '') {
            $data['products'] = $this->CommonModal->getDataByIdInOrderLimit('products', array('subcategory_id' => $subcategoryid), 'product_id', 'desc', $limit, $offset);
        } elseif ($categoryid != '') {
            $data['products'] =  $this->CommonModal->getDataByIdInOrderLimit('products', array('category_id' => $categoryid), 'product_id', 'desc', $limit, $offset);
        } else {
            $data['products'] = $this->CommonModal->getAllRows('products');
            // print_r($data['products']);
        }

        $this->load->view('get_product', $data);
    }
    public function checkPromo()
    {
        $promocode = $this->input->post('promocode');
        echo json_encode($this->CommonModal->getRowById('promocode', 'title', $promocode));
    }

    public function faq()
    {
        $data['subcate'] = $this->CommonModal->getAllRowsInOrder('sub_category', 'sub_category_id', 'desc');

        $data['contactdetails'] = $this->CommonModal->getRowById('contactdetails', 'cid', '1');
        $data['logo'] = 'assets/logo.png';
        $data['faq'] = $this->CommonModal->getAllRowsInOrder('faq', 'fid', 'desc');


        $data['title'] = 'FAQ | SriMitra';

        $this->load->view('faq', $data);
    }
    public function disclaimer()
    {
        $data['subcate'] = $this->CommonModal->getAllRowsInOrder('sub_category', 'sub_category_id', 'desc');
        $data['contactdetails'] = $this->CommonModal->getRowById('contactdetails', 'cid', '1');
        $data['logo'] = 'assets/logo.png';
        $data['title'] = 'Disclaimer | SriMitra';

        $this->load->view('disclaimer', $data);
    }
    public function returnPolicy()
    {
        $data['subcate'] = $this->CommonModal->getAllRowsInOrder('sub_category', 'sub_category_id', 'desc');
        $data['contactdetails'] = $this->CommonModal->getRowById('contactdetails', 'cid', '1');
        $data['logo'] = 'assets/logo.png';
        $data['returnPolicy'] = $this->CommonModal->getRowById('tbl_return_policy', 'id', '1');

        $data['title'] = 'Return Policy | SriMitra';

        $this->load->view('returnPolicy', $data);
    }
    public function terms_condition()
    {
        $data['subcate'] = $this->CommonModal->getAllRowsInOrder('sub_category', 'sub_category_id', 'desc');
        $data['contactdetails'] = $this->CommonModal->getRowById('contactdetails', 'cid', '1');
        $data['logo'] = 'assets/logo.png';
        $data['data'] = $this->CommonModal->getSingleRowById('tbl_add_on_data', array('id' => '2'));
        $data['title'] = 'Terms and condition | SriMitra';

        $this->load->view('terms_condition', $data);
    }
    public function delivery_policy()
    {
        $data['subcate'] = $this->CommonModal->getAllRowsInOrder('sub_category', 'sub_category_id', 'desc');
        $data['contactdetails'] = $this->CommonModal->getRowById('contactdetails', 'cid', '1');
        $data['logo'] = 'assets/logo.png';
        $data['data'] = $this->CommonModal->getSingleRowById('tbl_add_on_data', array('id' => '10'));
        $data['title'] = 'Delivery policy | SriMitra';

        $this->load->view('terms_condition', $data);
    }
    public function term_of_use()
    {
        $data['subcate'] = $this->CommonModal->getAllRowsInOrder('sub_category', 'sub_category_id', 'desc');
        $data['contactdetails'] = $this->CommonModal->getRowById('contactdetails', 'cid', '1');
        $data['logo'] = 'assets/logo.png';
        $data['data'] = $this->CommonModal->getSingleRowById('tbl_add_on_data', array('id' => '3'));
        $data['title'] = 'Terms of use | SriMitra';

        $this->load->view('term_of_use', $data);
    }
    public function refund_policy()
    {
        $data['subcate'] = $this->CommonModal->getAllRowsInOrder('sub_category', 'sub_category_id', 'desc');
        $data['contactdetails'] = $this->CommonModal->getRowById('contactdetails', 'cid', '1');
        $data['logo'] = 'assets/logo.png';
        $data['data'] = $this->CommonModal->getSingleRowById('tbl_add_on_data', array('id' => '9'));
        $data['title'] = 'Refund Policy | SriMitra';

        $this->load->view('refund-policy', $data);
    }

    public function privacy_policy()
    {
        $data['subcate'] = $this->CommonModal->getAllRowsInOrder('sub_category', 'sub_category_id', 'desc');
        $data['contactdetails'] = $this->CommonModal->getRowById('contactdetails', 'cid', '1');
        $data['logo'] = 'assets/logo.png';
        $data['data'] = $this->CommonModal->getSingleRowById('tbl_add_on_data', array('id' => '1'));
        $data['title'] = 'Privacy Policy | SriMitra';

        $this->load->view('privacy-policy', $data);
    }

    public function consultation()
    {
        $data['subcate'] = $this->CommonModal->getAllRowsInOrder('sub_category', 'sub_category_id', 'desc');
        $data['contactdetails'] = $this->CommonModal->getRowById('contactdetails', 'cid', '1');

        if (count($_POST) > 0) {
            $post = $this->input->post();
            $insert = $this->CommonModal->insertRowReturnId('consult_query', $post);
            if ($insert) {
                $this->session->set_userdata('msg', 'Your query is successfully submit. We will contact you as soon as possible.');
            } else {
                $this->session->set_userdata('msg', 'We are facing technical error ,please try again later or get in touch with Email ID provided in contact section.');
            }
        } else {
        }
        $data['title'] = 'SriMitra | Consultation';
        $data['logo'] = 'assets/logo.png';
        $this->load->view('consultation', $data);
    }


    public function withdrawrequest()
    {
        $user = $this->session->userdata('login_user_id');
        $points = $this->input->post('points');
        $this->CommonModal->insertRowReturnId('affiliate_withdraw', array('user_id' => $user, 'points' => $points));
    }

    public function our_mitras()
    {
        $data['contactdetails'] = $this->CommonModal->getRowById('contactdetails', 'cid', '1');
        $data['logo'] = 'assets/logo.png';
        $data['title'] = 'Our mitras | SriMitra';
        $this->load->view('our_mitras', $data);
    }
    public function know_about_us()
    {
        $data['contactdetails'] = $this->CommonModal->getRowById('contactdetails', 'cid', '1');
        $data['logo'] = 'assets/logo.png';
        $data['title'] = 'Know about SriMitras India | SriMitra';
        $this->load->view('know_about_us', $data);
    }
    public function vision_and_mission()
    {
        $data['contactdetails'] = $this->CommonModal->getRowById('contactdetails', 'cid', '1');
        $data['logo'] = 'assets/logo.png';
        $data['title'] = 'Our vision and Our mission | SriMitra';
        $this->load->view('vision_and_mission', $data);
    }
    public function live_projects()
    {
        $data['contactdetails'] = $this->CommonModal->getRowById('contactdetails', 'cid', '1');
        $data['logo'] = 'assets/logo.png';
        $data['title'] = 'Live projects | SriMitra';
        $this->load->view('live_projects', $data);
    }
    public function career()
    {
        $data['contactdetails'] = $this->CommonModal->getRowById('contactdetails', 'cid', '1');
        $data['logo'] = 'assets/logo.png';
        $data['title'] = 'Career | SriMitra';
        $this->load->view('career', $data);
    }
    public function fulltime_profile()
    {
        $data['contactdetails'] = $this->CommonModal->getRowById('contactdetails', 'cid', '1');
        $data['logo'] = 'assets/logo.png';
        $data['title'] = 'Full Time Profile | SriMitra';
        $this->load->view('fulltime_profile', $data);
    }


    public function internship()
    {
        $data['contactdetails'] = $this->CommonModal->getRowById('contactdetails', 'cid', '1');
        $data['logo'] = 'assets/logo.png';
        $data['title'] = 'Internship | SriMitra';
        $this->load->view('internship', $data);
    }
}
