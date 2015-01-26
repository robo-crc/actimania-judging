<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Main_model extends CI_Model {

	function __construct() {
		parent::__construct();

	}

	/***
	 * Get a list of all schools
	 *
	 * @return array
	 */
	public function get_school_list() {

		$schools = array();
		foreach ($this->db->get('schools')->result() as $row) {
			$schools[$row->id] = $row->name;
		}

		return $schools;
	}

	public function get_rubric_values($component = null, $judge_id = null, $school_id = null) {
		// Web, Journalism and Video have different rubric values
		switch ($component) {
			case "video":
				$this->db->select('1, 2, 3, 4, 5, 6, 7, comments');
				break;
			case "journalism":
				$this->db->select('1, 2, 3, 4, 5, 6, 7, comments');
				break;
			case "web":
				$this->db->select('1, 2, 3, 4, 5, 6, comments');
				break;
			default:
				return true;
		}

		$this->db->where('judge_id', $judge_id);
		$this->db->where('school_id', $school_id);
		$this->db->limit(1);

		$result = $this->db->get($component . "_rubric")->result_array();
		return (isset($result[0])) ? $result[0] : false;
	}

	public function get_rubric_matrix($component = null, $judge_id = null) {
		// Web, Journalism and Video have different rubric values
		switch ($component) {
			case "video":
				$this->db->select('schools.id, schools.name, schools.video AS url, 1, 2, 3, 4, 5, 6, 7, comments');
				break;
			case "journalism":
				$this->db->select('schools.id, schools.name,schools.journalism AS url, 1, 2, 3, 4, 5, 6, 7, comments');
				break;
			case "web":
				$this->db->select('schools.id, schools.name, schools.web AS url, 1, 2, 3, 4, 5, 6, comments');
				break;
			default:
				return true;
		}

		$this->db->where('judge_id', $judge_id);
		$this->db->join('schools', 'schools.id = ' . $component . '_rubric.school_id');
		$this->db->order_by('total', 'DESC');

		return $this->db->get($component . "_rubric")->result_array();
	}

	public function get_missing_rubric($component = null, $judge_id = null) {
		$this->db->where("schools." . $component . " != ", '""', false);
		$this->db->where("id NOT IN (select school_id from " . $component . "_rubric where judge_id = " . $judge_id . ")");
		return $this->db->get('schools')->result_array();
	}

	/***
	 * Returns a list of schools for a given component [web|video] (journalism uses web)
	 *
	 * @param string $component
	 * @return array
	 */
	public function get_eligible_school_list($component = null, $judge_id = null) {
		$schools = array();
		$this->db->where("schools." . $component . " != ", '""', false);
		$this->db->where("id NOT IN (select school_id from " . $component . "_rubric where judge_id = " . $judge_id . ")");

		foreach ($this->db->get('schools')->result() as $row) {
			$schools[$row->id] = $row->name;
		}

		return $schools;
	}

	/***
	 * Get the component url of a school's entry.
	 *
	 * @param array $component
	 * @param int $school_id
	 * @return mixed
	 */
	public function get_component_url($component = null, $school_id = null) {
		$this->db->select($component);
		$this->db->where('id', $school_id);

		$schools = $this->db->get('schools')->result();
		return (array_key_exists(0, $schools)) ? $schools[0]->$component : null;
		//return $this->db->get('schools')->result()[0]->$component;
	}

	/***
	 * @param null $school_id
	 * @return mixed
	 */
	public function get_school_name($school_id = null) {
		$this->db->select('name');
		$name = $this->db->get_where('schools', array('id' => $school_id))->result();
		return (array_key_exists(0, $name)) ? $name[0]->name : null;
	}

	/***
	 * @param null $school_id
	 * @param null $judge_id
	 * @param null $component
	 * @return int
	 */
	public function check_existing_judge_submission($school_id = null, $judge_id = null, $component = null) {

		$this->db->from($component . '_rubric');
		$this->db->where(array(
			'judge_id' => $judge_id,
			'school_id' => $school_id
		));

		return ($this->db->count_all_results() > 0) ? true : false;
	}


	/***
	 * @param array $post
	 * @return mixed
	 */
	public function put_video_rubric($post = null) {
		$values = Array();
		$values['school_id'] = $post['school'];
		$values['judge_id'] = $post['judge_id'];
		$values['comments'] = $post['comment'];
		$values['total'] = null;

		array_key_exists('axis-1', $post) != null ? $values['1'] = 'true' : $values['1'] = 'false';
		for ($i = 2; $i <= 7; $i++) {
			$values[$i] = $post['axis-' . $i];
			$values['total'] += $post['axis-' . $i];
		}

		return $this->db->insert('video_rubric', $values);
	}

	/***
	 * @param array $post
	 * @return bool
	 */
	public function put_web_rubric($post = null) {
		$values = Array();
		$values['school_id'] = $post['school'];
		$values['judge_id'] = $post['judge_id'];
		$values['comments'] = $post['comment'];
		$values['total'] = null;

		array_key_exists('axis-6', $post) != null ? $values['6'] = 'true' : $values['6'] = 'false';
		for ($i = 1; $i <= 5; $i++) {
			$values[$i] = $post['axis-' . $i];
			$values['total'] += $post['axis-' . $i];
		}

		return $this->db->insert('web_rubric', $values);
	}

	/***
	 * @param array $post
	 * @return bool
	 */
	public function put_journalism_rubric($post = null) {
		$values = Array();
		$values['school_id'] = $post['school'];
		$values['judge_id'] = $post['judge_id'];
		$values['comments'] = $post['comment'];
		$values['total'] = null;

		array_key_exists('axis-1', $post) != null ? $values['1'] = 'true' : $values['1'] = 'false';
		for ($i = 2; $i <= 7; $i++) {
			$values[$i] = $post['axis-' . $i];
			$values['total'] += $post['axis-' . $i];
		}

		return $this->db->insert('journalism_rubric', $values);
	}


	/***
	 * @param string $component
	 * @param array $post
	 * @param int $judge_id
	 * @return bool
	 */
	public function put_overall($component = null, $post = null, $judge_id = null) {
		print $component . "<br /><br />";
		$values = Array();
		$insert = Array();

		// The array index is the rank, the value is the school_id, array[0] = 1st place.
		$values = explode(',', $post['sort_order']);

		// Count through the array and assign a rank-weighted value to the school
		for ($i = 0; $i <= count($values) - 1; $i++) {
			$insert[] = array(
				'id' => null,
				'school_id' => $values[$i],
				'judge_id' => $judge_id,
				'component' => $component,
				'score' => count($values) - $i,
			);
		}

		return $this->db->insert_batch('overall', $insert);
	}

	/***
	 * @param string $component
	 * @return array
	 */
	public function get_overall($component = null) {
		$results = Array();
		$count = count($this->get_school_list());

		for ($i = 1; $i <= $count; $i++) {
			$this->db->select_sum('overall.score');
			$this->db->select('schools.name');
			$this->db->where('overall.component', $component);
			$this->db->where('overall.school_id', $i);
			$this->db->join('schools', 'overall.school_id = schools.id', 'inner');
			$overall = $this->db->get('overall')->result();
			if (array_key_exists(0, $overall)) {
				$results[$i] = $overall[0];
			}
		}

		arsort($results);
		return $results;
	}

	/**
	 * @param null $component (video or journalism)
	 * @return array
	 */
	public function get_flags($component = null) {
		$flags = Array();

		$this->db->select('schools.name');
		$this->db->where('1', 'false');
		$this->db->join('schools', $component . '_rubric.school_id = schools.id', 'inner');
		$this->db->order_by('schools.name', 'ASC');
		$flagged = $this->db->get($component . '_rubric')->result_array();
		if (array_key_exists(0, $flagged)) {
			foreach ($flagged as $item) {
				$flags[] = $item['name'];
			}
		}
		return array_key_exists(0, $flags) ? $flags : false;
	}

	/**
	 * @return mixed
	 */
	public function get_judges_done() {

		$this->db->select('users.firstname, users.lastname');
		$this->db->join('users', 'overall.judge_id = users.id', 'inner');
		$this->db->where('score', '1');

		return $this->db->get('overall')->result_array();

	}


	/**
	 * @param null $component
	 * @param null $school_id
	 * @return bool
	 */
	public function get_school_matrix($component = null, $school_id = null, $result_key = null) {
		// Web, Journalism and Video have different rubric values
		switch ($component) {
			case "video":
				$this->db->select('schools.name, 1, 2, 3, 4, 5, 6, 7, comments');
				break;
			case "journalism":
				$this->db->select('schools.name, 1, 2, 3, 4, 5, 6, 7, comments');
				break;
			case "web":
				$this->db->select('schools.name, 1, 2, 3, 4, 5, comments');
				break;
			default:
				return true;
		}
		$this->db->where('school_id', $school_id);
		$this->db->where('result_key', $result_key);
		$this->db->join('schools', 'schools.id = ' . $component . '_rubric.school_id');

		return $this->db->get($component . "_rubric")->result_array();
	}

}
