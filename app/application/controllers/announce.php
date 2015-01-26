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

		// Only root can announce.
		if ($this->session->userdata('judge_id') != 0 || $this->session->userdata('judge_id') != 1) {
			header('HTTP/1.0 403 Forbidden');
		}

		$judges = $this->announce_model->get_judges();

		foreach ($judges as $judge) {
			$this->email->clear();

			$this->email->from($this->from_address, $this->from_name);
			$this->email->reply_to($this->reply_to, $this->from_name);
			$this->email->to($judge['email']);
			$this->email->subject("CRC Robotics Judging Application");

			$message = 'Hello ' . $judge['firstname'] . ",\n";
			$message .= "Thank you for agreeing to be a judge for the CRC Robotics Actimania 2015 competiton!\n\n";

			$message .= "Before judging, please consult the rule book so that you may understand specifically \n";
			$message .= "what we have asked of the students. It is available in English and French here:\n http://www.robo-crc.ca/en/actimania-official-rulebook/\n\n";

			$message .= "Video judges: the intro sequence doesn't count toward the total time limit for the video.\n\n";

			$message .= 'You may connect to the site at ' . $this->url . ' with this email address and your PIN: ' . $judge['pin'] . "\n\n";

			$message .= "If you have any questions, simply reply to this email and I will do my best to help.\n\n";
			$message .= "Sincerely,\n";
			$message .= $this->from_name;

			$this->email->message($message);

			$this->email->send();

			echo $this->email->print_debugger();
		}
	}

	public function instructions() {
		// Authenticate the user
		if (!$this->session->userdata('validated')) {
			redirect('login');
		}

		// Only root can announce.
		if ($this->session->userdata('judge_id') != 0 || $this->session->userdata('judge_id') != 1) {
			header('HTTP/1.0 403 Forbidden');
		}

		$judges = $this->announce_model->get_judges();

		foreach ($judges as $judge) {
			$this->email->clear();

			$this->email->from($this->from_address, $this->from_name);
			$this->email->reply_to($this->reply_to, $this->from_name);
			$this->email->to($judge['email']);
			$this->email->subject("CRC Robotics Judging Instructions & Tips");

			$message = 'Hello ' . $judge['firstname'] . ",\n\n";
			$message .= "You are receiving this email because you have previously been a judge for the CRC\n";
			$message .= "robotics competition, and have expressed an interest in being included in future competitions.\n";
			$message .= "We value greatly your input and contribution, and thank you for your interest in this year's competition,\n";
			$message .= "CRC Robotics \nActimania 2015 !\n\n";

			$message .= "REMINDERS:\n";
			$message .= "- For a tutorial on how the judging system works: http://www.youtube.com/watch?v=B1o5f-Z2hOU \n\n";
			$message .= "- The individual judging forms you fill out, including comments, are visible\n";
			$message .= "  to students. They appreciate constructive feedback, so please don't be shy!\n\n";
			$message .= "- Check out the rule book's sections that you are judging: \n\n";
			$message .= "  In English here:\n http://www.robo-crc.ca/en/actimania-official-rulebook/\n\n";
			$message .= "  En français:\n http://www.robo-crc.ca/fr/actimania-official-rulebook/\n\n";

			$message .= "Video judges: the intro sequence doesn't count toward the total time limit for the video.\n\n";

			$message .= "Web/journalism judges: Montmorency has apparently password-protected part of their site with 'CRCMOMO_2014'.\n\n";

			$message .= "You may connect to the site at \n" . $this->url . " with this email address \n and your PIN: " . $judge['pin'] . "\n\n";

			$message .= "If you have any questions, simply reply to this email and I will do my best to help.\n\n";
			$message .= "Sincerely,\nMichael Sanford\nmichael@robo-crc.ca";

			$this->email->message($message);

			$this->email->send();

			echo $this->email->print_debugger();
		}
	}

	public function reminder() {
		// Authenticate the user
		if (!$this->session->userdata('validated')) {
			redirect('login');
		}

		// Only root can announce.
		if ($this->session->userdata('judge_id') != 0 || $this->session->userdata('judge_id') != 1) {
			header('HTTP/1.0 403 Forbidden');
		}

		$judges = $this->announce_model->get_judges();

		foreach ($judges as $judge) {
			$this->email->clear();

			$this->email->from($this->from_address, $this->from_name);
			$this->email->reply_to($this->reply_to, $this->from_name);
			$this->email->to($judge['email']);
			$this->email->subject("CRC Robotics Judging Reminder");

			$message = 'Hello ' . $judge['firstname'] . ",\n\n";
			$message .= "You are receiving this email because you are a judge for CRC Robotics \nActimania 2015\n";
			$message .= "robotics competition.\n\n";

			$message .= "This is a friendly reminder that we need your individual entries AND overall rankings by February 19th\n";
			$message .= "so that we can compile results in time for the competition.\n\n";

			$message .= "We can prolong judging up until Feb 21, if need be. But that's the *last possible* ";
			$message .= "day we have to work with.\n\n";

			$message .= "We value your contribution greatly and need all the judges we can get.\n\n";

//			$message .= "If you have already completed your individual and overall rankings, please accept our thanks\n";
//			$message .= "and disregard this message.\n\n";

			$message .= "REMINDERS:\n";
			$message .= "- For a tutorial on how the judging system works: http://www.youtube.com/watch?v=B1o5f-Z2hOU \n\n";
			$message .= "- The individual judging forms you fill out, including comments, are visible\n";
			$message .= "  to students. They appreciate constructive feedback, so please don't be shy!\n\n";
			$message .= "- Check out the rule book's sections that you are judging: \n\n";
			$message .= "  In English and French here:\n http://www.robo-crc.ca/en/actimania-official-rulebook/\n\n";

			$message .= "Video judges: the intro sequence doesn't count toward the total time limit for the video.\n\n";

			$message .= "Web/journalism judges: Montmorency has apparently password-protected part of their site with 'CRCMOMO_2014'.\n\n";

			$message .= "You may connect to the site at \n" . $this->url . " with this email address \n and your PIN: " . $judge['pin'] . "\n\n";

			$message .= "If you have any questions, simply reply to this email and I will do my best to help.\n\n";
			$message .= "Sincerely,\nMichael Sanford\nmichael@robo-crc.ca";

			$this->email->message($message);

			$this->email->send();

			echo $this->email->print_debugger();
		}
	}

	public function thanks() {
		// Authenticate the user
		if (!$this->session->userdata('validated')) {
			redirect('login');
		}

		// Only root can announce.
		if ($this->session->userdata('judge_id') != 0 || $this->session->userdata('judge_id') != 1) {
			header('HTTP/1.0 403 Forbidden');
		}

		$judges = $this->announce_model->get_judges();

		foreach ($judges as $judge) {
			$this->email->clear();

			$this->email->from($this->from_address, $this->from_name);
			$this->email->reply_to($this->reply_to, $this->from_name);
			$this->email->to($judge['email']);
			$this->email->subject("Thank you from the CRC !");

			$message = 'Hello ' . $judge['firstname'] . ",\n\n";

			$message .= "You are receiving this email because you are a judge for CRC Robotics \nActimania 2015\n";
			$message .= "robotics competition.\n\n";

			$message .= "On behalf of all the CRC Committee Organizers and competing teams, we would like to";
			$message .= "extend a heartfelt thank you for contributing your time and effort to making this experience";
			$message .= "enjoyable and worthwhile for the competitors. Your valuable feedback will help them improve";
			$message .= "their entries for next year.\n\n";

			$message .= "By default, We will keep you on file for next year. If you would rather we not retain your";
			$message .= "information, simply reply to this email and let me know, and I'll remove you.\n\n";

			$message .= "Sincerely,\nMichael Sanford\nmichael@robo-crc.ca";

			$this->email->message($message);

			$this->email->send();

			echo $this->email->print_debugger();
		}
	}
}
