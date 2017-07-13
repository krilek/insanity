var step = 100;
var scrolling = false;

$("#lewo").bind("click", function (event) {
  event.preventDefault();
  $("#zdjecia").animate({
    scrollLeft: "-=" + step + "px"
  });
});


$("#prawo").bind("click", function (event) {
  event.preventDefault();
  $("#zdjecia").animate({
    scrollLeft: "+=" + step + "px"
  });
});

function scrollContent(direction) {
  var amount = (direction === "up" ? "-=1px" : "+=1px");
  $("#zdjecia").animate({
    scrollTop: amount
  }, 1, function () {
    if (scrolling) {
      scrollContent(direction);
    }
  });
}