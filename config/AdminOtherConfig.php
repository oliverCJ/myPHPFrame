<?php
namespace Config;
/**
 * 
 * 后台其他配置
 * @Author:oliver <cgjp123@163.com>
 * @Since:2013-1-22
 */
defined ( 'ADMIN' ) or die ( 'Access Denied' );

class AdminOtherConfig {
	/**
	 * 有趣的话
	 * @var unknown
	 */
	public static $funnyWords = array(
			'normal' => array(
					'人是铁，饭是钢，一顿不吃饿得慌！',
					'锄禾 日 当午',
					),
			'movie' => array(
					'就算是一条用过的内裤或是卫生纸，都有他的用处！',
					),
			);
	
	/**
	 * 菜品规则预置参数
	 * @var unknown
	 */
	public static $orderFoodRuleTag = array(
			'A'=>array(
					'name'=>'荤菜'
					),
			'B'=>array(
					'name'=>'素菜'
					),
			'C'=>array(
					'name'=>'汤'
					),
			'D'=>array(
					'name'=>'米饭'
					),
			'E'=>array(
					'name'=>'小吃（米线，面条，饺子，抄手....等等）'
					),
			'F'=>array(
					'name'=>'快餐（炒饭，盖饭，豆汤饭，冒菜....等等）'
					),
			'G'=>array(
					'name'=>'其他（赠品，加钱送饮料....等等）'
					)
			);
}