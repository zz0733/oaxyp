<?php 
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Admin/temp/offGame.php';
include_once ROOT_PATH.'Admin/ExistUser.php';
include_once ROOT_PATH.'Admin/config/AdminConfig.php';
if ($ConfigModel['g_nowrecord_lock'] !=1 || $ConfigModel['g_kg_game_lock'] !=1)exit(href('right.php'));
$oddsLock = false;
if ($Users[0]['g_login_id']==48){
	if ($Users[0]['g_Immediate2_lock'] != 1) exit(back('抱歉！您無權限訪問即時注單。'));
}
if ($Users[0]['g_login_id']==89){
	$oddsLock=true;
} 
else if (isset($Users[0]['g_odds_lock']) && $Users[0]['g_odds_lock']==1){
	$oddsLock=true;
}

$g = $_GET['cid'];
$Mean = -1000000;
switch ($g) {
	case '1':
		$types = '第一球';
		if ($ConfigModel['g_game_1'] !=1)exit(href('right.php'));
		if (isset($_SESSION['Mean1']))
			$Mean = $_SESSION['Mean1'];
		break;
	case '2':
		$types = '第二球';
		if ($ConfigModel['g_game_2'] !=1)exit(href('right.php'));
		if (isset($_SESSION['Mean2']))
			$Mean = $_SESSION['Mean2'];
		break;
	case '3':
		$types = '第三球';
		if ($ConfigModel['g_game_3'] !=1)exit(href('right.php'));
		if (isset($_SESSION['Mean3']))
			$Mean = $_SESSION['Mean3'];
		break;
	case '4':
		$types = '第四球';
		if ($ConfigModel['g_game_4'] !=1)exit(href('right.php'));
		if (isset($_SESSION['Mean4']))
			$Mean = $_SESSION['Mean4'];
		break;
	case '5':
		$types = '第五球';
		if ($ConfigModel['g_game_5'] !=1)exit(href('right.php'));
		if (isset($_SESSION['Mean5']))
			$Mean = $_SESSION['Mean5'];
		break;
	case '6':
		$types = '第六球';
		if ($ConfigModel['g_game_6'] !=1)exit(href('right.php'));
		if (isset($_SESSION['Mean6']))
			$Mean = $_SESSION['Mean6'];
		break;
	case '7':
		$types = '第七球';
		if ($ConfigModel['g_game_7'] !=1)exit(href('right.php'));
		if (isset($_SESSION['Mean7']))
			$Mean = $_SESSION['Mean7'];
		break;
	case '8':
		$types = '第八球';
		if ($ConfigModel['g_game_8'] !=1)exit(href('right.php'));
		if (isset($_SESSION['Mean8']))
			$Mean = $_SESSION['Mean8'];
		break;
	default:exit;
}
markPos("后台-广东即时注单-{$types}");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo $oncontextmenu?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Admin/temp/css/common.css" rel="stylesheet" type="text/css" />
<link href="/static/css/base.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/actiontop.js"></script>
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/Admin/temp/js/oddsFile.js"></script>
<script type="text/javascript" src="/Admin/temp/js/setOdds.js"></script>
<script type="text/javascript">
<!--
	function setMean($this){
		var patrn=/^[0-9-]{1,9}$/; 
		if (patrn.exec($this.value)){
			$.post("/Admin/temp/ajaxad/json.php", {typeid : 4, meanid : $this.value, cid : <?php echo $g?>}, function(){});
		}
	}
	function GoLocation(sInt){
		location.href = "/Admin/temp/"+sInt;
	}
//-->		
</script>
<script type="text/javascript">
$(function(openTime){
        if (openTime <= 0) {
            addClassName();
        }
  $("#ct1").show();
});
function setcData() {
    if (cData != undefined && cData != "") {
        var max = 0;
        for (var i = 0; i < cData.length; i++) {
            if (cData[i] > max) {
                max = cData[i];
            }
        }
        for (var i = 0; i < cData.length; i++) {
            if (cData[i] == max && cData[i] != "0") {
                $(".a_" + (i + 1)).html("<b class=\"red\">" + cData[i] + "</b>");
            } else {
                $(".a_" + (i + 1)).html(cData[i]);
            }
        }
    } else {
        setTimeout(setcData,1000);
    }
}
</script>
</head>
<body onselectstart="return false">
	<table width="100%" height="99.3%" border="0" cellspacing="0" class="a">
    	<tr>
        	<td width="5" height="100%" bgcolor="#4F4F4F"></td>
    <td class="c">
      <table border="0" cellspacing="0" class="main1">
        <tr>
          <td width="12"><img src="/Admin/temp/images/tab_03.gif" alt="" /></td>
          <td background="/Admin/temp/images/tab_05.gif">
            <?php include_once ROOT_PATH.'Admin/temp/oddsTop.php';?>
          </td>
          <td width="16"><img src="/Admin/temp/images/tab_07.gif" alt="" /></td>
        </tr><!--/content_head-->
        <tr>
          <td class="t"></td>
          <td class="c">
          	<!-- strat -->
            <table width="100%" class="t_RT" border="0" cellSpacing="0" cellPadding="1">
            	<tr>
              	<td width="100%" align="center" vAlign="top">
                  <table border="0" cellspacing="0" class="t_odds" width="49%"  style="margin:0px -5px;margin-top:5px;top:1px;">
                    <tr class="tr_top">
                        <td width="15%">號</td>
                          <td width="25%">賠率</td>
                          <?php if ($oddsLock){?><td width="6%" colspan="2">設置</td><?php }?>
                          <td>注額</td>
                          <td>虧盈</td>
                      </tr>	
<tbody id="ct1" style="display:none">					  
                      <tr align="center">
                        <td class="ball" id="n1">01</td>
                          <td class="odds" id="h1"></td>
                          <?php if ($oddsLock){?>
                          <td>
                            <input title="上調賠率" type="button" onclick="setodds('h1','Ball_<?php echo $g?>',this)" class="aase aase_a" name="1" />
                        </td>
						<td>							
                            <input title="下調賠率" type="button" onclick="setodds('h1','Ball_<?php echo $g?>',this)" class="aase aase_b" name="0"  />
                        </td>
                          <?php }?>
                          <td class="odds"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('01')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="a1">-</a><span id="b1" class="so"></span></td>
                          <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="d1">-</a></td>
                      </tr>
                      <tr align="center">
                        <td class="ball" id="n2">02</td>
                          <td class="odds" id="h2"></td>
                          <?php if ($oddsLock){?>
                          <td>
                            <input title="上調賠率" type="button" onclick="setodds('h2','Ball_<?php echo $g?>',this)" class="aase aase_a" name="1" />
                        </td>
						<td>							
                            <input title="下調賠率" type="button" onclick="setodds('h2','Ball_<?php echo $g?>',this)" class="aase aase_b" name="0"  />
                        </td>
                          <?php }?>
                          <td class="odds"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('02')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="a2">-</a><span id="b2" class="so"></span></td>
                          <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="d2">-</a></td>
                      </tr>
                      <tr align="center" >
                        <td class="ball" id="n3">03</td>
                          <td class="odds" id="h3"></td>
                          <?php if ($oddsLock){?>
                          <td>
                            <input title="上調賠率" type="button" onclick="setodds('h3','Ball_<?php echo $g?>',this)" class="aase aase_a" name="1" />
                        </td>
						<td>							
                            <input title="下調賠率" type="button" onclick="setodds('h3','Ball_<?php echo $g?>',this)" class="aase aase_b" name="0"  />
                        </td>
                          <?php }?>
                          <td class="odds"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('03')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="a3">-</a><span id="b3" class="so"></span></td>
                          <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="d3">-</a></td>
                      </tr>
                      <tr align="center" >
                        <td class="ball" id="n4">04</td>
                          <td class="odds" id="h4"></td>
                          <?php if ($oddsLock){?>
                          <td>
                            <input title="上調賠率" type="button" onclick="setodds('h4','Ball_<?php echo $g?>',this)" class="aase aase_a" name="1" />
                        </td>
						<td>							
                            <input title="下調賠率" type="button" onclick="setodds('h4','Ball_<?php echo $g?>',this)" class="aase aase_b" name="0"  />
                        </td>
                          <?php }?>
                          <td class="odds"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('04')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="a4">-</a><span id="b4" class="so"></span></td>
                          <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="d4">-</a></td>
                      </tr>
                      <tr align="center" >
                        <td class="ball" id="n5">05</td>
                          <td class="odds" id="h5"></td>
                          <?php if ($oddsLock){?>
                          <td>
                            <input title="上調賠率" type="button" onclick="setodds('h5','Ball_<?php echo $g?>',this)" class="aase aase_a" name="1" />
                        </td>
						<td>							
                            <input title="下調賠率" type="button" onclick="setodds('h5','Ball_<?php echo $g?>',this)" class="aase aase_b" name="0"  />
                        </td>
                          <?php }?>
                          <td class="odds"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('05')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="a5">-</a><span id="b5" class="so"></span></td>
                          <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="d5">-</a></td>
                      </tr>
                      <tr align="center" >
                        <td class="ball" id="n6">06</td>
                          <td class="odds" id="h6"></td>
                          <?php if ($oddsLock){?>
                          <td>
                            <input title="上調賠率" type="button" onclick="setodds('h6','Ball_<?php echo $g?>',this)" class="aase aase_a" name="1" />
                        </td>
						<td>							
                            <input title="下調賠率" type="button" onclick="setodds('h6','Ball_<?php echo $g?>',this)" class="aase aase_b" name="0"  />
                        </td>
                          <?php }?>
                          <td class="odds"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('06')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="a6">-</a><span id="b6" class="so"></span></td>
                          <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="d6">-</a></td>
                      </tr>
                      <tr align="center" >
                        <td class="ball" id="n7">07</td>
                          <td class="odds" id="h7"></td>
                          <?php if ($oddsLock){?>
                          <td>
                            <input title="上調賠率" type="button" onclick="setodds('h7','Ball_<?php echo $g?>',this)" class="aase aase_a" name="1" />
                        </td>
						<td>							
                            <input title="下調賠率" type="button" onclick="setodds('h7','Ball_<?php echo $g?>',this)" class="aase aase_b" name="0"  />
                        </td>
                          <?php }?>
                          <td class="odds"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('07')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="a7">-</a><span id="b7" class="so"></span></td>
                          <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="d7">-</a></td>
                      </tr>
                      <tr align="center" >
                        <td class="ball" id="n8">08</td>
                          <td class="odds" id="h8"></td>
                          <?php if ($oddsLock){?>
                          <td>
                            <input title="上調賠率" type="button" onclick="setodds('h8','Ball_<?php echo $g?>',this)" class="aase aase_a" name="1" />
                        </td>
						<td>							
                            <input title="下調賠率" type="button" onclick="setodds('h8','Ball_<?php echo $g?>',this)" class="aase aase_b" name="0"  />
                        </td>
                          <?php }?>
                          <td class="odds"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('08')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="a8">-</a><span id="b8" class="so"></span></td>
                          <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="d8">-</a></td>
                      </tr>
                      <tr align="center" >
                        <td class="ball" id="n9">09</td>
                          <td class="odds" id="h9"></td>
                          <?php if ($oddsLock){?>
                          <td>
                            <input title="上調賠率" type="button" onclick="setodds('h9','Ball_<?php echo $g?>',this)" class="aase aase_a" name="1" />
                        </td>
						<td>							
                            <input title="下調賠率" type="button" onclick="setodds('h9','Ball_<?php echo $g?>',this)" class="aase aase_b" name="0"  />
                        </td>
                          <?php }?>
                          <td class="odds"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('09')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="a9">-</a><span id="b9" class="so"></span></td>
                          <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="d9">-</a></td>
                      </tr>
                      <tr align="center" >
                        <td class="ball" id="n10">10</td>
                          <td class="odds" id="h10"></td>
                          <?php if ($oddsLock){?>
                          <td>
                            <input title="上調賠率" type="button" onclick="setodds('h10','Ball_<?php echo $g?>',this)" class="aase aase_a" name="1" />
                        </td>
						<td>							
                            <input title="下調賠率" type="button" onclick="setodds('h10','Ball_<?php echo $g?>',this)" class="aase aase_b" name="0"  />
                        </td>
                          <?php }?>
                          <td class="odds"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('10')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="a10">-</a><span id="b10" class="so"></span></td>
                          <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="d10">-</a></td>
                      </tr>
                      <tr align="center" >
                        <td class="ball" id="n11">11</td>
                          <td class="odds" id="h11"></td>
                          <?php if ($oddsLock){?>
                          <td>
                            <input title="上調賠率" type="button" onclick="setodds('h11','Ball_<?php echo $g?>',this)" class="aase aase_a" name="1" />
                        </td>
						<td>							
                            <input title="下調賠率" type="button" onclick="setodds('h11','Ball_<?php echo $g?>',this)" class="aase aase_b" name="0"  />
                        </td>
                          <?php }?>
                          <td class="odds"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('11')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="a11">-</a><span id="b11" class="so"></span></td>
                          <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="d11">-</a></td>
                      </tr>
                      <tr align="center" >
                        <td class="ball" id="n12">12</td>
                          <td class="odds" id="h12"></td>
                          <?php if ($oddsLock){?>
                          <td>
                            <input title="上調賠率" type="button" onclick="setodds('h12','Ball_<?php echo $g?>',this)" class="aase aase_a" name="1" />
                        </td>
						<td>							
                            <input title="下調賠率" type="button" onclick="setodds('h12','Ball_<?php echo $g?>',this)" class="aase aase_b" name="0"  />
                        </td>
                          <?php }?>
                          <td class="odds"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('12')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="a12">-</a><span id="b12" class="so"></span></td>
                          <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="d12">-</a></td>
                      </tr>
                      <tr align="center" >
                        <td class="ball" id="n13">13</td>
                          <td class="odds" id="h13"></td>
                          <?php if ($oddsLock){?>
                          <td>
                            <input title="上調賠率" type="button" onclick="setodds('h13','Ball_<?php echo $g?>',this)" class="aase aase_a" name="1" />
                        </td>
						<td>							
                            <input title="下調賠率" type="button" onclick="setodds('h13','Ball_<?php echo $g?>',this)" class="aase aase_b" name="0"  />
                        </td>
                          <?php }?>
                          <td class="odds"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('13')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="a13">-</a><span id="b13" class="so"></span></td>
                          <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="d13">-</a></td>
                      </tr>
                      <tr align="center" >
                        <td class="ball" id="n14">14</td>
                          <td class="odds" id="h14"></td>
                          <?php if ($oddsLock){?>
                          <td>
                            <input title="上調賠率" type="button" onclick="setodds('h14','Ball_<?php echo $g?>',this)" class="aase aase_a" name="1" />
                        </td>
						<td>							
                            <input title="下調賠率" type="button" onclick="setodds('h14','Ball_<?php echo $g?>',this)" class="aase aase_b" name="0"  />
                        </td>
                          <?php }?>
                          <td class="odds"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('14')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="a14">-</a><span id="b14" class="so"></span></td>
                          <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="d14">-</a></td>
                      </tr>
                      <tr align="center" >
                        <td class="ball" id="n15">15</td>
                          <td class="odds" id="h15"></td>
                          <?php if ($oddsLock){?>
                          <td>
                            <input title="上調賠率" type="button" onclick="setodds('h15','Ball_<?php echo $g?>',this)" class="aase aase_a" name="1" />
                        </td>
						<td>							
                            <input title="下調賠率" type="button" onclick="setodds('h15','Ball_<?php echo $g?>',this)" class="aase aase_b" name="0"  />
                        </td>
                          <?php }?>
                          <td class="odds"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('15')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="a15">-</a><span id="b15" class="so"></span></td>
                          <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="d15">-</a></td>
                      </tr>
                      <tr align="center" >
                        <td class="ball" id="n16">16</td>
                          <td class="odds" id="h16"></td>
                          <?php if ($oddsLock){?>
                          <td>
                            <input title="上調賠率" type="button" onclick="setodds('h16','Ball_<?php echo $g?>',this)" class="aase aase_a" name="1" />
                        </td>
						<td>							
                            <input title="下調賠率" type="button" onclick="setodds('h16','Ball_<?php echo $g?>',this)" class="aase aase_b" name="0"  />
                        </td>
                          <?php }?>
                          <td class="odds"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('16')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="a16">-</a><span id="b16" class="so"></span></td>
                          <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="d16">-</a></td>
                      </tr>
                      <tr align="center" >
                        <td class="ball" id="n17">17</td>
                          <td class="odds" id="h17"></td>
                          <?php if ($oddsLock){?>
                          <td>
                            <input title="上調賠率" type="button" onclick="setodds('h17','Ball_<?php echo $g?>',this)" class="aase aase_a" name="1" />
                        </td>
						<td>							
                            <input title="下調賠率" type="button" onclick="setodds('h17','Ball_<?php echo $g?>',this)" class="aase aase_b" name="0"  />
                        </td>
                          <?php }?>
                          <td class="odds"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('17')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="a17">-</a><span id="b17" class="so"></span></td>
                          <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="d17">-</a></td>
                      </tr>
                      <tr align="center" >
                        <td class="ball" id="n18">18</td>
                          <td class="odds" id="h18"></td>
                          <?php if ($oddsLock){?>
                          <td>
                            <input title="上調賠率" type="button" onclick="setodds('h18','Ball_<?php echo $g?>',this)" class="aase aase_a" name="1" />
                        </td>
						<td>							
                            <input title="下調賠率" type="button" onclick="setodds('h18','Ball_<?php echo $g?>',this)" class="aase aase_b" name="0"  />
                        </td>
                          <?php }?>
                          <td class="odds"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('18')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="a18">-</a><span id="b18" class="so"></span></td>
                          <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="d18">-</a></td>
                      </tr>
                      <tr align="center" >
                        <td class="red" id="n19">19</td>
                          <td class="odds" id="h19"></td>
                          <?php if ($oddsLock){?>
                          <td>
                            <input title="上調賠率" type="button" onclick="setodds('h19','Ball_<?php echo $g?>',this)" class="aase aase_a" name="1" />
                        </td>
						<td>							
                            <input title="下調賠率" type="button" onclick="setodds('h19','Ball_<?php echo $g?>',this)" class="aase aase_b" name="0"  />
                        </td>
                          <?php }?>
                          <td class="odds"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('19')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="a19">-</a><span id="b19" class="so"></span></td>
                          <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="d19">-</a></td>
                      </tr>
                      <tr align="center" >
                        <td class="red" id="n20">20</td>
                          <td class="odds" id="h20"></td>
                          <?php if ($oddsLock){?>
                          <td>
                            <input title="上調賠率" type="button" onclick="setodds('h20','Ball_<?php echo $g?>',this)" class="aase aase_a" name="1" />
                        </td>
						<td>							
                            <input title="下調賠率" type="button" onclick="setodds('h20','Ball_<?php echo $g?>',this)" class="aase aase_b" name="0"  />
                        </td>
                          <?php }?>
                          <td class="odds"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('20')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="a20">-</a><span id="b20" class="so"></span></td>
                          <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="d20">-</a></td>
                      </tr>	
</tbody>					  
                  </table>
                  <table border="0" cellspacing="0" class="t_odds" width="50%"  style="margin-left:8px;margin-top:5px;top:1px;">
                    <tr class="tr_top">
                        <td width="15%">號</td>
                          <td width="25%">賠率</td>
                          <?php if ($oddsLock){?><td width="6%" colspan="2">設置</td><?php }?>
                          <td>注額</td>
                          <td>虧盈</td>
                      </tr>
                      <tr align="center" >
                        <td class="ball_1" id="n21">大</td>
                          <td class="odds" id="h21"></td>
                          <?php if ($oddsLock){?>
                          <td>
                            <input title="上調賠率" type="button" onclick="setodds('h21','Ball_<?php echo $g?>',this)" class="aase aase_a" name="1" />
							</td>
							<td>
                            <input title="下調賠率" type="button" onclick="setodds('h21','Ball_<?php echo $g?>',this)" class="aase aase_b" name="0"  />
                        </td>
                          <?php }?>
                          <td class="odds"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('大')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="a21">-</a><span id="b21" class="so"></span></td>
                          <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="d21">-</a></td>
                      </tr>
                      <tr align="center" >
                        <td class="ball_1" id="n22">小</td>
                          <td class="odds" id="h22"></td>
                          <?php if ($oddsLock){?>
                          <td>
                            <input title="上調賠率" type="button" onclick="setodds('h22','Ball_<?php echo $g?>',this)" class="aase aase_a" name="1" />
							</td>
							<td>
                            <input title="下調賠率" type="button" onclick="setodds('h22','Ball_<?php echo $g?>',this)" class="aase aase_b" name="0"  />
                        </td>
                          <?php }?>
                          <td class="odds"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('小')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="a22">-</a><span id="b22" class="so"></span></td>
                          <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="d22">-</a></td>
                      </tr>
                      <tr align="center" >
                        <td class="ball_1" id="n23">單</td>
                          <td class="odds" id="h23"></td>
                          <?php if ($oddsLock){?>
                          <td>
                            <input title="上調賠率" type="button" onclick="setodds('h23','Ball_<?php echo $g?>',this)" class="aase aase_a" name="1" />
							</td>
							<td>							
                            <input title="下調賠率" type="button" onclick="setodds('h23','Ball_<?php echo $g?>',this)" class="aase aase_b" name="0"  />
                        </td>
                          <?php }?>
                          <td class="odds"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('單')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="a23">-</a><span id="b23" class="so"></span></td>
                          <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="d23">-</a></td>
                      </tr>
                      <tr align="center" >
                        <td class="ball_1" id="n24">雙</td>
                          <td class="odds" id="h24"></td>
                          <?php if ($oddsLock){?>
                          <td>
                            <input title="上調賠率" type="button" onclick="setodds('h24','Ball_<?php echo $g?>',this)" class="aase aase_a" name="1" />
							</td>
							<td>							
                            <input title="下調賠率" type="button" onclick="setodds('h24','Ball_<?php echo $g?>',this)" class="aase aase_b" name="0"  />
                        </td>
                          <?php }?>
                          <td class="odds"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('雙')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="a24">-</a><span id="b24" class="so"></span></td>
                          <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="d24">-</a></td>
                      </tr>
                      <tr align="center" >
                        <td class="ball_1" id="n25">尾大</td>
                          <td class="odds" id="h25"></td>
                          <?php if ($oddsLock){?>
                          <td>
                            <input title="上調賠率" type="button" onclick="setodds('h25','Ball_<?php echo $g?>',this)" class="aase aase_a" name="1" />
							</td>
							<td>							
                            <input title="下調賠率" type="button" onclick="setodds('h25','Ball_<?php echo $g?>',this)" class="aase aase_b" name="0"  />
                        </td>
                          <?php }?>
                          <td class="odds"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('wd')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="a25">-</a><span id="b25" class="so"></span></td>
                          <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="d25">-</a></td>
                      </tr>
                      <tr align="center" >
                        <td class="ball_1" id="n26">尾小</td>
                          <td class="odds" id="h26"></td>
                          <?php if ($oddsLock){?>
                          <td>
                            <input title="上調賠率" type="button" onclick="setodds('h26','Ball_<?php echo $g?>',this)" class="aase aase_a" name="1" />
							</td>
							<td>							
                            <input title="下調賠率" type="button" onclick="setodds('h26','Ball_<?php echo $g?>',this)" class="aase aase_b" name="0"  />
                        </td>
                          <?php }?>
                          <td class="odds"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('wx')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="a26">-</a><span id="b26" class="so"></span></td>
                          <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="d26">-</a></td>
                      </tr>
                      <tr align="center" >
                        <td class="ball_1" id="n27">合單</td>
                          <td class="odds" id="h27"></td>
                          <?php if ($oddsLock){?>
                          <td>
                            <input title="上調賠率" type="button" onclick="setodds('h27','Ball_<?php echo $g?>',this)" class="aase aase_a" name="1" />
							</td>
							<td>							
                            <input title="下調賠率" type="button" onclick="setodds('h27','Ball_<?php echo $g?>',this)" class="aase aase_b" name="0"  />
                        </td>
                          <?php }?>
                          <td class="odds"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('合數單')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="a27">-</a><span id="b27" class="so"></span></td>
                          <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="d27">-</a></td>
                      </tr>
                      <tr align="center" >
                        <td class="ball_1" id="n28">合雙</td>
                          <td class="odds" id="h28"></td>
                          <?php if ($oddsLock){?>
                          <td>
                            <input title="上調賠率" type="button" onclick="setodds('h28','Ball_<?php echo $g?>',this)" class="aase aase_a" name="1" />
							</td>
							<td>							
                            <input title="下調賠率" type="button" onclick="setodds('h28','Ball_<?php echo $g?>',this)" class="aase aase_b" name="0"  />
                        </td>
                          <?php }?>
                          <td class="odds"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('合數雙')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="a28">-</a><span id="b28" class="so"></span></td>
                          <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="d28">-</a></td>
                      </tr>
                      <tr align="center" >
                        <td class="ball_1" id="n29">東</td>
                          <td class="odds" id="h29"></td>
                          <?php if ($oddsLock){?>
                          <td>
                            <input title="上調賠率" type="button" onclick="setodds('h29','Ball_<?php echo $g?>',this)" class="aase aase_a" name="1" />
							</td>
							<td>							
                            <input title="下調賠率" type="button" onclick="setodds('h29','Ball_<?php echo $g?>',this)" class="aase aase_b" name="0"  />
                        </td>
                          <?php }?>
                          <td class="odds"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('東')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="a29">-</a><span id="b29" class="so"></span></td>
                          <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="d29">-</a></td>
                      </tr>
                      <tr align="center" >
                        <td class="ball_1" id="n30">南</td>
                          <td class="odds" id="h30"></td>
                          <?php if ($oddsLock){?>
                          <td>
                            <input title="上調賠率" type="button" onclick="setodds('h30','Ball_<?php echo $g?>',this)" class="aase aase_a" name="1" />
							</td>
							<td>							
                            <input title="下調賠率" type="button" onclick="setodds('h30','Ball_<?php echo $g?>',this)" class="aase aase_b" name="0"  />
                        </td>
                          <?php }?>
                          <td class="odds"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('南')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="a30">-</a><span id="b30" class="so"></span></td>
                          <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="d30">-</a></td>
                      </tr>
                      <tr align="center" >
                        <td class="ball_1" id="n31">西</td>
                          <td class="odds" id="h31"></td>
                           <?php if ($oddsLock){?>
                          <td>
                            <input title="上調賠率" type="button" onclick="setodds('h31','Ball_<?php echo $g?>',this)" class="aase aase_a" name="1" />
							</td>
							<td>							
                            <input title="下調賠率" type="button" onclick="setodds('h31','Ball_<?php echo $g?>',this)" class="aase aase_b" name="0"  />
                        </td>
                          <?php }?>
                          <td class="odds"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('西')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="a31">-</a><span id="b31" class="so"></span></td>
                          <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="d31">-</a></td>
                      </tr>
                      <tr align="center" >
                        <td class="ball_1" id="n32">北</td>
                          <td class="odds" id="h32"></td>
                           <?php if ($oddsLock){?>
                          <td>
                            <input title="上調賠率" type="button" onclick="setodds('h32','Ball_<?php echo $g?>',this)" class="aase aase_a" name="1" />
							</td>
							<td>							
                            <input title="下調賠率" type="button" onclick="setodds('h32','Ball_<?php echo $g?>',this)" class="aase aase_b" name="0"  />
                        </td>
                          <?php }?>
                          <td class="odds"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('北')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="a32">-</a><span id="b32" class="so"></span></td>
                          <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="d32">-</a></td>
                      </tr>
                      <tr align="center" >
                        <td class="ball_1" id="n33">中</td>
                          <td class="odds" id="h33"></td>
                           <?php if ($oddsLock){?>
                          <td>
                            <input title="上調賠率" type="button" onclick="setodds('h33','Ball_<?php echo $g?>',this)" class="aase aase_a" name="1" />
							</td>
							<td>							
                            <input title="下調賠率" type="button" onclick="setodds('h33','Ball_<?php echo $g?>',this)" class="aase aase_b" name="0"  />
                        </td>
                          <?php }?>
                          <td class="odds"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('中')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="a33">-</a><span id="b33" class="so"></span></td>
                          <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="d33">-</a></td>
                      </tr>
                      <tr align="center" >
                        <td class="ball_1" id="n34">發</td>
                          <td class="odds" id="h34"></td>
                           <?php if ($oddsLock){?>
                          <td>
                            <input title="上調賠率" type="button" onclick="setodds('h34','Ball_<?php echo $g?>',this)" class="aase aase_a" name="1" />
							</td>
							<td>							
                            <input title="下調賠率" type="button" onclick="setodds('h34','Ball_<?php echo $g?>',this)" class="aase aase_b" name="0"  />
                        </td>
                          <?php }?>
                          <td class="odds"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('發')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="a34">-</a><span id="b34" class="so"></span></td>
                          <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="d34">-</a></td>
                      </tr>
                      <tr align="center" >
                        <td class="ball_1" id="n35">白</td>
                          <td class="odds" id="h35"></td>
                           <?php if ($oddsLock){?>
                          <td>
                            <input title="上調賠率" type="button" onclick="setodds('h35','Ball_<?php echo $g?>',this)" class="aase aase_a" name="1" />
							</td>
							<td>							
                            <input title="下調賠率" type="button" onclick="setodds('h35','Ball_<?php echo $g?>',this)" class="aase aase_b" name="0"  />
                        </td>
                          <?php }?>
                          <td class="odds"><a href="CrystalIsNot.php?pid=<?php echo base64_encode('白')?>&tid=<?php echo base64_encode($types)?>" target="_blank" id="a35">-</a><span id="b35" class="so"></span></td>
                          <td class="odds"><a class="psp" onclick="GoPos(this,'1')" id="d35">-</a></td>
                      </tr>
                      <tr>
								<?php if ($oddsLock){?>
                        <td colspan="6" class="hbvgd">
                            <div>總投注額：<span class="ls" id="CountNum">0</span></div><br />
                              <div>最高虧損：<span class="ballr" id="CountLose">0</span></div><br />
                              <div>最高盈利：<span class="balls" id="CountWin">0</span></div>
                          </td>
								<?php }else{ ?>
                        <td colspan="4" class="hbvgd">
                            <div>總投注額：<span class="ls" id="CountNum">0</span></div><br />
                              <div>最高虧損：<span class="ballr" id="CountLose">0</span></div><br />
                              <div>最高盈利：<span class="balls" id="CountWin">0</span></div>
                          </td>
								<?php }?>	  
                      </tr>
                  </table>
                </td>
                <td width="1%" vAlign="top"><table border="0" cellspacing="0" class="t_odds" width="180" style="margin-left:-11px;margin-top:5px;top:1px;">
              <tr class="tr_top" align="center">
                  <td>總額：<span id="CountNums" class="ls">0</span></td>
                    <td width="30" colspan="2"><font color="#000000"><b>遺漏</b></font></td>
                </tr>
                <tr align="center">
                  <td class="zh" onclick="GoLocation('oddsFile.php?cid=1')">第一球<span class="odds">總</span>：<span class="ls" id="l1">0</span></td>
                    <td class="balls">01</td>				  
                    <td id="f1">0</td>
                </tr>
                <tr align="center">
                  <td class="zh" onclick="GoLocation('oddsFile.php?cid=2')">第二球<span class="odds">總</span>：<span class="ls" id="l2">0</span></td>
                    <td class="balls">02</td>                    
					<td id="f2">0</td>
                </tr>
                <tr align="center">
                  <td class="zh" onclick="GoLocation('oddsFile.php?cid=3')">第三球<span class="odds">總</span>：<span class="ls" id="l3">0</span></td>
                    <td class="balls">03</td>
					<td id="f3">0</td>
                </tr>
                <tr align="center">
                  <td class="zh" onclick="GoLocation('oddsFile.php?cid=4')">第四球<span class="odds">總</span>：<span class="ls" id="l4">0</span></td>
                    <td class="balls">04</td>
					<td id="f4">0</td>
                </tr>
                <tr align="center">
                  <td class="zh" onclick="GoLocation('oddsFile.php?cid=5')">第五球<span class="odds">總</span>：<span class="ls" id="l5">0</span></td>
                    <td class="balls">05</td>
					<td id="f5">0</td>
                </tr>
                <tr align="center">
                  <td class="zh" onclick="GoLocation('oddsFile.php?cid=6')">第六球<span class="odds">總</span>：<span class="ls" id="l6">0</span></td>
                    <td class="balls">06</td>
					<td id="f6">0</td>
                </tr>
                <tr align="center">
                  <td class="zh" onclick="GoLocation('oddsFile.php?cid=7')">第七球<span class="odds">總</span>：<span class="ls" id="l7">0</span></td>
                    <td class="balls">07</td>
					<td id="f7">0</td>
                </tr>
                <tr align="center">
                  <td class="zh" onclick="GoLocation('oddsFile.php?cid=8')">第八球<span class="odds">總</span>：<span class="ls" id="l8">0</span></td>
                    <td class="balls">08</td>
					<td id="f8">0</td>
                </tr>
                 <tr align="center">
                  <td class="zh" onclick="GoLocation('oddsFile_LH.php?cid=9')">總和大小：<span class="ls" id="l9">0</span></td>
                    <td class="balls">09</td>
					<td id="f9">0</td>
                </tr>
                <tr align="center">
                  <td class="zh" onclick="GoLocation('oddsFile_LH.php?cid=9')">總和單雙：<span class="ls" id="l10">0</span></td>
                    <td class="balls">10</td>
					<td id="f10">0</td>
                </tr>
                <tr align="center">
                  <td class="zh" onclick="GoLocation('oddsFile_LH.php?cid=9')">總尾大小：<span class="ls" id="l11">0</span></td>
                    <td class="balls">11</td>
					<td id="f11">0</td>
                </tr>
                <tr align="center">
                  <td class="zh" onclick="GoLocation('oddsFile_LH.php?cid=9')">龍&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;虎：<span class="ls" id="l12">0</span></td>
                    <td class="balls">12</td>
					<td id="f12">0</td>
                </tr>
                <tr align="center">
                  <td class="zh" onclick="GoLocation('oddsFile_LM.php?cid=10')">任&nbsp;&nbsp;選&nbsp;二：<span class="ls" id="l13">0</span></td>
                    <td class="balls">13</td>
					<td id="f13">0</td>
                </tr>
                <tr align="center">
                  <td class="zh" onclick="GoLocation('oddsFile_LM.php?cid=10')">選二連直：<span class="ls" id="l14">0</span></td>
                    <td class="balls">14</td>
					<td id="f14">0</td>
                </tr>
                <tr align="center">
                  <td class="zh" onclick="GoLocation('oddsFile_LM.php?cid=10')">選二連組：<span class="ls" id="l15">0</span></td>
                    <td class="balls">15</td>
					<td id="f15">0</td>
                </tr>
                <tr align="center">
                  <td class="zh" onclick="GoLocation('oddsFile_LM.php?cid=10')">任&nbsp;&nbsp;選&nbsp;三：<span class="ls" id="l16">0</span></td>
                    <td class="balls">16</td>
					<td id="f16">0</td>
                </tr>
                <tr align="center">
                  <td class="zh" onclick="GoLocation('oddsFile_LM.php?cid=10')">選三連直：<span class="ls" id="l17">0</span></td>
                    <td class="balls">17</td>
					<td id="f17">0</td>
                </tr>
                <tr align="center">
                  <td class="zh" onclick="GoLocation('oddsFile_LM.php?cid=10')">選三連組：<span class="ls" id="l18">0</span></td>
                    <td class="balls">18</td>
					<td id="f18">0</td>
                </tr>
                <tr align="center">
                  <td class="zh" onclick="GoLocation('oddsFile_LM.php?cid=10')">任&nbsp;&nbsp;選&nbsp;四：<span class="ls" id="l19">0</span></td>
                    <td class="ballr">19</td>
					<td id="f19">0</td>
                </tr>
                <tr align="center">
                  <td class="zh" onclick="GoLocation('oddsFile_LM.php?cid=10')">任&nbsp;&nbsp;選&nbsp;五：<span class="ls" id="l20">0</span></td>
                    <td class="ballr">20</td>
					<td id="f20">0</td>
                </tr>
            </table></td>
                <td width="1%" id="RR_DIV" vAlign="top"/><table border="0" cellspacing="0" class="t_odds" width="135" id="cl" style="margin-left:3px;margin-top:5px;top:1px;">
              <!-- <tr class="tr_top">
                  <th colspan="2">兩面長龍</th>
                </tr>
                <tr align="center">
                  <td class="uo">第一球-單</td>
                    <td class="fe">5期</td>
                </tr> -->
            </table></tr>
              </tr>
            </table>
          	<!-- end -->
          </td>
          <td class="r"></td>
        </tr><!--/content_body-->
        <tr>
          <td width="12"><img src="/Admin/temp/images/tab_18.gif" alt="" /></td>
            <td class="f" align="center">評價虧損：
            <input type="text" class="textb" id="Param" onkeyup="setMean(this)" value="<?php echo $Mean?>" />&nbsp;&nbsp;
            <input type="button" class="inputs" onclick="planning()" value="計算補貨" style="top: 0px; color: #7300aa; position: relative;" />&nbsp;&nbsp;
            <?php if ($oddsLock){?>
            <input type="button" class="inputs" value="還原賠率" onclick="initializes()" />&nbsp;&nbsp;&nbsp;&nbsp;
            設置調動幅度：<input type="text" class="texta" id="Ho" value="0.001" />
            <?php }?>
            </td>
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
<?php echo $HtmlPop?>
</body>
</html>