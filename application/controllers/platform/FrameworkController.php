<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FrameworkController extends CI_Controller {
	 
	public function __construct()
	{
	    parent::__construct();
		$this->load->model('platform/FunctionTree');
		$this->load->library('ss');
	}
	
	public function index()
	{
		//var_dump($this->session->userdata('data'));
		$baseUrl = $this->config->item('base_url');
		$data['baseUrl'] = $baseUrl;
		
		$this->load->view('platform/frameworkMainPage', $data);
	}
	
	public function grid()
	{
		$baseUrl = $this->config->item('base_url');
		$data['baseUrl'] = $baseUrl;
		
		$this->load->view('platform/grid', $data);
	}
	
}