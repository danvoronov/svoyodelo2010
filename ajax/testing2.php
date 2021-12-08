<?php header("Content-type: text/html; charset=utf-8");
require  $_SERVER['DOCUMENT_ROOT']."/dop/dostup-inc.php"; 	if ($dostp_c == false) die('{"state":"'.$msg.'"}');	

  	$result = @mysql_query("SELECT test1_e FROM `proft_testtime` WHERE `unic` = ".$unic) or die('{"state":"Ошибка!"}'); $row_time = mysql_fetch_array($result); 
  	if (mysql_num_rows($result) == 0) 	die('{"state":"Ошибка!"}');	
	if ($row_time["test1_e"] == 0) die('{"state":"Второй тест идет после прохождения первого!"}');

		require $_SERVER['DOCUMENT_ROOT']."/dop/timing-inc.php";	
	 $json_ans ='{"state":"Ошибка параметров!"}'; 	
 
 if(isset($_REQUEST['nm']) and isset($_REQUEST['o1']) and isset($_REQUEST['o2']) and isset($_REQUEST['o3'])) { 
	if (round($_REQUEST['o1'] < 0) or round($_REQUEST['o1'] > 1)) die('{"state":"Неправильный ввод даных 1 - '.round($_REQUEST['o1']).'."}');	
	if (round($_REQUEST['o2'] < 0) or round($_REQUEST['o2'] > 1)) die('{"state":"Неправильный ввод даных 2 - '.round($_REQUEST['o2']).'."}');	
	if (round($_REQUEST['o3'] < 0) or round($_REQUEST['o3'] > 1)) die('{"state":"Неправильный ввод даных 3 - '.round($_REQUEST['o3']).'."}');	
	$nomer = round($_REQUEST['nm']);	
	if (($nomer <= 0) or ($nomer > 54)) die('{"state":"Неправильный номер вопроса."}');	
		
		$result = @mysql_query("SELECT unic, `test2_".($nomer-2)."`,`test2_".($nomer-1)."`,`test2_".$nomer."` FROM proft_otv WHERE `unic` = ".$unic) or die('{"state":"Что-то не то с нашей базей данных."}'); 
		if (mysql_num_rows($result) == 0) 	die('{"state":"Ошибка!"}');	
		$row_test = mysql_fetch_array($result);	
		if ($row_test["test2_".($nomer-2)] != NULL) 	die('{"state":"Не сохранено. В базе уже есть ответ '.($nomer-2).'"}');
		if ($row_test["test2_".($nomer-1)] != NULL) 	die('{"state":"Не сохранено. В базе уже есть ответ '.($nomer-1).'"}');
		if ($row_test["test2_".($nomer)] != NULL) 	die('{"state":"Не сохранено. В базе уже есть ответ '.($nomer).'"}');
												
		@mysql_query("UPDATE  proft_otv  SET `test2_".($nomer-2)."` = ".round($_REQUEST['o1']).", `test2_".($nomer-1)."` = ".round($_REQUEST['o2']).", `test2_".$nomer."` = ".round($_REQUEST['o3'])."  WHERE `unic` = ".$unic) or die('{"state":"Что-то не то с нашей базей данных."}');
			
		if ($nomer ==3) setCurTime('test2_b',$unic);	
		$json_ans = '{"state":"Тест 2: сохранено."}';
}	

			$result = @mysql_query("SELECT `test2_1`, `test2_2`, `test2_3`, `test2_4`, `test2_5`, `test2_6`, `test2_7`, `test2_8`, `test2_9`, `test2_10`, `test2_11`, `test2_12`, `test2_13`, `test2_14`, `test2_15`, `test2_16`, `test2_17`, `test2_18`, `test2_19`, `test2_20`, `test2_21`, `test2_22`, `test2_23`, `test2_24`, `test2_25`, `test2_26`, `test2_27`, `test2_28`, `test2_29`, `test2_30`, `test2_31`, `test2_32`, `test2_33`, `test2_34`, `test2_35`, `test2_36`, `test2_37`, `test2_38`, `test2_39`, `test2_40`, `test2_41`, `test2_42`, `test2_43`, `test2_44`, `test2_45`, `test2_46`, `test2_47`, `test2_48`, `test2_49`, `test2_50`, `test2_51`, `test2_52`, `test2_53`, `test2_54` FROM proft_otv WHERE `unic` = ".$unic) or die('{"state":"Что-то не то с нашей базей данных."}'); 		if (mysql_num_rows($result) == 0) 	die('{"state":"Ошибка!"}');	
			$row_test = mysql_fetch_array($result);		
		for ($i = 1; $i <= 54; $i++) $test2[$i] = $row_test['test2_'.$i];	
 
 if(isset($_REQUEST['getpoz'])) 
 	$json_ans = array_search(NULL, $test2);
 	elseif (in_array(NULL, $test2) == false) 
  		{$json_ans='{"state":"end2"}';  setCurTime('test2_e',$unic);}
 	 	
echo $json_ans;
?>