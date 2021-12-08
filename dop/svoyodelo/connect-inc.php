<? 	if(!mysql_connect("dan.mysql.ukraine.com.ua","dan_proft","Bmbhf6mpa246hgaMVb4v"))
			{		echo "<h2>Айль хозайн мы не можем найти серверу базов данних</h2>"; 		die();	}
	@mysql_select_db("dan_proft")  or die("Датабаза не выбирается");
	mysql_query("SET NAMES utf8");		
	ini_set('display_errors', '0');
?>