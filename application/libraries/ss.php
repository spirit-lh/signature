<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ss{
    public $logged_in = FALSE;

    public function  __construct() {
 		$this->ci = &get_instance();
        $this->is_logged_in();
//      $this->check();
    }

    public function is_logged_in()
    {
        $logged = $this->ci->session->userdata('data');
        $this->logged_in = ($logged) ? TRUE : FALSE;
    }

    public function getData()
    {
    	return $this->ci->session->userdata('data');
    }

    public function check()
    {
        $uri = $this->ci->uri->uri_string;
		
        if($uri != '' && $uri !='service/ServiceManage/scanning'){
            if(!$this->logged_in){
                header('Location: /');
                return;
            }
        }
    }
}

?>