<?php
defined('BASEPATH') or exit('No Direct script access allowed');

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials, true');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
	header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
	header('Access-Control-Allow-Headers: Content-Type');
	exit;
}


require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Api_user extends REST_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('User_Model');
	}

	//menampilkan data userget masukkan kodingnya situ.
	function user_get($id_user = "")
	{
		if ($id_user === "") {
			$user = $this->User_Model->get_user();
		} else {
			$user = $this->User_Model->get_user_id($id_user);
		}
		$this->response($user, 200);
	}

	function user_post()
	{
		// $this->response(['status'=>"OK"], 200);
		// var_dump($this->post("nama"));
		$user = [
			'nama' => $this->post('nama'),
			'email' => $this->post('email'),
			'password' => password_hash($this->post('password'), PASSWORD_DEFAULT),
			'nohp' => $this->post('no_hp')
		];
		$add = $this->User_Model->add_user($user);
		if ($add) {
			$this->response(["status" => "success !"], 200);
		} else {
			$this->response(["status" => "failed !"], 502);
		}
	}

	function user_put()
	{
		$id = $this->put('id');
		$data = array(
			'nama'		=> $this->put('nama'),
			'email'		=> $this->put('email'),
			'password'	=> password_hash($this->put('password'), PASSWORD_DEFAULT),
			'alamat'		=> $this->put('alamat'),
			'no_hp'		=> $this->put('no_hp')
		);
		$update = $this->User_Model->update_user($data, $id);
		if ($update) {
			$this->response($update, "200");
		} else {
			$this->response(["status" => "failed"], 502);
		}
	}

	function user_delete()
	{
		$id = $this->delete('id');
		$delete = $this->User_Model->delete_user($id);

		if ($delete) {
			$this->response(array('status' => 'success'), 201);
		} else
			$this->response(array('status' => 'failed'), 502);
	}

	function login_post()
	{
		$data = array(
			'email'    => $this->post('email'),
			'password' => $this->post('password')
		);
		$login = $this->User_Model->login($data);
		if ($login) {
			return $this->response($login, 200);
		} else {
			return $this->response(["status" => "login failed !"], 200);
		}
	}
}
