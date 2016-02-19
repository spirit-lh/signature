<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class FunctionTree extends CI_Model {

    public function __construct()
    {
		$this->load->library('ss');
        parent::__construct();
    }


    public function getRoleTree()
    {
    	$sessionData = $this->ss->getData();
    	$roleid = $sessionData['roleid'];
    	
    	$result = array();
    	$queryData = array();

    	$sql = "";
    	$sql .= " SELECT b.*  FROM  t_bj_roletree a, t_bj_functiontree b";
    	$sql .= " WHERE a.c_roleid =".$roleid;
    	$sql .= " and a.c_treenodeid = b.c_id";

    	$query = $this->db->query($sql);

		foreach ($query->result() as $row)
		{
			array_push($queryData, array(
					"id" => $row->c_id,
					"text" => $row->c_name,
					'parentid' => $row->c_parentid
			));
		}

		$result = array(
			'children' => $this->tree($queryData, 0)
		);

		return $result;
    }

    public function getFunctionTree()
    {		
		$jsonArray = array();
		$query = $this->db->query("SELECT * FROM t_bj_functiontree order by c_nodeorder");

		$tempA = array();
		foreach ($query->result() as $row)
		{
			array_push($tempA, array(
					"id" => $row->c_id,
					"text" => $row->c_name,
					'parentid' => $row->c_parentid
			));
		}

		$jsonArray = array(
			'children' => $this->tree($tempA, 0)
		);

        return $jsonArray;
    }

	private function tree($table,$p_id) {
	    $tree = array();
	    foreach($table as $row){
	        if($row['parentid'] == $p_id){
	            $tmp = $this->tree($table,$row['id']);
	            if($tmp){
	                $row['children']=$tmp;
	                //$row['leaf'] = true;
	            }else{
	                $row['leaf'] = true;
	            }
	            $tree[]=$row;
	        }
	    }
	    Return $tree;
	}
	
}