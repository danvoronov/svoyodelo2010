<?php include  $_SERVER['DOCUMENT_ROOT']."/dop/dostup-inc.php"; 	if ($dostp_c == false) die($msg);	
		if (!(($unic == 777) or ($unic == 888))) die($msg);	

	if (isset($_REQUEST['no']))	{
		@mysql_query("UPDATE `proft_profdb_ug` SET `apr_state` =2 WHERE `id` =  ".round($_REQUEST['no'])) or die("Couldn't WRITE information!");	 
	echo "Запрос №". round($_REQUEST['no'])." - помеченно как отклонённый.<br/><br/>";}
	
	if (isset($_REQUEST['yes']))	{
		$yesid = round($_REQUEST['yes']);	
		@mysql_query("UPDATE `proft_profdb_ug` SET `apr_state` =1 WHERE `id` =  ".$yesid) or die("Couldn't WRITE information!");		
		$ugprof = mysql_query("SELECT * FROM `proft_profdb_ug` WHERE  `id` = ".$yesid) or die('Что-то отвалилось в базе данных.');	 $row_ugprof = mysql_fetch_assoc($ugprof);
				
		@mysql_query("UPDATE `proft_profdb_max` SET `profession`= '".$row_ugprof['profession']."', `predmet1`= ".$row_ugprof['predmet1'].", `predmet2`= ".$row_ugprof['predmet2'].", `predmet3`= ".$row_ugprof['predmet3'].", `cel1`= ".$row_ugprof['cel1'].", `cel2`= ".$row_ugprof['cel2'].", `uslovia1`= ".$row_ugprof['uslovia1'].", `uslovia2`= ".$row_ugprof['uslovia2'].", `sredsto1`= ".$row_ugprof['sredsto1'].", `sredsto2`= ".$row_ugprof['sredsto2'].", `soderj`= '".$row_ugprof['soderj']."', `pol`= ".$row_ugprof['pol'].", `zdorove`= ".$row_ugprof['zdorove'].", `pow_req`= ".$row_ugprof['pow_req'].", `aff_req`= ".$row_ugprof['aff_req'].", `ach_req`= ".$row_ugprof['ach_req']." WHERE  `id` = ".$row_ugprof['profid']) or die('Что-то отвалилось в базе данных.');	
	echo "Запрос №".$yesid." - записанно В БАЗУ.<br/><br/>";
	}	

		$ugprof = mysql_query("SELECT * FROM `proft_profdb_ug` WHERE  `apr_state` = 0") or die('Что-то отвалилось в базе данных.');	

	while($row_ugprof = mysql_fetch_assoc($ugprof)) {
			$insertText = mysql_query("SELECT `profession`, `predmet1`, `predmet2`, `predmet3`, `cel1`, `cel2`, `uslovia1`, `uslovia2`, `sredsto1`, `sredsto2`, `soderj`, `pol`, `zdorove`, `pow_req`, `aff_req`, `ach_req` FROM `proft_profdb_max` WHERE  `id` = ".$row_ugprof['profid']) or die('Что-то отвалилось в базе данных.');	
			if (mysql_num_rows($insertText) != 1 ) echo "Ошибка получения ".$row_ugprof['profid'];
			else { 	
				echo "[".$row_ugprof['id']."] <a href='#' onclick='load4base(".$row_ugprof['profid'].",0)'>".$row_ugprof['profid']." ".$row_ugprof['profession']."</a><br/>"; 
				$row=mysql_fetch_assoc($insertText);	
				foreach ($row as $key => $value)
				  if (($key != 'comments') and ($row_ugprof[$key] != $value))
					echo "  <b>".$key."</b>: ".(($key != 'soderj') ? $value." => ".$row_ugprof[$key] : '');
				}	
			echo '&nbsp;<a href="#" style="color: green;" onClick="modertoryes('.$row_ugprof['id'].');"><b>ДА</b> (безвозвратно) </a> &nbsp; <a href="#" style="color: red;" onClick="modertorno('.$row_ugprof['id'].');">нет</a><br/><i>'.$row_ugprof['comments']."</i><br/><br/>";
	}			
?>