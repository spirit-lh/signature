<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FunctionTreeController extends CI_Controller {
	 
	public function __construct()
	{
	    parent::__construct();
		$this->load->model('platform/FunctionTree');
		$this->load->library('ss');
	}
		
	public function functiontree()
	{
		$baseUrl = $this->config->item('base_url');
		$data['baseUrl'] = $baseUrl;
		
		$this->load->view('platform/functiontree', $data);
	}

	public function test()
	{
		$data = $this->FunctionTree->getFunctionTree();
		echo json_encode($data);
	}
}