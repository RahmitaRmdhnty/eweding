<?php

class User_Model extends CI_Model{
	public function get_user(){
		return $this->db->order_by('nama', 'ASC')->get('user')->result();
	}

	public function get_user_id($id){
		return $this->db->order_by('nama', 'ASC')->where('id', $id)->get('user')->result();	
	}

	public function add_user($data){
		return $this->db->insert('user', $data);
	}

	function update_user($data, $id){
		$this->db->where('id', $id);
		return $this->db->update('user', $data);
	}

	function delete_user($id){
		return $this->db->delete('user', ["id"=>$id]);
	}

	function login($data){
		$email = $data['email'];
		$pass = $data['password'];

		$sql = $this->db->where('email', $email)->get('user');

		if($sql->num_rows()>0){
			$user = $sql->result();
			if(password_verify($pass, $user[0]->password)){
				return $user[0];
			}
			else{
				return false;
			}
		}
		else{
			return false;
		}
		
	}
}