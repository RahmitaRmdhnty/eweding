<?php

class TodoList_Model extends CI_Model
{
	function get_list($id)
	{
		$this->db->select('*');
		$this->db->from('todolist');
		$this->db->where('id_user', $id);
		$this->db->order_by('tgl', 'ASC');
		$this->db->join('user', 'user.id=todolist.id_user');
		return $this->db->get()->result();
	}

	function add_list($data)
	{
		var_dump($data);
		return $this->db->insert('todolist', $data);
	}

	function remove_list($id)
	{
		return $this->db->delete('todolist', ["id_todolist" => $id]);
	}

	function edit_list($data, $id)
	{
		$this->db->where('id_todolist', $id);

		return $this->db->update('todolist', $data);
	}
}
