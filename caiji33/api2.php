<?php  

mysql_connect("localhost","root","zkeys");   //连接服务器   
mysql_select_db("sql12");
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
date_default_timezone_set('PRC');

$result1 = mysql_query("SELECT * FROM  `g_history3` WHERE `g_game_id`='3' and g_ball_1 is null  order by g_date desc  limit 1");    //在mytable表上执行SQL语句 
while($result = mysql_fetch_array($result1)) 
 {  
  if($result['g_qishu']!=null)
 {
	

    	 
		$g_qishu=$result['g_qishu'];
		$g_date=str_replace(" ","T",$result['g_date']);
		 $g_qishuqian=substr($g_qishu,0,8);
		  $g_qishuhou=(int)substr($g_qishu,8);
		  $haoma=randKeys();
		// echo  $g_date;
	
	
	}
}

//echo '<xml><row expect="'.$g_qishu.'" opencode="'.randKeys().'" opentime="'.$g_date.'"/></xml>';
echo "[{\"drawTime\":\"".$g_date."\",\"Num\":\"".$haoma."\",\"periodsNumber\":".$g_qishuhou.".0,\"periodsTime\":\"".$g_qishuqian."\"},{\"drawTime\":\"".$g_date."\",\"Num\":\"".$haoma."\",\"periodsNumber\":".$g_qishuhou.".0,\"periodsTime\":\"".$g_qishuqian."\"}]";

 
/* 生成随机数 */

function randKeys($len=5){
	$str='6038519724';
	$rand='';
	for($x=0;$x<$len;$x++){
		$rand.=($rand!=''?',':'').substr($str,rand(0,strlen($str)-1),1);
	}
	return $rand;
}
 

?>