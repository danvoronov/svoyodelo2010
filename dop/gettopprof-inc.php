<?php  
		$pol =  $user['pol']; $zdorove =   $user['zdorove']; 
		
if (array_search(NULL, $user) > 0) {
	require "dop/timing-inc.php"; 	setCurTime('metafora',$unic);
	$result = @mysql_query("SELECT * FROM proft_otv WHERE `unic` = ".$unic) or die("Couldn't SELECT 5 information!"); if (mysql_num_rows($result) != 1) die('Проблема базы данных.');
	
	$row_test = mysql_fetch_array($result);	
	if (array_search(NULL, $row_test) > 0) die('В базе нет результатов тестов для использованого кода - так быть не должно!');

	for ($i = 1; $i <= 30; $i++) $test1[$i] = $row_test['test1_'.$i];
	for ($i = 1; $i <= 54; $i++) $test2[$i] = $row_test['test2_'.$i];
	for ($i = 1; $i <= 33; $i++) $test3[$i] = $row_test['test3_'.$i];   	
	 	
	function is_test_a($test_val) { if ($test_val == 0) return 1; else return 0;}; 	function is_test_b($test_val) { if ($test_val == 1) return 1; else return 0;};	
	
// тип мотивации
		$ind= $test1[1]+$test1[5]+$test1[8]+$test1[15]+$test1[20];
		$soc= $test1[3]+$test1[7]+$test1[12]+$test1[17];
		$plus= $test1[4]+$test1[9]+$test1[10]+$test1[14]+$test1[16]+$test1[19];
		$minus= $test1[2]+$test1[6]+$test1[11]+$test1[13]+$test1[18];
		
// метапрограммы
	 	$act_1= is_test_a($test3[2])+is_test_a($test3[6])+is_test_a($test3[11])+is_test_a($test3[16])+is_test_a($test3[17])+is_test_a($test3[20])+is_test_a($test3[25]);
	 	$refl_1= is_test_b($test3[2])+is_test_b($test3[6])+is_test_b($test3[11])+is_test_b($test3[16])+is_test_b($test3[17])+is_test_b($test3[20])+is_test_b($test3[25]);
	 	
	 	$k_2= is_test_a($test3[3])+is_test_a($test3[5])+is_test_a($test3[12])+is_test_a($test3[19])+is_test_a($test3[26])+is_test_a($test3[28])+is_test_a($test3[32]);
	 	$ot_2= is_test_b($test3[3])+is_test_b($test3[5])+is_test_b($test3[12])+is_test_b($test3[19])+is_test_b($test3[26])+is_test_b($test3[28])+is_test_b($test3[32]);	 
	 	    
	 	$in_3= is_test_a($test3[8])+is_test_a($test3[9])+is_test_a($test3[14])+is_test_a($test3[22])+is_test_a($test3[23])+is_test_a($test3[29])+is_test_a($test3[31]);
	 	$out_3= is_test_b($test3[8])+is_test_b($test3[9])+is_test_b($test3[14])+is_test_b($test3[22])+is_test_b($test3[23])+is_test_b($test3[29])+is_test_b($test3[31]);		

// структура мотивации субличностей	 	
	$ach= is_test_a($test3[1])+is_test_b($test3[4])+is_test_a($test3[10])+is_test_b($test3[13])+is_test_a($test3[18])+is_test_b($test3[21])+is_test_a($test3[27])+is_test_b($test3[30]);
	$ach = round(( $ach+ ( ($test1[9]+$test1[12]+$test1[29])*9/21 )-1 ) /2);
	// 1-7 - дает 3-21 - дает 0.85-9 с минусо -0.25 - 8 и дальше это и то что из теста даёт среднее
	
	$aff= is_test_b($test3[1])+is_test_a($test3[7])+is_test_a($test3[13])+is_test_b($test3[15])+is_test_b($test3[18])+is_test_a($test3[24])+is_test_a($test3[30])+is_test_b($test3[33]);
	$aff = round(( $aff+ ( ($test1[1]+$test1[15]+$test1[23])*9/21 )-1 ) /2);
	
	$pow= is_test_a($test3[4])+is_test_b($test3[7])+is_test_b($test3[10])+is_test_a($test3[15])+is_test_a($test3[21])+is_test_b($test3[24])+is_test_b($test3[27])+is_test_a($test3[33]);	 	
	$pow = round(( $pow+ ( ($test1[11]+$test1[14]+$test1[26])*9/21 )-1 ) /2);
	
// предмет труда
	$formula1_values[1]= is_test_b($test2[1])+is_test_b($test2[7])+is_test_a($test2[9])+is_test_b($test2[18])+is_test_a($test2[27])+is_test_b($test2[28])+is_test_b($test2[33])+is_test_b($test2[36])+is_test_b($test2[37])+is_test_b($test2[42])+is_test_a($test2[45])+is_test_b($test2[54]);
	
	$formula1_values[2]= is_test_a($test2[2])+is_test_b($test2[12])+is_test_a($test2[17])+is_test_a($test2[18])+is_test_a($test2[21])+is_test_b($test2[22])+is_test_a($test2[25])+is_test_a($test2[37])+is_test_a($test2[47])+is_test_a($test2[49])+is_test_b($test2[53])+is_test_a($test2[54]);
	
	$formula1_values[3]= is_test_a($test2[1])+is_test_b($test2[2])+is_test_a($test2[5])+is_test_b($test2[11])+is_test_b($test2[25])+is_test_a($test2[28])+is_test_b($test2[30])+is_test_a($test2[33])+is_test_a($test2[35])+is_test_a($test2[40])+is_test_b($test2[44])+is_test_b($test2[47]);
	
	$formula1_values[4]= is_test_b($test2[5])+is_test_a($test2[7])+is_test_a($test2[14])+is_test_b($test2[17])+is_test_b($test2[21])+is_test_a($test2[34])+is_test_b($test2[35])+is_test_a($test2[36])+is_test_b($test2[40])+is_test_a($test2[42])+is_test_b($test2[49])+is_test_a($test2[50]);
		
	$formula1_values[5]= is_test_b($test2[9])+is_test_a($test2[11])+is_test_a($test2[12])+is_test_b($test2[14])+is_test_a($test2[22])+is_test_b($test2[27])+is_test_a($test2[30])+is_test_b($test2[34])+is_test_a($test2[44])+is_test_b($test2[45])+is_test_b($test2[50])+is_test_a($test2[53]);

//	тип труда
	$formula2_values[1]= is_test_a($test2[3])+is_test_a($test2[10])+is_test_a($test2[13])+is_test_a($test2[16])+is_test_a($test2[20])+is_test_a($test2[23])+is_test_a($test2[26])+is_test_a($test2[29])+is_test_a($test2[31])+is_test_a($test2[43]);
	$formula2_values[2]= is_test_b($test2[3])+is_test_a($test2[6])+is_test_b($test2[10])+is_test_b($test2[13])+is_test_b($test2[16])+is_test_a($test2[18])+is_test_a($test2[38])+is_test_b($test2[43])+is_test_a($test2[46])+is_test_a($test2[52]);
	$formula2_values[3]= is_test_b($test2[6])+is_test_b($test2[18])+is_test_b($test2[20])+is_test_b($test2[23])+is_test_b($test2[26])+is_test_b($test2[29])+is_test_b($test2[31])+is_test_b($test2[38])+is_test_b($test2[46])+is_test_b($test2[52]);	

// способ труда	
	$formula3_values[1]= is_test_a($test2[8])+is_test_a($test2[11])+is_test_a($test2[39]);
		$formula3_values[1] = round(($formula3_values[1]*2 + $test1[21] - 1)/2);
	$formula3_values[2]= is_test_b($test2[11])+is_test_a($test2[15])+is_test_a($test2[41]);
		$formula3_values[2] = round(($formula3_values[2]*2 + $test1[24] - 1)/2);
	$formula3_values[3]= is_test_a($test2[24])+($test2[39])+is_test_b($test2[41]);
		$formula3_values[3] = round(($formula3_values[3]*2 + $test1[27] - 1)/2);
	$formula3_values[4]= is_test_b($test2[8])+is_test_b($test2[15])+is_test_b($test2[24]);	
		$formula3_values[4] = round(($formula3_values[4]*2 + $test1[30] - 1)/2);	
//	условия труда
	$formula4_values[1]= is_test_a($test2[4])+is_test_a($test2[48])+is_test_b($test2[49]);
		$formula4_values[1] = round(($formula4_values[1]*2 + $test1[22] - 1)/2);	
	$formula4_values[2]= is_test_a($test2[19])+is_test_a($test2[49])+is_test_a($test2[51]);
		$formula4_values[2] = round(($formula4_values[2]*2 + $test1[25] - 1)/2);	
	$formula4_values[3]= is_test_b($test2[19])+is_test_a($test2[32])+is_test_b($test2[48]);
		$formula4_values[3] = round(($formula4_values[3]*2 + $test1[28] - 1)/2);		
	$formula4_values[4]= is_test_b($test2[4])+is_test_b($test2[32])+is_test_b($test2[51]);		
		$formula4_values[4] = round(($formula4_values[4]*2 + $test1[3] - 1)/2);		
		
		$query = "UPDATE proft_maindata SET `motiv_vibora1` = ".$ind.", `motiv_vibora2` = ".$soc.", `motiv_vibora3` = ".$plus.", `motiv_vibora4` = ".$minus.", `metapr_1` = ".$act_1.", `metapr_2` = ".$k_2.", `metapr_3` = ".$in_3.", `frml_0_1` = ".$pow.", `frml_0_2` = ".$aff.", `frml_0_3` = ".$ach;
		for ($i = 1; $i <= 5; $i++) $query = $query.", `frml_1_".$i."` = ".$formula1_values[$i];
		for ($i = 1; $i <= 3; $i++) $query = $query.", `frml_2_".$i."` = ".$formula2_values[$i];
		for ($i = 1; $i <= 4; $i++) $query = $query.", `frml_3_".$i."` = ".$formula3_values[$i];
		for ($i = 1; $i <= 4; $i++) $query = $query.", `frml_4_".$i."` = ".$formula4_values[$i];		
		$query = $query."  WHERE `unic` = ".$unic;
		@mysql_query($query) or die("Couldn't WRITE 2 information!");			
		
		$result_user = @mysql_query("SELECT * FROM  `proft_maindata` WHERE  `unic` = ".$unic) or die("Couldn't SELECT 4 information!");	if (mysql_num_rows($result_user) != 1)  die('В базе данных нет такого пользователя.'); $user=mysql_fetch_array($result_user);
		
} // доложно быть в базе - читаем оттуда 	
else {
		$act_1 =$user['metapr_1']; $k_2 =$user['metapr_2']; $in_3 =$user['metapr_3'];
		$refl_1=7 - $act_1; 	$ot_2=	7 - $k_2;  	$out_3 = 7- $in_3;
		$ind =$user['motiv_vibora1']; $soc =$user['motiv_vibora2']; $plus =$user['motiv_vibora3']; $minus =$user['motiv_vibora4'];
		$pow =$user['frml_0_1']; $aff = $user['frml_0_2']; $ach = $user['frml_0_3'];
		for ($i = 1; $i <= 5; $i++) $formula1_values[$i] = $user['frml_1_'.$i]; 				
		for ($i = 1; $i <= 3; $i++) $formula2_values[$i] = $user['frml_2_'.$i]; 				
		for ($i = 1; $i <= 4; $i++) $formula3_values[$i] = $user['frml_3_'.$i]; 		
		for ($i = 1; $i <= 4; $i++) $formula4_values[$i] = $user['frml_4_'.$i]; 
}

// считаем позиции максимумов
function firsrtMaxKey($ar) {
	$max = max($ar);
	foreach($ar as $key => $value)
		if ($value == $max) {return $key; break;}
}

$formula1 = firsrtMaxKey($formula1_values); 
$formula2 = firsrtMaxKey($formula2_values);
$formula3 = firsrtMaxKey($formula3_values);
$formula4 = firsrtMaxKey($formula4_values);

// загоняемы в нулевые 
			$formula1_values[0]  = max($formula1_values);
			$formula2_values[0]  = max($formula2_values);			
			$formula3_values[0]  = max($formula3_values);
			$formula4_values[0]  = max($formula4_values);							

	$result = @mysql_query("SELECT id, predmet1, predmet2, predmet3, cel1, 	cel2, 	uslovia1,	sredsto1, uslovia2,	sredsto2, pol, zdorove, `pow_req`, `aff_req`, `ach_req` FROM  `proft_profdb_max` WHERE  (`predmet1` = ".$formula1." OR `predmet2` = ".$formula1." OR `predmet3` = ".$formula1.") AND (`cel1` = ".$formula2." OR `cel2` = ".$formula2.") AND (`pol` =2 OR `pol` =".$pol.") AND `zdorove` <= ".$zdorove." AND `pow_req` <= ".$pow." AND `aff_req` <= ".$aff." AND `ach_req` <= ".$ach) or die("Couldn't SELECT information!");
	if (mysql_num_rows($result) == 0) $result = @mysql_query("SELECT id, predmet1, predmet2, predmet3, cel1, 	cel2, 	uslovia1,	sredsto1, uslovia2,	sredsto2, pol, zdorove, `pow_req`, `aff_req`, `ach_req` FROM  `proft_profdb_max` WHERE  (`predmet1` = ".$formula1." OR `predmet2` = ".$formula1." OR `predmet3` = ".$formula1.") AND (`cel1` = ".$formula2." OR `cel2` = ".$formula2.") AND (`pol` =2 OR `pol` =".$pol.") AND `zdorove` <= ".$zdorove) or die("Couldn't SELECT information!");
	if (mysql_num_rows($result) == 0) $result = @mysql_query("SELECT id, predmet1, predmet2, predmet3, cel1, 	cel2, 	uslovia1,	sredsto1, uslovia2,	sredsto2, pol, zdorove, `pow_req`, `aff_req`, `ach_req` FROM  `proft_profdb_max` WHERE  (`predmet1` = ".$formula1." OR `predmet2` = ".$formula1." OR `predmet3` = ".$formula1.") AND (`cel1` = ".$formula2." OR `cel2` = ".$formula2.") AND (`pol` =2 OR `pol` =".$pol.")") or die("Couldn't SELECT information!");	
	
		if (mysql_num_rows($result) != 0) {	
		$i=1; while( $toformula=mysql_fetch_array($result) ) {
		
	// вот она магическая формула вычисления совместимости!
		$pol_koef = 1; if (($toformula['pol'] != 2) and ($pol != $toformula['pol'])) $pol_koef = 0.2;
		$zdorove_koef = 1; if (($zdorove - $toformula['zdorove']) < 0) $zdorove_koef = 1 + ($zdorove - $toformula['zdorove'])*3/20;
		$pow_koef = 1; if (($pow - $toformula['pow_req']) < 0) $pow_koef = 1 + ($pow - $toformula['pow_req'])/10;
		$aff_koef = 1; if (($aff - $toformula['aff_req']) < 0) $aff_koef = 1 + ($aff - $toformula['aff_req'])/10;
		$ach_koef = 1; if (($ach - $toformula['ach_req']) < 0) $ach_koef = 1 + ($ach - $toformula['ach_req'])/10;
			
			$procent[$toformula['id']] = round(($formula1_values[$toformula['predmet1']]/12+$formula1_values[$toformula['predmet2']]/12+$formula1_values[$toformula['predmet3']]/12 
			+ $formula2_values[$toformula['cel1']]/10+$formula2_values[$toformula['cel2']]/10 
			+ $formula3_values[$toformula['sredsto1']]/6+$formula4_values[$toformula['uslovia1']]/6
			+ $formula3_values[$toformula['sredsto2']]/6+$formula4_values[$toformula['uslovia2']]/6
			+ $pol_koef +$zdorove_koef
			+ $pow_koef + $aff_koef + $ach_koef	)/14*100, 2);
			$i++;
		} 
		
		arsort($procent);
		$ids = array_keys($procent);
		
		$rec_cont = (sizeof ($ids) < 4) ? sizeof ($ids) : 4;	
			$query = "UPDATE proft_maindata SET `recom1_nameid` = ".$ids[0].", `recom1_proc` = ".$procent[$ids[0]];
			for ($i = 2; $i <= $rec_cont; $i++) $query = $query.", `recom".$i."_nameid` = ".$ids[$i-1].", `recom".$i."_proc` = ".$procent[$ids[$i-1]];
			$query = $query."  WHERE `unic` = ".$unic;
				@mysql_query($query) or die("Couldn't WRITE RECOM information!");	
		
		$rec_cont = (sizeof ($ids) < 100) ? sizeof ($ids) : 100;	
		$profarr = "var profnm=new Array(".$ids[0];
		for ($i = 1; $i < $rec_cont; $i++) $profarr = $profarr.", ".$ids[$i];
		$profarr = $profarr.");";
	
	} else die ('Ошибка выборки из базы данных - обратитесь к администратору.');
	
?> 