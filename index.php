<?php header("Content-type: text/html; charset=utf-8");  		
	require  $_SERVER['DOCUMENT_ROOT']."/dop/dostup-inc.php"; $msg = '';
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Электронный консультант «СВОЁ ДЕЛО» — каждый может | SvoyoDelo.com</title>
		<!--link rel='index' title='SvoyoDelo.com' href='http://www.svoyodelo.com' /-->
		<link rel="shortcut icon" href="favicon.ico" />
		<link type="text/css" href="css/Aristo/jquery-ui.css" rel="stylesheet" />
				<link type="text/css" href="css/jquery.jgrowl.css" rel="stylesheet" />
		<link type="text/css" href="css/main.css" rel="stylesheet" />
		<script src="js/jquery/jquery-1.4.2.min.js" type="text/javascript"></script>
		<script src="js/jquery/jquery-ui-1.8.js" type="text/javascript"></script>
		<script src="js/jquery/jquery.jgrowl_minimized.js" type="text/javascript"></script>
		<script src="js/jquery/jquery.watermarkinput.js" type="text/javascript"></script>
		<script type="text/javascript">
		$(function() {        $(".linkcopy").hover(function() { $(this).stop().animate({"opacity": "1"}, "slow"); },function() { $(this).stop().animate({"opacity": "0.3"}, "slow"); }); });
		</script>
<?	  if (isset($_REQUEST['logout'])){
 	delCookie(); header('Location: http://'.$_SERVER['HTTP_HOST'].'/');

} elseif 	($dostp_c ==true)	// куки пропускают
		{ 	require  $_SERVER['DOCUMENT_ROOT']."/mod/userpanel-inc.php"; }
		
  elseif(isset($_REQUEST['l']) and isset($_REQUEST['k'])) {  // есть входящие параметры
		$unic = round(trim($_REQUEST['l'])); 
		$prekod = trim($_REQUEST['k']); 
 		if (strlen($prekod) and preg_match("/^[a-zA-Z0-9]+$/",$prekod) and escape_inj($_REQUEST['l']) and escape_inj($prekod) and ($unic > 0))
 	{ 		$kodSha = sha1($prekod);

			$result = @mysql_query("SELECT kod_id FROM  `proft_maindata` WHERE  `unic` = ".$unic) or die("Couldn't SELECT 1 information!"); 
			if (mysql_num_rows($result) == 1 ) { 
				$row=mysql_fetch_array($result); 
				$result = @mysql_query("SELECT kod, used FROM  `proft_dostup_md5` WHERE  `id` = ".$row['kod_id']) or die("Couldn't SELECT 2 information!"); 
				
				if (mysql_num_rows($result) == 1 ) { // такой код есть в базе и он ОДНИ
					$row=mysql_fetch_array($result); 
					
				 if (($row['used'] > 0) and (md5($kodSha) == $row['kod'])) { // тут идет часть после авторизации	
					
					function generateCode($length) {  // функция загона случайной строки
					    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789"; 
					    $code = ""; $clen = strlen($chars) - 1;   
					    while (strlen($code) < $length) { $code .= $chars[mt_rand(0,$clen)]; } 
					    return $code; 
					}
					$hash = md5(generateCode(10)); 
					
				 	@mysql_query("UPDATE proft_maindata SET user_hash='".$hash."', user_ip=INET_ATON('".$_SERVER['REMOTE_ADDR']."') WHERE  `unic` = ".$unic) or die("База данных отвалилась!");
				 	
				 	setcookie("proftid", $unic, time()+60*60*24*30,"/"); 
        			setcookie("profthui", $hash, time()+60*60*24*30,"/"); 
        			setcookie("daetoparol", $kodSha, time()+60*60*24*30,"/");     			        			  					
        			require  $_SERVER['DOCUMENT_ROOT']."/mod/userpanel-inc.php";// тут у нас юзерпанел
			
				 } // код не совпадает или с ним проблемы		
				 else $msg = "Проблема с кодом доступа."; 			 
				} // такого КОДА нет в базе
				else $msg = "Проблема с кодом доступа."; 
			} // такого UIN нет в базе
			else  $msg = "Проблема с ID.";
	} // не правильно
	else $msg = "Неправильный ввод данных.";
} else $msg = "  ";

if ($msg != '') {
	require $_SERVER['DOCUMENT_ROOT']."/mod/index-inc.php";
}	 // тут если человек без куков 
?>
<div id="linkcopy-1" class="linkcopy">	
	<div style="margin-left: 26px; color: black;  font-size: 10pt;">&copy; <a style="font-size: inherit; 	text-decoration: none; color: black;" href="http://dan.kiev.ua/" target="_blank">Дан Воронов</a>, 2010.</div>
</div>
	<div style="float: left; display : none;">мы знаем, что вы будете делать ;)</div>
<div id="linkcopy-2" class="linkcopy">
	<div align="right">
	<span style="margin-right: 4px; background: url(images/vk.png) no-repeat left;"><a style="margin-left: 22px; 	text-decoration: none;		color: black;" href="http://vkontakte.ru/svoyodelo" target="_blank">Друг</a></span>
	<span style="margin-right: 3px; background: url(images/twi.png) no-repeat left;"><a style=" margin-left: 16px; 	text-decoration: none;		color: black;" href="http://twitter.com/svoyodelo" target="_blank">Микро</a></span>
	<span style="margin-right: 20px; background: url(images/lj.png) no-repeat left;"><a style="margin-left: 20px; 	text-decoration: none;		color: black;" href="http://svoyodelo.livejournal.com/" target="_blank">Блог</a></span>
	</div>
</div>
</div>  
    <div id="jGrowl" class="jGrowl bottom-right"></div>
<!-- UserEcho widget start -->
<script type='text/javascript'>
var ueJsHost = (('https:' == document.location.protocol) ? 'https://' : 'http://');
document.write(unescape("%3Cscript src='" + ueJsHost + "userecho.com/s/js/widget-1.2.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type='text/javascript'>
UE.Widget.init({
host:'userecho.com',
forum:'431',
lang:'ru',
tab_alignment:'left',
tab_text_color:'white',
tab_bg_color:'#7dc473',
tab_hover_color:'#045f20'
})
</script>
<!-- UserEcho widget end -->
</body></html>
