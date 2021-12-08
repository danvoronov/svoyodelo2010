function getInitData() {  VK.Api.call('execute', {'code': 'return {me: API.getProfiles({uids: API.getVariable({key: 1280}), fields: "sex,bdate,photo_medium,city,country,nickname"})[0]};'}, onGetInitData); }

function onGetInitData(data) {
	$('#user_ank').slideUp(); $('#header_ank_msg').hide();       $('#userdata_contener').slideDown(); 
  var r;  if (data.response) {     
    r = data.response;
    if (r.me) {
  	  $("#name").val(r.me.first_name); 
   	  $("#fam").val(r.me.last_name);     
  	  if (r.me.bdate) {
  	  	$("#datepickerBirth").val(r.me.bdate);
    	$("#userbdate").html(r.me.bdate);  
    } else $("#userbdate").append($("#datepickerBirth"));
    
    $("#userfoto").attr("src", r.me.photo_medium); $("#usernic").html(r.me.nickname);
    $("#username").html(r.me.first_name);     $("#userfam").html(r.me.last_name);
   
    if (r.me.sex == 1)  $("#usersex").html('женский');    
    if (r.me.sex == 2)  $("#usersex").html('мужской'); 
    if (r.me.sex == 0)  $("#usersex").append($("#radioPol"));
      else $("#radioPol :radio[value='"+(r.me.sex-1)+"']").attr("checked","checked");
    $("#radioPol").buttonset("refresh"); 
     
     if (r.me.city != 0) 
     	VK.Api.call('getCities', {cids: r.me.city}, function(resp) {if(resp.response) { $("#usercity").html(resp.response[0].name);  $("#city").val(resp.response[0].name); }})
       else $("#usercity").append($("#city"));
       
	if (r.me.country != 0) VK.Api.call('getCountries', {cids: r.me.country}, function(resp) {if(resp.response) {   $("#usercountry").html(resp.response[0].name);  $("#contr").val(resp.response[0].name); }});              
       else $("#usercountry").append($("#contr"));
               
       
      $.jGrowl('Полученны данные пользователя vkontakte.ru/id' + r.me.uid);
        	  	$("#vkdatause").val(r.me.uid);
    }
} }


function logoutOpenAPI() {     
	$("#city1").append($("#city")); $("#contr1").append($("#contr"));
	$("#birth1").append($("#datepickerBirth"));
	$("#pol1").append($("#radioPol"));
	$('#userdata_contener').slideUp();   $('#user_ank').slideDown(); $('#header_ank_msg').show(); }

function doLogin() {  VK.Auth.login(); }
function doLogout() {   VK.Auth.logout(logoutOpenAPI); }

window.vkAsyncInit = function() {
        VK.Observer.subscribe('auth.login', function(response) {
          $.jGrowl('Авторизация vkontakte.ru.'); getInitData();
        });
        VK.init({
          apiId: 1867401,
          nameTransportPath: '/dop/xd_receiver.html'
        });
      };
      (function() {
        var el = document.createElement('script');
        el.type = 'text/javascript';
        el.src = 'http://vkontakte.ru/js/api/openapi.js';
        el.async = true;
        document.getElementById('vk_api_transport').appendChild(el);
      }());