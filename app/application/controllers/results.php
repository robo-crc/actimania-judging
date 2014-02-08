<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Results extends CI_Controller {

	protected $data = Array();

	public function __construct() {
		parent::__construct();

        if ($this->session->userdata('judge_id') == 0 || $this->session->userdata('judge_id') == 1) $this->output->enable_profiler(TRUE);
        $this->output->enable_profiler(TRUE);

		$this->load->model('main_model');
		$this->load->library('table');

		// Set session data
		$this->data['judge_id'] = $this->session->userdata('judge_id');
		switch ($this->session->userdata('lang')) {
			case "en":
				$this->lang->load('strings', 'english');
				break;
			case "fr":
				$this->lang->load('strings', 'francais');
				break;
			default:
				$this->lang->load('strings', 'english');
		}
	}

	public function index() {
		$this->output->cache(20);
		$this->load->view('results_welcome');
	}

	public function web() {
		$data['component'] = "web";
		$data['schools'] = $this->main_model->get_overall('web');
		$data['flags'] = false;

		$this->load->view('head', $data);
		$this->load->view('rank_result', $data);
		$this->load->view('foot');
	}

	public function journalism() {
		$data['component'] = "journalism";
		$data['schools'] = $this->main_model->get_overall('journalism');
		$data['flags'] = $this->main_model->get_flags('journalism');

		$this->load->view('head', $data);
		$this->load->view('rank_result', $data);
		$this->load->view('foot');
	}

	public function video($mode = null) {
		$data['component'] = "video";
		$data['schools'] = $this->main_model->get_overall('video');
		$data['flags'] = $this->main_model->get_flags('video');

		switch ($mode) {
			case "csv":
				$this->load->helper('download');
				$this->load->helper('file');
				$this->load->dbutil();
				echo $this->dbutil->csv_from_result($data['schools']);
				break;
			case "xml":
				$this->load->helper('download');
				$this->load->helper('file');
				$this->load->dbutil();
				echo $this->dbutil->csv_from_result($data['schools']);
				break;
			default:
				$this->load->view('head', $data);
				$this->load->view('rank_result', $data);
				$this->load->view('foot');
				break;
		}

	}

	/**
	 *
	 */
	public function entries() {
		$this->db->select('name, video, web');
		$schools = $this->db->get('schools')->result_array();

		echo "<table><tbody>";
		foreach ($schools as $school) {
			// TODO Refactor so blanks don't go nowhere.
			echo sprintf('<tr><td>%s</td><td><a href="%s">Video</a></td><td><a href="%s">Web</a></td></tr>',
				($school['name'] === null ? "#" : $school['name']),
				($school['video'] === null ? "#" : $school['video']),
				($school['web'] === null ? "#" : $school['web'])
			);
		}
		echo "</tbody></table>";
	}

	public function team_report() {

		$data['school_id'] = $this->input->get('s');
		$data['component'] = $this->input->get('c');
		$data['points'] = $this->input->get('p');
		$data['rank'] = $this->input->get('r');

		$data['cards'] = $this->main_model->get_school_matrix($data['component'], $data['school_id']);

		$this->load->view('head');
		$this->load->view('team_report', $data);
		$this->load->view('foot');
	}

	public function done() {
		// Authenticate the user
		if (!$this->session->userdata('validated')) {
			redirect('login');
		}

		$result = $this->main_model->get_judges_done();
		if ($result) {
			echo "<ul>";
			foreach ($result as $judge) {
				echo sprintf('<li>%s %s</li>', $judge['firstname'], $judge['lastname']);
			}
			echo "</ul>";
		}
	}

}
