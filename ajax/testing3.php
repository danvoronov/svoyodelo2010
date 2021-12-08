<?php header("Content-type: text/html; charset=utf-8");
include  $_SERVER['DOCUMENT_ROOT']."/dop/dostup-inc.php"; 	if ($dostp_c == false) die('{"state":"'.$msg.'"}');
		
  	$result = @mysql_query("SELECT test1_e, test2_e FROM `proft_testtime` WHERE `unic` = ".$unic) or die('{"state":"Ошибка!"}'); $row_time = mysql_fetch_array($result); 
  	if (mysql_num_rows($result) == 0) 	die('{"state":"Ошибка!"}');	
	if (($row_time["test1_e"] == 0) or ($row_time["test2_e"] == 0)) die('{"state":"Третий тест идет после прохождения первого и второго!"}');
	
	require $_SERVER['DOCUMENT_ROOT']."/dop/timing-inc.php";	
	 $json_ans ='{"state":"Ошибка параметров!"}'; 	
 
if (isset($_REQUEST['nm']) and isset($_REQUEST['o1']) and isset($_REQUEST['o2']) and isset($_REQUEST['o3'])) { 
	if (round($_REQUEST['o1'] < 0) or round($_REQUEST['o1'] > 1)) die('{"state":"Неправильный ввод даных 1 - '.round($_REQUEST['o1']).'."}');	
	if (round($_REQUEST['o2'] < 0) or round($_REQUEST['o2'] > 1)) die('{"state":"Неправильный ввод даных 2 - '.round($_REQUEST['o2']).'."}');	
	if (round($_REQUEST['o3'] < 0) or round($_REQUEST['o3'] > 1)) die('{"state":"Неправильный ввод даных 3 - '.round($_REQUEST['o3']).'."}');	
	$nomer = round($_REQUEST['nm']);	
	if (($nomer <= 0) or ($nomer > 33)) die('{"state":"Неправильный номер вопроса."}');	
		
		$result = @mysql_query("SELECT unic, `test3_".($nomer-2)."`,`test3_".($nomer-1)."`,`test3_".$nomer."` FROM proft_otv WHERE `unic` = ".$unic) or die('{"state":"Что-то не то с нашей базей данных."}'); 
		if (mysql_num_rows($result) == 0) 	die('{"state":"Ошибка!"}');	
		$row_test = mysql_fetch_array($result);	
		if ($row_test["test3_".($nomer-2)] != NULL) 	die('{"state":"В базе уже есть ответ '.($nomer-2).'"}');
		if ($row_test["test3_".($nomer-1)] != NULL) 	die('{"state":"В базе уже есть ответ '.($nomer-1).'"}');
		if ($row_test["test3_".($nomer)] != NULL) 	die('{"state":"В базе уже есть ответ '.($nomer).'"}');
								
		@mysql_query("UPDATE  proft_otv  SET `test3_".($nomer-2)."` = ".round($_REQUEST['o1']).", `test3_".($nomer-1)."` = ".round($_REQUEST['o2']).", `test3_".$nomer."` = ".round($_REQUEST['o3'])."  WHERE `unic` = ".$unic) or die('{"state":"Что-то не то с нашей базей данных."}');
			
		if ($nomer ==3) setCurTime('test3_b',$unic); $json_ans = '{"state":"Тест 3: сохранено."}';
}	

			$result = @mysql_query("SELECT `test3_1`, `test3_2`, `test3_3`, `test3_4`, `test3_5`, `test3_6`, `test3_7`, `test3_8`, `test3_9`, `test3_10`, `test3_11`, `test3_12`, `test3_13`, `test3_14`, `test3_15`, `test3_16`, `test3_17`, `test3_18`, `test3_19`, `test3_20`, `test3_21`, `test3_22`, `test3_23`, `test3_24`, `test3_25`, `test3_26`, `test3_27`, `test3_28`, `test3_29`, `test3_30`, `test3_31`, `test3_32`, `test3_33` FROM proft_otv WHERE `unic` = ".$unic) or die('{"state":"Что-то не то с нашей базей данных."}'); 		if (mysql_num_rows($result) == 0) 	die('{"state":"Ошибка!"}');	
			$row_test = mysql_fetch_array($result);		
		for ($i = 1; $i <= 33; $i++) $test3[$i] = $row_test['test3_'.$i];	
			
 if(isset($_REQUEST['getpoz'])) 
 	$json_ans = array_search(NULL, $test3);
 	elseif (in_array(NULL, $test3) == false) 
  			{$json_ans='{"state":"end3"}';  setCurTime('test3_e',$unic);
  			
  			$result = @mysql_query("SELECT test1_e, test2_e,test3_e FROM `proft_testtime` WHERE `unic` = ".$unic) or die('{"state":"Ошибка!"}'); if (mysql_num_rows($result) == 0) 	die('{"state":"Ошибка!"}');
  			 $row_test = mysql_fetch_array($result);	
  			
		if (($row_test["test1_e"] > 0) and ($row_test["test2_e"] > 0) and ($row_test["test3_e"] > 0)){ @mysql_query("UPDATE proft_dostup_md5  SET `used` =2 WHERE `id` = '".$userdata['kod_id']."'") or die('{"state":"Ошибка!"}');
  			
  			}
}
  		 	 	
echo $json_ans;
?>