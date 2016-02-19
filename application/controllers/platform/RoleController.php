<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RoleController extends CI_Controller {
	 
	public function __construct()
	{
	    parent::__construct();
		$this->load->model('platform/FunctionTree');
		$this->load->library('ss');
	}
	
	public function index()
	{
		
	}

	public function role()
	{
		$baseUrl = $this->config->item('base_url');
		$data['baseUrl'] = $baseUrl;
		
		$this->load->view('platform/role', $data);
	}
	
	public function getRoleTree()
	{
		$data = $this->FunctionTree->getRoleTree();
		echo json_encode($data);
	}
}