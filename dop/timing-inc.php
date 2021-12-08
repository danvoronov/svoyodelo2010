<?php  
	function setCurTime($field_name, $unic_in) {
			$result_time = @mysql_query("SELECT ".$field_name.", regtime FROM  `proft_testtime` WHERE `unic` = ".$unic_in );
			$row_time=mysql_fetch_array($result_time);
			if ($row_time[$field_name] == 0) {	
				@mysql_query("UPDATE proft_testtime  SET `".$field_name."` ='".(date('U')-$row_time['regtime'])."' WHERE `unic` = ".$unic_in) or die("Couldn't WRITE timing information!");	
				return true;			
			} else return false;
}
?>