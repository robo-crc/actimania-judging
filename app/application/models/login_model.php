<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Login_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	public function login() {

		$this->db->where('email', $this->input->post('login_email'));
		$this->db->where('pin', $this->input->post('login_pin'));
		$this->db->where('state', 0); // 0 = enabled

		$user_query = $this->db->get('users');

		// Let's check if there are any results
		if($user_query->num_rows == 1)
		{
			$row = $user_query->row();
			$data = array (
				'lang' => $row->lang,
				'validated' => true,
				'user_role' => $row->role,
				'judge_id' => $row->id,
				'email' => $row->email,
				'first_name' => $row->firstname,
				'last_name' => $row->lastname,
			);
			$this->session->set_userdata($data);
			return true;
		}

		// If the previous process did not validate
		// then return false.
		return false;
	}

	public function logout() {
		$this->session->sess_destroy();
	}


	public function validate_by_url() {

	}

}