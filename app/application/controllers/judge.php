<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

/***
 * TODO Add link to video and web in overall rank page.
 *
 */

class Judge extends CI_Controller {

	protected $data = array();

	public function __construct() {
		// Honour thy ancestors
		parent::__construct();

		header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
		header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past

		$this->load->helper('form');
		$this->load->library('session');
		$this->load->model('main_model');
		$this->load->model('login_model');

		// Authenticate the user
		if (!$this->session->userdata('validated')) {
			redirect('login');
		}

		// Enable profiling during development
		if ($this->session->userdata('judge_id') == 0 || $this->session->userdata('judge_id') == 1) {
			$this->output->enable_profiler(TRUE);
		}

		//$this->user_data['lang'] = 'en';
		//$this->user_data['today'] = unix_to_human(time(), FALSE, 'eu');

		$this->data['judge_id'] = $this->session->userdata('judge_id');

		switch ($this->session->userdata('lang')) {
			case "en":
				$this->lang->load('strings', 'english');
				break;
			case "fr":
				$this->lang->load('strings', 'francais');
				break;
		}


	}

	public function __destruct() {
	}

	/***
	 * Welcome page
	 */
	public function index() {
		$this->data['web'] = $this->main_model->get_eligible_school_list('web', $this->data['judge_id']);
		$this->data['journalism'] = $this->main_model->get_eligible_school_list('journalism', $this->data['judge_id']);
		$this->data['video'] = $this->main_model->get_eligible_school_list('video', $this->data['judge_id']);
		$this->data['component'] = lang('page-header-judging-main');

		$this->load->view('head', $this->data);
		$this->load->view('judge_welcome', $this->data);
		$this->load->view('foot');
	}

	/***
	 * Web  overall or individual
	 * @param null $overall
	 */
	public function web($overall = null) {
		$this->data['component'] = "web";

		$this->load->view('head', $this->data);

		if ($overall == null) {
			$this->data['school_id'] = $this->input->post('school_id');
			$this->data['school_name'] = $this->main_model->get_school_name($this->data['school_id']);
			$this->data['school_url'] = $this->main_model->get_component_url($this->data['component'], $this->data['school_id']);

			if ($this->main_model->check_existing_judge_submission($this->data['school_id'], $this->data['judge_id'], $this->data['component'])) {
				$this->load->view('judged_already', $this->data);
			} else {
				$this->load->view('judge_web', $this->data);
			}

		} else {
			$this->data['rubric_matrix'] = $this->main_model->get_rubric_matrix($this->data['component'], $this->data['judge_id']);
			$this->data['missing'] = $this->main_model->get_missing_rubric($this->data['component'], $this->data['judge_id']);
			$this->load->view('judge_rank', $this->data);
		}

		$this->load->view('foot');
	}

	/***
	 * Journalism  overall or individual
	 * @param null $overall
	 */
	public function journalism($overall = null) {
		$this->data['component'] = "journalism";

		$this->load->view('head', $this->data);

		if ($overall == null) {
			$this->data['school_id'] = $this->input->post('school_id');
			$this->data['school_name'] = $this->main_model->get_school_name($this->data['school_id']);
			$this->data['school_url'] = $this->main_model->get_component_url($this->data['component'], $this->data['school_id']);

			if ($this->main_model->check_existing_judge_submission($this->data['school_id'], $this->data['judge_id'], $this->data['component'])) {
				$this->load->view('judged_already', $this->data);
			} else {
				$this->load->view('judge_component', $this->data);
			}

		} else {
			$this->data['rubric_matrix'] = $this->main_model->get_rubric_matrix($this->data['component'], $this->data['judge_id']);
			$this->data['missing'] = $this->main_model->get_missing_rubric($this->data['component'], $this->data['judge_id']);
			$this->load->view('judge_rank', $this->data);
		}

		$this->load->view('foot');
	}

	/***
	 * Video overall or individual
	 * @param null $overall
	 */
	public function video($overall = null) {
		$this->data['component'] = "video";

		$this->load->view('head', $this->data);

		if ($overall == null) {
			$this->data['school_id'] = $this->input->post('school_id');
			$this->data['school_name'] = $this->main_model->get_school_name($this->data['school_id']);
			$this->data['school_url'] = $this->main_model->get_component_url('video', $this->data['school_id']);

			if ($this->main_model->check_existing_judge_submission($this->data['school_id'], $this->data['judge_id'], $this->data['component'])) {
				$this->load->view('judged_already', $this->data);
			} else {
				$this->load->view('judge_component', $this->data);
			}

		} else {
			$this->data['rubric_matrix'] = $this->main_model->get_rubric_matrix($this->data['component'], $this->data['judge_id']);
			$this->data['missing'] = $this->main_model->get_missing_rubric($this->data['component'], $this->data['judge_id']);
			$this->load->view('judge_rank', $this->data);
		}

		$this->load->view('foot');
	}

	/***
	 * Kiosk overall
	 */
	public function kiosk() {
		$this->data['school_list'] = $this->main_model->get_school_list();

		$this->load->helper('html');
		$this->data['component'] = "kiosk";
		$this->load->view('head', $this->data);

		$this->load->view('judge_rank', $this->data);
		$this->load->view('foot');
	}

	/***
	 * Design overall
	 */
	public function design() {
		$this->data['school_list'] = $this->main_model->get_school_list();

		$this->data['component'] = "design";
		$this->load->view('head', $this->data);
		$this->load->view('judge_rank', $this->data);
		$this->load->view('foot');
	}

	/***
	 * Build overall
	 */
	public function build() {
		$this->data['school_list'] = $this->main_model->get_school_list();

		$this->data['component'] = "build";
		$this->load->view('head', $this->data);
		$this->load->view('judge_rank', $this->data);
		$this->load->view('foot');
	}

}