<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
	{
	    parent::__construct();
		$this->load->model('WelcomeModel');
	}

	public function index()
	{
		$baseUrl = $this->config->item('base_url');
		$data['baseUrl'] = $baseUrl;
		$data['error'] = '';

		$this->load->view('index', $data);
	}

}
