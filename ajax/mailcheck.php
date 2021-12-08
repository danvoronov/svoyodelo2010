<?php header("Content-type: text/html; charset=utf-8");
		include  $_SERVER['DOCUMENT_ROOT']."/dop/svoyodelo/noinj-inc.php"; 
		include  $_SERVER['DOCUMENT_ROOT']."/dop/svoyodelo/connect-inc.php"; 
				
		$mailform = '<form name="email_form" action="" onsubmit="return false;"><div style="padding: 10px 0 40px; font-size: 1.2em">Для получения кода введите существующий адрес e-mail:<br/><input type=text size=20 name=email id="email" value="'.trim($_REQUEST['mail']).'" class="ui-corner-all" style="width: 98%"/></div><div style="float:left; width: 142px; padding-top: 48px;">Символы <br/>на картинке:</div><div style="float:left; width: 210px;">&nbsp;<img src="capt/ca-image.php?nocache=<?php echo md5(time()); ?>" border="0">  <input id="onlylu" name="onlylu" type="text" class="ui-corner-all" style="width: 200px; font-size: 33pt;"></div></form><br/><span style="color: red;">';

include($_SERVER['DOCUMENT_ROOT']."/capt/ca-function.php");
session_start();

if (!captcha_verify_word()) die ($mailform."Неправильно введёные символы!</span>");		

if (isset($_REQUEST['mail']) and (strlen(trim($_REQUEST['mail']))>=6) and (escape_inj ($_REQUEST['mail']))) { 
			function validEmail($email)
			{
			   $isValid = true;
			   $atIndex = strrpos($email, "@");
			   if (is_bool($atIndex) && !$atIndex)
			   {
			      $isValid = false;
			   }
			   else
			   {
			      $domain = substr($email, $atIndex+1);
			      $local = substr($email, 0, $atIndex); 
			      $localLen = strlen($local);
			      $domainLen = strlen($domain);
			      if ($localLen < 1 || $localLen > 64)
			      {
			         // local part length exceeded
			         $isValid = false;
			      }
			      else if ($domainLen < 1 || $domainLen > 255)
			      {
			         // domain part length exceeded
			         $isValid = false;
			      }
			      else if ($local[0] == '.' || $local[$localLen-1] == '.')
			      {
			         // local part starts or ends with '.'
			         $isValid = false;
			      }
			      else if (preg_match('/\\.\\./', $local))
			      {
			         // local part has two consecutive dots
			         $isValid = false;
			      }
			      else if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain))
			      {
			         // character not valid in domain part
			         $isValid = false;
			      }
			      else if (preg_match('/\\.\\./', $domain))
			      {
			         // domain part has two consecutive dots
			         $isValid = false;
			      }
			      else if
			(!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/',
			                 str_replace("\\\\","",$local)))
			      {
			         // character not valid in local part unless 
			         // local part is quoted
			         if (!preg_match('/^"(\\\\"|[^"])+"$/',
			             str_replace("\\\\","",$local)))
			         {
			            $isValid = false;
			         }
			      }
			      if ($isValid && !(checkdnsrr($domain,"MX") || checkdnsrr($domain,"A")))
			      {
			         // domain not found in DNS
			         $isValid = false;
			      }
			   }
			   return $isValid;
			}  
  
		$email_address =mysql_escape_string(stripslashes($_REQUEST['mail']));
		if ( validEmail( $email_address ) == false) die($mailform."Проблемы соединения с вашим email провайдером!</span>"); 
		if (strpos($email_address, 'thismail.ru') > 0) die($mailform."Мы не принимаем thismail.ru</span>"); 
	
		    $arr = array('a','b','c','d','e','f', 'g','h','i','j','k','l','m','n','o','p','r','s','t','u','v','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','R','S','T','U','V','X','Y','Z','1','2','3','4','5','6','7','8','9','0');
		    $pass = "";
		    for($i = 1; $i <= 30; $i++)    {
		      $index = rand(0, count($arr) - 1);
		      $pass .= $arr[$index];
		    }    
		    
		 	$result = @mysql_query("SELECT id FROM  `proft_dostup_md5`  WHERE  (`kod` LIKE  '".$pass."' OR `mail` LIKE  '".$email_address."')") or die("Couldn't SELECT information!"); 
		 	
			if (mysql_num_rows($result) == 0 ) {
			@mysql_query("INSERT INTO proft_dostup_md5 (`kod`, `partner_id`, `mail`) VALUES ('".md5(sha1($pass))."', '4', '".$email_address."')") or die("Couldn't WRITE information!");  
			    
	require  $_SERVER['DOCUMENT_ROOT']."/dop/mailer/swift_required.php"; 
 
$transport = Swift_SmtpTransport::newInstance('mail.ukraine.com.ua', 25)
  ->setUsername('robot@svoyodelo.com')
  ->setPassword('Lcf979YTQaTWu6RAQJ3x')
  ;
$mailer = Swift_Mailer::newInstance($transport);
$message = Swift_Message::newInstance('[svoyodelo.com] код доступа')
  ->setFrom(array('robot@svoyodelo.com' => 'Электронный консультант СВОЁ ДЕЛО'))
  ->setTo(array($email_address))
  ->setBody('К адрессу почты '.$email_address.' приклеплён код доступа '.$pass.' — <a href="http://svoyodelo.com/?code='.$pass.'">перейти к регистрации</a>.<br/>Большое вам спасибо за использование нашего сервиса.', 'text/html')
  ;
  
  $numSent = $mailer->send($message);
 echo ($numSent == 1) ? "Внимание. Код доступа отправлен на почту <span style='color: red;'>".substr($email_address, 0, strrpos($email_address, "@"))."@<a style='font-size: inherit; color: inherit;' href='http://".substr($email_address, strrpos($email_address, "@")+1)."/'  target='_blank'>".substr($email_address, strrpos($email_address, "@")+1)."</a></span>." : "Проблема с отправкой почты. Код доступа <a href='#' onclick='".'fillcode("'.$pass.'")'."' style='font-size: 14pt;'><b>".$pass."</b></a><br/>Сохраните его!";
			    
			}  
			else  echo $mailform."К данному адресу почты уже привязан код.</span>";
		
} else echo $mailform.'Проблемы получения адреса почты.</span>';
?>