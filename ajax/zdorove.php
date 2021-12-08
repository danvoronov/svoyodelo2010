<?php header("Content-type: text/html; charset=utf-8");  
require  $_SERVER['DOCUMENT_ROOT']."/dop/dostup-inc.php"; 	if ($dostp_c == false) die($msg);	

if ((isset($_REQUEST['zd']) and (strlen($_REQUEST['zd']) == 1))) {
  	@mysql_query("UPDATE proft_maindata  SET `zdorove` =".round($_REQUEST['zd'])." WHERE `unic` = ".$unic) or die("Couldn't WRITE zdorove information!");
  	echo "msg: zd_save";
  }
  else  echo 'msg: zd_error';
?>