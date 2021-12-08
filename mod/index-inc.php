<?php  session_start(); 	
	$handle = @mysql_query("SELECT used FROM `proft_dostup_md5`WHERE `used` =3") or die ("Проблема связи с БД");
	$ujelu = mysql_num_rows($handle);
?>
<script src="js/jquery/loopedslider.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="js/jquery/jquery.coda-slider-2.0.js"></script>
<script src="js/jquery/jquery.scrollTo-1.4.2-min.js" type="text/javascript"></script>
<script src="js/jquery/jquery.localscroll-1.2.5.js" type="text/javascript" charset="utf-8"></script>
<script src="js/jquery/jquery.serialScroll-1.2.2-min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/jquery/coda-slider.js" type="text/javascript" charset="utf-8"></script>
<script  type="text/javascript">var dlopen = <? echo (isset($_REQUEST['code'])) ? 'true' : 'false';	?>;</script>
<script src="js/index.js" type="text/javascript"></script>
<script type="text/javascript" src="http://vkontakte.ru/js/api/share.js?5" charset="windows-1251"></script>
<script type="text/javascript" src="http://www.google.com/buzz/api/button.js"></script>
<script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script>
<script  type="text/javascript">
<!--
$(function(){
			$('#scroller').loopedSlider(); 	 	
		  $("#login_dialog").dialog({  modal: true,  width: 420,  position: [$(window).width()-450, 40], autoOpen: <? if (trim($msg)  != '') echo 	"true"; else echo "false";  ?>, dragStop: function(event, ui) { if (ui.offset.top < 14) {$(this).dialog( "option" , "position" , [$(this).dialog( "option", "position" )[0],26] ); }  }, 
		  buttons: {  "Вход": function() { 	if (($("#kod_login").val() != kod_login_wt) && ($("#id_login").val() != id_login_wt) && ($("#id_login").val().replace(/\s/g, '') != '') && ($("#kod_login").val().replace(/\s/g, '') != '')) {	$.jGrowl("Вход для пользователя ID "+$("#id_login").val()); document.forms['login_form'].submit();	 }
 			else $.jGrowl('Пустые данные в форме входа.'); },
		  "Отмена": function() { $(this).dialog("close"); } }	});
});
-->
</script>
</head>
<body><noscript><div id="noscript-warning">Пожалуйста, включите Javascript в настроке браузера.<br/>Please turn on Javascript from browser options.</div></noscript>
<div id="puzzleimg">
<div  class="wraper">
	<div id="toplogo"><a href="#" id="demo_login">ПРИМЕР ОТЧЁТА</a></div>
	<div class="alpha-bg"></div>	<div class="shadow"></div>
	<div id="toppanel"><span style="float:left;"><a href="#" onClick="alert('Электронный консультант «СВОЁ ДЕЛО» \n Версия 1.1 \n Дан Воронов, 2010');"><img src="images/logo_mini.png" border="0"/></a></span><span  style="float:left; margin-left: 10px;"><a href="/"><b>СВОЁ ДЕЛО</b></a></span><span style="margin-left: 20px;">уже <b><? echo $ujelu; ?></b> человек</span>		
<span style="float:right; padding-right:1px;"><a href="#" onclick="$('#dialog_form').dialog('open');">Регистрация</a> <span style="margin-left: 14px; background: url(images/i-login.gif) no-repeat right;"><a href="#" onclick="$('#login_dialog').dialog('open');" style="margin-right: 14px;">Вход</a></span></span>
	</div>
	<div id="data_drag">
		<div id="okno1">
					<div id="logotxt"><img src="images/sd_logo.png" width=327 height=63 border="0"/></div>
			<div id="annotation">
			<div style="color:#009E60;">электронный консультант</div>  <!-- 00a86b -->
			<div style="font-size: 0.71em;">профессиональной направленности</div>
			</div>		
		</div>

<div id="alphaslider"> 
<div id="slider"> 
	<center>  
            <ul class="navigation">
           	<li class="tab1"><a id="oda" href="#o-da">Очевидные причины</a></li>
            <li class="tab2"><a href="#help">Помощь: три простых шага</a></li>
            <li class="tab3"><a href="#info">Информация</a></li>
            <li class="tab4"><a href="#buzz">О нас говорят</a></li>
            </ul>
	</center>
            <div class="scroll">
                <div class="scrollContainer">
                <div class="panel" id="o-da">
					<div id="polosa">Почему люди выбрали «СВОЁ ДЕЛО»</div>
					<div id="okno3">
					<table border=0 align="center" cellpadding=0 cellspacing=0 width="100%" height="100%" ><tr>
				<td><div class="arg4 arg4-1"><div class="argtxt">Запустить полезный сайт относительно легко, а вот сделать его приятным и удобным для пользователя это искусство.</div> <div class="argimg"><img src="images/arg1.png" border="0"/><br/><b>УДОБНО</b></div></div><div class="arg4 arg4-1"><div class="argtxt">Человек-консультант субъективен и легко может ошибиться, а стандартная процедура оценки стабильно объективна.</div> <div class="argimg"><img src="images/arg3.png" border="0"/><br/><b>СТАНДАРТ</b></div></div></td>
				<td><hr style="border: 0; 	color: lightgrey;	background-color: lightgrey; height: 90%; min-height: 90%; width: 1px;"/></td>
				<td><div class="arg4 arg4-2"><div class="argimg"><img src="images/arg2.png" border="0"/><br/><b>ПОНЯТНО</b></div><div class="argtxt">Теперь нам доступно много данных, а вот понятными они становится только в правильном дизайне визуализаций.</div></div><div class="arg4 arg4-2"><div class="argimg"><img src="images/arg4.png" border="0"/><br/><b>ТОЧНОСТЬ</b></div><div class="argtxt">Психолог-консультант может путать вас неясными, чуть-ли не эзотерическими, техниками. Мы работаем по науке.</div></div></td>
				</tr></table>
			</div>
			</div>
			
			
                <div class="panel" id="help">			<div id="okno2">

<div id="scroller">	
        <div class="containertop">
        <ul class="pagination floatstop">
            <li class="active" style="width:250px;">
                <span>1</span>
                <a href="#">Войти<br/>в систему</a>
                <p>Если вы на сайте первый раз вам понадобится зарегистрироватся.</p>
            </li>
            <li class="sep"></li>
            <li  style="width:285px;">
                <span>2</span>
                <a href="#">Ответить<br/>на вопросы</a>
                <p>Три специально подобранные методики для выявления профессиональных предпочтений.</p>
            </li>
            <li class="sep"></li>
            <li  style="width:225px;">
                <span>3</span>
                <a href="#">Изучить<br/>отчёты</a>
                <p>Эллектронный консультант оценит вашу совместимость со всеми профессиями.</p>
            </li>
        </ul>  
        </div>  
        <div class="container">
            <div class="slides">
                <div><img src="images/mindmap1.png" height="346" width="900" alt="Описание процедуры ввхода в систему"/></div>
                <div><img src="images/mindmap2.png" height="346" width="900"  alt="Описание процедуры прохождения тестов"/></div>
                <div><img src="images/mindmap3.png" height="346" width="900"  alt="Описание процедуры работы с отчётами"/></div>             
            </div>
        </div>
    </div>
			</div>
			
</div><div class="panel" id="info">    
    		<div class="wind" id="okno5">
    			<div id="infomenu"><a id="fomenu0" href="#" title="Для людей" onclick="data_load_4arr(0); return false;">О проекте</a> <a id="fomenu1" href="#" title="Сотрудничество" onclick="data_load_4arr(1); return false;">Команда</a> <a id="fomenu2" href="#" title="О проекте" onclick="data_load_4arr(2); return false;">Сотрудничество</a> <a id="fomenu3" href="#" title="Контакты" onclick="data_load_4arr(3); return false;">Контакты</a></div><img id="menutri" src="images/tri.gif"/>
				<div id="data_load"></div>            
			</div>
</div><div class="panel" id="buzz">
                <div class="wind" id="okno5">
                		<table border=0 align="center" cellpadding=0 cellspacing=10 width="890" style="margin-top: 15px;">
		<tr><td valign="top" height="400" >
				<div style="font-size: 2em; margin-left: 15px;">Команда проекта «СВОЁ ДЕЛО» прикладывает все усилия для того, чтобы помочь как можно большему количеству людей. </div><div style="font-size: 2em; margin-left: 15px; margin-top: 15px;">Поделитесь своим мыслями, расскажите о нас друзьям: любое опубликованое мнение важно. <br/>Большое вам спасибо!</div>   		
		</td><td  valign="top"  width="251"  class="nosha">
<script src="http://widgets.twimg.com/j/2/widget.js"></script>
<script>
new TWTR.Widget({
  version: 2,
  type: 'search',
  search: 'svoyodelo',
  interval: 6000,
  title: '<b>Прямой эфир микро с twitter.com</b>',
  theme: {
    shell: {
      background: 'grey',
      color: '#ffffff'
    },
    tweets: {
      background: '#ffffff',
      color: '#444444',
      links: '#d50505'
    }
  },
  features: {
    scrollbar: false,
    loop: true,
    live: true,
    hashtags: true,
    timestamp: true,
    avatars: true,
    behavior: 'default'
  }
}).render().start();
</script></td></tr>
<tr><td>
			<div id="buzzbuttons" >
			<div style="float: left; padding: 2px; margin-left: 40px;  margin-top: 7px;"><script type="text/javascript"> document.write(VK.Share.button(false,{type: "round", text: "Сохранить"}));</script></div>
			<div style="float: left; padding: 2px; margin-left: 20px;  margin-top: 5px;"><a name="fb_share" type="button_count" href="http://www.facebook.com/sharer.php">Опубликовать</a></div>
			<div style="float: left; padding: 2px; margin-left: 20px;  margin-top: 4px;"><a title="Опубликовать в Живой ленте Google" class="google-buzz-button" href="http://www.google.com/buzz/post" data-button-style="small-count" data-locale="ru"></a></div>
			<div style="float: left; padding: 2px; margin-left: 20px;  margin-top: 10px;"><script type="text/javascript"> tweetmeme_style = 'compact'; </script><script type="text/javascript" src="http://tweetmeme.com/i/scripts/button.js"></script></div>
			</div>
</td><td align="center"><span id="userecholink"><a onmouseover="UE.Popin.preload();" href="#" onclick="UE.Popin.show(); return false;"><span style="font-size: 22px;">Ваши отзывы</span> <sup>UserEcho</sup></a></span></td></tr>
</table>
</div>
                </div>
                </div>
            </div>
        </div>
        </div>            
	</div>
	            <div id="porafoot">А чего вы ждёте? Пора  <span class="pora greenbutton"><a id="kupi_but">получить код доступа</a></span></div>
</div>

<div id="vk_api_transport"></div><script src="js/vkparse.js" type="text/javascript"></script>
<div id="hidediv" style="clear:both; display : none; height: 1px; width: 1px;">

<div id="kupi_dialog" title="Оплатить код доступа"  style="font-size: 16pt;">
	<div id="pay_2" style="display: none;"  class="nosha">
<form name="email_form" action="" onsubmit="return false;"><div style="padding: 10px 0 40px; font-size: 1.2em">Для получения кода введите существующий адрес e-mail:<br/><input type=text size=20 name=email id="email" value="" class="ui-corner-all" style="width: 98%"/></div><div style="float:left; width: 142px; padding-top: 48px;">Символы <br/>на картинке:</div><div style="float:left; width: 210px;"><img src="capt/ca-image.php?nocache=<?php echo md5(time()); ?>" border="0">  <input id="onlylu" name="onlylu" type="text" class="ui-corner-all" style="width: 200px; font-size: 33pt;"></div></form>
	</div>
	<div id="pay_1" style="padding: 30px;" class="nosha">Самым первым пользователям мы предоставляем возможность бесплатного использования сервиса. В замен мы искрени надеемся на ваши отзывы.<br/><br/><center style="margin-top: 20px; "><a href="#" style="font-size: 24pt;" onclick="oplata();">Оплатить <b>0</b> евро &gt;</a></center></div>
</div>

<div id="login_dialog" title="Введите свои данные">
		<form id="login_form" name="login_form"  method="post" action="index.php">
		<table id=login_table border=0 cellpadding=2 cellspacing=2  align=center style="margin-top:14px; border: 1px solid lightgrey; font-size: 1.8em" class="ui-corner-all">
		<tr><td><input class="ui-corner-all" type=text size=30 name=l id="id_login" value="<? echo (round($_REQUEST['l']) ==0) ? "" : $_REQUEST['l'] ;?>"/></td></tr><tr><td>
	<input type="text" id="kod_login_txt" size=30  class="ui-corner-all"  autocomplete="off" style="color: #aaa" />
    <input type="password" size=30  name="k" id="kod_login" value="" autocomplete="off" style=" display: none;" class="ui-corner-all"/>
		</td></tr>
			</table></form>		
		<? if (trim($msg)  != '') echo '<div align=center style="font-size: 1.3em; color:#d50505; margin: 20px;">',$msg,'</div>'; ?>  
</div>


<div id="usercontract" title="Пользовательское соглашение"  style="font-size: 12pt;"  class="nosha">
<h2>1. Предмет Пользовательского Соглашения</h2>
<p>Настоящее Пользовательское Соглашение (далее – <b>ПС</b>) регулирует отношения Пользователя, с одной стороны, и Администрации услуг сайта www.svoyodelo.com (далее — <b>Сайт</b>) с другой. </p>
<p>ПС вступает в силу с момента выражения Пользователем согласия с его условиями путем регистрации на Сайте.</p>
<p>Сайт предлагает свои услуги на условиях, являющихся предметом настоящего ПС. Администрация имеет право на одностороннее изменение положений ПС без какого-либо специального уведомления.</p>
<p>Ничто в ПС не может пониматься как установление между Пользователем и Сайтом агентских отношений, отношений товарищества, отношений по совместной деятельности, отношений личного найма, либо каких-то иных отношений, прямо не предусмотренных ПС.</p>
<p>Признание судом какого-либо положения ПС недействительным или не подлежащим принудительному исполнению не влечет недействительности или неисполнимости иных положений Соглашения.</p>
<h2>2. Описание услуг</h2>
<p>Для того чтобы воспользоваться услугами Сайта, необходимо иметь исправно работающий компьютер и доступ в Интернет (WWW). Сайт является интернет-ресурсом, позволяющим определять профессиональное занятие Пользователя, для работы с которым используется браузер или специализированные клиентские приложения.</p>
<p>Услуги Сайта являются платными и оплачиваются Пользователем согласно указанным расценкам.</p>
<h2>3. Положение о конфиденциальности</h2>
<p>Вся предоставляемая Пользователем информация используется исключительно для выполнения Сайтом свох функций и ни при каких обстоятельствах не может быть передана третей стороне.</p>
<h2>4. Регистрация, код доступа и безопасность</h2>
<p>При регистрации на Сайте Пользователь обязан предоставить Администрации Сайта необходимую достоверную и актуальную информацию.</p>
<p>Пользователь несёт ответственность за безопасность своего код доступа к услугам Сайта, а также за все, что будет сделано под его учетной записью.</p>
<p>Сайт имеет право запретить использование определенных кодов доступа и/или изъять их из обращения. Пользователь соглашаеться с тем, что обязан немедленно уведомить Сайт о любом случае неавторизованного (не разрешенного Пользователем) доступа с его кодом доступа и/или о любом нарушении безопасности, а также с тем, что Пользователь самостоятельно осуществляет завершение работы под своим кодом доступа (ссылка «Выход») по окончании каждой сессии работы со службами Сайта. Сайт не отвечает за возможную потерю или порчу данных, которая может произойти из-за нарушения Пользователем положений этой части ПС.</p>
<h2>5. Освобождение от гарантий</h2>
<p>Пользователь понимает и соглашаетеся с тем, что:</p> 
<p>использует услуги Сайта и любые материалы, полученные с использованием услуг Сайта, на свой собственный страх и риск. Услуги предоставляются «как есть». Сайт не принимает на себя никакой ответственности, в том числе и за соответствие услугам цели пользователя;</p>
<p>Сайт не гарантирует, что: службы будут соответствовать требованиям Пользователя; службы будут предоставляться непрерывно, быстро, надежно и без ошибок; результаты, которые могут быть получены с использованием служб, будут точными и надежными; качество услуг будет соответствовать ожиданиям Пользователя; все ошибки на Сайте будут исправлены;</p>
<p>Сайт не несет ответственности за любые прямые или непрямые убытки, произошедшие из-за использования либо невозможности использования его служб;</p>
<h2>6. Освобождение от отвественности и возмещения убытков</h2>
<p>Пользователь обязуетеся возмещать убытки, защищать и ограждать Сайт, а также его любые зависимые и аффилированные структуры, его подразделения и дочерние структуры, а также сотрудников, агентов, совладельцев товарного знака и иных партнеров от каких-либо претензий третьих лиц, включая судебные издержки, возникающие у третьих лиц и (или) вытекающие из использования Пользователем услуг Сайта, причастности к работе и развитию Сайта, несоблюдения настоящего ПС или нарушений любых других прав третьих лиц. Пользователь несет полную личную ответственность при использовании Сайта, включая, помимо прочего, оплату стоимости доступа к интернету в процессе такого использования.</p>
<h2>7. Поведение зарегистрированного пользователя</h2>
<p>Пользователю при использовании Сайта запрещается: <br/>использовать программное обеспечение и осуществлять действия, направленные на нарушении нормального функционирования Сайта и его сервисов или персональных аккаунтов Пользователей; <br/>любым способом, в том числе, но не ограничиваясь, путем обмана, злоупотребления доверием, взлома, пытаться получить доступ к коду доступа другого Пользователя; <br/>осуществлять (пытаться получить) доступ к каким-либо функциям иным способом, кроме как через интерфейс, предоставленный Администрацией Сайта, за исключением случаев, когда такие действия были прямо разрешены Пользователю в соответствии с отдельным соглашением с Администрацией Сайта.</p>
<p style="font-size: 70%; padding-top: 20px;"><i>Последняя редакция от 9 мая 2010 г.</i></p>
</div>

<div id="dialog_form" title="Регистрация: заполните все поля">
	<form name="dialogform" action="" onsubmit="return false;">
	<fieldset class="ui-widget-content ui-corner-all" style=" padding-top: 14px;">	
		<div id="header_ank_msg">
			 <a style="text-decoration:none;"href="#" onclick="doLogin();"><img border="0" src="images/vk-flip.png" alt="Вход vkontakte.ru" /></a>
		</div>
		<div id="user_ank">
<table border=0 cellpadding=2 cellspacing=0  align=right style="font-size: 12pt;">
<tr><td align="right" width="140">Имя:</td><td width="280"><input type=text size=24 id="name" name=name class="ui-corner-all" style="width: 95%"/></td></tr>
<tr style="background-color: #C3FDB8;"><td align="right">Фамилия:</td><td><input type=text size=24 name=fam id="fam"  value="" class="ui-corner-all" style="width: 95%"/></td></tr>
<tr><td align="right">Пол:</td><td id="pol1"><span id="radioPol"><input type="radio" id="radio1" name="pol" value="0" /><label for="radio1" style="font-size: 12pt;">женский</label><input type="radio" id="radio2" name="pol" value="1"  /><label for="radio2" style="font-size: 12pt;">мужской</label></span> </td></tr>
<tr style="background-color: #C3FDB8;"><td align="right">Дата рождения:</td><td id="birth1"> <input type="text" name="birthdate" size=10  id="datepickerBirth" value=""  class="ui-corner-all"/></td></tr>
<tr><td align="center" colspan="2">Страна: <span id="contr1"><input type=text name=contr id="contr"  value="" class="ui-corner-all" style="width: 25%"/></span> Город: <span id="city1"><input type=text name=city id="city"  value="" class="ui-corner-all" style="width: 40%"/></span></td></tr>
</table></div>
<div id="userdata_contener" style="font-size: 16pt; line-height: 25px; display: none">
	<div style="float: left; margin: 6px;"><img src="" alt="userfoto" id="userfoto" style="max-height: 200px;" /></div>
	<div style="float: left; margin: 6px;">
		<div style="font-size: 22pt; color: darkblue; margin-bottom: 6px;"><b><span id="username"></span> <span id="usernic"></span> <span id="userfam"></span></b> <span><a href="#" onclick="doLogout();">выход</a></span></div>
		<div><span style="color: grey;" id="polnamehd">Пол:</span> <span id="usersex"></span></div><div><span style="color: grey;">Дата рождения:</span> <span id="userbdate"></span></div><div><span style="color: grey;">Страна: </span><span id="usercountry"></div><div><span style="color: grey;">Город: </span><span id="usercity"></span></div>
	</div>
</div>
	<div align="center" style="clear:both; font-size: 20px; color: red; padding-top: 4px;"  id="login_load">
		<div class="inpkod"><span>Код доступа (<a href="#" onclick="$('#kupi_dialog').dialog('open');"><b>у вас нет?</b></a>):</span><span><input type=password size=30 name=kod  id="kod" value="<? if (isset($_REQUEST['code'])) echo $_REQUEST['code'];?>"  style="color: red; font-size: 10pt" class="ui-corner-all"/></span></div>	
	</div>
	<div style="margin-top: 10px; font-size: 8pt; color: grey;"  class="nosha"><center>Нажимая «Cоздать аккаунт» вы принимаете <a href="#" onclick="$('#usercontract').dialog('open');" style="font-size: 8pt; color: grey;"><b>Пользовательское соглашение</b></a>.</center></div>
</fieldset>
		<input type=hidden id="vkdatause" name="vkdatause" value="0">
</form>
<div class="validateTips" style="clear: both; text-align:right; color: red; margin-top: 14px; margin-right: 12px;"></div>
</div>
</div> <!--  Закрыли блок спрятаных окошек -->