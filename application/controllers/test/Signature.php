<?php
header("Content-type: text/html; charset=utf-8");
header('Access-Control-Allow-Origin:*');
class  Signature extends CI_Controller {
	var $base;
	var $css;
	var $js;
	var $images;
	var $data;
	public function Signature() {
		parent::__construct();
		$this->load->helper('picture_helper');
		$this->load->helper('qrcode_helper');
	}
	
	/**
	 * 签名页面
	 */
	public function good(){
		$this->load->view('test/signature.html');
	}
	
	/**
	 * 保存签名图片
	 */
	public function saveImgBase64(){
		$base64 = $_POST['dataurl'];
		$img = base64_decode($base64);
		$path = "qrcode/sign".'.png';
        $a = file_put_contents($path, $img);
	
        echo '{"path" : "'.$a.'","size" : "100MB"}';
	}
	
	public function mergeImage(){
			$this->load->view('test/mergeSign.html');
	}
	
	public function saveHT(){
		$base64 = $_POST['dataurl'];
		$img = base64_decode($base64);
		$path = "qrcode/HTHH".'.png';
        $a = file_put_contents($path, $img);
	
        echo '{"path" : "'.$a.'","size" : "100MB"}';
	}
	
	
}
