<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH."helpers/phpqrcode.php");
/**
 * 二维码生成
 * @param 二维码内容 $data
 * @param 二维码文件名 $filename
 */
function generate_qrcode($data,$filename){
	// 纠错级别：L、M、Q、H
	$errorCorrectionLevel = 'L';
	// 点的大小：1到10
	$matrixPointSize = 6;
	//创建一个二维码文件
	QRcode::png($data, $filename, $errorCorrectionLevel, $matrixPointSize, 2);
	//输入二维码到浏览器
// 	QRcode::png($data);
    return true;
}
/**
 * 带logo的二维码生成
 * @param 二维码内容 $data
 * @param 二维码文件名 $filename
 * @param 准备好的logo图片 $logo
 */
function generate_qrcode_logo($data,$filename,$logo){
	$errorCorrectionLevel = 'L';//容错级别
	$matrixPointSize = 6;//生成图片大小
	//生成二维码图片
	QRcode::png($data, 'qrcode.png', $errorCorrectionLevel, $matrixPointSize, 2);
	$QR = 'qrcode.png';//已经生成的原始二维码图
	
	if ($logo !== FALSE) {
		$QR = imagecreatefromstring(file_get_contents($QR));
		$logo = imagecreatefromstring(file_get_contents($logo));
		$QR_width = imagesx($QR);//二维码图片宽度
		$QR_height = imagesy($QR);//二维码图片高度
		$logo_width = imagesx($logo);//logo图片宽度
		$logo_height = imagesy($logo);//logo图片高度
		$logo_qr_width = $QR_width / 5;
		$scale = $logo_width/$logo_qr_width;
		$logo_qr_height = $logo_height/$scale;
		$from_width = ($QR_width - $logo_qr_width) / 2;
		//重新组合图片并调整大小
		imagecopyresampled($QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width,
				$logo_qr_height, $logo_width, $logo_height);
	}
	//输出图片
	imagepng($QR, $filename);
	return true;
}