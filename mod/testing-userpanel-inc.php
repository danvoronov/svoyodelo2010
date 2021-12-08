<span style='font-size: 18px; color: grey;' >Неопределенна. Пройдите все тесты.</span></span></div>

<div id="ZdoBlock" class='ui-widget-content ui-corner-all bloki' style='width: 55%; display: <? echo ($user['zdorove']  == 0) ? "inline" : "none" ?>'><center>Оцените свой уровень <b>здоровья</b>:<hr/><div id="radioZdo">
			<input type="radio" id="radio_1" name="zdorov" value=1 /><label for="radio_1">-3</label><input type="radio" id="radio_2" name="zdorov" value=2  /><label for="radio_2">-2</label><input type="radio" id="radio_3" name="zdorov" value=3  /><label for="radio_3">-1</label><input type="radio" id="radio_4" name="zdorov" value=4  /><label for="radio_4">нормальное</label><input type="radio" id="radio_5" name="zdorov" value=5  /><label for="radio_5">+1</label><input type="radio" id="radio_6" name="zdorov" value=6  /><label for="radio_6">+2</label><input type="radio" id="radio_7" name="zdorov" value=7  /><label for="radio_7">+3</label></div>	</center>
</div>

<div class='bloki' style='width: 55%;'>
	<center>Блок тестов:</center><hr/><center><? echo "<div style='padding-top: 5px;'><button id='open_test1' style='font-size: 18px; color: ".(($row_from_testtime['test1_e']  != 0) ? "green'>Шаг №1. Пройден" : "#92000a'>Шаг №1. Тест «Мотивация выбора профессии»")."</button> 
	<button id='open_test2' style='font-size: 18px; margin-top: 10px; color: ".(($row_from_testtime['test2_e']  != 0) ? "green'>Шаг №2. Пройден" : "#92000a'>Шаг №2. Тест «Формула профессии»")."</button>		
	<button id='open_test3' style='font-size: 18px; margin-top: 10px; color: ".(($row_from_testtime['test3_e']  != 0) ? "green'>Шаг №3. Пройден" : "#92000a'>Шаг №3. Тест «Мотивационный профиль»")."</button></div>	";	
	?>	</center><div style='clear:both;'></div>
</div>					
<div id="nizblok" class='ui-widget-content ui-corner-all bloki' style='width: 91%; display : none;'><center><h3 class='ui-widget-header ui-corner-all killmargins'>Это очень интересно:</h3></center><div id="nizblok_cont" style="margin: 30px;"  class="nosha"></div><center><a href="/" style="margin: 20px; font-size: 24pt;">Пора перейти к результатам.</a></center></div>			
<div id="hidediv" class="hidediv">	
	<div id="hello" title="Ваш уникальный номер (ID)" style="margin: 20px; font-size: 18pt;" class="nosha">Анкете присвоен <span style="color: green;">ID <? echo  $unic; ?></span>. Сохраните его и в дальнейшем используте (вместе с кодом доступа) для входа в зону пользователей.</div>	
	<div id="metafora" title="Это интересно"><div id="contentWrap"  style="font-size: 12pt;"  class="nosha"></div></div> 
	<!-- test form --> <div id="dialog_test" title="Общие рекомендации по прохождению тестов">
		<form action="" name="testform" id="testform" onsubmit="return false;">	
		<fieldset id="rd0" class="ui-corner-all"  style="padding: 25px; font-size: 14pt;">
		   <div  class="nosha">Тесты стоит проходить один за другим. Желательно не делать долгих пауз между и пройти все в один день.<br/><br/>
Правила теста №1:	<center>Будут приведены утверждения, характеризующие любую профессию. Прочтите и оцените по шкале <b style="font-size: 110%">(меньше) 1-7 (больше)</b>, в какой мере каждое из них повлияло на ваш выбор профессии. </center>
		   		<center><button id='starttest' style='font-size: 24pt; margin-top: 10px;'>Начинаем</button></center>
			</div>			
		</fieldset>			  
			<fieldset id="rd1" class="ui-corner-all"  style="padding-bottom: 1px; 	display: none;">
			<input type=hidden name="poz" id="poz" class="testform" value="0"/>
<? 	for ($i = 1;  $i <=5;  $i++)  echo '<div style=" clear: both; width: 730px; height: 50px; margin:12px;" ><label id="nm'.$i.'"  for="inp'.$i.'" style="font-size: 14pt; width: 200px;"></label><div align=center style="padding-top:8px;" ><input type="text" id="inp'.$i.'" name=inp'.$i.' class="testform inputi" value=0 disabled size=1 style="border:0; color:#bb3902;  background-color: #e6e6fa; font-weight:bold; float: right; font-size: 7pt; margin-left: 7px;" /><div id="slider'.$i.'" style="width: 200px; float: right;" ></div>	 </div></div>';
?>	 			</fieldset>
		</form>
	  </div>    
	  
	<form action="" name="testform2" id="testform2" onsubmit="return false;" style="display : none; ">
		<input type="radio" class="testform2" id="radio0" name="radioTest"  value="0" />
		<input type="radio" class="testform2" id="radio1" name="radioTest" value="1" />
		<input type="radio" class="testform2" id="radio0_2" name="radioTest2"  value="0" />
		<input type="radio" class="testform2" id="radio1_2" name="radioTest2" value="1" />   
	</form>	
		  
<div id="dialog_test2" title="Правила тестирования №2" style="overflow:hidden;">	   
	<fieldset id="rd4" class="ui-corner-all"  style="display: none; margin-top: 15px">
	   <div id="uslovia" style='font-size: 2em; margin: 20px;'  class="nosha">	Представьте, что после соответствующего обучения вы сможете выполнить <b style="span-size: 110%">любую</b> работу.<br/><br/><center> Тест каждый раз будет предлагать вам выбор <b style="span-size: 110%">один из двух</b> вариантов. Чем займётесь?</center></div>
	   	<center><button id='start_test23' style='margin: 25px;'>Начинаем</button></center>			
	</fieldset>	
	<div  style="height: 310px;">
		<div id="rd2" style="padding: 5px">
			<div id="click_radio0" class="otvbut greenbutton" onclick="$('#radio0').click();"><span id="radio0_1_txt"></span></div>
			<div id="click_radio1" class="otvbut greenbutton" onclick="$('#radio1').click();"><span id="radio1_1_txt"></span></div>	
		</div>			
		<div id="rd3" style="padding: 5px; 	display: none;">
			<div id="click_radio0_2" class="otvbut greenbutton" onclick="$('#radio0_2').click();"><span id="radio0_2_txt"></span></div>
			<div id="click_radio1_2" class="otvbut greenbutton" onclick="$('#radio1_2').click();"> <span id="radio1_2_txt"></span></div>
		</div>			
	</div>		
	<div style="clear:both; height: 10px; margin: 12px  15px 0;" id="progressbar"></div>
</div>

</div>  	  
</div>