<?php ?>
<style type="text/css" media="all">
	@import "css/jTip.css";
</style>	
<script src="js/jquery/jquery.jtip.js" type="text/javascript"></script>
<script src="js/jquery/tools.expose-1.0.5.min.js" type="text/javascript"></script>
<script src="js/profile.js"  type="text/javascript"></script>
<script type="text/javascript">
<!--
	function form_validation(){
		tips = $(".validateTips");
		function updateTips(t) {
			tips
				.text(t)
				.addClass('ui-state-highlight');
			setTimeout(function() {
				tips.removeClass('ui-state-highlight', 1500);
			}, 500);
		}

		function checkLength(o,n,min,max) {
			if ( o.val().length > max || o.val().length < min ) {
				updateTips("Длина поля " + n + " дложна быть между "+min+" и "+max+".");
				return false;
			} else return true;
		}
		
		function checkFormChbox(o,max) {
			if ( o.length == 0 || o.length > max ) {
				updateTips("Проверте что выбрано больше одного и меньше "+max+" вариантов.");
				return false;
			} else return true;
		}		
		
		function checkFormRadios(form)
		{
		 var el = form.elements; 
		 for(var i = 0 ; i < el.length ; ++i) { 
			  if(el[i].type == "radio") { 
			   var radiogroup = el[el[i].name]; // get the whole set of radio buttons. 
			   var itemchecked = false;    
				   for(var j = 0 ; j < radiogroup.length ; ++j) { 
				    if(radiogroup[j].checked) { 
						itemchecked = true; 
						break; 
					} 
			   	   } 
			   if(!itemchecked) { 
					updateTips("Забыли выбрать одну из характеристик.");
					return false; 
			     } 
		      }
		    }
		 return true; 
		}		
		
		function get_radio_value(fr)
		{
		for (var i=0; i < fr.length; i++)
		   {
		   if (fr[i].checked)
		      {
		      var rad_val = fr[i].value;
		      return rad_val;
		      }
		   }
		}

		function checkSum12(o,max) {
			if ((parseInt($( "#sliderAch" ).slider( "option", "value")) +	 parseInt($( "#sliderPow" ).slider( "option", "value") )+  parseInt($( "#sliderAff" ).slider( "option", "value"))) > 12) {
				updateTips("Сумма трех показателей мотивации должна быть меньше или равна 12.");
				return false;
			} else return true;
		}		
		
					var bValid = true;
						 
					bValid = bValid && checkSum12();
					bValid = bValid && checkFormChbox($('#predmet :checked'),3);
					bValid = bValid && checkFormChbox($('#cel :checked'),2);					
					bValid = bValid && checkFormChbox($('#sredsto :checked'),2);	
					bValid = bValid && checkFormChbox($('#uslovia :checked'),2);						
					bValid = bValid && checkLength($("#soderj"),"краткое описание",20,10000);
					bValid = bValid && checkFormRadios(document.forms["dform"]);
									
					if (bValid) {	 
						$("#comments").val('');
						<?	 if (($unic == 777) or ($unic == 888)) { ?>
								makeJSONRequest('ajax/prof.php', 'json='+$.form.get('dform'));																	devstv = true;
								setTimeout("$('#db-next').click();", 300);								
						<? } else echo '$("#confirm").dialog("open");'; ?>
					 }
}	

	
$(function() {
	$("#profid").keypress(function (e){
	  if( e.which!=13 && e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))  {
	    //display error message
	    $("#errmsg").html("цифры!").show().fadeOut("slow");
	    return false;
	  }
	  if((parseInt(document.getElementById('profid').value) > <?	$handle = @mysql_query("SELECT MAX(id) FROM  `proft_profdb_max`"); $ar = mysql_fetch_array($handle); echo $ar['MAX(id)']; 	?>))  {
	    //display error message
	    $("#errmsg").html("много!").show().fadeOut("slow");
	    return false;
	  }
	  if((parseInt(document.getElementById('profid').value) == 0))  {
	    //display error message
	    $("#errmsg").html("не 0!").show().fadeOut("slow");
	    return false;
	  }
	});
	
	<?	 echo $profarr; ?>
function load_top_prof(from) {
		$.jGrowl('Получаем данные профессий.'); color = false;
			for (i = 0; i < 5; i++) { $('#loadnm'+i).text("");		$('#load'+i).text(""); 
				if ((from+i) < profnm.length) {
					$('#loadnm'+i).html((from+i+1)+':');
					$('#load'+i).hide('fast').load("ajax/prof.php?profn="+profnm[from+i], function(){JT_init();}).fadeIn('slow');	   
					if ((from+i+1) == 100) $('#loadnm'+i).css("margin-left","0px");		 	
				}}	
}			
  
		 $("#slider_tp").slider({animate: true,	value: 0,min: 0,	max: parseInt((profnm.length-1)/5),	step: 1, slide: function(event, ui) { load_top_prof(ui.value*5);}		});	
		   				
		$("#topprof").dialog({width: 850, position: [80, 'center'], autoOpen: false, buttons: { "Закрыть (ESC)": function() { $(this).dialog("close"); },  	},  open: function(event, ui) { load_top_prof( $( "#slider_tp" ).slider( "option", "value") *5);   }, dragStop: function(event, ui) { if (ui.offset.top < 14) {$(this).dialog( "option" , "position" , [$(this).dialog( "option", "position" )[0],26] ); }  }   });  
				
		$('#leftprof')
			.button()
			.click(function() {
				if ( $( "#slider_tp" ).slider( "option", "value")  > 0) {
				     $( "#slider_tp" ).slider( "option", "value", $( "#slider_tp" ).slider( "option", "value") -1);
					load_top_prof( $( "#slider_tp" ).slider( "option", "value") *5);
				} else $.jGrowl('Достигнут конец.');
			});
		$('#rightprof')
			.button()
			.click(function() {
				if (( $( "#slider_tp" ).slider( "option", "value") +1)*5 < profnm.length) {
				     $( "#slider_tp" ).slider( "option", "value", $( "#slider_tp" ).slider( "option", "value") +1);
					load_top_prof( $( "#slider_tp" ).slider( "option", "value") *5);
				} else $.jGrowl('Достигнут конец.');
			});
							 
	<?	 if (($unic == 777) or ($unic == 888)) { ?>
		$("#moderation").dialog({width: 700, autoOpen: false, buttons: { "Закрыть (ESC)": function() { $(this).dialog("close"); }}, open: function() {$('#moder_contener').load('ajax/moderator.php');}, dragStop: function(event, ui) { if (ui.offset.top < 14) {$(this).dialog( "option" , "position" , [$(this).dialog( "option", "position" )[0],26] ); }  }    });
	<? } ?>
			
		$("#prof_search").dialog({width: 760, autoOpen: false, buttons: { "Закрыть (ESC)": function() { $(this).dialog("close"); }}, dragStop: function(event, ui) { if (ui.offset.top < 14) {$(this).dialog( "option" , "position" , [$(this).dialog( "option", "position" )[0],26] ); }  }    });
		
	$("#welcome").dialog({width: 600, modal: true, draggable: false, autoOpen: <?	if (($row['used']  == 2) and ($row_from_testtime['profession']  ==0)) echo "true"; else echo "false";  ?>, buttons: { "Начинаем": function() { $(this).dialog("close"); $("#topprof").dialog("open"); }, }   });	 
		  
	$("#confirm").dialog({
			autoOpen: false,
			height: 300,
			width: 310,
			draggable: false,
			modal: true,
			buttons: {
				'Отправить': function() {
								      	makeJSONRequest('ajax/prof.php', 'json='+$.form.get('dform'));	
						$("#topprof").dialog("close"); 				        $(this).dialog("close");				
	<?	 if (($unic != 777) and ($unic != 888)) echo '$("#edit-db").dialog("close"); ';?>	
				},			
			},
		});	

		$("#edit-db").dialog({
			autoOpen: false, 
			width: 870,
			buttons: { <?	 if (($unic == 777) or ($unic == 888)) echo "'Сохранить'"; else echo "'Послать на проверку как должно быть'"; ?>
				: function() {form_validation();	},
				'Отмена (ESC)': function() {
					$(this).dialog('close');
				}
			}, dragStop: function(event, ui) { if (ui.offset.top < 14) {$(this).dialog( "option" , "position" , [$(this).dialog( "option", "position" )[0],26] ); }  }
		});		

	$("#bar_predmet_hover").hover(function() {
		$("#bar_predmet.graphic2").slideToggle();
		$("#bar_predmet.graphic").slideUp();		
	}, function() {
		$("#bar_predmet.graphic").slideToggle();
		$("#bar_predmet.graphic2").slideUp();		
	});

	$("#bar_cel_hover").hover(function() {
		$("#bar_cel.graphic2").slideToggle();
		$("#bar_cel.graphic").slideUp();		
	}, function() {
		$("#bar_cel.graphic").slideToggle();
		$("#bar_cel.graphic2").slideUp();		
	});

	$("#bar_3_hover").hover(function() {
		$("#bar_3.graphic2").slideToggle();
		$("#bar_3.graphic").slideUp();		
	}, function() {
		$("#bar_3.graphic").slideToggle();
		$("#bar_3.graphic2").slideUp();		
	});
	
	$("#bar_4_hover").hover(function() {
		$("#bar_4.graphic2").slideToggle();
		$("#bar_4.graphic").slideUp();		
	},function() {
		$("#bar_4.graphic").slideToggle();
		$("#bar_4.graphic2").slideUp();		
	});			
	
	$("#bar_motiv_hover").hover(function() {
		$("#bar_motiv.graphic2").slideToggle();
		$("#bar_motiv.graphic").slideUp();		
	},function() {
		$("#bar_motiv.graphic").slideToggle();
		$("#bar_motiv.graphic2").slideUp();		
	});	

});

function equalHeight(group) {
  tallest = 0;
  group.each(function() {
    thisHeight = $(this).height();
    if(thisHeight > tallest) {
      tallest = thisHeight;
    }
  });
  group.height(tallest);
}

var showingexp;

$(document).ready(function() {
  equalHeight($(".bloki"));
    
    $("div.bloki1").click(function() { 
       $(this).expose({loadSpeed:'normal', color: '#2a4977', onLoad: function(event) { $("#hdr1").html('на что направлена деятельность');    }, onClose: function(event) {   $("#hdr1").html('');    } }).load();  
       
    });  	
    $("div.bloki2").click(function() { 
       $(this).expose({loadSpeed:'normal', color: '#50c878', onLoad: function(event) {     $("#hdr2").html('к чему человек стремится');  }, onClose: function(event) {   $("#hdr2").html('');     } }).load();  
    });
    $("div.bloki3").click(function() { 
      $(this).expose({loadSpeed:'normal', color: '#C48793', onLoad: function(event) {   $("#hdr3").html('чем воздействует на предмет'); }, onClose: function(event) { $("#hdr3").html('');      } }).load();  
    });
    $("div.bloki4").click(function() { 
       $(this).expose({loadSpeed:'normal', color: '#F88017', onLoad: function(event) {   $("#hdr4").html('где находится во время работы');  }, onClose: function(event) { $("#hdr4").html('');      } }).load();  
    });
});

function profvibor(nomer) {
			if (confirm('Подтверждаете изменение своей профессии?')) { 
				makePOSTRequest('ajax/prof.php','vibor='+nomer, 'prof_name');
				$("#topprof").dialog("close"); 	$("#prof_search").dialog("close");
				$("#infoId").text('');
				if (nomer == 0) $('#open_print').button({ disabled: true } );
					else  $('#open_print').button({ disabled: false } );
			}			 
		}
		
	<?	 if (($unic == 777) or ($unic == 888)) { ?>		
function modertoryes(id){if (confirm('Точно перезаписать базу?')) $('#moder_contener').load('ajax/moderator.php?yes='+id);}
function modertorno(id){$('#moder_contener').load('ajax/moderator.php?no='+id);}
	<? } ?>			
 -->
</script> 