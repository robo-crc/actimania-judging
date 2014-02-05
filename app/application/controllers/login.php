<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

/**
 *  Controls logging in and out
 */
class Login extends CI_Controller {

	public function __construct() {
		// Enable profiling in this contoller's constructor
		parent::__construct();

		$this->load->helper('form');
		$this->load->helper('html');
		$this->lang->load('strings', 'english');
		$this->load->library('session');
		$this->load->model('main_model');
		$this->load->model('login_model');

	}

	/**
	 *    Show the login form
	 */
	public function index() {
		$data['component'] = "";
		$this->load->view('head', $data);
		$this->load->view('login_form');
		$this->load->view('foot');
	}

	/***
	 * The controller that received POSTed login_form
	 */
	public function authenticate() {
		if ($this->login_model->login()) {
			redirect('/judge');
		} else {
			redirect('/login');
		}
	}

	/***
	 * Logs out
	 */
	public function logout() {
		$this->login_model->logout();
		redirect("/");
	}

	/***
	 * Creates new users with a slightly more user-friendly interface
	 * @param string $key Authenticaiton key for creating new users
	 */
	public function create($key = null) {
		if ($key !== "") {
			// do it
		} else {
			// Not allowed
		}
	}

}
