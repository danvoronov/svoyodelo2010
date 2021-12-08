<?php  header("Content-type: text/html; charset=utf-8"); 
require  $_SERVER['DOCUMENT_ROOT']."/dop/dostup-inc.php"; 	if ($dostp_c == false) die($msg);	 		
	$predment_name = array("1"=>  "<a onclick='return false'  style='color: white;  text-decoration:none; padding: 2px' title='Предмет труда «знаковые системы»'  >Ч-З</a>", "2"=>  "<a onclick='return false'  style='color: white;  text-decoration:none; padding: 2px' title='Предмет труда «природа»'  >Ч-П</a>", "3"=>  "<a onclick='return false'  style='color: white;  text-decoration:none; padding: 2px' title='Предмет труда «техника»'  >Ч-Т</a>", "4"=>  "<a onclick='return false'  style='color: white;  text-decoration:none; padding: 2px' title='Предмет труда «человек»'  >Ч-Ч</a>",  "5"=>  "<a onclick='return false'  style='color: white;  text-decoration:none; padding: 2px' title='Предмет труда «художственный образ»'>Ч-Х</a>");
	$cel_name = array("1"=>  "<a onclick='return false'  style='color: white;  text-decoration:none; padding: 2px'  title='Цель труда «гностика, познание»'>Г</a>", "2"=>  "<a onclick='return false'  style='color: white;  text-decoration:none; padding: 2px'  title='Цель труда «преобразование»'>П</a>", "3"=>  "<a onclick='return false'  style='color: white;  text-decoration:none; padding: 2px'  title='Цель труда «изобретение»'>И</a>" );
	$sposob_name = array("1"=>  "<a onclick='return false'  style='color: white;  text-decoration:none; padding: 2px'  title='Способ труда «ручной»'>Р</a>", "2"=>  "<a onclick='return false'  style='color: white;  text-decoration:none; padding: 2px'  title='Способ труда «машины с ручным управлением»'>М</a>", "3"=>  "<a onclick='return false'  style='color: white;  text-decoration:none; padding: 2px'  title='Способ труда «автоматы и приборы»'>А</a>", "4"=>  "<a onclick='return false'  style='color: white;  text-decoration:none; padding: 2px'  title='Способ труда «функциональный»'>Ф</a>" );
	$uslovia_name = array("1"=> "<a onclick='return false'  style='color: white;  text-decoration:none; padding: 2px' title='Условия труда «бытовые»' >Б</a>", "2"=> "<a onclick='return false'  style='color: white;  text-decoration:none; padding: 2px' title='Условия труда «на открытом воздухе»' >О</a>", "3"=> "<a onclick='return false'  style='color: white;  text-decoration:none; padding: 2px' title='Условия труда «необычные, специфические»' >Н</a>", "4"=> "<a onclick='return false'  style='color: white;  text-decoration:none; padding: 2px' title='Условия труда «материально и морально ответственные»' >М</a>");
	$pol_name = array("2" => "у", "0" => "ж", "1" => "м");
	$zdorov_name = array("1" => "-3", "2" => "-2", "3" => "-1", "4" => "Н", "5" => "+1", "6" => "+2", "7" => "+3");

function neat_trim_words($text, $counttext = 10, $delim='...', $sep = ' ') {
     $words = split($sep, $text);
     if ( count($words) > $counttext )
         $text = join($sep, array_slice($words, 0, $counttext)). $delim;
     return $text;
 }
 
function firsrtMaxKey($ar) {
	$max = max($ar);
	foreach($ar as $key => $value)
		if ($value == $max) {return $key; break;}
}
		
function format_profstring($profid, $flag = ''){
		global $pol, $zdorove, $pow, $aff, $ach,$formula1_values,$formula2_values,$formula3_values,$formula4_values,$predment_name, $sposob_name, $cel_name, $uslovia_name, $pol_name,$zdorov_name, $myprof, $profid_use;
 
		$insertText = mysql_query("SELECT `profession`, `predmet1`, `predmet2`, `predmet3`, `cel1`, `cel2`, `uslovia1`, `uslovia2`, `sredsto1`, `sredsto2`, `soderj`, `pol`, `zdorove`, `pow_req`, `aff_req`, `ach_req` FROM `proft_profdb_max` WHERE  `id` = ".$profid) or die('Что-то отвалилось в базе данных.');	
		
		$procentID = 0;
		if (mysql_num_rows($insertText) == 1 ) {
		$row=mysql_fetch_array($insertText);	
						
				$pol_koef = 1; if (($row['pol'] != 2) and ($pol != $row['pol'])) $pol_koef = 0.2;
				$zdorove_koef = 1; if (($zdorove - $row['zdorove']) < 0) $zdorove_koef = 1 + ($zdorove - $row['zdorove'])*3/20;
				$pow_koef = 1; if (($pow - $row['pow_req']) < 0) $pow_koef = 1 + ($pow - $row['pow_req'])/10;
				$aff_koef = 1; if (($aff - $row['aff_req']) < 0) $aff_koef = 1 + ($aff - $row['aff_req'])/10;
				$ach_koef = 1; if (($ach - $row['ach_req']) < 0) $ach_koef = 1 + ($ach - $row['ach_req'])/10;
					
					$procentID = round(($formula1_values[$row['predmet1']]/12+$formula1_values[$row['predmet2']]/12+$formula1_values[$row['predmet3']]/12 
					+ $formula2_values[$row['cel1']]/10+$formula2_values[$row['cel2']]/10 
					+ $formula3_values[$row['sredsto1']]/6+$formula4_values[$row['uslovia1']]/6
					+ $formula3_values[$row['sredsto2']]/6+$formula4_values[$row['uslovia2']]/6
					+ $pol_koef +$zdorove_koef
					+ $pow_koef + $aff_koef + $ach_koef	)/14*100, 2);			
				
				$podsv =  "";	 $owicol = "grey; text-decoration: none; font-size: 11pt;' onClick='load4base(".$profid.",0);'>Ошибка?</a>";					
			   	$prof_zapros = "профессия+".str_replace(" ", "+", $row['profession']);
			   	$yes = ($myprof == 0) ?  " <center><a  href='#' onClick='profvibor(".$profid.")' style='background-color: #FAFAD2; font-size: 20px; border-bottom: 1px dotted black; text-decoration: none;'>выбрать себе</a></center> ": ''; 
			   	if ($myprof == $profid) $podsv =  "background-color: #FAFAD2;";  
				if (in_array($profid, array_keys($profid_use))){
				  if ($profid_use[$profid] == 0) {
				  		$podsv =  "background-color: #C12267;";
				  		$owicol = "#C12267; text-decoration: none; cursor: default; font-size: 11pt;'>Проверим</a>";
				  		}}
				$blokwd = ($myprof == 0) ?  "490": "590"; 	
	   	
				$outstr = "<div style='float:left; width: 85px;'><b style='font-size: 16pt;'>".$procentID."</b>% <br/><a href='#' style='color: ".$owicol."</div><div style='float:left; width: 100px;'>".$yes."</div><div style='float:left; width: ".$blokwd."px; ".$podsv." margin: 0 5px;'  class='nosha'><a href='#' style='color: #d50505; font-size: 14pt; text-decoration: none;'  onClick='open_prgramma(".$profid.");'><b>".$row['profession']."</b></a>&nbsp;  <span style='background-color: #2a4977; -moz-border-radius-topleft: 8px;  -webkit-border-top-left-radius: 8px;  border-top-left-radius: 8px; -moz-border-radius-bottomleft: 8px; -webkit-border-bottom-left-radius: 8px; border-bottom-left-radius: 8px; '>&nbsp;</span><span style='background-color: #2a4977;'>".$predment_name[$row['predmet1']]."</span><span style='background-color: #2a4977;'>".$predment_name[$row['predmet2']]."</span><span style='background-color: #2a4977;'>".$predment_name[$row['predmet3']]."</span><span style='background-color: #50c878;'>".$cel_name[$row['cel1']]."</span><span style='background-color: #50c878;'>".$cel_name[$row['cel2']]."</span><span style='background-color: #C48793;'>".$sposob_name[$row['sredsto1']]."</span><span style='background-color: #C48793;'>".$cel_name[$row['sredsto2']]."</span><span style='background-color: #F88017;'>".$uslovia_name[$row['uslovia1']]."</span><span style='background-color: #F88017;'>".$cel_name[$row['uslovia2']]."</span><span style='background-color: #F88017; -moz-border-radius-topright: 8px;  -webkit-border-top-right-radius: 8px;  border-top-right-radius: 8px; -moz-border-radius-bottomright: 8px; -webkit-border-bottom-right-radius: 8px; border-bottom-right-radius: 8px; '>&nbsp;</span> &nbsp;".neat_trim_words($row['soderj'],15,"...")." <a href='http://www.google.com/search?q=".$prof_zapros."' target=_blank style='font-size: 9pt;'>Искать в google.com</a></div><div style='clear:both;'></div>";
				
			} // запрос вернул пустоту
		 	else $outstr = "Ничего  не найдена. Попробуйте по другому.<br>"; 

    return ($flag == '%') ? $procentID : $outstr;
}					


if(isset($_REQUEST['profn']) or isset($_REQUEST['search_req']) or isset($_REQUEST['vibor'])) { 
	$result = @mysql_query("SELECT * FROM  `proft_maindata` WHERE `unic` = ".$unic) or die('Щось у бази здохло');	$row=mysql_fetch_array($result);
	$pol =  $row['pol']; $zdorove =   $row['zdorove']; 
	$pow =$row['frml_0_1']; $aff = $row['frml_0_2']; $ach = $row['frml_0_3'];
	$myprof = $row['profid']; $kodid = $row['kod_id'];
// загоняем с базы даннх сюда значения				
		for ($i = 1; $i <= 5; $i++) $formula1_values[$i] = $row['frml_1_'.$i]; 				
		for ($i = 1; $i <= 3; $i++) $formula2_values[$i] = $row['frml_2_'.$i]; 				
		for ($i = 1; $i <= 4; $i++) $formula3_values[$i] = $row['frml_3_'.$i]; 		
		for ($i = 1; $i <= 4; $i++) $formula4_values[$i] = $row['frml_4_'.$i]; 
		$formula1 = firsrtMaxKey($formula1_values); 
			$predment_name[$formula1] = "<b>".$predment_name[$formula1]."</b>";
		$formula2 = firsrtMaxKey($formula2_values);
			$cel_name[$formula2] = "<b>".$cel_name[$formula2]."</b>";
		$formula3 = firsrtMaxKey($formula3_values);
		$formula4 = firsrtMaxKey($formula4_values);	
// загоняемы в нулевые 
			$formula1_values[0]  = max($formula1_values);
			$formula2_values[0]  = max($formula2_values);			
			$formula3_values[0]  = max($formula3_values);
			$formula4_values[0]  = max($formula4_values);

		$ugprof = mysql_query("SELECT `profid`, `unic`, `apr_state` FROM `proft_profdb_ug` WHERE  `unic` = ".$unic) or die('Что-то отвалилось в базе данных.');	

	$profid_use=array();	
	while($row_ugprof = mysql_fetch_assoc($ugprof)) 
		$profid_use[$row_ugprof['profid']] = $row_ugprof['apr_state'];	
	
}			
			
/// тута начинаеться ветвление			
			
if(isset($_REQUEST['json'])) { 
	$json = $_REQUEST['json']; if (!escape_inj ($json))  die("Айяйяй что за гадость?");
	$json = str_replace("\\", "", $json);
	$json_ar = json_decode($json, true);

	if (($unic == 777) or ($unic == 888)) {
		$query = '';
		foreach ($json_ar as $key => $inpParam) {		
			if (is_array($inpParam)){
				foreach ($inpParam as $i => $inpInParam){
					$query = $query."`".mysql_real_escape_string($key).($i+1)."` = ".mysql_real_escape_string($inpInParam).", ";
				}
			}
			elseif (($key != "message") and ($key != "profid") and ($key != "comments")) {					
					$query = $query."`".mysql_real_escape_string($key)."` = ";		
					is_numeric($inpParam) ? $s = "" : $s ="'";
					$query = $query." ".$s.mysql_real_escape_string($inpParam).$s.", ";
			} elseif ($key == "profid") $profid = round($inpParam);
		}

		@mysql_query("UPDATE `proft_profdb_max` SET `predmet2` = 0, `predmet3` = 0, `cel2` = 0, `sredsto2` = 0, `uslovia2` = 0 WHERE `id` =  ".$profid) or die("Couldn't WRITE information!");			
		@mysql_query("UPDATE `proft_profdb_max` SET ". substr($query,0,strlen($query)-2)." WHERE `id` =  ".$profid) or die("Couldn't WRITE information!");	
		echo  '{"message":"профессия № '.$json_ar['profid'].' - сохранено В БАЗУ."}'; 
			
	} else {
		$query1 = "(`unic`"; $query2 = "(".$unic;
		foreach ($json_ar as $key => $inpParam) {
			if (is_array($inpParam)){
				foreach ($inpParam as $i => $inpInParam){
					$query1 = $query1.", `".mysql_real_escape_string($key).($i+1)."`";
					$query2 = $query2.", ".mysql_real_escape_string($inpInParam);
				}
			}
			elseif ($key != "message") {
					$query1 = $query1.", `".mysql_real_escape_string($key)."`";
					is_numeric($inpParam) ? $s = "" : $s ="'";
					$query2 = $query2.", ".$s.mysql_real_escape_string($inpParam).$s;
			}
		}
		
		@mysql_query("INSERT INTO `proft_profdb_ug` ".$query1.") VALUES ".htmlspecialchars($query2).");") or die("Couldn't WRITE information!");	
		echo  '{"message":"профессия № '.$json_ar['profid'].' - обновление сохранено."}'; 
	}
			
} // тут запрос засунуть в форму данных из базы профессий
elseif(isset($_REQUEST['jsonload'])) {  
	$profid = round($_REQUEST['jsonload']); if ($profid  == 0)  die("Айяйяй что за гадость?");

	$profData = mysql_query("SELECT `predmet1`, `predmet2`, `predmet3`, `cel1`, `cel2`,`uslovia1`, `sredsto1`, `uslovia2`, `sredsto2` FROM `proft_profdb_max` WHERE `id` =".$profid) or die('Что-то отвалилось в базе данных.');		
	if (mysql_num_rows($profData) == 1 ) {
		$profRow=mysql_fetch_assoc($profData);
		$output_json_pr = '"predmet":["'.$profRow['predmet1'].'"';
		if (round ($profRow['predmet2']) > 0) $output_json_pr = $output_json_pr.',"'.$profRow['predmet2'].'"';
		if (round ($profRow['predmet3']) > 0) $output_json_pr = $output_json_pr.',"'.$profRow['predmet3'].'"';		
		$output_json_pr = $output_json_pr.']';	

		$output_json_cl = ', "cel":["'.$profRow['cel1'].'"';
		if (round ($profRow['cel2']) > 0) $output_json_cl = $output_json_cl.',"'.$profRow['cel2'].'"';	
		$output_json_cl = $output_json_cl.']';	
		$output_json_us = ', "uslovia":["'.$profRow['uslovia1'].'"';
		if (round ($profRow['uslovia2']) > 0) $output_json_us = $output_json_us.',"'.$profRow['uslovia2'].'"';	
		$output_json_us = $output_json_us.']';	
		$output_json_sr = ', "sredsto":["'.$profRow['sredsto1'].'"';
		if (round ($profRow['sredsto2']) > 0) $output_json_sr = $output_json_sr.',"'.$profRow['sredsto2'].'"';	
		$output_json_sr = $output_json_sr.']';	
						
		$profData = mysql_query("SELECT `profession`, `soderj`, `pol`, `zdorove`, `pow_req`, `aff_req`, `ach_req` FROM `proft_profdb_max` WHERE `id` =".$profid) or die('Что-то отвалилось в базе данных.');	if (mysql_num_rows($profData) == 1 ) {
			$profRow=mysql_fetch_assoc($profData);
			$output_json = '{"message":"профессия №'.$profid.' - загруженно.",'.$output_json_pr.$output_json_cl.$output_json_us.$output_json_sr.', "profid":"'.$profid;
			foreach ($profRow as $name => $param) $output_json = $output_json.'","'.$name.'":"'.$param;
			$output_json = $output_json.'"}';
		echo $output_json; 		
		} 
	}	else  echo  '{"message":"поиск элемента №'.$profid.' не дал результатов.","profid":"'.$profid.'","profession":"","soderj":"","pol":"","zdorove":"","predmet":[],"cel":[],"sredsto":[],"uslovia":[],"pow_req":"0","aff_req":"0","ach_req":"0"}'; 		
			
}  // тут поиск по базе
elseif (isset($_REQUEST['search_req'])) { 
	$req = trim($_REQUEST['search_req']); if (!escape_inj ($req))  die("Айяйяй что за гадость?");
	$req =mysql_escape_string(htmlspecialchars($req));	$insertText = mysql_query("SELECT id FROM `proft_profdb_max` WHERE `profession` LIKE '%".$req."%' OR `soderj` LIKE '%".$req."%' LIMIT 0,7" ) or die('Что-то отвалилось в базе данных.');	
		
		if (mysql_num_rows($insertText) != 0 ) {
			$utoc = ''; if (mysql_num_rows($insertText) == 7) $utoc = ' <i>(уточните запрос)</i>';
			$msgout = '<div align=center style="padding: 6px;">Первые '.mysql_num_rows($insertText).$utoc.' результатов:</div>';
			$i=1; while( $row=mysql_fetch_array($insertText) ) {				
				$msgout = $msgout."<div style='padding: 4px;'>".format_profstring($row['id'])."</div>"; $i++;
			}
			echo "<div style='padding: 10px;'>".$msgout."</div>";
						
		} // запрос вернул пустоту
		 	else echo "Запрос «".$req."» - ничего  не найдено. Переформулируйте запрос.<br>"; 
	
		 	
} // выбор професси под таким
elseif (isset($_REQUEST['vibor'])) {
	$vibor = round($_REQUEST['vibor']);  $procent = 0;
	if ($vibor == 0)	echo "<span style='font-size: 18px; color: grey;' >не выбранна!</span></span>";
		else {
			require $_SERVER['DOCUMENT_ROOT']."/dop/timing-inc.php"; setCurTime('profession',$unic);
			$result2 = @mysql_query("SELECT profession FROM  `proft_profdb_max` WHERE `id` =".$vibor); $row_proname=mysql_fetch_array($result2);	
			$procent =	format_profstring($vibor,'%');
			echo ("<div style='padding-top: 8px; text-align: center;'><a href='#'   style='font-size: 18pt; text-decoration:none;  color: #d50505;' onClick='open_prgramma(".$vibor.");'><b>".$row_proname['profession']."</b></a>.<sup><a href='#' onClick='profvibor(0);' style='color:grey; 	text-decoration:none; '>нет</a></sup><br/> Подходит вам на <b>".$procent."</b>%.</div></span>");	
			
	require  $_SERVER['DOCUMENT_ROOT']."/dop/mailer/swift_required.php"; 
	
	$result3 = @mysql_query("SELECT mail FROM  `proft_dostup_md5` WHERE  `id` = ".$kodid); 
	$row3=mysql_fetch_array($result3);
						 
			$transport = Swift_SmtpTransport::newInstance('mail.ukraine.com.ua', 25)
			  ->setUsername('robot@svoyodelo.com')
			  ->setPassword('Lcf979YTQaTWu6RAQJ3x')
			  ;
			$mailer = Swift_Mailer::newInstance($transport);
			$message = Swift_Message::newInstance('[svoyodelo.com] ваша профессия')
			  ->setFrom(array('robot@svoyodelo.com' => 'Электронный консультант СВОЁ ДЕЛО'))
			  ->setTo(array($row3['mail']))
			  ->setBody("Ваш номер анкеты ".$unic.". Вы выбрали профессию <b>".$row_proname['profession']."</b>, которая по оценке электронного консультанта подходит вам на <b>".$procent."</b>%.", 'text/html');		  
  
	$mailer->send($message);
  
			}		
				
		@mysql_query("UPDATE proft_maindata  SET `profid` ='".$vibor."', `profproc` ='".$procent."' WHERE `unic` = ".$unic) or die("Couldn't WRITE information!");
		@mysql_query("UPDATE proft_dostup_md5  SET `used` =3 WHERE `id` = '".$kodid."'") or die("Couldn't WRITE kod information!");		
							
} // нет тех параметров
elseif (isset($_REQUEST['profn'])) {
	if (round($_REQUEST['profn']) == 0) die("В базе нет такой профессии.");
	echo format_profstring(round($_REQUEST['profn']));
		
} // тут мы загружаем профграмму 
elseif (isset($_REQUEST['profid'])) {
	$profid= round($_REQUEST['profid']); if ($profid == 0) die("Проблемы с кодом доступа!");
	$result = @mysql_query("SELECT profession, soderj, znat, profkacestva,	medpokaz, id FROM  `proft_profdb_max` WHERE `id` = ".$profid) or die('Что-то отвалилося в базе данных.');
	if (mysql_num_rows($result) != 0 ) {
		$row=mysql_fetch_array($result);
		echo "<div style='padding: 5px 30px;'><center><h3 class='ui-widget-header ui-corner-all killmargins' style='font-size: 28px; 				-webkit-box-shadow: 0 0 7px rgba(153, 153, 153, 0.8); -moz-box-shadow: 0 0 7px rgba(153, 153, 153, 0.8); box-shadow: 0 0 7px rgba(153, 153, 153, 0.8);'>".$row['profession']."</h3></center>"; 		
			echo "<h2 style='padding-top:15px; 	text-shadow: rgba(153, 153, 153, 0) 0 1px 1px;'>Содержание</h2>".$row['soderj']."<br/><h2 style='padding-top:10px; 	text-shadow: rgba(153, 153, 153, 0) 0 1px 1px;'>Необходимые знания</h2>".$row['znat']."<h2 style='padding-top:10px; 	text-shadow: rgba(153, 153, 153, 0) 0 1px 1px;'>Профессионально важные качества</h2>".$row['profkacestva']."<br/><h2 style='padding-top:10px; 	text-shadow: rgba(153, 153, 153, 0) 0 1px 1px;'>Медицинские противопоказания</h2>".$row['medpokaz']."</div>";
	} else  echo "Информация не найдена.<br>"; 
} else exit("No parametros!");
?>