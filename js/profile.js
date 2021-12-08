var devstv = true, lastnomer;
	  
function makeJSONRequest(axaj_url, axaj_parameters) {
	$.ajax({
		url: axaj_url, data: axaj_parameters,
			  timeout: 4000, type: 'POST',
     			beforeSend: function(){
          			$.form.set('dform','message','получаем данные: ждите...')
     			},
     		     error: function(){
     		               			$.form.set('dform','message','ошибка связи!');
        		  $.jGrowl('К сожалению, произошла ошибка связи!', { life: 1500, glue: 'before' });
     		},	
   			success: function(data) {
            	the_object = JSON.parse(data); devstv = true;
				for(elemName in the_object) $.form.set('dform',elemName,the_object[elemName]);			  
  					 	 $( "#sliderAch" ).slider( "option", "value", the_object['ach_req'] );
  					 	 $( "#sliderPow" ).slider( "option", "value", the_object['pow_req'] );
    					 $( "#sliderAff" ).slider( "option", "value", the_object['aff_req'] );
    					 $("#cel").buttonset("refresh" );			$("#predmet").buttonset("refresh" );	
						$("#uslovia").buttonset("refresh" ); 		$("#sredsto").buttonset("refresh" );
						$("#radioZdo").buttonset("refresh" );	
  	}});	 	
}
   

   
   
function load4base(nomer_in, kuda) {
	if ((devstv == false)  && !(confirm('Внесённые изменения не сохранены. Точно продолжить?'))) 
	{	document.getElementById('profid').value = lastnomer;}
   else {
		nomer = nomer_in+kuda;						 
		 if(nomer != 0)  {
			makeJSONRequest('ajax/prof.php', 'jsonload='+nomer, 'data_load');
			if ($("#edit-db").dialog("isOpen") == false) $('#edit-db').dialog('open');
				devstv = true; lastnomer = nomer;
			if ($("#profgramma").dialog("isOpen")) open_prgramma(nomer);
			document.getElementById('profid').value = nomer;
		}
  }
}

function open_prgramma(nomer){

	$.ajax({
		url: "ajax/prof.php", data: 'profid='+nomer,
			  timeout: 4000, type: 'POST',
     			beforeSend: function(){
          			$.jGrowl('Получаем данные.'); $("#profgramma_contiener").fadeOut('fast'); $("#profgramma_contiener").html('ждите...');
     			},
     		     error: function(){
        		  $.jGrowl('К сожалению, произошла ошибка связи!', { life: 1500, glue: 'before' });
     		},	
   			success: function(data) {    $("#profgramma_contiener").html(data); 
   					$("#profgramma_contiener").fadeIn();
  	}});	

	$(function(){ $("#profgramma").dialog("open"); });
};


/// modal dialog	
$(function() {	
		$(".dform").bind('click', function() {devstv = false;});
		$("#profid").unbind('click');

		$("#profgramma").dialog({width: 700, autoOpen: false, buttons: { "Закрыть (ESC)": function() { $(this).dialog("close"); },  	}  });  				  	
		$("#recom_dialog").dialog({width: 700, height: 520, autoOpen: false, modal: true, buttons: { "Согласен": function() { $(this).dialog("close"); },  	}  });  	
		
		$('#open_prof').button().click(function() {$("#prof_search").dialog("open");});
		$('#open_topprof').button().click(function() { $("#topprof").dialog("open");});			
		$('#open_print').button().click(function() {window.location.href = "print.php";});
						
		$('#db-prev')
			.button({icons: {primary: 'ui-icon-carat-1-w'},text: false})
			.click(function() {
				if (document.getElementById('profid').value > 2) 
					load4base(parseInt($('#profid').val()),-1);
			});
		$('#db-next')
			.button({icons: {primary: 'ui-icon-carat-1-e'},text: false})
			.click(function() {
				if (document.getElementById('profid').value < 2000)
					load4base(parseInt($('#profid').val()),1);
			});
		$('#db-refresh')
			.button({icons: {primary: 'ui-icon-arrowrefresh-1-s'},text: false})
			.click(function() {load4base(parseInt($('#profid').val()),0);});	
			
		$("#cel").buttonset();			$("#predmet").buttonset();	
		$("#uslovia").buttonset(); 		$("#sredsto").buttonset();
			$("#radioZdo").buttonset();
		
		$("#sliderPow").slider({
			range: "min",
			value: 1,min: 0,	max: 8,	step: 1,
			slide: function(event, ui) {
				$("#pow_req").val(ui.value); devstv = false;
			}
		});
		$("#pow_req").val($("#sliderPow").slider("value"));
		$("#sliderAff").slider({
			range: "min",
			value: 1,min: 0,	max: 8,	step: 1,
			slide: function(event, ui) {
				$("#aff_req").val(ui.value); devstv = false;
			}
		});
		$("#aff_req").val($("#sliderAff").slider("value"));
		$("#sliderAch").slider({
			range: "min",
			value: 1,min: 0,	max: 8,	step: 1,
			slide: function(event, ui) {
				$("#ach_req").val(ui.value); devstv = false;
			}
		});
		$("#ach_req").val($("#sliderAch").slider("value"));	
		
		$("#profsearch").Watermark("Ввести запрос и нажать Enter");
		$("#profsebt").button().click(function() { $('#infoId').hide('fast').load('ajax/prof.php?search_req='+decodeURI($('#profsearch').val())).fadeIn('slow'); });	
});