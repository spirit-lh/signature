<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class WelcomeModel extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function login($userid, $password)
    {		
    	$result = array();

    	$sql = "";
    	$sql .= " SELECT a.c_id AS userid, a.c_name AS username, c.c_id AS roleid, c.c_name AS rolename, c.c_roletype AS roletype";
		$sql .= " FROM t_bj_user a, t_bj_userrole b, t_bj_role c";
		$sql .= " WHERE a.c_name =  '".$userid."'";
		$sql .= " AND a.c_password =  '".$password."'";
		$sql .= " AND a.c_status =1";
		$sql .= " AND a.c_id = b.c_userid";
		$sql .= " AND b.c_roleid = c.c_id";

		$query = $this->db->query($sql);

		if ($query->num_rows() > 0)
		{
			$row = $query->row_array();

			$result = array(
				'userid' 	=> $row['userid'],
				'username' 	=> $row['username'],
				'roleid' 	=> $row['roleid'],
				'rolename' 	=> $row['rolename'],
				'roletype' 	=> $row['roletype'],
			);
		}

        return $result;
    }

}