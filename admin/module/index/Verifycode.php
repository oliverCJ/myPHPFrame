<?php
namespace Admin\Module\Index;
/**
 * 生成验证码
 * FileName:verifycode.php
 * @Author:chengjun <cgjp123@163.com>
 * @Since:2012-3-21
 */
 class Verifycode {
 	
 	private $width;
 	private $height;
 	private $font_size;
 	private $length;
 	
 	public function __construct($width='100',$height='28',$font_size='18',$length='4'){
 		$this->width = $width;
 		$this->height = $height;
 		$this->font_size = $font_size;
 		$this->length = $length;
 	}
 	//生成验证码
	public function creatVerifyCode(){
		$verifyCode = \Lib\Helper\CommonFunction::random($this->length);
		$_SESSION[SESSION_PREFIX.'verifyCode'] = $verifyCode;
		//创建图床
		$image			= imagecreatetruecolor($this->width, $this->height);
		// 定义背景色  
		$bg_color		= imagecolorallocate($image, 0xFF, 0xFF, 0xFF);
		// 定义文字及边框颜色  
		$black_color	= imagecolorallocate($image, 0x00, 0x00, 0x00);  
		//生成矩形边框  
		imagefilledrectangle($image, 0, 0, $this->width, $this->height, $bg_color);
		
		// 循环生成雪花点  
		for ($i = 0; $i < 200; $i++)
		{
			$gray_color		= imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255));
			imagesetpixel($image, mt_rand(1, $this->width-2), mt_rand(4, $this->height-2), $gray_color);
		}
		//绘制背景干扰线
		for($i=0;$i<5;$i++){
			$line_color = ImageColorAllocate($image, rand(0, 255), rand(0, 255), rand(0, 255));
   			imagearc($image, mt_rand(-5,$this->width), mt_rand(-5,$this->height), mt_rand(20,300), mt_rand(20,200), 55, 44, $line_color); 
		}
		
		$font	= MODULE_PATH . 'index/acidic.ttf';
		// 把随机字符串输入图片 
		for ($i = 0; $i < strlen($verifyCode); $i++)
		{
			$font_color		= imagecolorallocate($image, rand(0, 100), rand(0, 100), rand(0, 100));
			if(!function_exists('imagettftext')) {
				imagechar( $image, $this->font_size,  15 + $i*20, rand(5,13), $verifyCode[$i], $font_color );
			}else{
				imagettftext($image, $this->font_size, 0, 10 + $i*20, rand(20,28), $font_color, $font, $verifyCode[$i]);
			}
		}
		return imagepng($image);
	}
	
	public function run(){
		Header("Content-type: image/PNG");
		echo $this->creatVerifyCode();
		return;
	}
 }