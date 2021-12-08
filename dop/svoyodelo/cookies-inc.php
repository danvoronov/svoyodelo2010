<?php 		function delCookie(){
		  	setcookie("proftid", "", time() - 3600*24*30*12, "/");
		  	setcookie("profthui", "", time() - 3600*24*30*12, "/") ;
		  	setcookie("daetoparol", "", time() - 3600*24*30*12, "/");
		}

 		$msg = '';	$dostp_c = false;	
 
 if (isset($_COOKIE['proftid']) and isset($_COOKIE['profthui']) and isset($_COOKIE['daetoparol']) and !empty($_COOKIE['proftid']) and !empty($_COOKIE['profthui']) and !empty($_COOKIE['daetoparol'])) {
	
	
	$unic = round($_COOKIE['proftid']);
					
 				if ((strlen($_COOKIE['profthui'])==32) and preg_match("/^[a-zA-Z0-9]+$/",$_COOKIE['daetoparol']) and (strlen($_COOKIE['daetoparol'])==40) and preg_match("/^[a-zA-Z0-9]+$/",$_COOKIE['daetoparol']) and escape_inj($_COOKIE['daetoparol']) and escape_inj($_COOKIE['profthui']) and ($unic > 0)) 	{  
 		   $query = @mysql_query("SELECT user_hash, kod_id, INET_NTOA(user_ip) FROM proft_maindata WHERE unic = ".$unic)or die("Couldn't SELECT ip information!"); 
 		   
 		   if (mysql_num_rows($query) == 1) { // такой пользователь есть в базе и он ОДНИ
 			   $userdata = mysql_fetch_array($query); 	  $kodid = $userdata['kod_id']; 
 				$result = @mysql_query("SELECT kod, used FROM  `proft_dostup_md5` WHERE  `id` = ".$kodid) or die("Couldn't SELECT user information!"); 
				if (mysql_num_rows($result) == 1 ) { // такой код есть в базе и он ОДНИ
					$row=mysql_fetch_array($result);
	 		   		$kodSha = $_COOKIE['daetoparol'];
	 		   				
	 		   		if(($row['used'] > 0) and (md5($kodSha) == $row['kod']) and ($userdata['user_hash'] == $_COOKIE['profthui']) and ($userdata['INET_NTOA(user_ip)'] == $_SERVER['REMOTE_ADDR'])) { 
	  		  				$dostp_c = true;	 
	  				}   // тут у нас тестовый вход
	  				elseif (($row['used'] == 3) and (md5($kodSha) == $row['kod']) and ($unic == 1000)) { 
	  		  				$dostp_c = true;	   							  						
	  				}  else // тут у нас кривые значения в куках
	    					{   delCookie();
	       		 				$msg = '<b>Ошибка</b> авторизации через cookies.';            
	       		 			}
			} // такого КОДА нет в базе
				else $msg = "Проблема с кодом доступа."; 
  		} // нет такого uin в базе 
    else  delCookie();  
        		
	} // тут должна быть когда куки есть но не те
 	else  delCookie();
  			
} // тут отсутсвие куко
 else  $msg = '<b>Замечание</b>: для правильной работы системы должны быть включены cookies.';
?>