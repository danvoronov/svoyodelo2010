var id_login_wt = "Номер ID", kod_login_wt = "Код доступа";
		  
function makePOSTRequest(axaj_url, axaj_parameters, contener_id) {
	$.ajax({
		url: axaj_url, data: axaj_parameters,
			  timeout: 8000, type: 'POST',
     			beforeSend: function(){
      			document.getElementById(contener_id).innerHTML = "<b style='color: grey;'>Загрузка...</b>";
     			},
     		     error: function(){ $.jGrowl('К сожалению, произошла ошибка связи!', { life: 1500, glue: 'before' });},
     		complete: function(){ loadTimer=clearInterval(loadTimer);},
   			success: function(data) {
		            if (data.indexOf('Сохранено') > 0) {
		           		document.getElementById(contener_id).innerHTML = result;  
		           		setTimeout('window.location.reload();', 400);
		            }
		            else  document.getElementById(contener_id).innerHTML = data;       
  	}});	  		
}
   
function oplata(){ $("#pay_1").hide(); 	$("#pay_2").show('slide');}
function fillcode(kod_inp){   $("#kod").val(kod_inp);     $("#kupi_dialog").dialog("close");}
  
$(function() {
	$.datepicker.regional['ru'] = {
		closeText: 'Закрыть',	prevText: '&#x3c;Пред',	nextText: 'След&#x3e;',		currentText: 'Сегодня',
		monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь',
		'Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
		monthNamesShort: ['Янв','Фев','Мар','Апр','Май','Июн',
		'Июл','Авг','Сен','Окт','Ноя','Дек'],
		dayNames: ['воскресенье','понедельник','вторник','среда','четверг','пятница','суббота'],
		dayNamesShort: ['вск','пнд','втр','срд','чтв','птн','сбт'],
		dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
		weekHeader: 'Не',		dateFormat: 'dd.mm.yy',		firstDay: 1,		isRTL: false,
		showMonthAfterYear: false,		yearSuffix: ''};
	$.datepicker.setDefaults($.datepicker.regional['ru']);
		$("#datepickerBirth").datepicker({changeMonth: true, changeYear: true, yearRange: '1969:1999' } );
	
		var username = $("#name"), fam = $("#fam"),
			password = $("#kod"),
			birthdate = $("#datepickerBirth"),
			usercity = $("#city"), usercountry = $("#contr"),
			allFields = $([]).add(username).add(fam).add(password).add(birthdate).add(usercity).add(usercountry),
			tips = $(".validateTips");

		function updateTips(t) {
			tips.text(t).addClass('ui-state-highlight');
			setTimeout(function() {tips.removeClass('ui-state-highlight', 1500);}, 500);
			$.jGrowl(t);
		}
		function checkLength(o,n,min,max) {
			if ( o.val().length > max || o.val().length < min ) {
				o.addClass('ui-state-error');
				updateTips("Длина поля " + n + " должна быть между "+min+" и "+max+".");
				return false;
			} else {
				return true;
			}
		}
		function checkLengthKod() {
			if ( document.dialogform.kod.value.length != 30) {
				password.addClass('ui-state-error');
				updateTips("Забыли ввести ваш код доступа!");
				return false;
			} else {
				return true;
			}
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
					updateTips("Определитесь со своим полом.");
					return false; 
			     } 
		      }
		    }
		 return true; 
		}
		
		function checkRegexp(o,regexp,n) {
			if ( !( regexp.test( o.val() ) ) ) {
				o.addClass('ui-state-error');
				updateTips(n);
				return false;
			} else {
				return true;
			}
		}
		function checkRegexpKod() {
			if ( !( /^([0-9a-zA-Z])+$/.test( document.dialogform.kod.value ) ) ) {
				password.addClass('ui-state-error');
				updateTips("Код неправильный.");
				return false;
			} else {
				return true;
			}
		}		
		
		var polucenkod = false;
		
		$("#kupi_dialog").dialog({
			autoOpen: false, width: 400,
			modal: true,  
			buttons: {
				'Получить код доступа': function() {	
					if	($("#onlylu").val() == '') { $.jGrowl('Забыли ввести символы с картинки.');}
					else
						if (polucenkod == false)
							if ( /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i.test( $("#email").val() )) {
							$.jGrowl("Генерация кода для почтового адреса "+encodeURI($("#email").val()));
						$.ajax({
				url: 'ajax/mailcheck.php', data: 'mail='+encodeURI($("#email").val())+'&onlylu='+$("#onlylu").val(),
			  timeout: 8000, type: 'POST',
     		beforeSend: function(){$.jGrowl('Получаем ответ от сайта.'); },
     	 error: function(){ $.jGrowl('К сожалению, произошла ошибка связи!', { life: 1500, glue: 'before' });},	
   			success: function(data) { $('#pay_2').html(data);
   			if (data.indexOf('Код доступа') > 0) { polucenkod = true; 		           		setTimeout('$("#kupi_dialog").dialog("close");', 6000); }
  	}});	 
					} else $.jGrowl('Проверте правильность адреса почты.');
				},
				'Закрыть': function() {
					$(this).dialog('close');
				}
			}
		});
				
		var ankest = false;
		
		$("#dialog_form").dialog({
			autoOpen: dlopen, 
								width: 555,
			modal: true,  
			buttons: {
				'Cоздать аккаунт': function() { if (ankest == false) {
					var bValid = true;
					allFields.removeClass('ui-state-error');	

					bValid = bValid && checkLength(username,"имя",3,20);
					bValid = bValid && checkLength(fam,"фамилия",2,30);					
					bValid = bValid && checkLength(birthdate,"дата рождения",8,10);
						bValid = bValid && checkLength(usercountry,"страна",3, 99);
						bValid = bValid && checkLength(usercity,"город",2,99);					
					bValid = bValid && checkLengthKod();	
					bValid = bValid && checkFormRadios(document.forms["dialogform"]);		
					
					if ($("#vkdatause").val() == 0) {	
						bValid = bValid && checkRegexp(username,/^[А-ЯA-Z]([а-яa-z])+$/,"Ваше имя. Первая буква большая.");   
						bValid = bValid && checkRegexp(fam,/^[А-ЯA-Z]([а-яa-z])+$/,"Ваша фамилия. Первая буква большая.");	}
					bValid = bValid && checkRegexpKod();		

					if (bValid) {										
					    name_req = encodeURI(username.val()); fam_req = encodeURI(fam.val());				
							pol_req = $('input[name=pol]:radio:checked').val();		
							birthdate_req = encodeURI(birthdate.val());
							country_req = encodeURI(usercountry.val()); 
							city_req = encodeURI(usercity.val());
							kod_req = encodeURI(document.dialogform.kod.value);
							vk_req = $("#vkdatause").val();
							$.ajax({
				url: 'ajax/ankvalidator.php', data: 'n='+name_req+'&f='+fam_req+'&k='+kod_req+'&d='+birthdate_req+'&p='+pol_req+'&c='+country_req+'&g='+city_req+'&vk='+vk_req,
			  timeout: 8000, type: 'POST',
     		beforeSend: function(){$('#login_load').html("<b style='color: grey;'>Загрузка...</b>");},
     	 error: function(){ $.jGrowl('К сожалению, произошла ошибка связи!', { life: 1500, glue: 'before' });},	
     		complete: function(){ $.jGrowl('Сохранение анкеты: ответ получен.');},
   			success: function(data) { $('#login_load').html(data);
		            if (data.indexOf('Сохранено!') > 0) {
		           		$.jGrowl('Анкета сохранена!'); ankest = true;
		           		setTimeout('location.href = "index.php"', 2000);
		            }
    
  	}});	  									
			}
					}
				},
				'Отмена': function() {
					$(this).dialog('close');
				}
			},
			close: function() {
				allFields.removeClass('ui-state-error');
			}
		});

	
		  $("#usercontract").dialog({  modal: false,  width: 700, height: 400, autoOpen: false,  buttons: { "Закрыть": function() { $(this).dialog("close"); } }	});
		  
   $("#id_login").Watermark(id_login_wt);
   $("#kod_login_txt").val(kod_login_wt);
  $("#name").Watermark("Cлово, первая буква большая");
  $("#fam").Watermark("Cлово, первая буква большая");

$('#kod_login_txt').focus(function() {
    $('#kod_login_txt').hide();
    $('#kod_login').show();
    $('#kod_login').focus();
});
$('#kod_login').blur(function() {
    if($('#kod_login').val() == '') {
        $('#kod_login_txt').show();
        $('#kod_login').hide();
    }
});
    
    $("#logotxt").click(function() { 
    	$("#annotation").toggle("slow");
    	$("#alphaslider").toggle("slow");
    	$("#porafoot").toggle("slow");
    	$(".linkcopy").toggle("slow");
    	$('#oda').click();
    	 $('#slider .navigation')
    	   .parents('ul:first')
                .find('a')
                    .removeClass('selected')
                .end()
            .end()
            .addClass('selected');
    });
    
   $("#demo_login").click(function() {  $("#id_login").val('1000');
        $("#kod_login").val('pmKyMmrCvXUg2RROnFCC155josglyG');
		document.forms['login_form'].submit();});
	$("#kupi_but").click(function() { $('#kupi_dialog').dialog('open');});	
   
	$("#buzzbuttons").hover(function() { $(this).stop().animate({"opacity": "1"}, "slow"); },function() { $(this).stop().animate({"opacity": "0.8"}, "slow"); });
});

var textfooter = new Array( '<b>«СВОЁ ДЕЛО»</b><br/>— автоматическая, основаная на научных разработках психологии труда, система определения профессиональной направленности.<br/><br/>Целевая аудитория 1: школьники старших классов, которые выбирают своё будущее, ВУЗ и факультет.<br/>Целевая аудитория 2: люди, по тем или иным причинам, запутавшиеся в своей профессиональной самоидентичности. <br/><br/><b>Миссия проекта</b> создавать мир в котором каждый будет понимать и делать то, к чем предрасположен: находится на своем месте и заниматся своим делом. ', '<b>Дан Воронов</b> <a style="font-size: 22px; color: grey;" href="http://dan.kiev.ua/" target="_blank">dan.kiev.ua</a><br/>— руководитель проекта. Психолог, педагог, математик: дизайн визуализации данных с учетом психологических когнитивных характеристик, психология эффективных действий в бизнесе.<br/><br/><b>Хочешь быть с нами</b>  <a style="font-size: 22px; color: grey;" href="mailto:da@svoyodelo.com" >da@svoyodelo.com</a><br/>1. делая эту сайт-платформу ещё лучше. Необходимые компетенции: кодинг на PHP, javaScript (jQuery, jQuery UI) по технологиям ajax, html 5, css 3, vkontakte.ru API;<br/> 2. помогая школьным психологам узнать и полюбить «СВОЁ ДЕЛО». Необходимые компетенции: убедительность, привлекательность, мобильность.', '<b>Вы — школа</b>  <a style="font-size: 22px; color: grey;" href="mailto:shkolam@svoyodelo.com" >shkolam@svoyodelo.com</a><br/>тогда мы можем договориться о проведении вступительной лекции  «Значение профессиональной деятельности в жизни человека» и последующего массового тестирования учащихся 9-12 классов.<br/><br/><b>Вы — профконсультант</b>  <a style="font-size: 22px; color: grey;" href="mailto:konsultantam@svoyodelo.com" >konsultantam@svoyodelo.com</a><br/>тогда мы можем подсказать как повысить эффективность вашей работы. <br/><br/> Кроме того, создаем реестр профконсультантов основых больших городов. Наши пользователи смогут легко вас найти. ','<b>Работоспособность сайта</b>  <a style="font-size: 22px; color: grey;" href="mailto:techsupport@svoyodelo.com" >techsupport@svoyodelo.com</a> <br/><b>Деловые вопросы</b>  <a style="font-size: 22px; color: grey;" href="mailto:podelu@svoyodelo.com" >podelu@svoyodelo.com</a><br/>или собщение <br/>на <a href="skype:svoyodelo.com?chat">skype svoyodelo.com</a> <br/>на профиль  <a href="http://vkontakte.ru/mail.php?act=write&to=81994118" target="_blank">http://vkontakte.ru/svoyodelo</a>');
var pozfooter = new Array(210,346,517,687);

	function htmlst(idn){ 
		$("#infomenu a").css("border","0px").css("background-color","inherit");	
		$("#data_load").html(textfooter[idn]); 
		$("#fomenu"+idn).css("border","1px solid lightgrey").css("background-color","white");	
		$("#menutri").css("left",pozfooter[idn]+"px");	
	}
	function data_load_4arr(idnm) {
		setTimeout('htmlst('+idnm+');', 400);
		$("#data_load").slideUp(300).delay(200).slideDown(600); 	
	}
	
$(document).ready(function() {
	setTimeout('if  ( ($("#user_ank").css("display") != "none") && ($("#userdata_contener").css("display") != "none") ) $("#user_ank").hide();', 2000); $("#data_load").html(textfooter[0]); });