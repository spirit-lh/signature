<?php
class EchartsModel extends CI_Model {
	/*
	 * 构造器
	 */
	public function __construct() {
		$this->load->database ();
	}
	
	public function map(){
		$query = $this -> db -> query('select province as name,  gdp as value from echarts_map');
		return $query-> result();
	}
}