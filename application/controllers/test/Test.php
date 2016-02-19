<?php
header("Content-type: text/html; charset=utf-8");
header('Access-Control-Allow-Origin:*');
header('Content-type: text/json');
class  Test extends CI_Controller {
	var $base;
	var $css;
	var $js;
	var $images;
	var $data;
	public function Test() {
		parent::__construct();
		$this->load->helper('picture_helper');
		$this->load->helper('qrcode_helper');
	}
	
	/**
	 * 上传图片保存到服务器指定目录
	 */
	public function save_img(){
		$img_data = $_FILES['imagefile']['tmp_name'];
		$size = getimagesize($img_data);
		$file_type = $size['mime'];
		if (!in_array($file_type, array('image/jpg', 'image/jpeg', 'image/pjpeg', 'image/png', 'image/gif')))
		{
			$error_log = 'only allow jpg,png,gif';
			die ('upload error:' . $error_log);
		}
		switch ($file_type) {
				case 'image/jpg' :
				case 'image/jpeg' :
				case 'image/pjpeg' :
					$extension = 'jpg';
					break;
				case 'image/png' :
					$extension = 'png';
					break;
				case 'image/gif' :
					$extension = 'gif';
					break;
		}
		if (!is_file($img_data))
		{
			die ('Image upload error!');
		}
// 		$path= upload_server($_FILES['imagefile'], 5*1024*1000, "activity_img/", 'resize'.time());
// 		echo '{"type" : "'.$extension.'","path" : "'.'http://192.168.1.152:8888/'.$path.'","size" : "100MB"}';
		
		
		$path = "qrcode/canvas".time();
		move_uploaded_file($img_data, $path.'.'.$extension);
        echo '{"type" : "'.$extension.'","path" : "'.$img_data.'","size" : "100MB"}';
	}
	
	public function getBlobImg(){
		$path = str_replace("application/","",APPPATH);
		echo file_get_contents($path."activity_img/greatwall.jpg");

	}
	
}
