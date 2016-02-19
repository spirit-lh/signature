<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends CI_Controller {

	public function __construct()
	{
	    parent::__construct();
		$this->load->model('WelcomeModel');
	}

	public function index()
	{
		#1)
		$userid = $_POST['userid'];
		$password = md5($_POST['password']);
		#2)
		$baseUrl = $this->config->item('base_url');
		$result = $this->WelcomeModel->login($userid, $password);
		#3)
		$data['baseUrl'] = $baseUrl;
		$data['error'] = '';
		#4)
		if(empty($result))
		{
			$data['error'] = 'sorry';
			$this->indexPage($data);
		}
		else
		{
			/*
			$customer_session_config = array(                        
			    'sess_cookie_name' => 'customer_session_config',
		     	'sess_expiration' => 3600);
			$this->load->library('session', $customer_session_config, 'customer_session');
			*/
			
			$sessionData = array(
           		'status' => 'OK',
           		'data' => $result
			);
   			$this->session->set_userdata($sessionData);
			$this->mainPage($data);
		}
	}

	public function logout()
	{

		$baseUrl = $this->config->item('base_url');
		$data['baseUrl'] = $baseUrl;
		$data['error'] = '';

        $sessionData = array(
           		'status' => '',
           		'data' => array()
		);
        $this->session->unset_userdata('status');
        $this->session->unset_userdata('data');
        $this->indexPage($data);
	}

	private function mainPage($data)
	{
		//var_dump($this->session->userdata('data'));
		header('Location: /index.php/platform/FrameworkController');
	}

	private function indexPage($data)
	{
		header('Location: /');
	}
}
