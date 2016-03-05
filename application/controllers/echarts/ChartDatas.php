<?php
header("Content-type: text/html; charset=utf-8");
header('Access-Control-Allow-Origin:*');
header('Content-type: text/json');
/**
 * echarts 
 * @author lihe
 *
 */
class ChartDatas extends CI_Controller {
	public function __construct() {
		parent::__construct();
		//加载基础类库
		$this -> load -> library('session');
		$this->load->model('echarts/EchartsModel');
	}
	
	public function getMapDatas(){
		$re = $this->EchartsModel->map();
		echo json_encode($re);
	}
	
}