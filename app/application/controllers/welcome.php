<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Welcome extends CI_Controller {

	public function index() {
		$this->load->helper('html');

		// We don't yet have session data and have to choose a language.
		$this->lang->load('strings', 'english');
		//$this->lang->load('strings', 'french');

		$data['component'] = "Main";
		$this->load->view('head', $data);
		$this->load->view('welcome_message');
		$this->load->view('foot');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */