<?php header("Content-type: text/html; charset=utf-8");
		include  $_SERVER['DOCUMENT_ROOT']."/dop/svoyodelo/noinj-inc.php"; 	
		
if (isset($_GET['k']) and (strlen($_GET['k'])==30) and (escape_inj ($_GET['k']))) { 
		$kod =mysql_escape_string(stripslashes($_GET['k']));
		require $_SERVER['DOCUMENT_ROOT']."/dop/connect-inc.php"; 		
		$result = @mysql_query("SELECT id, used,raz FROM proft_dostup_md5 WHERE `kod` = '".md5(sha1($kod))."'") or die("Couldn't SELECT information!"); 
		
		if (mysql_num_rows($result) == 1 ) {
			$row=mysql_fetch_array($result);
			if ($row['used'] == 0) {
				@mysql_query("UPDATE proft_dostup_md5  SET `raz` =".($row['raz']+1)." WHERE `id` = ". $row['id']) or die("Couldn't WRITE kod information!");	
				echo '<span style="color: green;">принят</span>.<input type=hidden name=kod  id="kod" value="'.$kod.'">';
			 } else echo 'код доступа уже использован <input type=password size=30 name=kod  id="kod" value=""  style="color: red;" class="text ui-widget-content ui-corner-all">'; 
		} else echo 'код доступа неправильный <input type=password size=30 name=kod  id="kod" value=""  style="color: red;" class="text ui-widget-content ui-corner-all">';
		
} else echo '<input type=password size=30 name=kod  id="kod" value=""  style="color: red;" class="text ui-widget-content ui-corner-all">';
?>