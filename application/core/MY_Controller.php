<?php

class MY_Controller extends CI_Controller {}

class CompilerHub extends CI_Controller {
	protected $_data = array(
		'site_name' => 'Cool Geeks', 
		'title' => '', 
		'author' => '', 
		'description' => '', 
		'user' => false, 
		'is_admin' => false,
		'nav' => 'product', 
		'errors' => [],
	);

	public function __construct() {
		parent::__construct();
		$this->_data['user'] = $this->user();
		$this->_data['is_admin'] = (isset($this->user()->permission) && $this->user()->permission == 1) ? true : false;
	}

	protected function template($view, $data = array()) {
		$this->_data = array_merge($this->_data, $data);

		$this->load->view('inc/header', $this->_data);
		$this->load->view('inc/navigation');
		$this->load->view($view);
		$this->load->view('inc/footer');
	}

	protected function user() {
		return $this->session->userdata('user') ? $this->session->userdata('user') : false;
	}

	protected function isAdmin() {
		return $this->_data['is_admin'];
	}

	protected function nav($nav = NULL) {
		$this->_data['nav'] = ($nav) ? strtolower($nav) : strtolower(debug_backtrace()[1]['function']);
		return $this->_data['nav'];
	}
}