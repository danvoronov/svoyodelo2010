 <?php 

$zn = $formula1_values[1]; $pr = $formula1_values[2]; $th = $formula1_values[3]; $ce = $formula1_values[4]; $hu = $formula1_values[5];
	
	include( $_SERVER['DOCUMENT_ROOT'].'/dop/GoogChart.class.php' ); // графики

$dataPr = array(	'Ч-З' => $zn,			'Ч-П' => $pr,			'Ч-Т' => $th,			'Ч-Ч' => $ce,			'Ч-Х' => $hu);
$dataMotiv = array(	'В' => $pow,			'П' => $aff,			'Д' => $ach		);
$dataCel= array(	'Г' => $formula2_values[1],			'П' => $formula2_values[2],			'И' => $formula2_values[3],		);
$dataSposob= array(			'Р' => $formula3_values[1],			'М' => $formula3_values[2],			'А' => $formula3_values[3],			'Ф' => $formula3_values[4],		);
$dataUslov = array(			'Б' => $formula4_values[1],			'О' => $formula4_values[2],			'Н' => $formula4_values[3],			'М' => $formula4_values[4],		);

// Set graph colors
$colorMotiv = array( '#d50505' );

$chartPredmet1 = new GoogChart();
$chartPredmet1->setChartAttrs( array(
	'type' => 'pie3d', 'title' => 'Распределение по предмету труда',
	'data' => $dataPr, 'size' => array( 240, 125 ),
	'color' => array( '#007fff' )
));

$chartPredmet2 = new GoogChart();
$chartPredmet2->setChartAttrs( array(
	'type' => 'bar-vertical', 'barsize' => 38,
	'maxdata' => max($dataPr)+1,
	'data' => $dataPr, 'size' => array( 240, 125 ),
	'color' => array( '#007fff' )
));

$chartCel = new GoogChart();
$chartCel->setChartAttrs( array(
	'type' => 'pie3d', 'title' => 'Распределение по цели труда',
	'data' => $dataCel, 'size' => array( 240, 155 ),
	'color' => array( '#50c878' )
));

$chartCel2 = new GoogChart();
$chartCel2->setChartAttrs( array(
	'type' => 'bar-vertical',  'barsize' => 70,
		'maxdata' => max($dataCel)+1,
	'data' => $dataCel, 'size' => array( 240, 155 ),
	'color' => array( '#50c878' )
));

$chartUslov = new GoogChart();
$chartUslov->setChartAttrs( array(
	'type' => 'pie', 'title' => 'Распределение по условиям труда',
	'data' => $dataUslov, 'size' => array( 240, 160 ),
	'color' => array( '#F88017' )
));

$chartUslov2 = new GoogChart();
$chartUslov2->setChartAttrs( array(
	'type' => 'bar-vertical', 'barsize' =>50,
		'maxdata' => max($dataUslov)+1,
	'data' => $dataUslov, 'size' => array( 240, 160 ),
	'color' => array( '#F88017' )
));

$chartSposob = new GoogChart();
$chartSposob->setChartAttrs( array(
	'type' => 'pie', 'title' => 'Распределение по способу труда',
	'data' => $dataSposob, 'size' => array( 240, 160 ),
	'color' => array( '#7F525D' )
));
$chartSposob2 = new GoogChart();
$chartSposob2->setChartAttrs( array(
	'type' => 'bar-vertical',  'barsize' => 50,
		'maxdata' => max($dataSposob)+1,
	'data' => $dataSposob, 'size' => array( 240, 160 ),
	'color' => array( '#7F525D' )
));

$chartMotiv = new GoogChart();
$chartMotiv->setChartAttrs( array(
	'type' => 'pie3d', 'title' => 'Распределение по мотивации',
	'data' => $dataMotiv, 'size' => array( 240, 155 ),
	'color' => $colorMotiv
));
$chartMotiv2 = new GoogChart();
$chartMotiv2->setChartAttrs( array(
	'type' => 'bar-vertical',  'barsize' => 70,
		'maxdata' => max($dataMotiv)+1,	
	'data' => $dataMotiv, 'size' => array( 240, 155 ),
	'color' => $colorMotiv
));

   
	// предмет - блок № 2 
	 echo "<div class='bloki bloki1'><div id='hdr1' class='nadtekst'></div><center>Приоритет <b>предмета</b> труда:</center><hr class='hrline'/><div class='cloud'><a id='open1_4' href='html/help/predmet1.htm?width=500' name='У вас в общей части предметов турда занимает ".round($zn/30*100,2)."%.'  class='jTip size_12_".$zn."'>«знаковые системы»</a><sup >".round($zn/30*100,1)."%</sup> <a href='html/help/predmet2.htm?width=500'  id='open1_1' name='У вас в общей части предметов турда занимает ".round($pr/30*100,2)."%.' class='jTip size_12_".$pr."'>«природа»</a><sup>".round($pr/30*100,1)."%</sup> <a id='open1_2' href='html/help/predmet3.htm?width=500' name='У вас в общей части предметов турда занимает ".round($th/30*100,2)."%.' class='jTip size_12_".$th."'>«техника»</a><sup>".round($th/30*100,1)."%</sup> <a id='open1_3' href='html/help/predmet4.htm?width=500' name='У вас в общей части предметов турда занимает ".round($ce/30*100,2)."%.' class='jTip size_12_".$ce."'>«человек»</a><sup>".round($ce/30*100,1)."%</sup> <a id='open1_5' href='html/help/predmet5.htm?width=500' name='У вас в общей части предметов турда занимает ".round($hu/30*100,2)."%.' class='jTip size_12_".$hu."'>«худож.образ»</a><sup>".round($hu/30*100,1)."%</sup></div><div id='bar_predmet_hover'><div id='bar_predmet' class='graphic'>".$chartPredmet1."</div><div id='bar_predmet' class='graphic2'>".$chartPredmet2."</div></div></div>";	
	 
	 // цель - блок №3
	      echo "<div class='bloki bloki2'><div id='hdr2' class='nadtekst'></div><center>Приоритет <b>целей</b> труда:</center><hr class='hrline'/><div  class='cloud'><a id='open2_1' href='html/help/cel1.htm?width=500' name='У вас в общей части целей труда занимает ".round($formula2_values[1]/15*100,2)."%.' class='jTip size_10_".$formula2_values[1]."'>(г)познание</a><sup>".round($formula2_values[1]/15*100,1)."%</sup> <a id='open2_2' href='html/help/cel2.htm?width=500' name='У вас в общей части целей труда занимает ".round($formula2_values[2]/15*100,2)."%.' class='jTip size_10_".$formula2_values[2]."'>[п]реобразование</a><sup>".round($formula2_values[2]/15*100,1)."%</sup> <a id='open2_3' href='html/help/cel3.htm?width=500' name='У вас в общей части целей труда занимает ".round($formula2_values[3]/15*100,2)."%.' class='jTip size_10_".$formula2_values[3]."'>[и]зобретение</a><sup>".round($formula2_values[3]/15*100,1)."%</sup></div><br/><div id='bar_cel_hover'><div id='bar_cel' class='graphic'>".$chartCel."</div><div id='bar_cel' class='graphic2'>".$chartCel2."</div></div></div>";
	      
	      
	    // мотивация - блок №4    
	    $summ= ($pow + $aff + $ach)/100;
	        echo "<div class='bloki blokimotiv'><center ><b>Мотивационный</b> профиль:</center><hr class='hrline'/><div class='cloud'><a id='open0_1' href='html/help/motiv1.htm?width=600'  class='jTip size_8_".$pow."' name='У вас в общей части мотивации занимает ".round($pow/$summ,1)."%.' >[в]оздействия</a><sup>".round($pow/$summ,1)."%</sup> <a id='open0_2' href='html/help/motiv2.htm?width=600'  class='jTip size_8_".$aff."' name='У вас в общей части мотивации занимает ".round($aff/$summ,1)."%.' >[п]ричастия</a><sup>".round($aff/$summ,1)."%</sup> <a id='open0_3' href='html/help/motiv3.htm?width=600'  class='jTip size_8_".$ach."' name='У вас в общей части мотивации занимает ".round($ach/$summ,1)."%.' >[д]остижения</a><sup>".round($ach/$summ,1)."%</sup></div><br/><div id='bar_motiv_hover'><div id='bar_motiv' class='graphic'>".$chartMotiv."</div><div id='bar_motiv' class='graphic2'>".$chartMotiv2."</div></div></div>";		
	        //  способо - блок №5
	        $sum3 = $formula3_values[1] + $formula3_values[2] + $formula3_values[3] + $formula3_values[4];
		  echo "<div class='bloki bloki3'><div id='hdr3' class='nadtekst'></div><center>Приоритет <b>способов</b> труда:</center><hr class='hrline'/><div class='cloud'><a id='open3_1' href='html/help/sposob1.htm?width=400' class='jTip size_6_".$formula3_values[1]."' name='У вас в общей части способов турда занимает ".round($formula3_values[1]/$sum3*100,2)."%.' >[р]учной</a><sup>".round($formula3_values[1]/$sum3*100,1)."%</sup> <a id='open3_2' href='html/help/sposob2.htm?width=400' class='jTip size_6_".$formula3_values[2]."' name='У вас в общей части способов турда занимает ".round($formula3_values[2]/$sum3*100,2)."%.' >[м]ашиный</a><sup>".round($formula3_values[2]/$sum3*100,1)."%</sup> <a id='open3_3' href='html/help/sposob3.htm?width=400' class='jTip size_6_".$formula3_values[3]."' name='У вас в общей части способов турда занимает ".round($formula3_values[3]/$sum3*100,2)."%.' >[а]втоматизированный</a><sup>".round($formula3_values[3]/$sum3*100,1)."%</sup> <a id='open3_4' href='html/help/sposob4.htm?width=500' class='jTip size_6_".$formula3_values[4]."' name='У вас в общей части способов турда занимает ".round($formula3_values[4]/$sum3*100,2)."%.' >[ф]ункциональный</a><sup>".round($formula3_values[4]/$sum3*100,1)."%</sup></div><div id='bar_3_hover'><div id='bar_3' class='graphic'>".$chartSposob."</div><div id='bar_3' class='graphic2'>".$chartSposob2."</div></div></div>";		
	 		
	 		// и условия - блок №6 - последний
	 	$sum4 = $formula4_values[1] + $formula4_values[2] + $formula4_values[3] + $formula4_values[4];
	  echo "<div class='bloki bloki4'><div id='hdr4' class='nadtekst'></div><center>Приоритет <b>условий</b> труда:</center><hr class='hrline'/><div class='cloud'><a id='open4_1' href='html/help/uslovia1.htm?width=250' class='jTip size_6_".$formula4_values[1]."' name='У вас в общей части условий турда занимает ".round($formula3_values[1]/$sum4*100,2)."%.' >[б]ытовые</a><sup>".round($formula4_values[1]/$sum4*100,1)."%</sup> <a id='open4_2' href='html/help/uslovia2.htm?width=250' class='jTip size_6_".$formula4_values[2]."' name='У вас в общей части условий турда занимает ".round($formula3_values[2]/$sum4*100,2)."%.' >(о)уличные</a><sup>".round($formula4_values[2]/$sum4*100,1)."%</sup> <a id='open4_3' href='html/help/uslovia3.htm?width=250' class='jTip size_6_".$formula4_values[3]."' name='У вас в общей части условий турда занимает ".round($formula3_values[3]/$sum4*100,2)."%.' >(н)специфические</a><sup>".round($formula4_values[3]/$sum4*100,1)."%</sup> <a id='open4_4' href='html/help/uslovia4.htm?width=250' class='jTip size_6_".$formula4_values[4]."' name='У вас в общей части условий турда занимает ".round($formula3_values[4]/$sum4*100,2)."%.' >(м)ответственные</a><sup>".round($formula4_values[4]/$sum4*100,1)."%</sup></div><div id='bar_4_hover'><div id='bar_4' class='graphic'>".$chartUslov."</div><div id='bar_4' class='graphic2'>".$chartUslov2."</div></div></div>";
		
		 		// рекомендации по выдачи профессии в отдельном окне
	  	  echo '<div id="hidediv" style="display : none; height: 1px; width: 1px;">',"<div id='recom_dialog' title='Профессональный путь лучше выбирать, чем надеяться на удачный случай'  class='nosha'><p>";
	  	  
	  	  // дерево для выдачи рекомендации по мотивации к ВЫБОРУ ПРОФЕССИИ
echo "Результаты тестирования показывают, что </p><div style='margin-left: 20px;'><p>при выборе профессии вы ";
if (($minus/5 >= 6) and ($refl_1 >= 5) and ($ot_2 >= 5) and ($out_3 >= 5)) {
    echo "сильно опираетесь на внешние <b>отрицательные</b> факторы:<br/> настоятельно <i>рекомендуем</i> обратить внимание на свои личные нужды и что хорошего вы можете получить. Ведь этим делом заниматься не кому-то другому, а вам. Оно просто обязанно приносить удовольствие вам. Понимаете, да?";
} elseif (($minus/5 >= 5) and ($ot_2 >= 4) and ($out_3 >= 4)) {
    echo "сильно опираетесь на внешние <b>отрицательные</b> факторы:<br/> настоятельно <i>рекомендуем</i> обратить внимание на свои личные нужды и что хорошего вы можете получить. Ведь этим делом заниматься не кому-то другому, а вам. ";
} elseif ($minus/5 >= 4.5) {
    echo "больше опираетесь на внешние <b>отрицательные</b> факторы:<br/>  <i>рекомендуем</i> обратить внимание на на свои личные нужды и что хорошего вы можете получить. ";
} elseif (($plus/6 > $soc/4) and ($plus/6 > $ind/5) ) {
    echo "больше опираетесь на <b>внешние положительные</b> факторы:<br/>  <i>рекомендуем</i> также обратить внимание на свои внутренние желания.";
} elseif ($soc/4 < $ind/5) {
    echo "больше опираетесь на внутренние <b>индивидуальные</b> факторы:<br/>  <i>рекомендуем</i> также обратить внимание на полезность будущей профессии для общества.";
}	else {
    echo "больше опираетесь на внутренние <b>социально значимые</b> факторы:<br/> <i>рекомендуем</i> также обратить внимание на полезность будущей профессии лично вам.";
};	
	
echo "</p><p>";	

// дерево для выдачи рекомендации по типам мотивации ВПД	
if (($ach == $aff) and ($ach == $pow)) {
    echo "у вас <b>смешанный</b> (не выраженный) тип мотивации:<br/> <i>рекомендуем</i> попробовать себя в жизненных ситуациях разной сложности, что поможет вам определится.";

// двойки    
} elseif ($ach == $aff) {
		if ($ach > $pow) echo "вас <b>мотивирует</b> <a id='motivac1' href='html/help/motiv2.htm?width=600'  class='jTip'>«причастность»</a> и <a id='motivac2' href='html/help/motiv3.htm?width=600'  class='jTip'>«достижения»</a>:<br/> эти мотивы противоположны по своей сути, поэтому <i>рекомендуем</i> обратить внимание на то в каких обстоятельствах они проявляются. <br/><br/>Если в рабочих отношениях преобладает мотив «достижения», то вам подходят должности с возможностью карьерного роста. Если в рабочих отношениях преобладает мотив «причастность», то вам подходят должности в сплоченном дружелюбном коллективе.";
		 else echo "вас <b>мотивирует</b> <a id='motivac3' href='html/help/motiv1.htm?width=600'  class='jTip'>«воздействия»</a>:<br/> <i>рекомендуем</i> вам должности с возможностью реализации лидерского потенциала.";
} elseif ($ach == $pow) {
		if ($pow > $aff) 
   		 	echo "вас <b>мотивирует</b> <a id='motivac' href='html/help/motiv1.htm?width=600'  class='jTip'>«воздействия»</a> и <a id='motivac' href='html/help/motiv3.htm?width=600'  class='jTip'>«достижения»</a>:<br/> эти мотивы противоположны по своей сути, поэтому <i>рекомендуем</i> обратить внимание на то в каких обстоятельствах они проявляются. <br/><br/>Если в рабочих отношениях преобладает мотив «достижения», то вам подходят должности с возможностью карьерного роста. Если в рабочих отношениях преобладает мотив «воздействия», то вам подходят должности с возможностью реализации лидерского потенциала.";
		 else echo "вас <b>мотивирует</b> <a id='hern' href='html/help/motiv2.htm?width=600'  class='jTip'>«причастность»</a>:<br/> <i>рекомендуем</i> вам должности в сплоченном дружелюбном коллективе.";
} elseif ($aff == $pow) {
		if ($pow > $ach) 
   			 echo "вас <b>мотивирует</b> <a id='motivac' href='html/help/motiv1.htm?width=600'  class='jTip'>«воздействия»</a> и <a id='motivac' href='html/help/motiv2.htm?width=600'  class='jTip'>«причастность»</a>:<br/>  эти мотивы противоположны по своей сути, поэтому <i>рекомендуем</i> обратить внимание на то в каких обстоятельствах они проявляются. <br/><br/>Если в рабочих отношениях преобладает мотив «воздействия», то вам подходят должности с возможностью реализации лидерского потенциала. Если в рабочих отношениях преобладает мотив «причастность», то вам подходят должности в сплоченном дружелюбном коллективе.";
		 else echo "вас <b>мотивирует</b> <a id='motivac' href='html/help/motiv3.htm?width=600'  class='jTip'>«достижения»</a>:<br/> <i>рекомендуем</i> вам должности с возможностью карьерного роста.";

// еденички   
} elseif ($aff == 8)  {
    echo "у вас ярко <b>выражена</b> мотивация <a id='motivac' href='html/help/motiv2.htm?width=600'  class='jTip'>«причастность»</a>:<br/> настоятельно <i>рекомендуем</i> вам должности в сплоченном дружелюбном коллективе.";
} elseif ($pow == 8) {
    echo "у вас ярко <b>выражена</b> мотивация <a id='motivac' href='html/help/motiv1.htm?width=600'  class='jTip'>«воздействия»</a>:<br/> настоятельно <i>рекомендуем</i> вам должности с возможностью реализации лидерского потенциала.";
} elseif ($ach == 8) {
     echo "у вас ярко <b>выражена</b> мотивация <a id='motivac' href='html/help/motiv3.htm?width=600'  class='jTip'>«достижения»</a>:<br/> настоятельно <i>рекомендуем</i> вам должности с возможностью карьерного роста.";

} elseif (($aff > $pow) and ($aff > $ach)) {
    echo "вас <b>мотивирует</b> <a id='hern' href='html/help/motiv2.htm?width=600'  class='jTip'>«причастность»</a>:<br/> <i>рекомендуем</i> вам должности в сплоченном дружелюбном коллективе.";
} elseif (($pow > $aff) and ($pow > $ach)) {
    echo "вас <b>мотивирует</b> <a id='motivac' href='html/help/motiv1.htm?width=600'  class='jTip'>«воздействия»</a>:<br/> <i>рекомендуем</i> вам должности с возможностью реализации лидерского потенциала.";
} elseif (($ach > $pow) and ($ach > $aff)) {
     echo "вас <b>мотивирует</b> <a id='motivac' href='html/help/motiv3.htm?width=600'  class='jTip'>«достижения»</a>:<br/> <i>рекомендуем</i> вам должности с возможностью карьерного роста.";
}    

echo "<br/></p></div>";
include $_SERVER['DOCUMENT_ROOT']."/html/recom.html";
echo "</div></div>"; 
?>