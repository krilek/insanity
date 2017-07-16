// TODO: Przerobić kurwa ten zjebany kod
// TODO: DASZ RADĘ ZROBIĆ TO LEPIEJ...
// TODO: ALERT PRZED WYJSCIEM
var iloscPlikow = 0;
var LIMIT_PLIKOW = 6;
// TODO: MOŻE W PRZYSZŁOŚCI!!!
// var licznikInputow = 1;
// $("#zdjecia").on("click", function () {
//   $("#inputy").append('<input type="file" name="zdjecia[]" onchange="czaryMary(this)" cel="p' + licznikInputow + '>')
//   $("input[cel='p1']").trigger("click");

//   console.log("LOL");
// })
// FIXME:
// dodaj_ogloszenie.php:171 Uncaught ReferenceError: czaryMary is not defined
//     at HTMLInputElement.onchange (dodaj_ogloszenie.php:171)
// file_input.js?v=1498679804:34 Uncaught TypeError: Failed to execute 'readAsDataURL' on 'FileReader': parameter 1 is not of type 'Blob'.
//     at czaryMary (file_input.js?v=1498679804:34)
//     at HTMLInputElement.onchange (dodaj_ogloszenie.php:171)

// Uncaught TypeError: Failed to execute 'readAsDataURL' on 'FileReader': parameter 1 is not of type 'Blob'.
//     at czaryMary (file_input.js?v=1500107044:39)
//     at HTMLInputElement.onchange (dodaj_ogloszenie.php:178)\
function czaryMary(input) {
  var jq = $(input);
  var cel = $("#" + jq.attr("cel"));
  if (input.files) {
    var reader = new FileReader();
    reader.onload = function (e) {
      iloscPlikow++;
      aktualizujLabel(iloscPlikow);
      cel.html("");
      cel.append('<img class="img-thumbnail img-responsive" src="' + e.target.result + '" />');
      cel.append('<span class="glyphicon glyphicon-remove" onclick="usunZdjecie(this)"></span>');
      cel.show();
      jq.hide();
      if (iloscPlikow < LIMIT_PLIKOW) {
        stworzGrupe(iloscPlikow + 1);
      } else if (iloscPlikow >= LIMIT_PLIKOW) {
        $("span.btn-file").addClass("disabled");
      }
    }
    reader.readAsDataURL(input.files[0]);
  }
}

function stworzGrupe(numer) {
  if ($("input[cel=p" + numer + "]").length < 1) {
    $("#inputy").append('<input type="file" name="zdjecia[]" accept="image/jpeg, image/png" onchange="czaryMary(this)" cel="p' + numer + '">');
    $("#podglad").append('<div id="p' + numer + '" class="oboksiebie"></div>');

  }
}

function aktualizujLabel(ilosc) {
  var spiewakowska = "zdjęcie";
  if (ilosc == 1) spiewakowska = "zdjęcie";
  else if (ilosc > 1 && ilosc < 5) spiewakowska = "zdjęcia";
  else spiewakowska = "zdjęć";
  $("span.label.label-info").html("Dodano " + ilosc + " " + spiewakowska);
}

function usunZdjecie(element) {
  var div = $(element).parent();
  div.html("");
  var wartoscCel = div.attr("id");
  var input = $('input[cel=' + wartoscCel + ']');
  input.show();
  input.replaceWith(input.val('').clone(true));
  $("span.btn-file").removeClass("disabled");
  iloscPlikow--;
  aktualizujLabel(iloscPlikow);
}

// var typOferty = function (radio) {
//   // }
//   // if (radio.val() == "sprzedaz") {
// }
var typOferty = function (wartosc) {
  console.log(wartosc);
  if (wartosc == 1)
    $("#cena").removeAttr('disabled');
  else
    $("#cena").attr("disabled", "disabled");

}
$(document).ready(function () {
  var radia = document.getElementById("dodajOgloszenie").elements.typ;
  console.log(radia);
  for (var i = 0; i < radia.length; i++) {
    console.log(radia[i]);
    if (radia[i].checked) {
      typOferty(radia[i].getAttribute("data-cena"));
    }
  }
  //FIXME: WCIŚNIĘCIE WSTECZ NIE WYŁĄCZA CENY JEŚLI BYŁ WYBÓR WCZEŚNIEJ
  $("input[type=radio]").on("change", function () {
    typOferty($(this).attr("data-cena"));
    // if ( == 1) {
    //   $("#cena").removeAttr('disabled');
    // } else {
    //   $("#cena").attr("disabled", "disabled");
    // }

    // typOferty($(this));
  });
  $("#cena").on("input", function (event) {
    var cena = $(this).val().replace(/\./g, ',');
    $(this).val(cena);
  });
  $("#cena").on("blur", function () {
    var cena = $(this).val();
    if (/^\d+([,]\d{1,2})?$/.test(cena)) {
      $("#cenaGrupa").removeClass("has-error");
    } else {
      $("#cenaGrupa").addClass("has-error");
    }
  })
});