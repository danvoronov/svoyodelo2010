 	var otv = new Array();
 	var testMax; testPoz = 0;
  	var timetest = 0; testnm = 0;
	var timer = window.setInterval(function() {timetest = timetest +1;}, 1000*60);
	  
function makeJSONRequest(axaj_url, axaj_parameters) {
	$.ajax({
		url: axaj_url, data: axaj_parameters,
			  timeout: 4000, type: 'POST',
     			beforeSend: function(){
          			$.jGrowl('Соеденение с сайтом...');
          			$("#rd1").fadeOut('fast');
     			},
     		     error: function(){
        		  $.jGrowl('К сожалению, произошла ошибка связи!', { life: 1500, glue: 'before' });
     		},	
     		complete: function(){
          				$.jGrowl('Сохранено.');
     			},
   			success: function(data) { req = JSON.parse(data); 			    		  		  			  
                			if (req['state'] == 'end1') setTimeout('startTest2();', 500);
							else {
								if (req['state'] == 'ok1') { 	 
								for(elemName in req) $.form.set('testform',elemName,req[elemName]);			  
  								for(var i = 1 ; i <= 5 ; i++)  {
  									$( "#slider"+i ).slider( "option", "value", req['inp'+i] );
  									$("#nm"+i).text(req['nm'+i]);
  							$("#rd1").fadeIn('fast');
  	} }
  	else $.jGrowl(req['state']); 
  	}
  	}});	  				
}

function metal(file_from) {
           $("#metafora").dialog("open"); 
           $("#contentWrap").hide('fast').load("html/metafori/"+file_from+".html").fadeIn('slow');
}

function makebt(tstnm){
	for(var i = 1 ; i <= 3 ; i++)
		if (tstnm != i) 
			{$('#open_test'+i).button( "option", "disabled", true ); }
 		else 
 			{$('#open_test'+i).button( "option", "disabled", false ); }
}

function startTest2 () {		
			$("#dialog_test").dialog("close");
			 testPoz = 0; testnm = 2; makebt(testnm); testMax = 54;  	 
			$("#rd2").css("display","none"); $("#rd3").css("display","none"); $("#rd4").css("display","inline"); 
 			metal("alisa");		
};
	
	var test3usl = 'Теперь узнаем ради чего вы делаете то, что вы делаете.<br/><br/><center>Выбрать одно из двух утверждение, которое вам <b style="font-size: 110%">по внутренним ощущениям</b> ближе.</center>';		
	
function startTest3 () {		
 			$("#dialog_test2").dialog("close");
			 testPoz = 0; testnm = 3; makebt(testnm); testMax = 33; 	
			$("#rd2").css("display","none"); $("#rd3").css("display","none"); $("#rd4").css("display","inline"); 	
			$("#dialog_test2").dialog( "option", "title",  "Правила тестирования №3");			 	
        	 $("#uslovia").html(test3usl);       		 
 			metal("milton");     		  			 
};
function endTest3 () {		
 			$("#dialog_test2").dialog("close");			
 			for(var i = 1 ; i <= 3 ; i++) 
 				{$('#open_test'+i).button( "option", "disabled", true ); 
 				$('#open_test'+i).css( "color", "green");  }		
 			$("#nizblok_cont").load("html/metafori/prints.html");
 			$("#nizblok").fadeIn('slow');   		 	     		  			 
 };


$(function(){
 	  		$("#radioZdo").buttonset();   
 	  		$("#radioZdo").change(function() { 
 	  			$.ajax({
			url: 'ajax/zdorove.php', data: 'zd='+$('input[name=zdorov]:radio:checked').val(),
			timeout: 4000, type: 'POST',
     		beforeSend: function(){$.jGrowl('Сохранение анкеты: здоровье.');},
     	 	error: function(){ $.jGrowl('К сожалению, произошла ошибка связи!', { life: 1500, glue: 'before' });},	
   			success: function(data) { 
		            if (data.indexOf('zd_save') > 0) {
		            	$("#ZdoBlock").slideUp(); makebt(1);
		           		$.jGrowl('Анкета сохранена!');  
		           		setTimeout('$("#dialog_test").dialog("open")', 700);	           		
		            } else {
		            	$.jGrowl('Ошибка связи с сайтом.');  
		            	$("input[name=zdorov]:radio").removeAttr("checked");  $("#radioZdo").buttonset("refresh"); 
		            	}
 	  		}}) });
 	  		
  $('#starttest').button().click(function() { 			
 			testnm = 1; 	makebt(testnm); 	timetest = 0;  			
 			$("#rd1").css("display","inline"); $("#rd0").css("display","none"); 
 			$("#dialog_test").dialog( "option", "title",  "Тест 1. 20 утверждений о выборе профессии");	
 			makeJSONRequest('ajax/testing1.php'); 			
	});

 					 
  $('#start_test23').button().click(function() { 
   		testPoz = 1;      
   		$.jGrowl('Соединение с сайтом.');  
  		$.ajax({ url: 'ajax/testing'+testnm+'.php',  data: 'getpoz=1',
  		      error: function(){
        		  $.jGrowl('К сожалению, произошла ошибка связи с интернетом. Так мы не можем начать', { life: 1500, glue: 'before' });        	
     		},	
			  success: function(data) { 
			  		testPoz = parseInt(data); 
			  		timetest = 0;	prbar.progressbar(  "option", "value" , Math.round(testPoz*100/testMax));  	
					$("#dialog_test2").dialog( "option", "title",  " Вопрос номер "+testPoz+" из "+testMax);		  
			      	if (testnm == 2) 
			     		 {html0 = JSON.parse(vopr2[testPoz])[0]; html1 = JSON.parse(vopr2[testPoz])[1]}
			     		 else  {html0 = JSON.parse(vopr3[testPoz])[0]; html1 = JSON.parse(vopr3[testPoz])[1]}	     	  
			        $("#radio0_1_txt").html(html0);
			       	$("#radio1_1_txt").html(html1);  
			       	
			       $(":radio[name=radioTest]").removeAttr("checked");  $(":radio[name=radioTest2]").removeAttr("checked");  	
			       $("#rd4").hide(); 	$("#rd2").show('slide');	  	
			       $.jGrowl("Тестирование начато с "+testPoz+" вопроса.");  		  
			  }});	 			      	 		 	
  });
  		
	var prbar = $("#progressbar").progressbar();
	   		
  	$("#slider1").slider({			range: "min",			value: 1,min: 1,	max: 7,	step: 1,			slide: function(event, ui) {$("#inp1").val(ui.value);	}		});		$("#inp1").val($("#slider1").slider("value"));	$("#slider2").slider({			range: "min",			value: 1,min: 1,	max: 7,	step: 1,			slide: function(event, ui) {$("#inp2").val(ui.value);	}		});		$("#inp2").val($("#slider2").slider("value"));	$("#slider3").slider({			range: "min",			value: 1,min: 1,	max: 7,	step: 1,			slide: function(event, ui) {$("#inp3").val(ui.value);	}		});		$("#inp3").val($("#slider3").slider("value"));	$("#slider4").slider({			range: "min",			value: 1,min: 1,	max: 7,	step: 1,			slide: function(event, ui) {$("#inp4").val(ui.value);	}		});		$("#inp4").val($("#slider4").slider("value"));	$("#slider5").slider({			range: "min",			value: 1,min: 1,	max: 7,	step: 1,			slide: function(event, ui) {$("#inp5").val(ui.value);	}		});		$("#inp5").val($("#slider5").slider("value"));	
  		
  $("#dialog_test").dialog({
  modal: false,
  show: 'slide',
   width: 800,
  autoOpen: false, 
  position: [$(window).width()/2- 450,50], 
  buttons: {
      "Дальше": function() {
      		if (($("#inp1").val() != 0) && ($("#inp2").val() != 0) && ($("#inp3").val() != 0) && ($("#inp4").val() != 0) && ($("#inp5").val() != 0) && (testnm == 1)) {  			
      			$("#poz").val(parseInt($("#poz").val())+1);
 		   	 makeJSONRequest('ajax/testing1.php', 'p=p&json1='+$.form.get('testform'));
 		    }},
      "Назад": function() {
      		if (($("#inp1").val() != 0) && ($("#inp2").val() != 0) && ($("#inp3").val() != 0) && ($("#inp4").val() != 0) && ($("#inp5").val() != 0) && (testnm == 1)) {
      			$("#poz").val(parseInt($("#poz").val())-1);
 		   	 makeJSONRequest('ajax/testing1.php', 'm=m&json1='+$.form.get('testform'));
 }}} });

  $("#dialog_test2").dialog({  modal: false,    width: 700, height: 370,  autoOpen: false	});  
  $("#metafora").dialog({  modal: false, position: [$(window).width()/2- 350,100],   width: 700,  autoOpen: false,  buttons: {  "Прочитал": function() { $(this).dialog("close"); $("#dialog_test2").dialog("open"); } }	});
          
 
   $(".otvbut").click(function(){  $(this).fadeOut(650).fadeIn();
  			window.setTimeout(function() {  if (testPoz <= testMax) TogleDiv ();			}, 600);}); 	    


function TogleDiv () {	 
		if ($("#rd2").is(":hidden"))
			otv[testPoz] = $('input[name=radioTest2]:checked').val();	  
			else otv[testPoz] = $('input[name=radioTest]:checked').val();	  				
		
		if ((testPoz % 3 ==0) )
			$.ajax({
			  url: 'ajax/testing'+testnm+'.php',
			  data: 'nm='+testPoz+'&o1='+otv[testPoz-2]+'&o2='+otv[testPoz-1]+'&o3='+otv[testPoz],
			  timeout: 4000, type: 'POST',
     			beforeSend: function(){
          			$.jGrowl('Ответы '+(testPoz-2)+' '+(testPoz-1)+' '+testPoz+'. Сохраняем...');
     			},
     		     error: function(){
        		  $.jGrowl('К сожалению, произошла ошибка связи!', { life: 1500, glue: 'before' });
          		  $("#dialog_test2").dialog("close"); $("#rd3").css("display","none"); $("#rd4").css("display","inline"); 
     		},	
     			success: function(data) { req = JSON.parse(data);
			  			switch(req['state'] ) {
							case 'end2': startTest3();  $.jGrowl('Тест 2 пройден!');	 break;
							case 'end3': endTest3();  $.jGrowl('Тест 3 пройден!');	 break;
							default: $.jGrowl(req['state']);	
						}
			}});	 		

		testPoz = testPoz +1; 
		prbar.progressbar(  "option", "value" , Math.round(testPoz*100/testMax));  
		
		$("#dialog_test2").dialog( "option", "title",  " Заняло минут: "+timetest+". Вопрос номер "+testPoz+ " из "+testMax);		
		
		if ((testPoz == 37) &&  $("#dialog_test2").dialog( "isOpen")) { $("#contentWrap").load("html/metafori/ispolneniejelanii.html"); $("#metafora").dialog("open"); } 
     		 	   
     	if (testnm == 2) 
     		 {html0 = JSON.parse(vopr2[testPoz])[0]; html1 = JSON.parse(vopr2[testPoz])[1]}
     		 else  {html0 = JSON.parse(vopr3[testPoz])[0]; html1 = JSON.parse(vopr3[testPoz])[1]}
     		 	       		 						
      	 if ($("#rd3").is(":hidden")) {	
       		 	$("#radio0_2_txt").html(html0);
       		 	$("#radio1_2_txt").html(html1);      	 
      	 	$(":radio[name=radioTest2]").removeAttr("checked");  $("#rd2").hide();  $("#rd3").show('slide');   	  
      	 	}
       		 else {
        		$("#radio0_1_txt").html(html0);
       		 	$("#radio1_1_txt").html(html1);      		 	
       		$(":radio[name=radioTest]").removeAttr("checked"); 	$("#rd3").hide(); 	$("#rd2").show('slide');		
       		}					
       		   	     	       	 			    	 
}
});

        