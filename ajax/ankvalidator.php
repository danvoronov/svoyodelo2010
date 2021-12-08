<?php header("Content-type: text/html; charset=utf-8"); 
		include  $_SERVER['DOCUMENT_ROOT']."/dop/svoyodelo/noinj-inc.php"; 
		include  $_SERVER['DOCUMENT_ROOT']."/dop/svoyodelo/connect-inc.php"; 	

$unic_const = 1272844800; // сдвиг времени от May 03 2010 03:00 для генерации уника

$form_div='<div class="ui-corner-all" style="margin-top: 18px; padding: 4px; background-color: #FFE87C;"><span>Код доступа (<a href="#" onclick="'."$('#kupi_dialog').dialog('open')".';"><b>у вас нет?</b></a>):</span><span><input type=password size=30 name=kod  id="kod" value=""  style="color: red; font-size: 10pt" class="text ui-widget-content ui-corner-all"/></span></div>';

 if(isset($_REQUEST['n']) and isset($_REQUEST['f']) and isset($_REQUEST['g']) and isset($_REQUEST['vk']) and isset($_REQUEST['k']) and isset($_REQUEST['d']) and isset($_REQUEST['p']) and isset($_REQUEST['c'])) {  
 	if ((strlen($_REQUEST['n'])<=60) and (strlen($_REQUEST['f'])<=90)  and (strlen($_REQUEST['c'])<=100) and (strlen($_REQUEST['g'])<=100) and (strlen($_REQUEST['k'])==30) and (strlen($_REQUEST['vk'])<=10) and (strlen($_REQUEST['d'])<12) and (strlen($_REQUEST['d'])>7) and (strlen($_REQUEST['p'])==1) and escape_inj($_REQUEST['n']) and escape_inj($_REQUEST['f']) and escape_inj($_REQUEST['g']) and escape_inj($_REQUEST['k']) and escape_inj($_REQUEST['d']) and escape_inj($_REQUEST['c']) and escape_inj($_REQUEST['vk'])) 
 	{ 	 
		$kod =mysql_escape_string($_REQUEST['k']);
		
			$result = @mysql_query("SELECT id, used,raz FROM proft_dostup_md5 WHERE `kod` = '".md5(sha1($kod))."'") or die("Couldn't SELECT information!"); 
			
			if (mysql_num_rows($result) == 1 ) {
				$row=mysql_fetch_array($result);
				if ($row['used'] == 0) {	 // код есть и он девственно чист ;)
					do { 
						$unic = (date('U') - $unic_const)*10+mt_rand(1, 9); // генерим случайный UID
						$testresult = @mysql_query("SELECT id FROM proft_maindata WHERE `unic` = ".$unic) or die("Couldn't SELECT information!");
					} while (mysql_num_rows($testresult) != 0); 
					
					$query = "INSERT INTO proft_maindata (`vkid`, `unic` , `imia`, `familia` , `country` , `pol` , `kod_id` , `date_birth` , `city`) VALUES (".round($_REQUEST['vk']).", ".$unic.", '".mysql_real_escape_string(htmlspecialchars($_REQUEST['n']))."', '".mysql_real_escape_string(htmlspecialchars($_REQUEST['f']))."', '".mysql_real_escape_string(htmlspecialchars($_REQUEST['c']))."', '".round($_REQUEST['p'])."', '".$row['id']."', '".date("y/m/d", strtotime($_REQUEST['d']))."',  '".mysql_real_escape_string(htmlspecialchars($_REQUEST['g']))."');";
					@mysql_query($query) or die("Couldn't WRITE information!");
						
					@mysql_query("UPDATE proft_dostup_md5  SET `used` =1 WHERE `id` = ".$row['id']) or die("Couldn't WRITE kod information!");
					@mysql_query("INSERT INTO proft_testtime (`unic`, `regtime`) VALUES ('".$unic."', '".date('U')."');") or die("Couldn't WRITE 2 information!");	
					
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
        			setcookie("daetoparol", sha1($kod), time()+60*60*24*30,"/"); 
        													
					echo '<span style="color: black;"><a href="index.php" style="color: green; font-size: 34px;">Сохранено! Начинаем.</a>';	
					
					
											
				 } else { // если этот кодик уже кто попользовал то ==1 2 3
			 	echo $form_div.'<div align="center" style="font-size: 12px; padding-top: 5px;">Код доступа уже активирован: используйте вход для пользователей.</div>';						
				 	@mysql_query("UPDATE proft_dostup_md5  SET `raz` =".($row['raz']+1)." WHERE `id` = ". $row['id']) or die("Couldn't WRITE kod information!");	
				 	}
		} // кода в базе нема
		else echo $form_div.'<div align="center" style="font-size: 12px; padding-top: 5px;">Код доступа неправильный.</div>';
			
} // длины не совпадают или инджекция 
 else echo $form_div.'<div align="center" style="font-size: 12px; padding-top: 5px;">Ошибка передачи параметров: если повторяется обратитесь к администратору.</div>';
 } // переданы другие параметы
  elseif ((isset($_REQUEST['zd']) and (strlen($_REQUEST['zd']) == 1))) {
  	@mysql_query("UPDATE proft_maindata  SET `zdorove` =".round($_REQUEST['zd'])." WHERE `unic` = ".$unic) or die("Couldn't WRITE zdorove information!");
  	echo "zd_save";
  }
  else  echo $form_div.'<div align="center" style="font-size: 12px; padding-top: 5px;">Ошибка входящих данных.</div>';
?>