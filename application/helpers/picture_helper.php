<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 图片等比例缩放
 * @param unknown $src
 * @param unknown $maxwidth
 * @param unknown $maxheight
 * @return unknown
 */
function resizeImage($src,$maxwidth,$maxheight)
{
	$temp=pathinfo($src);
	$name=$temp["basename"];//文件名
	$dir=$temp["dirname"];//文件所在的文件夹
	$extension=$temp["extension"];//文件扩展名
	$savepath="{$dir}/{$name}";//缩略图保存路径,新的文件名为*.thumb.jpg
	$im=create($src);
	
	$pic_width = imagesx($im);
	$pic_height = imagesy($im);

	if(($maxwidth && $pic_width > $maxwidth) || ($maxheight && $pic_height > $maxheight))
	{
		if($maxwidth && $pic_width>$maxwidth)
		{
			$widthratio = $maxwidth/$pic_width;
			$resizewidth_tag = true;
		}

		if($maxheight && $pic_height>$maxheight)
		{
			$heightratio = $maxheight/$pic_height;
			$resizeheight_tag = true;
		}

		if($resizewidth_tag && $resizeheight_tag)
		{
			if($widthratio<$heightratio)
				$ratio = $widthratio;
			else
				$ratio = $heightratio;
		}

		if($resizewidth_tag && !$resizeheight_tag)
			$ratio = $widthratio;
		if($resizeheight_tag && !$resizewidth_tag)
			$ratio = $heightratio;

		$newwidth = $pic_width * $ratio;
		$newheight = $pic_height * $ratio;

		if(function_exists("imagecopyresampled"))
		{
			$newim = imagecreatetruecolor($newwidth,$newheight);//PHP系统函数
			imagecopyresampled($newim,$im,0,0,0,0,$newwidth,$newheight,$pic_width,$pic_height);//PHP系统函数
		}
		else
		{
			$newim = imagecreate($newwidth,$newheight);
			imagecopyresized($newim,$im,0,0,0,0,$newwidth,$newheight,$pic_width,$pic_height);
		}

		imagejpeg($newim,$savepath);
		imagedestroy($newim);
		return $savepath;
	}
	else
	{
		imagejpeg($im,$savepath);
		return $savepath;
	}
}
//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

function _UPLOADPIC($upfile, $maxsize, $updir, $newname = 'date') {
	 
	if ($newname == 'date')
		$newname = date ( "Ymdhis" ); //使用日期做文件名
	$name = $upfile ["name"];
	$type = $upfile ["type"];
	$size = $upfile ["size"];
	$tmp_name = $upfile ["tmp_name"];
	
	switch ($type) {
		case 'image/jpg' :
		case 'image/pjpeg' :
		case 'image/jpeg' :
			$extend = ".jpg";
			break;
		case 'image/gif' :
			$extend = ".gif";
			break;
		case 'image/png' :
			$extend = ".png";
			break;
	}
	if (empty( $extend )) {
		return "type_error";
// 		echo  ( "警告！只能上传图片类型：GIF JPG PNG" );
// 		exit ();
	}else if ($size > $maxsize) {
		$maxpr = $maxsize / 1000;
		return "size_error";
// 		echo  ( "警告！上传图片大小不能超过" . $maxpr . "K!" );
// 		exit ();
	}
	else if (move_uploaded_file ( $tmp_name, $updir . $newname . $extend )) {
		return $updir . $newname . $extend;
	}
}

function show_pic_scal($width, $height, $picpath) {
	$imginfo = GetImageSize ( $picpath );
	$imgw = $imginfo [0];
	$imgh = $imginfo [1];
	 
	$ra = number_format ( ($imgw / $imgh), 1 ); //宽高比
	$ra2 = number_format ( ($imgh / $imgw), 1 ); //高宽比
	 

	if ($imgw > $width or $imgh > $height) {
		if ($imgw > $imgh) {
			$newWidth = $width;
			$newHeight = round ( $newWidth / $ra );
			 
		} elseif ($imgw < $imgh) {
			$newHeight = $height;
			$newWidth = round ( $newHeight / $ra2 );
		} else {
			$newWidth = $width;
			$newHeight = round ( $newWidth / $ra );
		}
	} else {
		$newHeight = $imgh;
		$newWidth = $imgw;
	}
	$newsize [0] = $newWidth;
	$newsize [1] = $newHeight;
	 
	return $newsize;
}



function getImageInfo($src)
{
	return getimagesize($src);
}
/**
 * 创建图片，返回资源类型
 * @param string $src 图片路径
 * @return resource $im 返回资源类型
 * **/
function create($src)
{
	$info=getImageInfo($src);
	switch ($info[2])
	{
		case 1:
			$im=imagecreatefromgif($src);
			break;
		case 2:
			$im=imagecreatefromjpeg($src);
			break;
		case 3:
			$im=imagecreatefrompng($src);
			break;
	}
	return $im;
}
/**
 * 缩略图主函数
 * @param string $src 图片路径
 * @param int $w 缩略图宽度
 * @param int $h 缩略图高度
 * @return mixed 返回缩略图路径
 * **/

function resize($src,$w,$h)
{
	$temp=pathinfo($src);
	$name=$temp["basename"];//文件名
	$dir=$temp["dirname"];//文件所在的文件夹
	$extension=$temp["extension"];//文件扩展名
	$savepath="{$dir}/{$name}";//缩略图保存路径,新的文件名为*.thumb.jpg

	//获取图片的基本信息
	$info=getImageInfo($src);
	$width=$info[0];//获取图片宽度
	$height=$info[1];//获取图片高度
	$per1=round($width/$height,2);//计算原图长宽比
	$per2=round($w/$h,2);//计算缩略图长宽比

	//计算缩放比例
	if($per1>$per2||$per1==$per2)
	{
		//原图长宽比大于或者等于缩略图长宽比，则按照宽度优先
		$per=$w/$width;
	}
	if($per1<$per2)
	{
		//原图长宽比小于缩略图长宽比，则按照高度优先
		$per=$h/$height;
	}
	$temp_w=intval($width*$per);//计算原图缩放后的宽度
	$temp_h=intval($height*$per);//计算原图缩放后的高度
	$temp_img=imagecreatetruecolor($temp_w,$temp_h);//创建画布
	$im=create($src);
	imagecopyresampled($temp_img,$im,0,0,0,0,$temp_w,$temp_h,$width,$height);
	if($per1>$per2)
	{
		imagejpeg($temp_img,$savepath, 100);
		imagedestroy($im);
		return addBg($savepath,$w,$h,"w");
		//宽度优先，在缩放之后高度不足的情况下补上背景
	}
	if($per1==$per2)
	{
		imagejpeg($temp_img,$savepath, 100);
		imagedestroy($im);
		return $savepath;
		//等比缩放
	}
	if($per1<$per2)
	{
		imagejpeg($temp_img,$savepath, 100);
		imagedestroy($im);
		return addBg($savepath,$w,$h,"h");
		//高度优先，在缩放之后宽度不足的情况下补上背景
	}
}
/**
 * 添加背景
 * @param string $src 图片路径
 * @param int $w 背景图像宽度
 * @param int $h 背景图像高度
 * @param String $first 决定图像最终位置的，w 宽度优先 h 高度优先 wh:等比
 * @return 返回加上背景的图片
 * **/
function addBg($src,$w,$h,$fisrt="w")
{
	$bg=imagecreatetruecolor($w,$h);
	$white = imagecolorallocate($bg,255,255,255);
	imagefill($bg,0,0,$white);//填充背景

	//获取目标图片信息
	$info=getImageInfo($src);
	$width=$info[0];//目标图片宽度
	$height=$info[1];//目标图片高度
	$img=create($src);
	if($fisrt=="wh")
	{
		//等比缩放
		return $src;
	}
	else
	{
		if($fisrt=="w")
		{
			$x=0;
			$y=($h-$height)/2;//垂直居中
		}
		if($fisrt=="h")
		{
			$x=($w-$width)/2;//水平居中
			$y=0;
		}
		imagecopymerge($bg,$img,$x,$y,0,0,$width,$height,100);
		imagejpeg($bg,$src,100);
		imagedestroy($bg);
		imagedestroy($img);
		return $src;
	}

}

// $filename=(_UPLOADPIC($_FILES["upload"],$maxsize,$updir,$newname='date'));
// $show_pic_scal=show_pic_scal(230, 230, $filename);
// resize($filename,$show_pic_scal[0],$show_pic_scal[1]);

/**
 * 上传图片等比例缩放后保存到服务器指定目录
 * @param unknown $upfile
 * @param unknown $maxsize
 * @param unknown $updir
 * @param string $newname
 */
function upload_server($upfile, $maxsize, $updir, $newname = 'date'){
	$filename = _UPLOADPIC($upfile, $maxsize, $updir, $newname);
	if($filename=='type_error'){
		return "只能上传图片类型：GIF JPG PNG";
	}else if($filename=='size_error'){
		return "上传图片大小不能超过5M";
	}else{
		$show_pic_scal=show_pic_scal(650, 450, $filename);
		return resize($filename,$show_pic_scal[0],$show_pic_scal[1]);
	}
	
	
}
/**
 * 等比例压缩成更小的图片 比upload_server方法压缩更深入
 * @param 获取到的上传文件 $upfile
 * @param 文件的保存路径 $updir
 * @param 新文件名 $newname
 */
function picture_move($upfile, $updir, $newname){
	$filename = _UPLOADPIC($upfile, 5*1024*1000, $updir, $newname);
	if($filename=='type_error'){
		return "只能上传图片类型：GIF JPG PNG";
	}else if($filename=='size_error'){
		return "上传图片大小不能超过5M";
	}else{
		return  resizeImage($filename,650,450);
	}
	
	
}
