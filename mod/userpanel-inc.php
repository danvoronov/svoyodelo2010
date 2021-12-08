<script src="js/jquery/jquery.json-2.2.min.js" type="text/javascript"></script>
<script src="js/jquery/jquery.form.js"  type="text/javascript"></script>
<script type="text/javascript"><!-- 
	function getCookie(name) {
		var cookie = " " + document.cookie;
		var search = " " + name + "=";
		var setStr = null;
		var offset = 0;
		var end = 0;
		if (cookie.length > 0) {
			offset = cookie.indexOf(search);
			if (offset != -1) {
				offset += search.length;
				end = cookie.indexOf(";", offset)
				if (end == -1) {
					end = cookie.length;
				}
				setStr = unescape(cookie.substring(offset, end));
			}
		}
		return(setStr);
	}
	
	function changewallp(in_url){
	 if (in_url != "" && in_url != null) {
	 	$.jGrowl('Подождите. Загружаю '+in_url);
	 	document.cookie="wallpaper="+in_url+"; path=/; expires=Mon, 01-Jan-2013 00:00:00 GMT";
		$("#page").attr('src', in_url);
		}
	}
	
$(document).ready(function() {$("#page").attr('src', getCookie("wallpaper"));});
--></script> 
<?php 		
$result_testtime = @mysql_query("SELECT * FROM proft_testtime WHERE `unic` = ".$unic) or die("Couldn't SELECT 3 information!"); if (mysql_num_rows($result_testtime) != 1)  die('В базе данных нет такого пользователя.'); $row_from_testtime=mysql_fetch_array($result_testtime);
$result_user = @mysql_query("SELECT * FROM  `proft_maindata` WHERE  `unic` = ".$unic) or die("Couldn't SELECT 4 information!");	if (mysql_num_rows($result_user) != 1)  die('В базе данных нет такого пользователя.'); $user=mysql_fetch_array($result_user);
	
if ($row['used']  >= 2) { 	  
	require $_SERVER['DOCUMENT_ROOT']."/dop/gettopprof-inc.php";		
	require $_SERVER['DOCUMENT_ROOT']."/mod/js-userpanel-inc.php"; }
	else { ?>
<script src="js/testing.js" type="text/javascript"></script>
<script type="text/javascript"><!-- 
<? require $_SERVER['DOCUMENT_ROOT']."/dop/voprosi-inc.php"; 	?> 
$(function(){
	$("#hello").dialog({  modal: true, width: 500, draggable: false, autoOpen: <? if ($row_from_testtime['test1_b']  == 0) echo 	"true"; else echo "false";  ?>, show: 'slide', buttons: {   "Ок": function() {$(this).dialog("close");  }   }  });  		
  $('#open_test1').button({disabled: <? echo ((($user['zdorove']  != 0) and ($row['used']  == 1) and ($row_from_testtime['test1_e']  ==0) and ($row_from_testtime['test2_e']  ==0) and ($row_from_testtime['test3_e']  ==0)) ? "false" : "true") ?>}).click(function() { $("#dialog_test").dialog("open");});
  $('#open_test2').button({disabled: <? echo ((($user['zdorove']  != 0) and ($row['used']  == 1) and ($row_from_testtime['test1_e']  >0) and ($row_from_testtime['test2_e']  ==0) and ($row_from_testtime['test3_e']  ==0)) ? "false" : "true") ?>}).click(function() {  if (testPoz == 0) {$("#rd2").css("display","none"); $("#rd3").css("display","none"); $("#rd4").css("display","inline");  testnm = 2; testMax = 54;	 } $("#dialog_test2").dialog("open");}); 
  $('#open_test3').button({disabled: <? echo ((($user['zdorove']  != 0) and ($row['used']  == 1) and ($row_from_testtime['test1_e']  >0) and ($row_from_testtime['test2_e']  >0) and ($row_from_testtime['test3_e']  ==0)) ? "false" : "true") ?>}).click(function() { if (testPoz == 0) {$("#rd2").css("display","none"); $("#rd3").css("display","none"); $("#rd4").css("display","inline"); testnm = 3; testMax = 33; $("#dialog_test2").dialog( "option", "title",  "Правила тестирования №3");   	 $("#uslovia").html(test3usl); } $("#dialog_test2").dialog("open");}); 
});	 	<? if (($row_from_testtime['test1_e']  >0) and ($row_from_testtime['test2_e']  > 0) and ($row_from_testtime['test3_e']  >0)) {  ?>	
 	$(document).ready(function() { $("#nizblok_cont").load("metafori/prints.html");
 	$("#nizblok").fadeIn('slow'); 
});	 	<? } ?>  
--></script> 
<?	 } ?>
	 </head>
<body id="page_bg"><img id="page" onerror="this.onerror=null;$.jGrowl('Установленны обои по-умолчанию.');this.src='images/wallpaper.jpg';"/><noscript><div id="noscript-warning">Пожалуйста, включите Javascript в настроке браузера.<br/>Please turn on Javascript from browser options.</div></noscript>
<div  class="wraper">
		<div id="toplogo"><? echo $user['imia'],' ',$user['familia'],' (#',$unic,')'; ?></div>
		<div class="alpha-bg"></div>	<div class="shadow"></div>
		<div id="toppanel">
	<span style="float:left;"><a href="#" onClick="alert('Электронный консультант «СВОЁ ДЕЛО» \n Версия 3.1 \n Дан Воронов, 2010');"><img src="images/logo_mini.png" border="0"/></a></span>
	<span  style="float:left; margin-left: 10px;"><a href="/"><b>СВОЁ ДЕЛО</b></a></span>
	<? 	 if ($row['used']  >= 2) echo '<span  style="float:left; margin-left: 20px;"><a href="#" onclick=$("#recom_dialog").dialog("open");>Рекомендации</a></span>'; ?>
<span style="float:right; padding-right:1px;"><? 	 if (($unic == 777) or ($unic == 888))  
		 echo '<a style="font-size: 12pt; text-decoration:none;" href="#" onclick="'."$('#moderation').dialog('open')".';"><b>Модерация</b></a> &nbsp;&nbsp; '; ?><a href="#" onclick="changewallp(prompt('Введите адрес картинки в интернете:','images/wallpaper.jpg'));">Обои</a> &nbsp; <a href="index.php?logout=1" title="Покинуть систему" onClick="return confirm('Точно желаете покинуть систему?');">Выход</a></span>
	</div>
	<div id="data_drag">
	<div  id='profblok' class='bloki'><center>Ваша <b>профессия</b>:</center><hr class='hrline'/><span id='prof_name'>
<?	
	
if ($row['used']  >= 2) {	// тут выбор что будет выведенно			
	if ($user['profid'] == 0)	// вывод выбранной профессии или сообщения что ничего нет
		echo "<span style='font-size: 18px; color: grey;' >не выбранна!</span></span>";
		else {
			$result2 = @mysql_query("SELECT profession FROM  `proft_profdb_max` WHERE `id` =".$user['profid']); $row2=mysql_fetch_array($result2);		
			echo ("<div style='padding-top: 8px; text-align: center;'><a href='#'   style='font-size: 18pt; text-decoration:none;  color: #d50505;' onClick='open_prgramma(".$user['profid'].");'><b>".$row2['profession']."</b></a>.<sup><a href='#' onClick='profvibor(0);' style='color:grey; 	text-decoration:none; '>нет</a></sup><br/> Подходит вам на <b>".$user['profproc']."</b>%.</div></span>");	
				}		// закончился профблок

			echo "<div align=center style='margin-top: 30px;'><button id='open_topprof' style='font-size: 18px;' ".(($row_from_testtime['metafora']  > 0) ? "" : "disabled").">Подходящие вам<br/>професии</button></div><div align=center  style='margin-top: 20px;'><button id='open_prof' style='font-size: 18px'>Поиск профессий</button></div><div style='margin-top: 25px;' align=center><button id='open_print' style='font-size: 12px;' ".((($row['used']  == 3) and ($user['profid'] != 0)) ? "" : "disabled").">Скачать отчет в формате PDF</button></div></div>";	
		
		require $_SERVER['DOCUMENT_ROOT']."/mod/profile-userpanel-inc.php";			
		
	echo '<div id="hidediv" style="display : none; height: 1px; width: 1px;">';
	require $_SERVER['DOCUMENT_ROOT']."/mod/dbform-userpanel.html";
		 if (($unic == 777) or ($unic == 888))  
		 echo '<div id="moderation" title="Модерация изменений базы пользователями"><div id="moder_contener" style="padding: 20px;">Тут будет форма</div></div>';
?>
<div id="confirm" title="Комментарий о найденной ошибке">
<form><textarea rows="7" cols="21"  id="comments" name=comments class="dform text ui-widget-content ui-corner-all" style="font-size: 14pt;"></textarea> </form>
</div>

<div id="profgramma" title='Профессиограмма'><p  id="profgramma_contiener" class="nosha">Ждите...</p></div>

<div id="topprof" title='Подходящие вам профессии'>
	<div class="ui-corner-all slidercont"><div id="slider_tp" style="width: 96%; 	margin: 0 auto;"></div></div>
	<table border=0 cellpadding=0 cellspacing=0 width="100%"><tr><td valign = "middle" align=center width=40><div id='leftprof' style="height: 100px; padding-top: 65px;">&lt;</div></td>
		<td><div id="top_contiener" style="margin: 10px 0 4px;">
		<div style='margin: 16px; height: 64px;'><div id="loadnm0" style='float:left; color: grey; margin: 3px;'>№</div><div id="load0"></div></div>
		<div style='margin: 16px; height: 64px;'><div  id="loadnm1" style='float:left; color: grey; margin: 3px;'>№</div><div id="load1"></div></div>
		<div style='margin: 16px; height: 64px;'><div  id="loadnm2" style='float:left; color: grey; margin: 3px;'>№</div><div id="load2"></div></div>
		<div style='margin: 16px; height: 64px;'><div  id="loadnm3" style='float:left; color: grey; margin: 3px;'>№</div><div id="load3"></div></div>
		<div style='margin: 16px; height: 64px;'><div  id="loadnm4" style='float:left; color: grey; margin: 3px;'>№</div><div id="load4"></div></div>
		</div></td>
	<td valign = "middle" align="center" width=40><div id='rightprof' style="height: 100px; padding-top: 65px;">&gt;</div></td></tr></table>
</div> 

<div id="prof_search" title="Поиск профессии">
	<form action="" onsubmit="return false;">
	<div style="margin-top: 8px; float: left; padding-left: 50px; "><INPUT class="ui-widget-content ui-corner-all" size=40 style="font-size: 24px;" TYPE=text id='profsearch' VALUE=''></div><div style="float:left; margin-top: 7px; margin-left: -8px;"><button id='profsebt'>Поиск</button></div>
	</form>
		<div id="infoId" style="clear: both;"><div style="font-size: 16pt; padding: 12px; "  class="nosha">Введите любое слово из названия или описания профессии.</div></div> <!-- будут данные, полученные с сервера -->
</div>

<div id="welcome" title="База данных профессиограмм">
	<div class='ui-widget-content ui-corner-all'><p style="font-size: 18pt; padding: 20px;" >По результатам ваших ответов электронный консультант оценил вероятность совместимости с каждой из профессий. </p>
	<center style="font-size: 10pt; padding: 10px;" class="nosha">В нашей базе нет и не может быть абсолютно всех профессиограм (сейчас <? 	$handle = @mysql_query("select count(1) from proft_profdb_max");	$tmp  = mysql_fetch_array($handle); echo $tmp[0]?>). Поэтому вы всегда можете найти себе более экзотическое занятие.</center>
	</div>
</div>

</div>

<?	 } // если только зашел  used=1 - выводить тестирование
	else { require "mod/testing-userpanel-inc.php";  } ?>
	
</div><div style="clear: both; height: 150px;">&nbsp;</div>