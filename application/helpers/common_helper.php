<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


function getAllData($table)
{
	$ci = &get_instance();
	$get = $ci->db->select()
		->from($table)
		->get();
	return $get->result_array();
}
function getWhereData($table, $where)
{
	$ci = &get_instance();
	$get = $ci->db->select()
		->from($table)
		->where($where)
		->get();
	if ($get->num_rows() > 0) {
		return $get->result_array();
	} else {
		return false;
	}
}


function clean($string)
{
	$string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

	$string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.

	return preg_replace('/-+/', '-', $string);
}

function getAllDataInOrder($table, $id, $order)
{
	$ci = &get_instance();
	$get = $ci->db->select()
		->from($table)
		->order_by($id, $order)
		->get();
	return $get->result_array();
}

function setDateTime()
{
	return date('Y-m-d H:i:s');
}
function encryptId($id)
{
	$ci = &get_instance();
	$key = $ci->encrypt->encode($id);
	return $key;
}

function decryptId($key)
{
	$ci = &get_instance();
	$id = $ci->encrypt->decode($key);
	return $id;
}



function setDateOnly()
{
	return date('Y-m-d');
}
function convertDatedmy($dt)
{
	return date("d,M Y", strtotime($dt));
}
function convertDateymd($dt)
{
	return date("Y-m-d", strtotime($dt));
}
function convertDatedmyhis($dt)
{
	return date("d-m-Y H:i s", strtotime($dt));
}
function dateDiffInDays($date1, $date2)
{
	$diff = strtotime($date2) - strtotime($date1);
	// 1 day = 24 hours
	// 24 * 60 * 60 = 86400 seconds
	return abs(round($diff / 86400));
}
function sessionId($id)
{
	$ci = &get_instance();
	return $ci->session->userdata($id);
}
function setData($var, $message)
{
	$ci = &get_instance();
	return $ci->session->set_userdata($var, $message);
}
function userData($var, $message)
{
	$ci = &get_instance();
	return $ci->session->set_userdata($var, $message);
}
function insertRow($table, $data)
{
	$ci = &get_instance();
	$clean = $ci->security->xss_clean($data);
	return $ci->db->insert($table, $clean);
}

function returnId($table, $data)
{
	$ci = &get_instance();
	$ci->db->insert($table, $data);
	return $ci->db->insert_id();
}

function randomCode($length_of_string)
{
	$str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	return substr(str_shuffle($str_result), 0, $length_of_string);
}

function getRowById($table, $column, $id)
{
	$ci = &get_instance();
	$get = $ci->db->get_where($table, array($column => $id));
	if ($get->num_rows() > 0) {
		return $get->result_array();
	} else {
		return false;
	}
}

function getRowsum($table, $column, $id, $row)
{
	$ci = &get_instance();
	$get = $ci->db->get_where($table, array($column => $id))->select_sum($row);

	return $get->result_array();
}
function getRowsumByMoreId($table, $where, $row)
{
	$ci = &get_instance();
	$get = $ci->db->from($table)
		->where($where)
		->select_sum($row)
		->get();

	return $get->result_array();
}
function getSingleRowById($table, $where)
{
	$ci = &get_instance();
	$get = $ci->db->select()
		->from($table)
		->where($where)
		->get();
	if ($get->num_rows() > 0) {
		return $get->row_array();
	} else {
		return false;
	}
}

function getAllRow($table)
{
	$ci = &get_instance();
	$get = $ci->db->select()
		->from($table)
		->get();
	if ($get->num_rows() > 0) {
		return $get->result_array();
	} else {
		return false;
	}
}

function updateRowById($table, $column, $id, $data)
{
	$ci = &get_instance();
	$clean = $ci->security->xss_clean($data);
	$query = $ci->db->where($column, $id)
		->update($table, $clean);
	return $ci->db->affected_rows();
}

function deleteRowById($table, $column, $id)
{
	$ci = &get_instance();
	$ci->db->where($column, $id);
	$ci->db->delete($table);
	if ($ci->db->affected_rows() > 0) {
		return true;
	} else {
		return $ci->db->error();
	}
}

function deleteRowMoreId($table, $where)
{
	$ci = &get_instance();
	$ci->db->where($where);
	$ci->db->delete($table);
	if ($ci->db->affected_rows() > 0) {
		return true;
	} else {
		return $ci->db->error();
	}
}

function getAllRowInOrder($table, $column, $type)
{
	$ci = &get_instance();
	$select = $ci->db->order_by($column, $type)->get($table);
	if ($select->num_rows() > 0) {
		return $select->result_array();
	} else {
		return false;
	}
}

function getRowsByMoreIdWithOrder($table, $where, $column, $type)
{
	$ci = &get_instance();
	$select = $ci->db->order_by($column, $type)->get_where($table, $where);
	if ($select->num_rows() > 0) {
		return $select->result_array();
	} else {
		return false;
	}
}

function getDataByIdInOrder($table, $column, $id, $orderColumn, $type)
{
	$ci = &get_instance();
	$select = $ci->db->order_by($orderColumn, $type)->get_where($table, array($column => $id));
	return $select->result_array();
}

function getAllDataWithLimitInOrder($table, $orderColumn, $type, $start, $end)
{
	$ci = &get_instance();
	$select = $ci->db->order_by($orderColumn, $type)->limit($start, $end)->get($table);
	return $select->result_array();
}
function getDataByIdInOrderLimit($table, $column, $id, $orderColumn, $type, $start, $end)
{
	$ci = &get_instance();
	$select = $ci->db->order_by($orderColumn, $type)->limit($start, $end)->get_where($table, array($column => $id));
	return $select->result_array();
}

function getRowByMoreId($table, $where)
{
	$ci = &get_instance();
	$get = $ci->db->select()
		->from($table)
		->where($where)
		->get();
	if ($get->num_rows() > 0) {
		return $get->result_array();
	} else {
		return false;
	}
}

function getNumRows($table, $where)
{
	$ci = &get_instance();
	$get = $ci->db->select()
		->from($table)
		->where($where)
		->get();
	return $get->num_rows();
}

function getRowByLikeInOrder($table, $where, $like, $name, $orderBy, $orderType)
{
	$ci = &get_instance();
	$get = $ci->db->select()
		->from($table)
		->where($where)
		->like($like, $name, 'both')
		->order_by($orderBy, $orderType)
		->get();
	if ($get->num_rows() > 0) {
		return $get->result_array();
	} else {
		return false;
	}
}


function lastReplace($search, $replace, $subject)
{
	$pos = strrpos($subject, $search);
	if ($pos !== false) {
		$subject = substr_replace($subject, $replace, $pos, strlen($search));
	}
	return $subject;
}

function flashData($var, $message)
{
	$ci = &get_instance();
	return $ci->session->set_flashdata($var, $message);
}

function sendOTP($contact_no, $message_content)
{
	$url = "http://mysmsshop.in/V2/http-api.php?apikey=aYR5fktJhboWNydD&senderid=UDHYME&number=$contact_no&message=" . urlencode($message_content) . "&format=json";
	$res = curl_init();
	curl_setopt($res, CURLOPT_URL, $url);
	curl_setopt($res, CURLOPT_RETURNTRANSFER, true);
	$result1 = curl_exec($res);
}

function getUserId($token)
{
	$ci = &get_instance();
	$ip = $ci->input->ip_address();
	$get = $ci->db->select()
		->from('user_registration')
		->where("user_registration.user_id = '" . $token['data']->id . "' AND user_status = '1' AND unique_hash = '" . $token['data']->unique_hash . "'")
		->get();
	if ($get->num_rows() > 0) {
		return $token['data']->id;
	} else {
		return false;
	}
}


function orderIdGenerateUser()
{
	$number = 'ORD' . date('ydmhis');
	if (checkOrderIdExistUser($number)) {
		orderIdGenerateUser();
	}
	return $number;
}

function checkOrderIdExistUser($number)
{
	$ci = &get_instance();
	$get = $ci->db->select()
		->from('book_product')
		->where("order_id = '$number'")
		->get();
	if ($get->num_rows() > 0) {
		return true;
	} else {
		return false;
	}
}

function setImage($image_nm, $location)
{
	if ($image_nm != '') {
		if (file_exists(FCPATH . $location . $image_nm)) {
			return base_url() . $location . $image_nm;
		} else {
			return base_url() . 'uploads/default.jpg' ;
		}
	} else {
		return base_url() . 'uploads/default.jpg' ;
	}
}
function imageUpload($imageName, $path)
{
	$ci = &get_instance();
	$config['file_name'] = date('dm') . round(microtime(true) * 1000);
	$config['allowed_types'] = 'jpg|png|jpeg|pdf|PNG';
	$config['upload_path'] = $path;
	$target_path = $path;
	$config['remove_spaces'] = true;
	$config['overwrite'] = false;
	$ci->load->library('upload', $config);
	$ci->upload->initialize($config);
	if ($ci->upload->do_upload($imageName)) {
		$data = array('upload_data' => $ci->upload->data());
		$path = $data['upload_data']['full_path'];
		$picture = $data['upload_data']['file_name'];
		$configi['image_library'] = 'gd2';
		$config['quality'] = '50%';
		$config['create_thumb'] = FALSE;
		$configi['source_image'] = $path;
		$configi['new_image'] = $target_path;
		$configi['maintain_ratio'] = TRUE;
		$configi['width'] = 380;
		$configi['height'] = 260;
		$ci->load->library('image_lib');
		$ci->image_lib->initialize($configi);
		$ci->image_lib->resize();
		return $picture;
	} else {
		return false;
	}
}

function videoUpload($imageName, $path)
{
	$ci = &get_instance();
	$config['file_name'] = date('dm') . round(microtime(true) * 1000);
	$config['allowed_types'] = 'mp4';
	$config['upload_path'] = $path;
	$target_path = $path;
	$config['remove_spaces'] = true;
	$config['overwrite'] = false;
	$ci->load->library('upload', $config);
	$ci->upload->initialize($config);
	if ($ci->upload->do_upload($imageName)) {
		$data = array('upload_data' => $ci->upload->data());
		$path = $data['upload_data']['full_path'];
		$picture = $data['upload_data']['file_name'];
		// $configi['image_library'] = 'gd2';
		// $config['quality'] = '50%';
		// $config['create_thumb'] = FALSE;
		// $configi['source_image'] = $path;
		// $configi['new_image'] = $target_path;
		// $configi['maintain_ratio'] = TRUE;
		// $configi['width'] = 380;
		// $configi['height'] = 260;
		// $ci->load->library('image_lib');
		// $ci->image_lib->initialize($configi);
		// $ci->image_lib->resize();
		return $picture;
	} else {
		return false;
	}
}

function imageUploadWithRatio($imageName, $path, $width, $height)
{
	$ci = &get_instance();
	$config['file_name'] = date('dm') . round(microtime(true) * 1000);
	$config['allowed_types'] = 'jpg|png|jpeg|pdf|PNG';
	$config['upload_path'] = $path;
	$target_path = $path;
	$config['remove_spaces'] = true;
	$config['overwrite'] = false;
	$ci->load->library('upload', $config);
	$ci->upload->initialize($config);
	if ($ci->upload->do_upload($imageName)) {
		$data = array('upload_data' => $ci->upload->data());
		$path = $data['upload_data']['full_path'];
		$picture = $data['upload_data']['file_name'];
		$configi['image_library'] = 'gd2';
		$config['quality'] = '100%';
		$config['create_thumb'] = FALSE;
		$configi['source_image'] = $path;
		$configi['new_image'] = $target_path;
		$configi['maintain_ratio'] = TRUE;
		$configi['width'] = $width;
		$configi['height'] = $height;
		$ci->load->library('image_lib');
		$ci->image_lib->initialize($configi);
		$ci->image_lib->resize();
		return $picture;
	} else {
		return false;
	}
}

function fullImage($imageName, $path)
{
	$ci = &get_instance();
	$config['file_name'] = date('dm') . round(microtime(true) * 1000);
	$config['allowed_types'] = 'jpg|png|jpeg|pdf|PNG';
	$config['upload_path'] = $path;
	$target_path = $path;
	$config['remove_spaces'] = true;
	$config['overwrite'] = false;
	$ci->load->library('upload', $config);
	$ci->upload->initialize($config);
	if ($ci->upload->do_upload($imageName)) {
		$data = array('upload_data' => $ci->upload->data());
		$path = $data['upload_data']['full_path'];
		$picture = $data['upload_data']['file_name'];
		$configi['image_library'] = 'gd2';
		$config['quality'] = '100%';
		$config['create_thumb'] = FALSE;
		$configi['source_image'] = $path;
		$configi['new_image'] = $target_path;
		$configi['maintain_ratio'] = TRUE;
		$ci->load->library('image_lib');
		$ci->image_lib->initialize($configi);
		$ci->image_lib->resize();
		return $picture;
	} else {
		return false;
	}
}

function sendNotificationUser($device_id, $title, $message)
{
	$url = 'https://fcm.googleapis.com/fcm/send';

	define('API_KEY', 'AAAA0k59dxI:APA91bGS22p4m1y4OUeTSAjMQv4YcKQjVaBNjgTiuScqtE_S2b813j-Nq_slYfD9zcGFFwsDMUxf17TPKp5L94MFhvvlbz8tITzKPNFzVHy9Hupm89pZevttM8U4EGWCBBwUHidjzybE');

	$data = array("to" => $device_id, "notification" => array("title" => $title, "body" => $message));
	$data_string = json_encode($data);
	$headers = array('Authorization: key=' . API_KEY, 'Content-Type: application/json');
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
	$results = curl_exec($ch);
	curl_close($ch);
	return $results;
}

// function sendEmail($mail, $order)
// {

// 	$ci = &get_instance();
// 	$ci->email->from('webangeltechnologies@gmail.com', 'Srimitra');
// 	$ci->email->to($mail);

// 	$ci->email->subject('Srimitra India');
// 	$ci->email->message(order_mail($order));
// 	// print_R(order_mail($order));
// 	$send =  $ci->email->send();
// }



function sendmail($to, $subject, $message)
{

	require 'php/class/class.phpmailer.php';
	$mail = new PHPMailer;
	$mail->IsSMTP();
	$mail->Host = 'mail.srimitraindia.com';
	$mail->Port = '587';
	$mail->SMTPAuth = true;
	$mail->Username = 'info@srimitraindia.com';
	$mail->Password = "?}4@;97P}o2T";
	$mail->SMTPSecure = '';
	$mail->From = 'info@srimitraindia.com';
	$mail->FromName = 'Srimitra';
	$mail->AddAddress($to);
	$mail->WordWrap = 50;
	$mail->IsHTML(true);
	$mail->Subject = $subject;
	$mail->Body = $message;
// 		print_R($mail);
	if ($mail->Send()) {
		return true;
	} else {
		return false;
	}


	// Always set content-type when sending HTML email
// 	$headers = "MIME-Version: 1.0" . "\r\n";
// 	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// 	// More headers
// 	$headers .= 'From: webangelte
// 	chnologies@gmail.com' . "\r\n";
// 	$headers .= 'Cc: ' . $to . "\r\n";

// 	$send = mail($to, $subject, $message, $headers);
// 	return $send;

	// 	$ci = &get_instance();

	// // 	$ci->email->protocol('smtp');
	// // 	$ci->email->smtp_host('mail.srimitraindia.com');
	// // 	$ci->email->smtp_user('info@srimitraindia.com');
	// // 	$ci->email->smtp_pass('?}4@;97P}o2T');
	// // 	$ci->email->smtp_port('465');
	// // 	$ci->email->smtp_keepalive(TRUE);
	// // 	$ci->email->smtp_crypto('ssl');
	// // 	$ci->email->mailtype('html');
	// // 	$ci->email->priority('2');

	// 	$ci->email->from('info@srimitraindia.com', 'Srimitra');
	// 	$ci->email->to($to);
	// // 	$ci->email->cc($to);
	// // 	$ci->email->bcc($to);

	// 	$ci->email->subject($subject);
	// 	$ci->email->message($message);

	// 	$ci->email->send();
	// 	print_r($ci->email);
}

function sendWhatsapp($contact_no, $message_content)
{

	$contact_no = (strlen($contact_no) == 10) ? '91' . $contact_no : $contact_no;
	$url = "http://mblaster.in/api/send.php?number=" . $contact_no . "&type=text&message=" . urlencode($message_content) . "&instance_id=62F7453162AF1&access_token=afbad9fe6b41d044771422848e85f618";
	// 	echo $url;
	// 	$res = curl_init(); 
	// 	curl_setopt($res, CURLOPT_URL, $url);  
	// 	curl_setopt($res, CURLOPT_RETURNTRANSFER, true);
	// 	$result1 = curl_exec($res); 
	// 	print_r($result1);

	$file = file_get_contents($url);
	return $file;
	// echo '<pre>';
	// print_r($file);
	// exit;
}
function group_by_array($array, $key)
{
	$return = array();
	foreach ($array as $val) {
		$return[$val[$key]][] = $val;
	}
	return $return;
}
