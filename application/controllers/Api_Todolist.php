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

class Api_Todolist extends REST_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('TodoList_Model');
	}

	function list_get($id)
	{
		$list = $this->TodoList_Model->get_list($id);
		$this->response($list, 200);
	}

	function list_post()
	{
		$data = [
			'list' => $this->post('list'),
			'tgl' => $this->post('date'),
			'id_user' => $this->post('id_user')
		];
		$add = $this->TodoList_Model->add_list($data);
		if ($add) {
			return $this->response(["status" => "add successfull"], 200);
		} else {
			return $this->response(["status" => "add failed"], 502);
		}
	}

	function list_delete()
	{
		$id = $this->delete('id_todolist');
		$delete = $this->TodoList_Model->remove_list($id);
		$this->response($delete, 200);
	}

	function list_put()
	{
		$id = $this->put('id_todolist');
		$data = [
			'status' => $this->put('status')
		];
		$edit = $this->TodoList_Model->edit_list($data, $id);
		if ($edit) {
			return $this->response(["status" => "edit successfull"], 200);
		} else {
			return $this->response(["status" => "edit failed"], 502);
		}
	}
}
