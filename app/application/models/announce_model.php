<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Announce_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	/**
	 * @return bool
	 */
	public function get_judges() {
		$this->db->select('email, firstname, lastname, pin');
		$this->db->where('id >= 10'); // Admins < 10
		$this->db->where('state', 0); // Not suspended
		$people = $this->db->get('users')->result_array();

		return (array_key_exists(0, $people)) ? $people : false;
	}

	/**
	 * @return bool
	 */
	public function get_admins() {
		$this->db->select('email, firstname, lastname');
		$this->db->where('id', '< 10');
		$this->db->where('state', '1');
		$people = $this->db->get('users')->result_array();

		// Let's check if there are any results
		return ($people->num_rows > 0) ? $people : false;
	}

}