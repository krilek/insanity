$("#login").blur(function (){ajaxInfo('login');});
$("#email").blur(function (){ajaxInfo('email');});


function ajaxInfo(param){

  if($("#login").val().length > 4 && param=='login'){
    $.post("php/rej.php", {
      wartosc: $("#login").val(),
      tryb: 'info',
      tryb2: param
    },function(data, status){
      $("#ajax-info").html(data);
    });
  }
  if($("#email").val().length > 5 && param=='email'){
    $.post("php/rej.php", {
      wartosc: $("#email").val(),
      tryb: 'info',
      tryb2: param
    },function(data, status){
      $("#ajax-info").html(data);
    });
  }
}
