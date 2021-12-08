<?php header("Content-type: text/html; charset=utf-8");
require  $_SERVER['DOCUMENT_ROOT']."/dop/dostup-inc.php"; 	if ($dostp_c == false) die($msg);	
require $_SERVER['DOCUMENT_ROOT']."/dop/timing-inc.php"; 

function json_decode_nice($json, $assoc = FALSE){
    $json = str_replace(array("\n","\r"),"",$json);
    $json = preg_replace('/([{,])(\s*)([^"]+?)\s*:/','$1"$3":',$json);
    return json_decode($json,$assoc);
}			

 $voprosi1 = array("1/30. Требует общения с разными людьми:", "2/30. Нравится моим родителям (близким):", "3/30. Предполагает высокое чувство ответственности:", "4/30. Требует переезда на новое место жительства:", "5/30. Соответствует моим способностям:", "6/30. Позволяет ограничиться уже имеющимися средствами:", "7/30. Дает возможность приносить пользу людям:", "8/30. Способствует умственному и физическому развитию:", "9/30. Является высокооплачиваемой:", "10/30. Позволяет работать близко от дома:", "11/30. Является сейчас престижной:", "12/30. Дает возможность стать мастером своего дела:", "13/30. Единственно возможная в моих жизненных обстоятельствах:", "14/30. Позволяет реализовать способности к руководящей работе:", "15/30. Является эмоционально привлекательной, нравится:", "16/30. Близка к любимому школьному предмету:", "17/30. Позволяет сразу получить хороший результат труда для других:", "18/30. Выбрана и моими друзьями:", "19/30. Позволяет использовать профессиональные умения вне работы:", "20/30. Дает большие возможности проявить творчество:", "21/30. Позволяет выполнять ручную работу:", "22/30. Дает возможность работать в помещение:", "23/30. Наличие дружелюбного сплоченного коллектива:", "24/30. Позволяет управлять разнообразными машинами:", "25/30. Дает возможность работать на открытом воздухе:", "26/30. Наличие у вас подчиненых:", "27/30. Позволяет следить за показаниями приборов и/или автоматов:", "28/30. Возможность испытывать себя работая в экстремальных условиях:", "29/30. Наличие интересных сложных задач:", "30/30. Зайдествует моё мышление, речь, мышечную координацию:");
 
 $poz = '0'; 
 
 if(isset($_REQUEST['json1'])) { 
	$json = $_REQUEST['json1']; if (!escape_inj ($json))  die('{"state":"Ахтунг - похоже на наезд. Доложили куда надо."}');
	$json = str_replace("\\", "", $json);
	$json_ar = json_decode_nice($json, true);
	$poz = round($json_ar['poz']);
	  if(isset($_REQUEST['p'])) $smesh = $poz -1;
	  	elseif(isset($_REQUEST['m'])) $smesh = $poz +1;
	  if ($poz < 0) $poz = 5; if ($poz > 5) $poz = 0; 
	
	$result = @mysql_query("SELECT unic FROM proft_otv WHERE `unic` = ".$unic) or die('{"state":"Не выбирается из базы."}'); if (mysql_num_rows($result) == 0) {
				setCurTime('test1_b',$unic);
				for ($i = 1; $i <= 5; $i++)	 $test1[$i] = round($json_ar['inp'.$i]);
				$query = "INSERT INTO proft_otv (unic";
				for ($i = 1; $i <= 5; $i++) $query = $query.",test1_".($i+$smesh*5);
					$query = $query.") VALUES('".$unic."'";
				for ($i = 1; $i <= 5; $i++) $query = $query.", '".$test1[$i]."'";		
					$query = $query.");";
		@mysql_query($query) or die('{"state":"Не пишется в базу."}');	
	} // если в базе уже есть запись для сохранения ответов 
	else {  $query = "UPDATE  proft_otv  SET `test1_".($smesh*5+1)."` = '".round($json_ar['inp1'])."'";
			  for ($i = 2; $i <= 5; $i++) $query = $query.", test1_".($i+$smesh*5)."= '".round($json_ar['inp'.$i])."'";				
			$query = $query."  WHERE `unic` = ".$unic;
			@mysql_query($query) or die('{"state":"Не пишется в базу."}');
	}	
}	
 
 		$result = @mysql_query("SELECT `test1_1`, `test1_2`, `test1_3`, `test1_4`, `test1_5`, `test1_6`, `test1_7`, `test1_8`, `test1_9`, `test1_10`, `test1_11`, `test1_12`, `test1_13`, `test1_14`, `test1_15`, `test1_16`, `test1_17`, `test1_18`, `test1_19`, `test1_20`, `test1_21`, `test1_22`, `test1_23`, `test1_24`, `test1_25`, `test1_26`, `test1_27`, `test1_28`, `test1_29`, `test1_30` FROM proft_otv WHERE `unic` = ".$unic) or die("Couldn't SELECT 5 information!"); $row_test = mysql_fetch_array($result);	
 		for ($i = 1; $i <= 30; $i++) {	
 			($row_test['test1_'.$i] == NULL) ?  $test1[$i] = 0 : $test1[$i] = $row_test['test1_'.$i];	}						
 				
  	if (in_array(0, $test1) == false) 
  		{$json_ans='{"state":"end1"}';  setCurTime('test1_e',$unic);}
  	else {
	  	$json_ans = '{"state":"ok1", "poz":"'. $poz.'"';
	  	for ($i = 1;  $i <=5;  $i++) 
	  	$json_ans = $json_ans.", ".'"nm'.$i.'":"'.$voprosi1[$poz*5+$i-1].'","inp'.$i.'":"'.$test1[$poz*5+$i].'"';	
	  	$json_ans = $json_ans.'}';
  	  	}
  	 	
  		echo $json_ans;
?>