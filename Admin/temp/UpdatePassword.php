<?php 
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Admin/ExistUser.php';
global $Users, $LoginId;
markPos("后台-修改密码");
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$s_pwd = sha1($_POST['s_pwd']);
	$new_pwd = $_POST['new_pwd'];
	if (!Matchs::isString($new_pwd, 8, 20)) exit(back('新密碼 請填寫 8 位或以上（最長20位）！'));
	$pwd = $Users[0]['g_login_id'] == 89 ? "`j_manage`" : "`g_rank`";
	$new_pwd = sha1($new_pwd);
	$db=new DB();
	if (isset($Users[0]['g_s_lock'])){
		$pwd = "g_relation_user";
		$g_name = "g_s_name";
		$sname = $Users[0]['g_s_name'];
	} else {
		$g_name = "g_name";
		$sname = $Users[0]['g_name'];
	}
	if ($db->query("SELECT {$g_name} FROM {$pwd} WHERE {$g_name} = '{$sname}' AND g_password = '{$s_pwd}' LIMIT 1", 0)){
		if($pwd=="`g_rank`")
		$sql = "UPDATE {$pwd} SET g_password = '{$new_pwd}' , g_pwd=0 WHERE {$g_name} = '{$sname}' LIMIT 1";
		else
		$sql = "UPDATE {$pwd} SET g_password = '{$new_pwd}'  WHERE {$g_name} = '{$sname}' LIMIT 1";
		if ($db->query($sql, 2)){
			exit(alert_href('更變成功，請重新登錄。', 'Quit.php'));
		} else {
			exit(back('更變失敗！'));
		}
	} else {
		exit(back('原始密碼錯誤！'));
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo $oncontextmenu?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Admin/temp/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/actiontop.js"></script>
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/Admin/temp/js/Pwd_Safety.js"></script>
<title></title>
<script type="text/javascript">
<!--
	function isPwd(){
		var s_pwd = $("#s_pwd").val();
		var new_pwd = $("#new_pwd").val();
		var f_pwd = $("#f_pwd").val();
		if (s_pwd == ""){
			alert("請輸入原始密碼");
		    return false;
		}
		if (s_pwd.length <8 || s_pwd.length >20){
			alert("原始密碼錯誤！");
		    return false;
		}
		if (new_pwd.length <8 || new_pwd.length >20){
			alert("新密碼 請填寫 8 位或以上（最長20位）！");
		    return false;
		}
		if (new_pwd != f_pwd){
			alert("確認密碼于新密碼不一致！");
		    return false;
		}
		if (new_pwd == s_pwd){
			alert("新密碼于原始密碼相同！");
		    return false;
		}
		if(Pwd_Safety(new_pwd)!=true) {
			return false;
		}
		return true;
	}
-->
</script>
</head>
<body onselectstart="return false">
<form method="post" action="" onsubmit="return isPwd()" >
	<table width="100%" height="99.3%" border="0" cellspacing="0" class="a">
    	<tr>
        	<td width="5" height="100%" bgcolor="#4F4F4F"></td>	
            <td class="c">
           	  <table border="0" cellspacing="0" class="main">
                	<tr>
                    	<td width="12"><img src="/Admin/temp/images/tab_03.gif" alt="" /></td>
						<td background="/Admin/temp/images/tab_05.gif">
					        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
						<td width="17"><img src="/Admin/temp/images/tb.gif" width="16" height="16" /></td>
                        <td><font style="font-weight:bold" color="#344B50">&nbsp;變更密碼</font></td>
						          </tr>
                            </table>
                        </td>
                        <td width="16"><img src="/Admin/temp/images/tab_07.gif" alt="" /></td>
                    </tr>
                    <tr>
                    	<td class="t"></td>
                        <td class="c">
                        <!-- strat -->
                            <table border="0" cellspacing="0" class="conter">
                            	<tr style="height:28px">
                                	<td class="bj">原始密碼</td>
                                    <td class="left_p5"><input autocomplete="off" type="password" style="width:139px;" onfocus="this.className='inp1mMM'" onblur="this.className='inp1MM'" class='inp1MM' id="s_pwd" name="s_pwd" value=''  maxlength="20" /></td>
                                </tr>
                                <tr style="height:28px">
                                	<td class="bj">新設密碼</td>
                                    <td class="left_p5"><input autocomplete="off" type="password" style="width:139px;" onfocus="this.className='inp1mMM'" onblur="this.className='inp1MM'" class='inp1MM' id="new_pwd" name="new_pwd" value=''  maxlength="20" /></td>
                                </tr>
                                <tr style="height:28px">
                                	<td class="bj">確認密碼</td>
                                    <td class="left_p5"><input autocomplete="off" type="password" style="width:139px;" onfocus="this.className='inp1mMM'" onblur="this.className='inp1MM'" class='inp1MM' id="f_pwd" name="f_pwd" value=''  maxlength="20" />									</td>
                                </tr>
                            </table>
                        <!-- end -->
                      </td>
                        <td class="r"></td>
                    </tr>
                    <tr>
                    	<td width="12"><img src="/Admin/temp/images/tab_18.gif" alt="" /></td>
                        <td class="f" align="center">
						<input type="submit" onmouseover="this.className='input2_2'" onmouseout="this.className='input2'" class="input2" value="確定脩改" /></td>
                        <td width="16"><img src="/Admin/temp/images/tab_20.gif" alt="" /></td>
                    </tr>
					
				</table>
            <td width="5" bgcolor="#4F4F4F"></td>
					</td>
        </tr>
        <tr>
        	<td height="5" bgcolor="#4F4F4F"></td>
            <td bgcolor="#4F4F4F"></td>
            <td height="5" bgcolor="#4F4F4F"></td>
        </tr>
    </table>
</form>
</body>
</html>