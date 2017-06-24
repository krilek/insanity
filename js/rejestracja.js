$("#login").blur(ajaxInfo);
$("#email").blur(ajaxInfo);


function ajaxInfo(){
  if($("#login").val().length>4 && $("#email").val().length > 5){
    $.post("rej.php", {
        tryb: "info",
        email: $("#email").val(),
        login: $("#login").val()
      },function(data, status){
        $("#ajax-info").html(data);
      });
  }
  // if($("#login").val().length > 4 && param=='login'){
  //   $.post("php/rej.php", {
  //     wartosc: $("#login").val(),
  //     tryb: 'info',
  //     tryb2: param
  //   },function(data, status){
  //     $("#ajax-info").html(data);
  //   });
  // }
  // if($("#email").val().length > 5 && param=='email'){
  //   $.post("php/rej.php", {
  //     wartosc: $("#email").val(),
  //     tryb: 'info',
  //     tryb2: param
  //   },function(data, status){
  //     $("#ajax-info").html(data);
  //   });
  // }
}
