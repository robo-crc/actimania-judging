<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Announce extends CI_Controller {

	/**
	 * @var string $from_address
	 * @var string $from_name
	 * @var string $reply_to Reply-to address
	 * @var string $url URL of the front page of the live application
	 */
	private $from_address = "michael@robo-crc.ca";
	private $from_name = "CRC Robotics Judging";
	private $reply_to = "michael@robo-crc.ca";
	private $url = "http://robotics.no-ip.ca";

	public function __construct() {
		parent::__construct();

		$this->load->helper('email');
		$this->load->library('email');
		$this->load->library('session');
		$this->lang->load('strings', 'english');
		$this->load->model('announce_model');

		// Enable profiling during development
		if ($this->session->userdata('judge_id') == 0 || $this->session->userdata('judge_id') == 1) {
			$this->output->enable_profiler(TRUE);
		}
	}

	/**
	 *
	 */
	public function index() {
		redirect('welcome');
	}

	/**
	 *  Sends emails to judges with their PIN and the URL of the judging app.
	 */
	public function judges() {
		// Authenticate the user
		if (!$this->session->userdata('validated')) {
			redirect('login');
		}
		if ($this->session->userdata('judge_id') != 0 || $this->session->userdata('judge_id') != 1) {
			header('HTTP/1.0 403 Forbidden');
		} // Only root can announce.

		$judges = $this->announce_model->get_judges();

		foreach ($judges as $judge) {
			$this->email->clear();

			$this->email->from($this->from_address, $this->from_name);
			$this->email->reply_to($this->reply_to, $this->from_name);
			$this->email->to($judge['email']);
			$this->email->subject("CRC Robotics Judging Application");

			$message = 'Hello ' . $judge['firstname'] . ",\n";
			$message .= "Thank you for agreeing to be a judge for the CRC Robotics Velistic 2013 competiton!\n\n";
			$message .= 'You may connect to the site at ' . $this->url . ' with this email address and your PIN: ' . $judge['pin'] . "\n\n";
			$message .= "If you have any questions, simply reply to this email and I will do my best to help.\n\n";
			$message .= "Sincerely,\n";
			$message .= $this->from_name;

			$this->email->message($message);

			$this->email->send();
			if ($this->session->userdata('judge_id') == 0 || $this->session->userdata('judge_id') == 1) {
				echo $this->email->print_debugger();
			}
		}
	}
}
