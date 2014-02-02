<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Submit extends CI_Controller {

	protected $data = Array();

	public function __construct() {
		parent::__construct();

		if ($this->session->userdata('judge_id') == 0 || $this->session->userdata('judge_id') == 1) {
			$this->output->enable_profiler(TRUE);
		}

		$this->load->model('main_model');

		// Set session data
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

	/***
	 * Welcome message
	 */
	public function index() {
		redirect('welcome');
	}

	/**
	 * @param null $component web, journalism, video
	 */
	public function overall($component = null) {

		$this->data['component'] = $component;
		$this->load->view('head', $this->data);

		if ($this->main_model->put_overall($component, $this->input->post(), $this->data['judge_id'])) {
			$this->load->view('submit_confirm', $this->data);
		} else {
			$this->load->view('submit_error', $this->data);
		}

		$this->load->view('foot');
	}

	public function video() {
		$this->load->view('head');

		if ($this->main_model->put_video_rubric($this->input->post())) {
			$this->load->view('submit_confirm', $this->data);
		} else {
			$this->load->view('submit_error', $this->data);
		}
	}

	public function web() {
		$this->data['component'] = "Web";
		$this->load->view('head', $this->data);

		if ($this->main_model->put_web_rubric($this->input->post())) {
			$this->load->view('submit_confirm', $this->data);
		} else {
			$this->load->view('submit_error', $this->data);
		}
	}

	public function journalism() {
		$this->load->view('head');

		if ($this->main_model->put_journalism_rubric($this->input->post())) {
			$this->load->view('submit_confirm', $this->data);
		} else {
			$this->load->view('submit_error', $this->data);
		}
	}
}
