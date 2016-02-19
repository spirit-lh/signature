<?php
header("Content-type: text/html; charset=utf-8");
header('Access-Control-Allow-Origin:*');
/**
 * 文件上传&下载
 */
class FileDemo extends CI_Controller {
	var $base;
	var $css;
	var $js;
	var $data;

	public function __construct() {
		parent::__construct();
		//加载基础类库
		$this -> load -> library('session');
		//加载基本环境变量
		$this -> base = $this -> config -> item('base_url');
		$this -> css = $this -> config -> item('css');
		$this -> js = $this -> config -> item('js');
	}

	/**
	 * 图片上传demo页面
	 * http://192.168.1.181:8888/index.php/demo/FileDemo/imgDemo
	 */
	public function imgDemo() {
		$data['base'] = $this -> base;
		$data['js'] = $this -> js;
		$data['css'] = $this -> css;
		$this -> load -> view('demo/file_demo.html', $data);
	}

	/**
	 * 上传图片
	 */
	public function uploadImage() {
		$path = 'img_poster/';
		if (!file_exists($path)) {
			mkdir($path, 0700);
		}

		$img_data = $_FILES['poster']['tmp_name'];
		$size = getimagesize($img_data);
		$file_type = $size['mime'];
		if (!in_array($file_type, array('image/jpg', 'image/jpeg', 'image/pjpeg', 'image/png', 'image/gif'))) {
			$error_log = 'only allow jpg,png,gif';
			die('upload error:' . $error_log);
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
		if (!is_file($img_data)) {
			die('Image upload error!');
		}
		$path = $path . time() . '.' . $extension;
		move_uploaded_file($img_data, $path);

		echo '{success:true, msg:"' . $path . '"}';

	}

	/**
	 * 下载图片
	 */
	public function downloadImage() {
		$file_path = isset($_GET['file_path']) ? $_GET['file_path'] : NULL;
//		var_dump($file_path);
echo '{success:true, content :"'.file_get_contents($this -> base.$file_path).'"}';
	}

}
