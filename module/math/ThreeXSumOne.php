<?php
namespace Module\Math;
/**
 *
 * 数学问题模块
 * @author oliver <cgjp123@163.com>
 *    
 * 3x+1问题：
 * 从任意一个整数开始，重复对其进行下面操作：如果这个数是偶数，则除以2;如果这个数是奇数，则把他扩大为原来的3倍后再加1。
 * 序列是否最终总会变成4，2，1，4，2，1，4，2，1，....这种循环
 */
class ThreeXSumOne extends \lib\Application{
      
      public function run(){
            $tpl = \Lib\Template:: getSmarty();
            set_time_limit(0);
             //$randomNum = 63;
             //$randomNum = 71;
             //$randomNum = 35;
            $randomNum = rand(1,1000);
            $result = $this->processFunction($randomNum);
             while($result[count($result)-1] != 1){
                  $result2 = array();
                  $result2 = $this->processFunction($result[count($result)-1]);
                  $result = array_merge($result,$result2);
            }
             echo 'mem:'.memory_get_peak_usage()/1024/1024 . "mb<br />";
             echo 'num:'.$randomNum."<br />";
             echo '<pre>';
            print_r($result);
             //$tpl->display('index.htm');
      }
      
      public function processFunction($num,&$step= array()){
             //因为PHP调试插件，最大递归层数是有限制的
             if($num!=1 && count($step)<=93){
                   if(($num%2)==0){
                         //偶数
                        $num = $num / 2;
                  } else{
                        $num = 3*$num + 1;
                  }
                  array_push($step, $num);
                  $this->processFunction($num,$step);
            }
             return $step;
      }
}